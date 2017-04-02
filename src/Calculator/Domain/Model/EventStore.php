<?php

namespace DDD\Calculator\Domain\Model;


interface EventStore
{
    public function append(Event $event);
}