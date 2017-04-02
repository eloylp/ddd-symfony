<?php


namespace DDD\Calculator\Domain\Model;


use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{

    public function testSum()
    {

        $calculator = new CalculatorSumOperation();
        $result = $calculator->sum(2,2);
        $this->assertEquals(4, $result);
    }

}
