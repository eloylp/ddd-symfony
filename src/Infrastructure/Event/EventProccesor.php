<?php


namespace DDD\Infrastructure\Event;


use DDD\Infrastructure\Message\Amqp\ConsumerLogicInterface;
use PhpAmqpLib\Message\AMQPMessage;

class EventProccesor implements ConsumerLogicInterface
{


    public function processMessage(AMQPMessage $message)
    {
        echo "\n--------\n";
        echo $message->body;
        echo "\n--------\n";
        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
    }
}