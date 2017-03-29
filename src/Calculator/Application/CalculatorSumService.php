<?php

namespace DDD\Calculator\Application;

use DDD\Calculator\Domain\CalculatorSumOperation;
use DDD\Calculator\Domain\CalculatorSumRequest;
use DDD\Calculator\Domain\CalculatorSumResponse;
use DDD\Calculator\Domain\Event\CalculatorSumEvent;
use DDD\Calculator\Domain\Repository\CalculatorEventStore;
use DDD\Calculator\Domain\Repository\CalculatorSumRepository;


class CalculatorSumService
{
    private $calculator;
    private $calculatorSumDoctrineRepository;
    private $calculatorEventStore;

    function __construct(CalculatorSumOperation $calculator,
                         CalculatorSumRepository $calculatorSumRepository,
                         CalculatorEventStore $calculatorEventStore)
    {
        $this->calculator = $calculator;
        $this->calculatorSumDoctrineRepository = $calculatorSumRepository;
        $this->calculatorEventStore = $calculatorEventStore;

    }

    private function getTime()
    {
        return (int)microtime();
    }

    public function sum(CalculatorSumRequest $calculatorRequest): CalculatorSumResponse
    {
        $time = $this->getTime();
        $result = $this->calculator->sum($calculatorRequest->getSum1(), $calculatorRequest->getSum2());
        $calculatorSumResponse = new CalculatorSumResponse($result, $this->getTime() - $time);
        $calculatorSumEvent = new CalculatorSumEvent($calculatorSumResponse->toArray());
        $this->calculatorEventStore->append($calculatorSumEvent);
        $this->calculatorSumDoctrineRepository->saveCalculatorSumResponse($calculatorSumResponse);
        return $calculatorSumResponse;
    }

}