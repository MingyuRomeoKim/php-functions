<?php

namespace MingyuKim\PhpFunctions;

class ServerClass
{
    /**
     * @return bool
     * @description 현재 ssl 적용 유무 반환.
     */
    public static function isHttps(): bool
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }

    /**
     * @return string
     * @description 현재 URL을 반환.
     */
    public static function getCurrentURL(): string
    {
        $domain = static::getCurrentDomain();
        $uri = static::getCurrentURI();

        return $domain . $uri;
    }

    /**
     * @return string
     * @description 현재 URI를 반환.
     */
    public static function getCurrentURI(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return string
     * @description 프로토콜을 포함한 현재 도메인 반환.
     */
    public static function getCurrentDomain(): string
    {
        $protocol = static::isHttps() ? 'https' : 'http';
        return $protocol . '://' . static::getCurrentDomainWithOutProtocol();
    }

    /**
     * @return string
     * @description 프로토콜을 제외한 현재 도메인 반환.
     */
    public static function getCurrentDomainWithOutProtocol(): string
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * @param string $paramName
     * @return string|null
     * @description 입력한 key에 해당하는 파라미터 value 반환.
     */
    public static function getQueryParam(string $paramName): ?string
    {
        return $_GET[$paramName] ?? null;
    }
}