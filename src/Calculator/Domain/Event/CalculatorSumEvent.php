<?php


namespace DDD\Calculator\Domain\Event;


use DateTime;
use DDD\Infrastructure\Event\EventAbstract;

class CalculatorSumEvent extends EventAbstract
{

    function __construct(array $context, DateTime $time = null)
    {
        parent::__construct(CalculatorEvents::CALCULATOR_SUM_EVENT, $context, $time);
    }

    function jsonSerialize()
    {
        return [
            "type" => $this->type,
            "time" => $this->time,
            "context" => $this->context
        ];
    }
}