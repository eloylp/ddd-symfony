<?php

namespace DDD\Calculator\Application\Sum;


use DDD\Calculator\Domain\Model\CalculatorSummedEvent;
use DDD\Calculator\Domain\Model\CalculatorSumOperation;
use DDD\Calculator\Domain\Model\CalculatorSumRepository;
use DDD\Calculator\Domain\Model\CalculatorSumResult;
use DDD\Calculator\Domain\Model\EventPublisher;

class CalculatorSumService
{
    private $calculatorSumOperation;
    private $calculatorSumRepository;
    private $eventPublisher;

    function __construct(CalculatorSumOperation $calculatorSumOperation,
                         CalculatorSumRepository $calculatorSumRepository,
                         EventPublisher $eventPublisher)
    {
        $this->calculatorSumOperation = $calculatorSumOperation;
        $this->calculatorSumRepository = $calculatorSumRepository;
        $this->eventPublisher = $eventPublisher;
    }

    private function getTime()
    {
        return (int)microtime();
    }

    public function sum(CalculatorSumRequest $calculatorRequest): CalculatorSumResponse
    {
        $time = $this->getTime();
        $result = $this->calculatorSumOperation->sum($calculatorRequest->getSum1(), $calculatorRequest->getSum2());
        $calculationTime = $this->getTime() - $time;

        $calculatorSumResponse = new CalculatorSumResponse($result, $calculationTime);

        $calculatorSumResult = new CalculatorSumResult($result, $calculationTime);

        $this->calculatorSumRepository->saveResult($calculatorSumResult);

        $calculatorSummedEvent = new CalculatorSummedEvent($result);
        $this->eventPublisher->publish($calculatorSummedEvent);

        return $calculatorSumResponse;
    }

}