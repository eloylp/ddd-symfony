<?php

namespace DDD\Infrastructure\Mailer\Event;


use DateTime;
use DDD\Infrastructure\Event\EventInterface;
use DDD\Infrastructure\Mailer\Command\MailerCommand;

class MailerSuccessEvent implements EventInterface
{
    private $type = MailerEvents::EMAIL_SUCCESS;
    private $version = 0;
    private $time;
    private $messageExecutedCommand;
    private $rawMail;

    function __construct(array $mailerCommand, string $rawMail, DateTime $time = null)
    {

        $this->messageExecutedCommand = $mailerCommand;
        $this->rawMail = $rawMail;

        if ($time) {
            $this->time = $time;
        } else {
            $this->time = new DateTime();
        }

    }


    public function getType()
    {
        return $this->type;
    }

    public function getVersion()
    {
        return $this->version;
    }

    function jsonSerialize()
    {
        return [
            "type" => $this->getType(),
            "version" => $this->getVersion(),
            "time" => $this->getTime(),
            "message_executed_command" => $this->getMessageExecutedCommand(),
            "raw_mail" => $this->getRawMail()
        ];
    }

    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return MailerCommand
     */
    public function getMessageExecutedCommand(): array
    {
        return $this->messageExecutedCommand;
    }

    /**
     * @return string
     */
    public function getRawMail(): string
    {
        return $this->rawMail;
    }
}