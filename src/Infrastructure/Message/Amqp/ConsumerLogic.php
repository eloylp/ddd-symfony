<?php

namespace DDD\Infrastructure\Message\Amqp;


use PhpAmqpLib\Message\AMQPMessage;

interface ConsumerLogic
{

    public function processMessage(AMQPMessage $message);

}