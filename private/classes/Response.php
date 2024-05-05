<?php


namespace classes;


class Response
{
    public static function jsonResp(array $response, Game $game = null): string
    {
        return json_encode($response + ($game === null ? [] : self::enrichResponse($game)), JSON_UNESCAPED_UNICODE);
    }

    public static function state(string $playerStatus): array
    {
        return ['gameState' => $playerStatus];
    }

    private static function enrichResponse(Game $game): array
    {
        $res = [];
        /*+ ($gameStatus->desk !== null ? ['desk' => $gameStatus->desk->desk] : [])
        + ['game_number' => $gameStatus->gameNumber];*/

        foreach($game::RESPONSE_PARAMS as $param => $path) {
            $paramValue = self::getParamValue($game, $path);
            $res += $paramValue !== null
                ? [$param => $paramValue]
                : [];
        }

        return $res;
    }

    private static function getParamValue(object $someObject, $path)
    {
        if (is_array($path)) {
            $subObject = array_keys($path)[0];
            $subPath = current($path);

            return $someObject->$subObject !== null
                ? self::getParamValue($someObject->$subObject, $subPath)
                : null;
        } else {
            return $someObject->$path;
        }
    }
}