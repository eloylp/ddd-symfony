<?php


namespace DDD\Infrastructure\Event;


use DDD\Infrastructure\Mailer\MailerProducer;
use DDD\Infrastructure\Message\Amqp\ConsumerLogicInterface;
use PhpAmqpLib\Message\AMQPMessage;

class EventHandler implements ConsumerLogicInterface
{

    private $eventStoreRepository;
    private $mailerProducer;

    function __construct(EventStoreRepository $eventStoreRepository, MailerProducer $mailerProducer)
    {
        $this->eventStoreRepository = $eventStoreRepository;
        $this->mailerProducer = $mailerProducer;
    }

    public function processMessage(AMQPMessage $message)
    {
        $event = json_decode($message->getBody());
        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
        if ($event['type']) {

            /// TODO

        }
    }
}