<?php

namespace MingyuKim\PhpFunctions;

class StringClass
{
    /**
     * @param string $camelTypeString
     * @return string
     * @description 카멜 형식의 스트링을 스네이크 형식으로 치환하는 함수
     */
    public function camelToSnake(string $camelTypeString): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $camelTypeString));
    }

    /**
     * @param string $snakeTypeString
     * @return string
     * @description 스네이크 형식의 스트링을 카멜 형식으로 치환하는 함수
     */
    public function snakeToCamel(string $snakeTypeString): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $snakeTypeString))));
    }

    /**
     * @param string $targetString
     * @param string $beforeString
     * @param bool $isNullable
     * @return string|null
     * @description targetString 에서 beforeString 문자열을 찾아 그 후의 문자열을 반환.
     */
    public function getAfterString(string $targetString, string $beforeString, bool $isNullable = false): ?string
    {
        $position = strpos($targetString, $beforeString);

        if ($position !== false) {
            // $beforeString 이후의 문자열 반환
            return substr($targetString, $position + strlen($beforeString));
        }

        return $isNullable ? null : $targetString;
    }

    /**
     * @param string $targetString
     * @param string $afterString
     * @param bool $isNullable
     * @return string|null
     * @description targetString 에서 beforeString 문자열을 찾아 그 후의 문자열을 반환.
     */
    public function getBeforeString(string $targetString, string $afterString, bool $isNullable = false): ?string
    {
        $position = strpos($targetString, $afterString);

        if ($position !== false) {
            // $afterString 이전의 문자열 반환
            return substr($targetString, 0, $position);
        }

        return $isNullable ? null : $targetString;
    }
}