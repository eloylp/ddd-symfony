<?php


namespace DDD\Infrastructure\Persistence\Doctrine\Odm;

use DDD\Calculator\Domain\Model\Command;
use DDD\Calculator\Domain\Model\CommandRepository;
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;

class CommandRepositoryRepository implements CommandRepository
{
    private $documentManager;

    function __construct(DoctrineOdmConfigurerAdapter $doctrineOdmConfigurerAdapter)
    {
        $this->documentManager = $doctrineOdmConfigurerAdapter->getDocumentManager();
    }

    public function save(Command $command)
    {
        $this->documentManager->persist($command);
        $this->documentManager->flush();
    }
}