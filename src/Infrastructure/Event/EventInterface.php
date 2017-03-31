<?php

namespace DDD\Infrastructure\Event;


use JsonSerializable;

interface EventInterface extends JsonSerializable
{

    public function getType();

    public function getVersion();

    public function getTime();

}