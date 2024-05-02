<?php


namespace classes;


class Response
{
    public static function jsonResp(array $response): string
    {
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public static function state(string $playerStatus): array
    {
        return ['gameState' => $playerStatus];
    }
}