<?php


use DDD\Infrastructure\Event\EventConsumer;
use DDD\Infrastructure\Event\EventHandler;
use DDD\Infrastructure\Event\EventStoreRepository;
use DDD\Infrastructure\Mailer\Configuration\MailerConfigurator;
use DDD\Infrastructure\Mailer\MailerCommandPublisher;
use DDD\Infrastructure\Mailer\MailerProducer;
use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Persistence\Mongo\Configuration\MongoConfigurerAdapter;

require_once (__DIR__."/../../../../vendor/autoload.php");


$amqpConnectionFactory = new AmqpConnectionFactory();
$mailConfig = new MailerConfigurator();

$eventProccesor = new EventHandler(
    new EventStoreRepository(new MongoConfigurerAdapter()),
    new MailerCommandPublisher(new MailerProducer($amqpConnectionFactory)),
    $mailConfig->getMailerConfiguration()
);
$eventConsumer = new EventConsumer($amqpConnectionFactory, $eventProccesor, "Event_processor".uniqid());
$eventConsumer->start();
