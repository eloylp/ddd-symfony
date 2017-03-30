<?php


namespace DDD\Infrastructure\Mailer\Configuration;


class MailerConfigurator
{
    public function getMailerConfiguration()
    {
        $mailerParams = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
        return $mailerParams;
    }
}