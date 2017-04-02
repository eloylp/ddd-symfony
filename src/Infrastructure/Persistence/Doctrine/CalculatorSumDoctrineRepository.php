<?php


namespace DDD\Infrastructure\Persistence\Doctrine;


use DDD\Calculator\Domain\Model\CalculatorSumRepository;
use DDD\Calculator\Domain\Model\CalculatorSumResult;
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;
use DDD\Infrastructure\Persistence\Doctrine\Orm\Configuration\DoctrineOrmConfigurerAdapter;

class CalculatorSumDoctrineRepository implements CalculatorSumRepository
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
    public function saveResult(CalculatorSumResult $calculatorSumResponse)
    {
        $this->entityManager->persist($calculatorSumResponse);
        $this->documentManager->persist($calculatorSumResponse);
        $this->documentManager->flush();
        $this->entityManager->flush();
    }
}