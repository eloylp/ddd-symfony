<?php

namespace DDD\Infrastructure\Command;

use DateTime;
use JsonSerializable;

abstract class CommandAbstract implements JsonSerializable
{
    protected $type;
    protected $requestTime;
    protected $doneTime;
    protected $context;

    function __construct(string $type,
                         array $context,
                         DateTime $requestTime = null,
                         DateTime $doneTime = null
    )
    {
        $this->type = $type;
        $this->context = $context;
        if (!$requestTime) {
            $this->requestTime = new DateTime();
        }
        $this->requestTime = $requestTime;
        $this->doneTime = $doneTime;
    }

    function jsonSerialize()
    {
        return [

            "type" => $this->getType(),
            "requestTime" => $this->getRequestTime(),
            "doneTime" => $this->getDoneTime(),
            "context" => $this->getContext()
        ];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return DateTime
     */
    public function getRequestTime(): DateTime
    {
        return $this->requestTime;
    }

    /**
     * @return DateTime
     */
    public function getDoneTime(): ? DateTime
    {
        return $this->doneTime;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}