<?php


namespace DDD\Infrastructure\Mailer;


use DDD\Infrastructure\Mailer\Configuration\MailerConfigurator;

use DDD\Infrastructure\Mailer\Exception\MailerException;
use Exception;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailerAdapter
{
    private $mailer;
    private $config;

    function __construct(MailerConfigurator $mailerConfigurator)
    {
        $this->config = $mailerConfigurator->getMailerConfiguration();
        $transport = Swift_SmtpTransport::newInstance(
            $this->config['host'],
            $this->config['port'],
            $this->config['security'])
            ->setUsername($this->config['user'])
            ->setPassword($this->config['password']);

        $this->mailer = Swift_Mailer::newInstance($transport);
    }

    public function sendMessage($to, $subject, $body)
    {
        try {
            $message = Swift_Message::newInstance($subject)
                ->setFrom(array($this->config['sender_address'] => $this->config['sender_name']))
                ->setTo($to)
                ->setBody($body);
            $this->mailer->send($message);

        } catch (Exception $e) {

            throw new MailerException($e->getMessage());
        }
    }
}