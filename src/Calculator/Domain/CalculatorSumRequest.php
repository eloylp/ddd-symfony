<?php


namespace DDD\Calculator\Domain;


class CalculatorSumRequest
{
    private $sum1;
    private $sum2;

    function __construct($sum1, $sum2)
    {
        $this->sum1 = $sum1;
        $this->sum2 = $sum2;
    }

    /**
     * @return mixed
     */
    public function getSum1()
    {
        return $this->sum1;
    }

    /**
     * @return mixed
     */
    public function getSum2()
    {
        return $this->sum2;
    }


}