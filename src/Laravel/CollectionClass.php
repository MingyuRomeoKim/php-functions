<?php

namespace MingyuKim\PhpFunctions\Laravel;

class CollectionClass
{

    /**
     * @param array $array
     * @return array|null
     * @description 배열을 collect 객체로 반환.
     */
    public static function convertArrayToCollect(array $array): ?array
    {
        return collect($array) ?? null;
    }

    /**
     * @param object $aCollection
     * @param object $bCollection
     * @return object|null
     * @description 각 collect 객체의 중복되는 value를 제거 하여 반환. 없다면 null 반환.
     */
    public static function removeDuplicatesEachCollections(object $aCollection, object $bCollection): ?object
    {
        return $aCollection->diff($bCollection)->all() ?? null;
    }
}