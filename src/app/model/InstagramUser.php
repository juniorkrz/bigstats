<?php

namespace App\model;

class InstagramUser
{
    public $instagram_id;
    public $username;
    public $full_name;
    public $biography;
    public $followers_count;
    public $profile_picture_url;
    public $profile_pic_base64;
    public $created_at;
    public $updated_at;

    public function __construct(
        $instagram_id = null,
        $username = null,
        $full_name = null,
        $biography = null,
        $followers_count = null,
        $profile_picture_url = null,
        $profile_pic_base64 = null,
        $created_at = null,
        $updated_at = null
    ) {
        $this->instagram_id = $instagram_id;
        $this->username = $username;
        $this->full_name = $full_name;
        $this->biography = $biography;
        $this->followers_count = $followers_count;
        $this->profile_picture_url = $profile_picture_url;
        $this->profile_pic_base64 = $profile_pic_base64;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // Método estático para criar a instância da classe com os dados do resultado da API
    public static function fromApiResponse(object $data): self
    {
        // Obtendo a URL da imagem
        $profilePicUrl = $data->user->profile_pic_url_hd;

        // Codificando a imagem em base64
        $profilePicBase64 = self::getImageBase64($profilePicUrl);

        return new self(
            $data->user->id,
            $data->user->username,
            $data->user->full_name,
            $data->user->biography,
            $data->user->edge_followed_by->count,
            $profilePicUrl,
            $profilePicBase64,
            null,
            date('Y-m-d H:i:s')
        );
    }

    public function getTableName()
    {
        return 'instagram_user';
    }

    public function getPk()
    {
        return 'instagram_id';
    }

    // Função auxiliar para pegar a imagem e codificar em base64
    private static function getImageBase64(string $url): string
    {
        // Baixando a imagem da URL
        $imageData = file_get_contents($url);

        // Convertendo a imagem para base64
        return base64_encode($imageData);
    }
}
