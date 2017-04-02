<?php


namespace DDD\Calculator\Domain\Model;


class PersistCommandSubscriber implements CommandSubscriber
{
    private $commandStore;

    function __construct(CommandRepository $eventStore)
    {
        $this->commandStore = $eventStore;
    }

    public function handle(Command $command)
    {
        $this->commandStore->save($command);
    }

    public function isSubscribedTo(Command $command)
    {
        return true;
    }
}