<?php 

namespace App\Framework\Helpers;

class Str 
{
    /**
     * @param string $str, string $delimiter
     * @return array
     */
    public static function explodeString(string $delimiter, string $string): array 
    {
        return explode($delimiter, $string);
    }
}