<?php

namespace DDD\Calculator\Domain\Repository;


use DDD\Calculator\Domain\CalculatorSumResponse;
use DDD\Infrastructure\Persistence\Doctrine\Configuration\DoctrineConfigurerAdapter;
use DDD\Infrastructure\Persistence\Mongo\Configuration\MongoConfigurerAdapter;

class CalculatorSumRepository
{
    private $entityManager;
    private $mongoClient;

    function __construct(DoctrineConfigurerAdapter $doctrineConfigurerAdapter,
    MongoConfigurerAdapter $mongoConfigurerAdapter
    )
    {
        $this->entityManager = $doctrineConfigurerAdapter->getEntityManager();
        $this->mongoClient = $mongoConfigurerAdapter->getMongoClient();
    }

    public function saveCalculatorSumResponse(CalculatorSumResponse $calculatorSumResponse)
    {
        $this->entityManager->persist($calculatorSumResponse);

        $this->mongoClient->sum_response->insertOne($calculatorSumResponse->toArray());

        $this->entityManager->flush();
    }
}