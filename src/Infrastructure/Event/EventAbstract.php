<?php

namespace DDD\Infrastructure\Event;


use DateTime;
use JsonSerializable;

abstract class EventAbstract implements JsonSerializable
{
    protected $type;
    protected $time;
    protected $context;

    function __construct(string $type, array $context, DateTime $time = null)
    {
        $this->type = $type;
        $this->context = $context;
        if ($time) {
            $this->time = $time;
        } else {
            $this->time = new DateTime();
        }
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return DateTime
     */
    public function getTime(): DateTime
    {
        return $this->time;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    function jsonSerialize()
    {
        return [
            "type" => $this->getType(),
            "time" => $this->getTime(),
            "context" => $this->getContext()
        ];
    }
}