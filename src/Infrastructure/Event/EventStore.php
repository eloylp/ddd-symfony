<?php


namespace DDD\Infrastructure\Event;

use DDD\Infrastructure\Message\Amqp\EventProducer;

class EventStore
{
    private $eventProducer;

    function __construct(EventProducer $eventProducer)
    {
        $this->eventProducer = $eventProducer;
    }

    public function append(EventAbstract $event)
    {
        $this->eventProducer->publish($event);
    }
}