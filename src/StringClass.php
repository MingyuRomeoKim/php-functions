<?php

namespace MingyuKim\PhpFunctions;

class StringClass
{
    /**
     * @param string $camelCaseString
     * @return string
     * @description 카멜 케이스 스트링을 스네이크 케이스로 치환하는 함수
     */
    public static function camelToSnake(string $camelCaseString): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $camelCaseString));
    }

    /**
     * @param $camelCaseString
     * @return string
     * @description 카멜 케이스 스트링을 케밥 케이스로 치환하는 함수.
     */
    public static function camelToKebab($camelCaseString): string
    {
        // camel case를 언더스코어로 대체하여 snake case로 변환
        $snakeCaseString = preg_replace('/([a-z])([A-Z])/', '$1-$2', $camelCaseString);

        // 모든 문자를 소문자로 변환
        return strtolower($snakeCaseString);
    }

    /**
     * @param string $snakeCaseString
     * @return string
     * @description 스네이크 케이스 스트링을 카멜 케이스로 치환하는 함수
     */
    public static function snakeToCamel(string $snakeCaseString): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $snakeCaseString))));
    }

    /**
     * @param $snakeCase
     * @return string
     * @description 스네이크 케이스 스트링을 케밥 케이스로 치환하는 함수
     */
    public static function snakeToKebab($snakeCase): string
    {
        // 언더스코어를 하이픈으로 대체하여 kebab case로 변환
        return str_replace('_', '-', $snakeCase);
    }

    /**
     * @param string $kebabCaseString
     * @return string
     * @description 케밥 케이스 스트링을 스네이크 케이스로 치환하는 함수
     */
    public static function kebabToSnake(string $kebabCaseString): string
    {
        return str_replace('-', '_', $kebabCaseString);
    }

    /**
     * @param string $kebabCaseString
     * @return string
     * @description 케밥 케이스 스트링을 카멜 케이스로 치환하는 함수
     */
    public static function kebabToCamel(string $kebabCaseString): string
    {
        // kebab case를 언더스코어로 대체하여 snake case로 변환
        $snakeCaseString = static::kebabToSnake(kebabCaseString: $kebabCaseString);
        // snake case를 camel case로 변환
        return static::snakeToCamel(snakeCaseString: $snakeCaseString);
    }

    /**
     * @param string $targetString
     * @param string $beforeString
     * @param bool $isNullable
     * @return string|null
     * @description targetString 에서 beforeString 문자열을 찾아 그 후의 문자열을 반환.
     */
    public static function getAfterString(string $targetString, string $beforeString, bool $isNullable = false): ?string
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
    public static function getBeforeString(string $targetString, string $afterString, bool $isNullable = false): ?string
    {
        $position = strpos($targetString, $afterString);

        if ($position !== false) {
            // $afterString 이전의 문자열 반환
            return substr($targetString, 0, $position);
        }

        return $isNullable ? null : $targetString;
    }

    /**
     * @param string $path
     * @param bool $isNullable
     * @return string|null
     * @description 주어진 경로에서 디렉토리를 string 문자열로 반환.
     */
    public static function getDirectoryName(string $path, bool $isNullable = false): ?string
    {
        if (!static::isPathString($path)) {
            return $isNullable ? null : $path;
        }

        // 경로를 디렉토리와 파일로 분리
        $info = pathinfo($path);

        // 디렉토리 이름 반환
        return $info['dirname'];
    }

    /**
     * @param string $path
     * @param bool $isNullable
     * @return string|null
     * @description 주어진 경로에서 baseName을 string 문자열로 반환.
     */
    public static function getBaseName(string $path, bool $isNullable = false): ?string
    {
        if (!static::isPathString($path)) {
            return $isNullable ? null : $path;
        }

        // 경로를 디렉토리와 파일로 분리
        $info = pathinfo($path);

        // 디렉토리 이름 반환
        return $info['basename'] ?? ($isNullable ? null : $path);
    }

    /**
     * @param string $path
     * @param bool $isNullable
     * @return string|null
     * @description 주어진 경로에서 파일 이름을 string 문자열로 반환.
     */
    public static function getFileName(string $path, bool $isNullable = false): ?string
    {
        if (!static::isPathString($path)) {
            return $isNullable ? null : $path;
        }

        // 경로를 디렉토리와 파일로 분리
        $info = pathinfo($path);

        // 파일 이름 반환
        return $info['filename'] ?? ($isNullable ? null : $path);
    }

    /**
     * @param string $path
     * @param bool $isNullable
     * @return string|null
     * @description 주어진 경로에서 파일 확장자명을 string 문자열로 반환.
     */
    public static function getFileExtension(string $path, bool $isNullable = false): ?string
    {
        if (!static::isPathString($path)) {
            return $isNullable ? null : $path;
        }

        // 경로를 디렉토리와 파일로 분리
        $info = pathinfo($path);

        // 파일 확장자 반환
        return $info['extension'] ?? ($isNullable ? null : $path);
    }


    /**
     * @param string $path
     * @return bool
     * @description 주어진 string 문자열이 path 경로와 일치한지 확인하여 true 혹은 false 반환.
     */
    public static function isPathString(string $path): bool
    {
        if (!file_exists($path) || !is_dir($path)) {
            return false; // 유효하지 않은 경로 또는 문자열인 경우 false 반환
        }
        return true;
    }

    /**
     * @param string $string
     * @return bool
     * @description 주어진 string 문자열이 Json 형식인지 확인하여 true 혹은 false 반환.
     */
    public static function isJsonString(string $string): bool
    {
        // 주어진 문자열이 JSON 형식인지 확인
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * @param string $string
     * @return bool
     * @description 주어진 string 문자열이 uuid 형식인지 확인하여 true 혹은 false 반환.
     */
    public static function isUuidString(string $string): bool
    {
        $uuidPattern = '/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-4[0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/';
        return (bool)preg_match($uuidPattern, $string);
    }

    /**
     * @param string $string
     * @return bool
     * @description 주어진 string 문자열이 ulid 형식인지 확인하여 true 혹은 false 반환.
     */
    public static function isUlidString(string $string): bool
    {
        $ulidPattern = '/^[0-7a-z]{26}$/';
        return (bool)preg_match($ulidPattern, $string);
    }

    /**
     * @param string $string
     * @return bool
     * @description 주어진 string 문자열이 url 형식인지 확인하여 true 혹은 false 반환.
     */
    public static function isUrlString(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * @param string $string
     * @param int $limit
     * @param string $after
     * @return string
     * @description 주어진 string 문자열에서 limit 개수만큼 자른 후 after 문자열을 연결지어 반환.
     */
    public static function getTruncateString(string $string, int $limit, string $after = '...'): string
    {
        // 문자열이 제한 길이보다 짧으면 그대로 반환
        if (strlen($string) <= $limit) {
            return $string;
        }

        // 문자열을 제한 길이까지 자르고 $after를 추가하여 반환
        return substr($string, 0, $limit) . $after;
    }
}