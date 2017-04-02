<?php

namespace DDD\Calculator\Domain\Model;


class CalculatorSumResult
{
    private $id;
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


    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @param mixed $calculationTime
     */
    public function setCalculationTime($calculationTime)
    {
        $this->calculationTime = $calculationTime;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}