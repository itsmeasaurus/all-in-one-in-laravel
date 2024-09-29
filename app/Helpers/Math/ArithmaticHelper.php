<?php

namespace App\Helpers\Math;

class ArithmaticHelper
{
    public static function add(...$numbers)
    {
        if (empty($numbers)) {
            throw new \InvalidArgumentException('At least one number is required');
        }

        foreach ($numbers as $number) {
            if (!is_numeric($number)) {
                throw new \InvalidArgumentException('Only numbers are allowed');
            }
        }

        return array_sum($numbers);
    }
}