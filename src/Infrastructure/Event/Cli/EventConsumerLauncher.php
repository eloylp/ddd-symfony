<?php


use DDD\Infrastructure\Event\EventConsumer;
use DDD\Infrastructure\Event\EventHandler;
use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;

require_once (__DIR__."/../../../../vendor/autoload.php");



$amqpConnectionFactory = new AmqpConnectionFactory();
$eventProccesor = new EventHandler();
$eventConsumer = new EventConsumer($amqpConnectionFactory, $eventProccesor, "Event_processor".uniqid());
$eventConsumer->start();
