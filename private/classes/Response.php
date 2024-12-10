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

        try {
            foreach ($game::RESPONSE_PARAMS as $param => $path) {
                if($param === $game::SPECIAL_PARAMS) {
                    $playerStatus = $game->SM::getPlayerStatus($game->User);
                    foreach($path as $status => $statusParams) {
                        if ($status === $playerStatus) {
                            foreach ($statusParams as $param => $path) {
                                $paramValue = self::getParamValue($game, $path);
                                $res += $paramValue !== null
                                    ? [$param => $paramValue]
                                    : [];
                            }
                        }
                    }

                    continue;
                }
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

    /**
     * @param object $someObject
     * @param $path
     * @return string|int|array|null
     */
    private static function getParamValue(object $someObject, $path)
    {
        if (is_array($path)) {
            $subObject = array_keys($path)[0];
            $subPath = current($path);

            return $someObject->$subObject !== null
                ? self::getParamValue($someObject->$subObject, $subPath)
                : null;
        } elseif (is_callable([$someObject, $path])) {
            return $someObject->$path();
        } else {
            return $someObject->$path;
        }
    }
}