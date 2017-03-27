<?php

namespace DDD\Calculator\Domain\Repository;


use DDD\Calculator\Domain\CalculatorSumResponse;
use DDD\Infrastructure\Persistence\Doctrine\Configuration\DoctrineConfigurerAdapter;

class CalculatorSumRepository
{
    private $entityManager;

    function __construct(DoctrineConfigurerAdapter $doctrineConfigurerAdapter)
    {
        $this->entityManager = $doctrineConfigurerAdapter->getEntityManager();
    }

    public function saveCalculatorSumResponse(CalculatorSumResponse $calculatorSumResponse)
    {
        $this->entityManager->persist($calculatorSumResponse);
        $this->entityManager->flush();
    }
}