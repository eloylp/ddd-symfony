<?php


namespace DDD\Calculator\Domain\Model;


use JsonSerializable;

interface Command extends JsonSerializable
{
    public function getType();

    public function getTime();
}