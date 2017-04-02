<?php


namespace DDD\Infrastructure\Message\Amqp\Activity;


use DDD\Calculator\Domain\Model\SendEmailCommand;
use DDD\Infrastructure\Message\Amqp\ConsumerLogic;
use DDD\Infrastructure\Message\Amqp\Mailer\MailerProducer;
use Exception;
use PhpAmqpLib\Message\AMQPMessage;

class ActivityHandler implements ConsumerLogic
{

    private $mailerProducer;
    private $mailerConfig;

    function __construct(MailerProducer $mailerProducer,
                         array $mailerConfig)
    {
        $this->mailerProducer = $mailerProducer;
        $this->mailerConfig = $mailerConfig;
    }

    public function processMessage(AMQPMessage $message)
    {
        try {

            $event = json_decode($message->getBody(), true);

            /// Todo something with your activity event.

            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

        } catch (Exception $e) {

            $message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag']);

        }

    }
}