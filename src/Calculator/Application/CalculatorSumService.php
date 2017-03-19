<?php

namespace DDD\Calculator\Application;


use DDD\Calculator\Domain\CalculatorSumOperation;
use DDD\Calculator\Domain\CalculatorSumRequest;
use DDD\Calculator\Domain\CalculatorSumResponse;

class CalculatorSumService
{
    private $calculator;

    function __construct(CalculatorSumOperation $calculator)
    {
        $this->calculator = $calculator;
    }

    public function sum(CalculatorSumRequest $calculatorRequest): CalculatorSumResponse
    {
        $time = microtime();
        $result = $this->calculator->sum($calculatorRequest->getSum1(), $calculatorRequest->getSum2());
        $response = new CalculatorSumResponse($result, microtime() - $time);
        return $response;

    }

}