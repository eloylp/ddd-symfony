<?php

namespace DDD\Infrastructure\Message\Amqp;


use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;

class EventProducer extends DefaultProducerAbstract
{
    function __construct(AmqpConnectionFactory $amqpConnectionFactory)
    {
        parent::__construct($amqpConnectionFactory, Exchanges::DDD_EXCHANGE, Queues::EVENTS_QUEUE, RoutingKeys::EVENT);
    }

}