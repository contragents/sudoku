<?php

namespace classes;

class Helper
{
    public static function paramFilter(array $request, array $paramsMask, bool $keepOtherParams = false): array
    {
        $result = [];

        foreach ($paramsMask as $newParam => $requestParam) {
            if (isset($request[$requestParam])) {
                $result[$newParam] = $request[$requestParam];
                unset($request[$requestParam]);
            }
        }

        if ($keepOtherParams) {
            $result = array_merge($result, $request);
        }

        return $result;
    }
}
