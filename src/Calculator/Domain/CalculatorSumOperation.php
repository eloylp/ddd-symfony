<?php

namespace DDD\Calculator\Domain;


class CalculatorSumOperation
{
    public function sum($sum1, $sum2)
    {
        return $sum1 + $sum2;
    }
}