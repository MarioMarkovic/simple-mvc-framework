<?php

namespace App\Framework\Helpers;

class Arr 
{
    /**
     * @param array $arr 
     * @return array
     * trim and remove empty array elements
     */
    public static function removeEmptyElementsFromArray(array $arr = []): array 
    {
        return array_filter(array_map('trim', $arr), 'strlen');
    }
}