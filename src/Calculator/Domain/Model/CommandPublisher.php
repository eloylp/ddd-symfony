<?php

namespace DDD\Calculator\Domain\Model;


class CommandPublisher
{

    private $subscribers;

    public function __construct(PersistEventSubscriber $persistCommandSubscriber,
                                 MessageEventSubscriber $messageCommandSubscriber)
    {
        $this->subscribers = [
            $persistCommandSubscriber,
            $messageCommandSubscriber
        ];
    }

    public function subscribe(Comman $eventSubscriber)
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