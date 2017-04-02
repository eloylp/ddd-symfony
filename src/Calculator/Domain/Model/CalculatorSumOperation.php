<?php

namespace DDD\Calculator\Domain\Model;


class CalculatorSumOperation
{
    public function sum($sum1, $sum2)
    {
        return $sum1 + $sum2;
    }
}