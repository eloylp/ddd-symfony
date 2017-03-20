<?php

namespace DDD\Calculator\Domain;


use JsonSerializable;

class CalculatorSumResponse implements JsonSerializable
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return $this->toArray();
    }

    function toArray()
    {
        return [
            "result" => $this->getResult(),
            "calculationTime" => $this->getCalculationTime()
        ];
    }
}