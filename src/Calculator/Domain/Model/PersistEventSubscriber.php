<?php


namespace DDD\Calculator\Domain\Model;


class PersistEventSubscriber implements EventSubscriber
{
    private $eventStore;

    function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function handle(Event $event)
    {
        $this->eventStore->append($event);
    }

    public function isSubscribedTo(Event $event)
    {
        return true;
    }
}