<?php


namespace DDD\Calculator\Domain\Model;


class PersistCommandSubscriber implements CommandSubscriber
{
    private $commandStore;

    function __construct(CommandStore $eventStore)
    {
        $this->commandStore = $eventStore;
    }

    public function handle(Command $command)
    {
        $this->commandStore->append($command);
    }

    public function isSubscribedTo(Command $command)
    {
        return true;
    }
}