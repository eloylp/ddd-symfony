<?php


namespace DDD\Infrastructure\Command;


use JsonSerializable;

interface CommandInterface extends JsonSerializable
{
    public function getType();

    public function getTime();
}