<?php

namespace DDD\Calculator\Domain;


class CalculatorSumResponse
{
    private $result;
    private $calculationTime;

    function __construct($result, $calculationTime)
    {
        $this->result = $result;
        $this->calculationTime = $calculationTime;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getCalculationTime()
    {
        return $this->calculationTime;
    }
}