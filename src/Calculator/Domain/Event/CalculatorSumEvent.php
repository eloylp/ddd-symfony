<?php


namespace DDD\Calculator\Domain\Event;


use DateTime;
use DDD\Infrastructure\Event\EventInterface;

class CalculatorSumEvent implements EventInterface
{
    private $type = CalculatorEvents::CALCULATOR_SUM_EVENT;
    private $version = 0;
    private $time;
    private $result;

    function __construct($result, DateTime $time = null)
    {
        $this->result = $result;
        if ($time) {
            $this->time = $time;
        } else {
            $this->time = new DateTime();
        }

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
        return [
            "type" => $this->getType(),
            "version" => $this->getVersion(),
            "time" => $this->getTime(),
            "result" => $this->getResult()
        ];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @return DateTime
     */
    public function getTime(): DateTime
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
}