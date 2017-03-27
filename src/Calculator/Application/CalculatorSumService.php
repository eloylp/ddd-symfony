<?php

namespace DDD\Calculator\Application;

use DDD\Calculator\Domain\CalculatorSumOperation;
use DDD\Calculator\Domain\CalculatorSumRequest;
use DDD\Calculator\Domain\CalculatorSumResponse;
use DDD\Calculator\Domain\Repository\CalculatorSumRepository;

class CalculatorSumService
{
    private $calculator;
    private $calculatorSumDoctrineRepository;

    function __construct(CalculatorSumOperation $calculator,
                         CalculatorSumRepository $calculatorSumDoctrineRepository)
    {
        $this->calculator = $calculator;
        $this->calculatorSumDoctrineRepository = $calculatorSumDoctrineRepository;
    }

    private function getTime(){
        return (int) microtime();
    }

    public function sum(CalculatorSumRequest $calculatorRequest): CalculatorSumResponse
    {
        $time = $this->getTime();
        $result = $this->calculator->sum($calculatorRequest->getSum1(), $calculatorRequest->getSum2());
        $calculatorSumResponse = new CalculatorSumResponse($result, $this->getTime() - $time);
        $this->calculatorSumDoctrineRepository->saveCalculatorSumResponse($calculatorSumResponse);
        return $calculatorSumResponse;
    }

}