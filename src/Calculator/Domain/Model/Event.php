<?php

namespace DDD\Calculator\Domain\Model;


use JsonSerializable;

interface Event extends JsonSerializable
{

    public function getType();

    public function getVersion();

    public function getTime();

}