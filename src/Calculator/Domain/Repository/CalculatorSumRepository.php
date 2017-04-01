<?php

namespace DDD\Calculator\Domain\Repository;


use DDD\Calculator\Domain\CalculatorSumResponse;
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;
use DDD\Infrastructure\Persistence\Doctrine\Orm\Configuration\DoctrineOrmConfigurerAdapter;

class CalculatorSumRepository
{
    private $entityManager;
    private $documentManager;

    function __construct(DoctrineOrmConfigurerAdapter $doctrineConfigurerAdapter,
                         DoctrineOdmConfigurerAdapter $doctrineOdmConfigurerAdapter
    )
    {
        $this->entityManager = $doctrineConfigurerAdapter->getEntityManager();
        $this->documentManager = $doctrineOdmConfigurerAdapter->getDocumentManager();
    }

    public function saveCalculatorSumResponse(CalculatorSumResponse $calculatorSumResponse)
    {
        $this->entityManager->persist($calculatorSumResponse);
        $this->documentManager->persist($calculatorSumResponse);
        $this->documentManager->flush();
        $this->entityManager->flush();
    }
}