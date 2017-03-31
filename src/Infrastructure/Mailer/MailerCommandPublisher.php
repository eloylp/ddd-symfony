<?php


namespace DDD\Infrastructure\Mailer;


use DDD\Infrastructure\Command\CommandInterface;

class MailerCommandPublisher
{
    private $mailerCommandProducer;

    function __construct(MailerProducer $mailerProducer)
    {
        $this->mailerCommandProducer = $mailerProducer;
    }

    public function publish(CommandInterface $command)
    {
        $this->mailerCommandProducer->publish($command);
    }

}