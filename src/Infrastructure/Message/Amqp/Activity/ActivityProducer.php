<?php

namespace DDD\Infrastructure\Message\Amqp\Activity;


use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use DDD\Infrastructure\Message\Amqp\DefaultProducerAbstract;
use DDD\Infrastructure\Message\Amqp\Exchanges;
use DDD\Infrastructure\Message\Amqp\Queues;
use DDD\Infrastructure\Message\Amqp\RoutingKeys;

class ActivityProducer extends DefaultProducerAbstract
{
    function __construct(AmqpConnectionFactory $amqpConnectionFactory)
    {
        parent::__construct($amqpConnectionFactory, Exchanges::DDD_EXCHANGE, Queues::EVENTS_QUEUE, RoutingKeys::EVENT);
    }

}