<?php

namespace lib;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token
{
    public static function create($platform)
    {
        // Chave secreta (nunca compartilhe esta chave)
        $secret_key = IsConfig::env("SECRET_KEY");
        $issuer = IsConfig::env("DOMINE"); // Emissor do token (pode ser seu domínio)
        $audience = "platforms"; // Público do token
        $issued_at = time(); // Tempo em que o token foi gerado
        $expiration_time = $issued_at + 7776000; // Token válido por 90 dias

        // Dados que você deseja incluir no token
        $payload = array(
            "iss" => $issuer,
            "aud" => $audience,
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "data" => array(
                "platform" => $platform
            )
        );

        // Gerar o token JWT
        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        return [
            "status" => true,
            "token" => $jwt
        ];
    }

    public static function isValid($token)
    {
        $secret_key = IsConfig::env("SECRET_KEY");
        try {
            // Decodificar o token JWT
            $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));

            // Se o token for válido, acessar os dados do usuário
            return array(
                "status" => true,
                "response" => $decoded->data
            );
        } catch (Exception $e) {
            // Se o token for inválido ou expirado, retornar erro
            return array(
                "status" => false,
                "response" => "Token inválido ou expirado: " . $e->getMessage()
            );
        }
    }
}
