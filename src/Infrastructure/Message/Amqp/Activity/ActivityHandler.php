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

            if($event['type'] != "ddd.event.email.sent"){

                $this->mailerProducer->publish(new SendEmailCommand(
                    $this->mailerConfig['sender_address'],
                    "Someone did something ..",
                    "event_mail.html.twig",
                    [
                        "name" => "DDD",
                        "event" => json_encode($event)
                    ]
                ));
            }

            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

        } catch (Exception $e) {

            $message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag']);

        }

    }
}