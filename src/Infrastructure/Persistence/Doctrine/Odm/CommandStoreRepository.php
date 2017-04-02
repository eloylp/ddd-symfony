<?php


namespace DDD\Infrastructure\Persistence\Doctrine\Odm;

use DDD\Calculator\Domain\Model\Command;
use DDD\Calculator\Domain\Model\CommandStore;
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;

class CommandStoreRepository implements CommandStore
{
    private $documentManager;

    function __construct(DoctrineOdmConfigurerAdapter $doctrineOdmConfigurerAdapter)
    {
        $this->documentManager = $doctrineOdmConfigurerAdapter->getDocumentManager();
    }

    public function append(Command $event)
    {
        $this->documentManager->persist($event);
        $this->documentManager->flush();
    }
}