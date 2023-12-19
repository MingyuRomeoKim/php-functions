<?php

namespace MingyuKim\PhpFunctions;

class CacheClass
{
    /**
     * @param string $key
     * @param mixed $data
     * @param int $expiration
     * @return void
     * @description Cache Driver가 File일 때 Cache 생성.
     */
    public static function createFileCache(string $key, mixed $data, int $expiration = 3600): void
    {
        $filename = 'cache/' . md5($key) . '.cache';

        $cacheData = [
            'data' => $data,
            'expiration' => time() + $expiration,
        ];

        file_put_contents($filename, serialize($cacheData));
    }

    /**
     * @param string $key
     * @return mixed
     * @description Cache Driver가 File일 때 Cache 읽기.
     */
    public static function readFileCache(string $key): mixed
    {
        $filename = 'cache/' . md5($key) . '.cache';

        if (file_exists($filename)) {
            $cacheData = unserialize(file_get_contents($filename));

            // 캐시의 만료 여부 확인
            if ($cacheData['expiration'] > time()) {
                return $cacheData['data'];
            } else {
                // 캐시 만료 시 삭제
                static::clearFileCache(key: $key);
            }
        }

        return null;
    }

    /**
     * @param string $key
     * @return void
     * @description Cache Driver가 File일 때 Cache 삭제.
     */
    public static function clearFileCache(string $key): void
    {
        $filename = 'cache/' . md5($key) . '.cache';

        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    /**
     * @param string $key
     * @param mixed $data
     * @param \Redis $redis
     * @param int $expiration
     * @return void
     * @description Cache Driver가 Redis일 때 Cache 생성.
     */
    public static function createRedisCache(string $key, mixed $data, \Redis $redis, int $expiration = 3600): void
    {
        $cacheData = [
            'data' => $data,
            'expiration' => time() + $expiration,
        ];

        $redis->setex($key, $expiration, serialize($cacheData));
    }

    /**
     * @param string $key
     * @param \Redis $redis
     * @return mixed
     * @description Cache Driver가 Redis일 때 Cache 읽기.
     */
    public static function readRedisCache(string $key, \Redis $redis): mixed
    {
        $cachedData = $redis->get($key);

        if ($cachedData !== false) {
            $cacheData = unserialize($cachedData);

            // 캐시의 만료 여부 확인
            if ($cacheData['expiration'] > time()) {
                return $cacheData['data'];
            } else {
                // 만료된 경우 삭제
                static::clearRedisCache(key: $key, redis: $redis);
            }
        }

        return null;
    }

    /**
     * @param string $key
     * @param \Redis $redis
     * @return void
     * @description Cache Driver가 Redis일 때 Cache 삭제.
     */
    public static function clearRedisCache(string $key, \Redis $redis): void
    {
        $redis->del($key);
    }
}