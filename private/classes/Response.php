<?php

namespace classes;

use BaseController as BC;

class Response
{
    public static function jsonResp(array $response, ?Game $game = null, bool $forceUnlock = false): string
    {
        return json_encode($response + ($game === null ? [] : self::enrichResponse($game)), JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
    }

    public static function jsonObjectResp(object $response): string
    {
        return json_encode($response, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
    }

    public static function state(string $playerStatus): array
    {
        return [BC::GAME_STATE_PARAM => $playerStatus];
    }

    private static function enrichResponse(Game $game): array
    {
        $res = [];

        try {
            $playerStatus = $game->SM::getPlayerStatus($game->User);

            foreach ($game::RESPONSE_PARAMS as $param => $path) {
                // Проверим по массиву исключений, обрабатывать ли этот параметр при данном статусе
                if (isset($game::EXCLUDED_PARAMS[$playerStatus]) && in_array($param, $game::EXCLUDED_PARAMS[$playerStatus])){
                    continue;
                }

                if($param === $game::SPECIAL_PARAMS) {
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

            if ($playerStatus == $game->SM::STATE_GAME_RESULTS && isset($game->gameStatus->invite)) {
                $inviteParams = $game->processInvites();

                // Добавляем к комментам игры комменты состояния приглашения
                $res['comments'] = ($res['comments'] ?? '') . ($inviteParams['comments'] ?? '');
                unset($inviteParams['comments']);

                // Добавляем остальные параметры состояния приглашения к ответу
                $res += $inviteParams;
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