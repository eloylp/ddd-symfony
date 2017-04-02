<?php


use DDD\Infrastructure\Mailer\Configuration\MailerConfigurator;
use DDD\Infrastructure\Message\Amqp\Activity\ActivityConsumer;
use DDD\Infrastructure\Message\Amqp\Activity\ActivityHandler;
use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Message\Amqp\Mailer\MailerProducer;

require_once (__DIR__."/../../../../../vendor/autoload.php");


$amqpConnectionFactory = new AmqpConnectionFactory();
$mailConfig = new MailerConfigurator();

$eventProccesor = new ActivityHandler(
    new MailerProducer($amqpConnectionFactory),
    (new MailerConfigurator())->getMailerConfiguration()
);
$eventConsumer = new ActivityConsumer($amqpConnectionFactory, $eventProccesor, "Event_processor".uniqid());
$eventConsumer->start();
