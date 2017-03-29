<?php

namespace DDD\Infrastructure\Message\Amqp;


use PhpAmqpLib\Connection\AMQPStreamConnection;

class EventProducer extends AmqpDefaultProducer
{
    function __construct(AMQPStreamConnection $amqpStreamConnection)
    {
        parent::__construct($amqpStreamConnection, Exchanges::DDD_EXCHANGE, Queues::EVENTS_QUEUE, RoutingKeys::EVENT);
    }

}