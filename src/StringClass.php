<?php

namespace MingyuKim\PhpFunctions;

class StringClass
{
    public function camelToSnake(string $camelTypeString): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $camelTypeString));
    }

    public function snakeToCamel(string $snakeTypeString): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $snakeTypeString))));
    }
}