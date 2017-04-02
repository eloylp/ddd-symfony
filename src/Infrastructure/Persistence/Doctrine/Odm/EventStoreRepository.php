<?php


namespace DDD\Infrastructure\Persistence\Doctrine\Odm;

use DDD\Calculator\Domain\Model\Event;
use DDD\Calculator\Domain\Model\EventStore;
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;

class EventStoreRepository implements EventStore
{
    private $documentManager;

    function __construct(DoctrineOdmConfigurerAdapter $doctrineOdmConfigurerAdapter)
    {
        $this->documentManager = $doctrineOdmConfigurerAdapter->getDocumentManager();
    }

    public function append(Event $event)
    {
        $this->documentManager->persist($event);
        $this->documentManager->flush();
    }
}