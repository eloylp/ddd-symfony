#!/usr/bin/php

<?php


use DDD\Calculator\Application\Sum\CalculatorSumRequest;
use DDD\Calculator\Application\Sum\CalculatorSumService;
use DDD\Calculator\Domain\Model\CalculatorSumOperation;
use DDD\Calculator\Domain\Model\EventPublisher;
use DDD\Calculator\Domain\Model\MessageEventSubscriber;
use DDD\Calculator\Domain\Model\PersistEventSubscriber;
use DDD\Infrastructure\Message\Amqp\Activity\ActivityProducer;
use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Persistence\Doctrine\CalculatorSumDoctrineRepository;
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;
use DDD\Infrastructure\Persistence\Doctrine\Odm\EventStoreRepository;
use DDD\Infrastructure\Persistence\Doctrine\Orm\Configuration\DoctrineOrmConfigurerAdapter;

require_once("../../../../vendor/autoload.php");

$calculatorSumService = new CalculatorSumService(
        new CalculatorSumOperation(),
        new CalculatorSumDoctrineRepository(new DoctrineOrmConfigurerAdapter(), new DoctrineOdmConfigurerAdapter()),
        new EventPublisher(
                new PersistEventSubscriber(new EventStoreRepository(new DoctrineOdmConfigurerAdapter())),
                new MessageEventSubscriber(new ActivityProducer(new AmqpConnectionFactory()))
        )

);
$sum1 = (int) $argv[1];
$sum2 = (int) $argv[2];

$calculatorSumRequest = new CalculatorSumRequest($sum1, $sum2);

$result = $calculatorSumService->sum($calculatorSumRequest);

echo json_encode($result, JSON_PRETTY_PRINT);