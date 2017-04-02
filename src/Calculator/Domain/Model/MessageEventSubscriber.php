<?php

namespace DDD\Calculator\Domain\Model;


class MessageEventSubscriber implements EventSubscriber
{

    private $messagePublisher;

    function __construct(MessagePublisher $messagePublisher)
    {
        $this->messagePublisher = $messagePublisher;
    }

    public function handle(Event $event)
    {
        $this->messagePublisher->publish($event);
    }

    public function isSubscribedTo(Event $event)
    {
        return true;
    }
}