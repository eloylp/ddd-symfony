<?php

namespace DDD\Infrastructure\Mailer\Event;


use DateTime;
use DDD\Infrastructure\Event\EventAbstract;

class MailerSuccessEvent extends EventAbstract
{
    function __construct(array $context, DateTime $time = null)
    {
        parent::__construct(MailerEvents::EMAIL_SUCCESS, $context, $time);
    }

}