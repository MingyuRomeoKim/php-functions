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
    public function getDuplicatesValueEachSequentialArrays(array $aSequentialArray, array $bSequentialArray): ?array
    {
        if ($this->isArrayAssociative($aSequentialArray) || $this->isArrayAssociative($bSequentialArray)) {
            return null;
        }
        return array_intersect($aSequentialArray, $bSequentialArray) ?? null;
    }

    /**
     * @param array $a
     * @param array $b
     * @return array|null
     * @description 두 연관 배열의 겹치는 key를 배열로 반환. 없다면 null 반환.
     */
    public function getDuplicatesKeysEachAssociativeArrays(array $aAssociativeArray, array $bAssociativeArray): ?array
    {
        if (!$this->isArrayAssociative($aAssociativeArray) || !$this->isArrayAssociative($bAssociativeArray)) {
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
    public function getDuplicatesValuesAssociativeArrayAndSequentialArray(array $associativeArray, array $sequentialArray): ?array
    {
        if (!$this->isArrayAssociative($associativeArray) || $this->isArrayAssociative($sequentialArray)) {
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
    function isArrayAssociative(array $array): bool
    {
        if ([] === $array) return false; // 빈 배열은 순차적 배열로 간주
        return array_keys($array) !== range(0, count($array) - 1);
    }


}