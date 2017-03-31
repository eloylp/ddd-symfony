<?php

namespace DDD\Infrastructure\Mailer\Command;


use DateTime;
use DDD\Infrastructure\Command\CommandInterface;

class MailerCommand implements CommandInterface
{
    private $type = MailerCommands::MAILER_COMMAND;
    private $to;
    private $subject;
    private $templateName;
    private $templateData;
    private $time;
    private $processingTime;

    function __construct(string $to, string $subject, string $template_name,
                         array $template_data, DateTime $time = null)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->templateName = $template_name;
        $this->templateData = $template_data;

        if ($time) {
            $this->time = $time;
        } else {
            $this->time = new DateTime();
        }
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getTemplateName(): string
    {
        return $this->templateName;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getProcessingTime()
    {
        return $this->processingTime;
    }

    /**
     * @param mixed $processingTime
     */
    public function setProcessingTime($processingTime)
    {
        $this->processingTime = $processingTime;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            "type" => $this->getType(),
            "time" => $this->getTime(),
            "to" => $this->getTo(),
            "subject" => $this->getSubject(),
            "template_name" => $this->getTemplateName(),
            "template_data" => $this->getTemplateData(),
            "processing_time" => $this->getProcessingTime()
        ];
    }

    /**
     * @return array
     */
    public function getTemplateData(): array
    {
        return $this->templateData;
    }

    /**
     * @return DateTime
     */
    public function getTime(): DateTime
    {
        return $this->time;
    }
}