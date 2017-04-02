<?php

namespace DDD\Calculator\Domain\Model;


interface CommandRepository
{
    public function save(Command $event);
}