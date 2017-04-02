<?php

namespace DDD\Calculator\Domain\Model;


interface CommandStore
{
    public function append(Command $event);
}