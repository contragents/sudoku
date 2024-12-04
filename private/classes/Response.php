<?php

namespace classes;

use BaseController;

class Response
{
    public static function jsonResp(array $response, ?Game $game = null, bool $forceUnlock = false): string
    {
        // __destruct() отрабатывает - пока force не нужен
        if ($forceUnlock) {
            //BaseController::saveGameStatus();
            //Cache::unlockAll();
        }

        return json_encode($response + ($game === null ? [] : self::enrichResponse($game)), JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
    }

    public static function jsonObjectResp(object $response): string
    {
        return json_encode($response, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
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
        try {
            foreach ($game::RESPONSE_PARAMS as $param => $path) {
                $paramValue = self::getParamValue($game, $path);
                $res += $paramValue !== null
                    ? [$param => $paramValue]
                    : [];
            }
        } catch(\Throwable $e) {
            $res['error'] = $e->__toString();
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