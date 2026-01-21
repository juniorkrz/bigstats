<?php

namespace App\util;

class Security
{
    private static function getKey()
    {
        return $_ENV['PW_ENCRYPTION_KEY'];
    }

    public static function encrypt(string $data): string
    {
        $key = self::getKey();
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($ivLength);

        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);

        // Retorna o IV + Dado encriptado (codificado em base64 para o banco)
        return base64_encode($iv . $encrypted);
    }

    public static function decrypt(string $data): string
    {
        $key = self::getKey();
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');

        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);

        return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
    }
}
