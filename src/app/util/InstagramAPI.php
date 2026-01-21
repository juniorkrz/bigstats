<?php

namespace App\util;

use App\model\InstagramAccount;
use App\model\InstagramCookie;
use App\model\InstagramUser;
use RuntimeException;

class InstagramAPI
{
    private $cookie;
    private ?InstagramAccount $account;
    private ?string $username;
    private string $baseUrl = "https://i.instagram.com/api/v1/users/web_profile_info/";
    private int $timeout = 10;

    public function __construct()
    {
        $this->account = null;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getApiUser()
    {
        return $this->account;
    }

    public function setCookie(): string
    {
        $rep_instagram_account = new Repository(InstagramAccount::class);
        $rep_instagram_account->findOne('WHERE rate_limited = 0 ORDER BY updated_at ASC, uses ASC');
        $this->account = $rep_instagram_account->getFirst();

        if ($this->account === null) {
            throw new RuntimeException("Nenhuma conta disponível.");
        }

        $this->cookie = $this->account->getCookies();
        return $this->cookie;
    }

    // Função para fazer a requisição à API
    private function request(): string
    {
        // Seta o cookie da conta menos utilizada
        $this->setCookie();

        $curl = curl_init();

        // Prepara a URL com o nome de usuário
        $url = sprintf("%s?username=%s", $this->baseUrl, urlencode($this->username));

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'User-Agent: Mozilla/5.0 (Linux; Android 9; GM1903 Build/PKQ1.190110.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/75.0.3770.143 Mobile Safari/537.36 Instagram 103.1.0.15.119 Android (28/9; 420dpi; 1080x2260; OnePlus; GM1903; OnePlus7; qcom; sv_SE; 164094539)',
                'Cookie: ' . $this->cookie,
            )
        ]);

        // Executa a requisição
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        // Atualiza o uso da conta
        $repAccount = new Repository(InstagramAccount::class);
        $this->account->uses += 1;
        $this->account->updated_at = date('Y-m-d H:i:s');
        $repAccount->update($this->account);

        // Tratamento de erros
        if ($error) {
            throw new RuntimeException("Erro de cURL: $error");
        }

        // tenta decodificar para checar require_login
        $result = json_decode($response);

        if (isset($result->require_login) && $result->require_login === true) {

            // tenta renovar cookie
            if ($this->login()) {
                // refaz request com cookie novo
                return $this->request();
            }

            // falhou login → desabilita a conta
            $this->account->rate_limited = true;
            $repAccount->update($this->account);

            throw new RuntimeException("Conta {$this->account->username} exige login e não conseguiu renovar sessão.");
        }

        if ($httpCode !== 200) {

            // falhou a requisição → desabilita a conta
            $this->account->rate_limited = true;
            $repAccount->update($this->account);

            $username = $this->account->username;
            $ds_user_id = $this->account->ds_user_id;
            throw new RuntimeException("Erro HTTP: Código $httpCode | username: $username | ds_user_id: $ds_user_id | response: $response");
        }

        return $response;
    }

    private function login(): bool
    {
        if (!$this->account || !$this->account->username || !$this->account->password) {
            return false;
        }

        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36';

        // --- PASSO 1: Obter o CSRF Token inicial ---
        $ch = curl_init("https://www.instagram.com/accounts/login/");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_USERAGENT => $userAgent,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => $this->timeout
        ]);
        $response = curl_exec($ch);

        // Extrai o csrftoken dos cookies da resposta
        preg_match('/csrftoken=([^;]+)/', $response, $matches);
        $csrfToken = $matches[1] ?? null;
        curl_close($ch);

        if (!$csrfToken) {
            // Se não encontrar, o Instagram pode estar bloqueando o IP ou mudou a estrutura
            return false;
        }

        // --- PASSO 2: Realizar o Login Real ---
        $loginUrl = "https://www.instagram.com/accounts/login/ajax/";
        $ch = curl_init($loginUrl);

        // Decodifica a senha do banco usando a key do ENV
        $plainPassword = Security::decrypt($this->account->password);

        $postData = [
            'username' => $this->account->username,
            'enc_password' => "#PWD_INSTAGRAM_BROWSER:0:" . time() . ":" . $plainPassword,
            'queryParams' => "{}",
            'optIntoOneTap' => 'false'
        ];

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'User-Agent: ' . $userAgent,
                'X-Requested-With: XMLHttpRequest',
                'Referer: https://www.instagram.com/accounts/login/',
                "X-CSRFToken: $csrfToken", // Agora enviamos o token real obtido
                "Cookie: csrftoken=$csrfToken" // O token também deve estar no Cookie
            ]
        ]);

        $response = curl_exec($ch);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);
        curl_close($ch);

        $result = json_decode($body);

        if (isset($result->authenticated) && $result->authenticated === true) {

            // 1. Extrair cookies do Header
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
            $cookiesFound = $matches[1] ?? [];

            if (empty($cookiesFound)) {
                return false;
            }

            // 2. Limpar cookies antigos no banco para esta conta
            $repCookie = new Repository(InstagramCookie::class);
            $oldCookies = $repCookie->findAll("WHERE instagram_account_id = {$this->account->id}");
            $repCookie->deleteAll();

            // 3. Salvar os novos cookies
            foreach ($cookiesFound as $cookieStr) {
                $parts = explode('=', $cookieStr, 2);
                if (count($parts) === 2) {
                    $newCookie = new InstagramCookie();
                    $newCookie->instagram_account_id = $this->account->id;
                    $newCookie->name = $parts[0];
                    $newCookie->value = $parts[1];
                    $repCookie->save($newCookie);
                }
            }

            // 4. Resetar status de rate limit da conta
            $repAccount = new Repository(InstagramAccount::class);
            $this->account->rate_limited = false;
            $this->account->updated_at = date('Y-m-d H:i:s');
            $repAccount->update($this->account);

            return true;
        }

        return false;
    }

    // Função para processar e retornar os dados do usuário
    public function getUserData($username): InstagramUser
    {
        $this->setUsername($username);

        $response = $this->request();

        // Decodifica a resposta JSON
        $result = json_decode($response);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException("Erro ao decodificar JSON: " . json_last_error_msg());
        }

        // Verifica se a resposta contém os dados do usuário
        if (!isset($result->data->user)) {
            throw new RuntimeException("Usuário não encontrado ou dados inválidos na resposta.");
        }

        // Cria e retorna o objeto InstagramUser
        return InstagramUser::fromApiResponse($result->data);
    }
}
