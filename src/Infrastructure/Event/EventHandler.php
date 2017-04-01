<?php


namespace DDD\Infrastructure\Event;


use DDD\Calculator\Domain\Event\CalculatorEvents;
use DDD\Infrastructure\Mailer\Command\MailerCommand;
use DDD\Infrastructure\Mailer\MailerCommandPublisher;
use DDD\Infrastructure\Message\Amqp\ConsumerLogicInterface;
use Exception;
use PhpAmqpLib\Message\AMQPMessage;

class EventHandler implements ConsumerLogicInterface
{

    private $eventStoreRepository;
    private $mailerCommandPublisher;
    private $mailerConfig;

    function __construct(EventStoreRepository $eventStoreRepository,
                         MailerCommandPublisher $mailerProducer,
                         array $mailerConfig)
    {
        $this->eventStoreRepository = $eventStoreRepository;
        $this->mailerCommandPublisher = $mailerProducer;
        $this->mailerConfig = $mailerConfig;
    }

    public function processMessage(AMQPMessage $message)
    {
        try {

            $event = json_decode($message->getBody(), true);

            if ($event['type'] == CalculatorEvents::CALCULATOR_SUMMED_EVENT) {

                $this->mailerCommandPublisher->publish(new MailerCommand(
                    $this->mailerConfig['sender_address'],
                    "Someone calculating a number ..",
                    "sum_mail.html.twig",
                    ["name" => "DDD"]
                ));
            }

            $this->eventStoreRepository->append($event);

            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

        } catch (Exception $e) {

            $message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag']);

        }

    }
}