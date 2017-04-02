<?php

namespace DDD\Calculator\Domain\Model;


class EventPublisher
{

    private $subscribers;

    public function __construct(PersistEventSubscriber $persistEventSubscriber,
                                 MessageEventSubscriber $messageEventSubscriber)
    {
        $this->subscribers = [
            $persistEventSubscriber,
            $messageEventSubscriber
        ];
    }

    public function subscribe(EventSubscriber $eventSubscriber)
    {
        $this->subscribers[] = $eventSubscriber;
    }

    public function publish(Event $event)
    {
        foreach ($this->subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($event)) {
                $subscriber->handle($event);
            }
        }
    }
}