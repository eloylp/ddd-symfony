<?php


namespace DDD\Infrastructure\Event;


class EventStore
{
    private $eventProducer;

    function __construct(EventProducer $eventProducer)
    {
        $this->eventProducer = $eventProducer;
    }

    public function append(EventInterface $event)
    {
        $this->eventProducer->publish($event);
    }
}