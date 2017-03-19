<?php
/**
 * Created by PhpStorm.
 * User: eloylp
 * Date: 19/03/17
 * Time: 10:33
 */

namespace DDD\Calculator\Domain;


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
