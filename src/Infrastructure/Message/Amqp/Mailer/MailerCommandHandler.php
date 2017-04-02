<?php

namespace DDD\Infrastructure\Message\Amqp\Mailer;


use DDD\Calculator\Domain\Model\EventPublisher;
use DDD\Calculator\Domain\Model\EmailSentEvent;
use DDD\Infrastructure\Mailer\Exception\MailerException;
use DDD\Infrastructure\Mailer\MailerAdapter;
use DDD\Infrastructure\Message\Amqp\ConsumerLogic;
use DDD\Infrastructure\Templating\Exception\TemplatingEngineException;
use DDD\Infrastructure\Templating\TemplateAdapter;
use PhpAmqpLib\Message\AMQPMessage;

class MailerCommandHandler implements ConsumerLogic
{
    private $mailer;
    private $templateEngine;
    private $eventPublisher;

    function __construct(MailerAdapter $mailerAdapter,
                         TemplateAdapter $templateAdapter,
                         EventPublisher $eventPublisher)
    {
        $this->mailer = $mailerAdapter;
        $this->templateEngine = $templateAdapter;
        $this->eventPublisher = $eventPublisher;
    }

    public function processMessage(AMQPMessage $message)
    {
        try {

            $amqpBody = json_decode($message->getBody(), true);
            $rendered = $this->templateEngine->render($amqpBody['template_name'], $amqpBody['template_data']);
            $this->mailer->sendMessage($amqpBody['to'], $amqpBody['subject'], $rendered);

            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

            $this->eventPublisher->publish(new EmailSentEvent($amqpBody['id'], $rendered));

        } catch (MailerException $e) {

            $message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag'], false, true);

            throw $e;

        } catch (TemplatingEngineException $e) {

            $message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag'], false, true);

            throw $e;
        }

    }
}