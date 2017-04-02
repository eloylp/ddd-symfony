<?php

namespace DDD\Infrastructure\Message\Amqp\Activity;


use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Message\Amqp\ConsumerLogic;
use DDD\Infrastructure\Message\Amqp\DefaultConsumerAbstract;
use DDD\Infrastructure\Message\Amqp\Exchanges;
use DDD\Infrastructure\Message\Amqp\Queues;
use DDD\Infrastructure\Message\Amqp\RoutingKeys;

class ActivityConsumer extends DefaultConsumerAbstract
{

    function __construct(AmqpConnectionFactory $amqpConnectionFactory, ConsumerLogic $consumerLogic, $consumerTag)
    {
        parent::__construct($amqpConnectionFactory, Exchanges::DDD_EXCHANGE, Queues::EVENTS_QUEUE, $consumerLogic, $consumerTag, RoutingKeys::EVENT);
    }

}