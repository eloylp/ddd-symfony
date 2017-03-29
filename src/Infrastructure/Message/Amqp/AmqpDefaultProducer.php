<?php


namespace DDD\Infrastructure\Message\Amqp;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class AmqpDefaultProducer
{
    private $connection;
    private $channel;
    private $exchange;

    function __construct(AMQPStreamConnection $amqpStreamConnection,
                         string $exchange,
                         string $queue,
                         string $routingKey)
    {
        $this->exchange = $exchange;
        $this->connection = $amqpStreamConnection;
        $this->channel = $amqpStreamConnection->channel();
        $this->channel->queue_declare($queue, false, true, false, false);
        $this->channel->exchange_declare($this->exchange, 'direct', false, true, false);
        $this->channel->queue_bind($queue, $this->exchange, $routingKey);
    }

    public function publish($msgBody)
    {
        $this->channel->basic_publish(new AMQPMessage(
            $msgBody, array('content_type' => 'application/json', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)

        ));
    }

    public function terminate()
    {
        $this->channel->close();
        $this->connection->close();
    }

}