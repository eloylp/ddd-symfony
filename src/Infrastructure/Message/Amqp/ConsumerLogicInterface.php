<?php

namespace DDD\Infrastructure\Message\Amqp;


use PhpAmqpLib\Message\AMQPMessage;

interface ConsumerLogicInterface
{

    public function processMessage(AMQPMessage $message);

}