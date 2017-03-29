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
}