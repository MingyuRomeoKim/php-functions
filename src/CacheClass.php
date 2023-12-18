<?php

namespace MingyuKim\PhpFunctions;

class CacheClass
{
    public function createFileCache(string $key, mixed $data, int $expiration = 3600): void
    {
        $filename = 'cache/' . md5($key) . '.cache';

        $cacheData = [
            'data' => $data,
            'expiration' => time() + $expiration,
        ];

        file_put_contents($filename, serialize($cacheData));
    }

    public function readFileCache(string $key): mixed
    {
        $filename = 'cache/' . md5($key) . '.cache';

        if (file_exists($filename)) {
            $cacheData = unserialize(file_get_contents($filename));

            // 캐시의 만료 여부 확인
            if ($cacheData['expiration'] > time()) {
                return $cacheData['data'];
            } else {
                // 캐시 만료 시 삭제
                $this->clearFileCache(key: $key);
            }
        }

        return null;
    }

    public function clearFileCache(string $key): void
    {
        $filename = 'cache/' . md5($key) . '.cache';

        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    public function createRedisCache(string $key, mixed $data, \Redis $redis, int $expiration = 3600): void
    {
        $cacheData = [
            'data' => $data,
            'expiration' => time() + $expiration,
        ];

        $redis->setex($key, $expiration, serialize($cacheData));
    }

    function readRedisCache(string $key, \Redis $redis): mixed
    {
        $cachedData = $redis->get($key);

        if ($cachedData !== false) {
            $cacheData = unserialize($cachedData);

            // 캐시의 만료 여부 확인
            if ($cacheData['expiration'] > time()) {
                return $cacheData['data'];
            } else {
                // 만료된 경우 삭제
                $this->clearRedisCache(key: $key, redis: $redis);
            }
        }

        return null;
    }

    public function clearRedisCache(string $key, \Redis $redis): void
    {
        $redis->del($key);
    }
}