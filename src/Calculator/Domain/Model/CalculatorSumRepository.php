<?php


namespace DDD\Calculator\Domain\Model;

interface CalculatorSumRepository
{
    public function saveResult(CalculatorSumResult $calculatorSumResponse);

}