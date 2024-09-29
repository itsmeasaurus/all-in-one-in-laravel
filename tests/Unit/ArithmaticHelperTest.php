<?php

namespace Tests\Unit;

use App\Helpers\Math\ArithmaticHelper;
use PHPUnit\Framework\TestCase;

class ArithmaticHelperTest extends TestCase
{
    public function test_sum_can_sum_of_two_positive_numbers()
    {
        $num1 = 10;
        $num2 = 10;
        $sum = $num1 + $num2;

        $result = ArithmaticHelper::add($num1, $num2);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_sum_more_than_two_numbers()
    {
        $num1 = 10;
        $num2 = 10;
        $num3 = 10;
        $sum = $num1 + $num2 + $num3;

        $result = ArithmaticHelper::add($num1, $num2, $num3);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_sum_of_positive_and_negative_numbers()
    {
        $num1 = 10;
        $num2 = -10;
        $sum = $num1 + $num2;

        $result = ArithmaticHelper::add($num1, $num2);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_sum_of_two_negative_numbers()
    {
        $num1 = -10;
        $num2 = -10;
        $sum = $num1 + $num2;

        $result = ArithmaticHelper::add($num1, $num2);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_sum_of_zero_and_number()
    {
        $num1 = 0;
        $num2 = 10;
        $sum = $num1 + $num2;

        $result = ArithmaticHelper::add($num1, $num2);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_sum_of_zero_and_zero()
    {
        $num1 = 0;
        $num2 = 0;
        $sum = $num1 + $num2;

        $result = ArithmaticHelper::add($num1, $num2);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_sum_of_large_numbers()
    {
        $num1 = 4352453264362453153215;
        $num2 = 543254326453654241354325;
        $sum = $num1 + $num2;

        $result = ArithmaticHelper::add($num1, $num2);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_sum_of_floating_points_number()
    {
        $num1 = 3.4535;
        $num2 = 0.2345;
        $sum = $num1 + $num2;

        $result = ArithmaticHelper::add($num1, $num2);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_sum_of_integer_and_float_numbers()
    {
        $num1 = 4;
        $num2 = 0.34242351;
        $sum = $num1 + $num2;

        $result = ArithmaticHelper::add($num1, $num2);
        $this->assertEquals($sum, $result);
    }

    public function test_sum_can_throw_exception_when_no_argument_passed()
    {
        $this->expectException(\InvalidArgumentException::class);
        ArithmaticHelper::add();
    }

    public function test_sum_can_only_accepts_numeric_values()
    {
        $this->expectException(\InvalidArgumentException::class);
        ArithmaticHelper::add('string', 'string');
    }


}
