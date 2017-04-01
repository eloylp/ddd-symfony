#!/usr/bin/php

<?php

use DDD\Calculator\Application\CalculatorSumService;
use DDD\Calculator\Domain\CalculatorSumOperation;
use DDD\Calculator\Domain\CalculatorSumRequest;
use DDD\Calculator\Domain\Repository\CalculatorEventStore;
use DDD\Calculator\Domain\Repository\CalculatorSumRepository;
use DDD\Infrastructure\Event\EventProducer;
use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;
use DDD\Infrastructure\Persistence\Doctrine\Orm\Configuration\DoctrineOrmConfigurerAdapter;

require_once("../../../../vendor/autoload.php");

$calculatorSumService = new CalculatorSumService(new CalculatorSumOperation(),
    new CalculatorSumRepository(new DoctrineOrmConfigurerAdapter(), new DoctrineOdmConfigurerAdapter()),
    new CalculatorEventStore(new EventProducer(new AmqpConnectionFactory()))
);
$sum1 = (int) $argv[1];
$sum2 = (int) $argv[2];

$calculatorSumRequest = new CalculatorSumRequest($sum1, $sum2);

$result = $calculatorSumService->sum($calculatorSumRequest);

echo json_encode($result, JSON_PRETTY_PRINT);