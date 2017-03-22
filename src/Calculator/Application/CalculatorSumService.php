<?php

namespace DDD\Calculator\Application;

use DDD\Calculator\Domain\CalculatorSumOperation;
use DDD\Calculator\Domain\CalculatorSumRequest;
use DDD\Calculator\Domain\CalculatorSumResponse;
use DDD\Calculator\Domain\Repository\CalculatorSumDoctrineRepository;

class CalculatorSumService
{
    private $calculator;
    private $calculatorSumDoctrineRepository;

    function __construct(CalculatorSumOperation $calculator,
                         CalculatorSumDoctrineRepository $calculatorSumDoctrineRepository)
    {
        $this->calculator = $calculator;
        $this->calculatorSumDoctrineRepository = $calculatorSumDoctrineRepository;
    }

    public function sum(CalculatorSumRequest $calculatorRequest): CalculatorSumResponse
    {
        $time = microtime();
        $result = $this->calculator->sum($calculatorRequest->getSum1(), $calculatorRequest->getSum2());
        $calculatorSumResponse = new CalculatorSumResponse($result, microtime() - $time);
        $this->calculatorSumDoctrineRepository->saveCalculatorSumResponse($calculatorSumResponse);
        return $calculatorSumResponse;
    }

}