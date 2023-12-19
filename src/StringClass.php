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

    /**
     * @param string $path
     * @param bool $isNullable
     * @return string|null
     * @description 주어진 경로에서 디렉토리를 string 문자열로 반환.
     */
    public function getDirectoryName(string $path, bool $isNullable = false): ?string
    {
        if (!$this->isPathString($path)) {
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
    public function getBaseName(string $path, bool $isNullable = false): ?string
    {
        if (!$this->isPathString($path)) {
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
    public function getFileName(string $path, bool $isNullable = false): ?string
    {
        if (!$this->isPathString($path)) {
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
    public function getFileExtension(string $path, bool $isNullable = false): ?string
    {
        if (!$this->isPathString($path)) {
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
    public function isPathString(string $path): bool
    {
        if (!file_exists($path) || !is_dir($path)) {
            return false; // 유효하지 않은 경로 또는 문자열인 경우 false 반환
        }
        return true;
    }
}