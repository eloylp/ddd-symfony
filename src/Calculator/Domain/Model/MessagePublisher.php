<?php

namespace DDD\Calculator\Domain\Model;


use JsonSerializable;

interface MessagePublisher
{
    public function publish(JsonSerializable $jsonSerializable);
}