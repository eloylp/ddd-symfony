<?php

namespace DDD\Infrastructure\Mailer\Command;


use DateTime;
use DDD\Infrastructure\Command\CommandAbstract;

class MailerCommand extends CommandAbstract
{

    function __construct(array $context, DateTime $requestTime = null, DateTime $doneTime = null)
    {
        parent::__construct(MailerCommands::SEND_EMAIL, $context, $requestTime, $doneTime);
    }
}