<?php


use DDD\Infrastructure\Event\EventProducer;
use DDD\Infrastructure\Event\EventStore;
use DDD\Infrastructure\Mailer\Configuration\MailerConfigurator;
use DDD\Infrastructure\Mailer\MailerAdapter;
use DDD\Infrastructure\Mailer\MailerCommandHandler;
use DDD\Infrastructure\Mailer\MailerConsumer;
use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Templating\FolderRegistry;
use DDD\Infrastructure\Templating\TemplateAdapter;

require_once(__DIR__ . "/../../../../vendor/autoload.php");


$amqpConnectionFactory = new AmqpConnectionFactory();
$mailCommandHandler = new MailerCommandHandler(
    new MailerAdapter(new MailerConfigurator()),
    new TemplateAdapter(new FolderRegistry()),
    new EventStore(new EventProducer(new AmqpConnectionFactory()))
);
$mailerCommandConsumer = new MailerConsumer($amqpConnectionFactory, $mailCommandHandler, "Mail_command_handler" . uniqid());
$mailerCommandConsumer->start();
