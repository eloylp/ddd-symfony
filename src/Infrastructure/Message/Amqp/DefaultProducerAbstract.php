<?php


namespace DDD\Infrastructure\Message\Amqp;


use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use PhpAmqpLib\Message\AMQPMessage;

abstract class DefaultProducerAbstract
{
    private $connection;
    private $channel;
    private $exchange;
    private $routingKey;

    function __construct(AmqpConnectionFactory $amqpConnectionFactory,
                         string $exchange,
                         string $queue,
                         string $routingKey,
                         string $exchangeType = ExchangeTypes::AMQP_DIRECT)
    {
        $this->exchange = $exchange;
        $this->routingKey = $routingKey;
        $this->connection = $amqpConnectionFactory->getAmqpConnection();
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($queue, false, true, false, false);
        $this->channel->exchange_declare($this->exchange, $exchangeType, false, true, false);
        $this->channel->queue_bind($queue, $this->exchange, $routingKey);
    }

    public function publish($msgBody)
    {
        $this->channel->basic_publish(
            new AMQPMessage(
                json_encode($msgBody),
                array('content_type' => 'application/json', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
            ),
            $this->exchange, $this->routingKey
            );
    }

    public function terminate()
    {
        $this->channel->close();
        $this->connection->close();
    }

}