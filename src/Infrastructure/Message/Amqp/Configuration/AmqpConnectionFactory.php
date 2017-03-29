<?php

namespace DDD\Infrastructure\Message\Amqp\Configuration;


use PhpAmqpLib\Connection\AMQPStreamConnection;

class AmqpConnectionFactory
{

    public function getAmqpConnection(): AMQPStreamConnection
    {
        $amqpParams = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
        $amqpConnection = new AMQPStreamConnection($amqpParams['host'],
            $amqpParams['port'],
            $amqpParams['user'],
            $amqpParams['pass'],
            $amqpParams['vhost']);
        return $amqpConnection;
    }
}