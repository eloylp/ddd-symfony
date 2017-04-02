<?php

namespace DDD\Calculator\Domain\Model;


use DateTime;

class EmailSentEvent implements Event
{
    private $id;
    private $type = "ddd.event.email.sent";
    private $version = 0;
    private $time;
    private $executedCommand;
    private $rawMail;

    function __construct(array $mailerCommand, string $rawMail, DateTime $time = null)
    {

        $this->executedCommand = $mailerCommand;
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
            "executed_command" => $this->getExecutedCommand(),
            "raw_mail" => $this->getRawMail()
        ];
    }

    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return array
     */
    public function getExecutedCommand(): array
    {
        return $this->executedCommand;
    }

    /**
     * @return string
     */
    public function getRawMail(): string
    {
        return $this->rawMail;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}