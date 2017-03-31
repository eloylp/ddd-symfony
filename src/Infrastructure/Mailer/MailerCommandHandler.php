<?php

namespace DDD\Infrastructure\Mailer;


use DDD\Infrastructure\Event\EventStore;
use DDD\Infrastructure\Mailer\Event\MailerSuccessEvent;
use DDD\Infrastructure\Mailer\Exception\MailerException;
use DDD\Infrastructure\Message\Amqp\ConsumerLogicInterface;
use DDD\Infrastructure\Templating\Exception\TemplatingEngineException;
use DDD\Infrastructure\Templating\TemplateAdapter;
use PhpAmqpLib\Message\AMQPMessage;

class MailerCommandHandler implements ConsumerLogicInterface
{
    private $mailer;
    private $templateEngine;
    private $eventStore;

    function __construct(MailerAdapter $mailerAdapter,
                         TemplateAdapter $templateAdapter,
                         EventStore $eventStore)
    {
        $this->mailer = $mailerAdapter;
        $this->templateEngine = $templateAdapter;
        $this->eventStore = $eventStore;
    }

    public function processMessage(AMQPMessage $message)
    {
        try {

            $amqpBody = json_decode($message->getBody(), true);
            $rendered = $this->templateEngine->render($amqpBody['template_name'], $amqpBody['template_data']);
            $this->mailer->sendMessage($amqpBody['to'], $amqpBody['subject'], $rendered);

            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

            $this->eventStore->append(new MailerSuccessEvent($amqpBody, $rendered));

        } catch (MailerException $e) {

            $message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag'], false, true);

            throw $e;

        } catch (TemplatingEngineException $e) {

            $message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag'], false, true);

            throw $e;
        }

    }
}