<?php

namespace MingyuKim\PhpFunctions;

class ArrayClass
{
    /**
     * @param array $aSequentialArray
     * @param array $bSequentialArray
     * @return array|null
     * @description 두 순차 배열의 겹치는 value를 배열로 반환. 없다면 null 반환.
     */
    public static function getDuplicatesValueEachSequentialArrays(array $aSequentialArray, array $bSequentialArray): ?array
    {
        if (static::isArrayAssociative($aSequentialArray) || static::isArrayAssociative($bSequentialArray)) {
            return null;
        }
        return array_intersect($aSequentialArray, $bSequentialArray) ?? null;
    }

    /**
     * @param array $aAssociativeArray
     * @param array $bAssociativeArray
     * @return array|null
     * @description 두 연관 배열의 겹치는 key를 배열로 반환. 없다면 null 반환.
     */
    public static function getDuplicatesKeysEachAssociativeArrays(array $aAssociativeArray, array $bAssociativeArray): ?array
    {
        if (!static::isArrayAssociative($aAssociativeArray) || !static::isArrayAssociative($bAssociativeArray)) {
            return null;
        }

        $keys1 = array_keys($aAssociativeArray);
        $keys2 = array_keys($bAssociativeArray);

        return array_intersect($keys1, $keys2) ?? null;
    }

    /**
     * @param array $associativeArray
     * @param array $sequentialArray
     * @return array|null
     * @description 각 연관 배열, 순차 배열의 겹치는 value를 배열로 반환. 없다면 null 반환.
     */
    public static function getDuplicatesValuesAssociativeArrayAndSequentialArray(array $associativeArray, array $sequentialArray): ?array
    {
        if (!static::isArrayAssociative($associativeArray) || static::isArrayAssociative($sequentialArray)) {
            return null;
        }

        $assocValues = array_values($associativeArray);
        return array_intersect($assocValues, $sequentialArray) ?? null;
    }

    /**
     * @param array $array
     * @return bool
     * @description true:연관 배열 (key,value), false:순차 배열(only value)
     */
    public static function isArrayAssociative(array $array): bool
    {
        if ([] === $array) return false; // 빈 배열은 순차적 배열로 간주
        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * @param array $array
     * @param array $values
     * @return array
     * @description 배열에 입력받은 values를 추가한 새로운 배열을 반환.
     */
    public static function addArray(array $array, array $values): array
    {
        return static::isArrayAssociative(array: $array) ?
            static::addAssociativeArray(associativeArray: $array, values: $values) :
            static::addSequentialArray(sequentialArray: $array, values: $values);
    }

    /**
     * @param array $associativeArray
     * @param array $values
     * @return array
     * @description 연관 배열에 입력받은 values를 추가한 새로운 배열을 반환.
     */
    public static function addAssociativeArray(array $associativeArray, array $values): array
    {
        foreach ($values as $key => $value) {
            $associativeArray[$key] = $value;
        }

        return $associativeArray;
    }

    /**
     * @param array $sequentialArray
     * @param array $values
     * @return array
     * @description 순차 배열에 입력받은 values를 추가한 새로운 배열을 반환.
     */
    public static function addSequentialArray(array $sequentialArray, array $values): array
    {
        foreach ($values as $value) {
            $sequentialArray[] = $value;
        }

        return $sequentialArray;
    }
}