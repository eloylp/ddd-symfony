<?php


use DDD\Calculator\Domain\Model\EventPublisher;
use DDD\Calculator\Domain\Model\MessageEventSubscriber;
use DDD\Calculator\Domain\Model\PersistEventSubscriber;

use DDD\Infrastructure\Mailer\Configuration\MailerConfigurator;
use DDD\Infrastructure\Mailer\MailerAdapter;
use DDD\Infrastructure\Message\Amqp\Activity\ActivityProducer;
use DDD\Infrastructure\Message\Amqp\Mailer\MailerCommandHandler;
use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Message\Amqp\Mailer\MailerConsumer;
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;
use DDD\Infrastructure\Persistence\Doctrine\Odm\EventStoreRepository;
use DDD\Infrastructure\Templating\FolderRegistry;
use DDD\Infrastructure\Templating\TemplateAdapter;

require_once(__DIR__ . "/../../../../../vendor/autoload.php");


$amqpConnectionFactory = new AmqpConnectionFactory();
$mailCommandHandler = new MailerCommandHandler(
    new MailerAdapter(new MailerConfigurator()),
    new TemplateAdapter(new FolderRegistry()),
    new EventPublisher(
        new PersistEventSubscriber(new EventStoreRepository(new DoctrineOdmConfigurerAdapter())),
        new MessageEventSubscriber(new ActivityProducer($amqpConnectionFactory))
    )
);
$mailerCommandConsumer = new MailerConsumer($amqpConnectionFactory, $mailCommandHandler, "Mail_command_handler" . uniqid());
$mailerCommandConsumer->start();
