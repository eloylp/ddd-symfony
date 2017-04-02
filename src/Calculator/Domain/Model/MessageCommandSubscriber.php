<?php

namespace DDD\Calculator\Domain\Model;


class MessageCommandSubscriber implements CommandSubscriber
{

    private $messagePublisher;

    function __construct(MessagePublisher $messagePublisher)
    {
        $this->messagePublisher = $messagePublisher;
    }

    public function handle(Command $command)
    {
        $this->messagePublisher->publish($command);
    }

    public function isSubscribedTo(Command $command)
    {
        return true;
    }
}