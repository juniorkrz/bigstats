<?php

namespace App\util;

use App\model\InstagramAccount;
use App\model\InstagramUser;
use RuntimeException;

class InstagramAPI
{
    private $cookie;
    private ?InstagramAccount $account;
    private ?string $username;
    private string $baseUrl = "https://i.instagram.com/api/v1/users/web_profile_info/";
    private int $timeout = 10;

    public function __construct() {
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

        if (!empty($error)) {
            echo var_export($error, true) . PHP_EOL;
            echo var_export($response, true) . PHP_EOL;
            echo var_export($httpCode, true) . PHP_EOL;
        }

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

        if ($httpCode !== 200) {
            $ds_user_id = $this->account->ds_user_id;
            $username = $this->account->username;

            /* marca a conta como rate_limited */
            $this->account->rate_limited = true;
            $repAccount->update($this->account);

            throw new RuntimeException("Erro HTTP: Código $httpCode | username: $username | ds_user_id: $ds_user_id | response: $response");
        }

        return $response;
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
