#!/usr/bin/php

<?php

use DDD\Calculator\Application\CalculatorSumService;
use DDD\Calculator\Domain\CalculatorSumOperation;
use DDD\Calculator\Domain\CalculatorSumRequest;

require_once ("../../../../vendor/autoload.php");

$calculatorSumService = new CalculatorSumService(new CalculatorSumOperation());
$sum1 = (int) $argv[1];
$sum2 = (int) $argv[2];

$calculatorSumRequest = new CalculatorSumRequest($sum1, $sum2);

$result = $calculatorSumService->sum($calculatorSumRequest);

echo json_encode($result, JSON_PRETTY_PRINT);