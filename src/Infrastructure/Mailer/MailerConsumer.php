<?php

namespace DDD\Infrastructure\Mailer;

use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Message\Amqp\ConsumerLogicInterface;
use DDD\Infrastructure\Message\Amqp\DefaultConsumerAbstract;
use DDD\Infrastructure\Message\Amqp\Exchanges;
use DDD\Infrastructure\Message\Amqp\Queues;
use DDD\Infrastructure\Message\Amqp\RoutingKeys;

class MailerConsumer extends DefaultConsumerAbstract
{
    function __construct(AmqpConnectionFactory $amqpConnectionFactory, ConsumerLogicInterface $consumerLogic, $consumerTag)
    {
        parent::__construct($amqpConnectionFactory, Exchanges::DDD_EXCHANGE, Queues::MAIL_QUEUE, $consumerLogic, $consumerTag, RoutingKeys::EMAIL);
    }

}