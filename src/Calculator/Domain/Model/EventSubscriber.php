<?php

namespace DDD\Calculator\Domain\Model;


interface EventSubscriber
{
    public function handle(Event $event);
    public function isSubscribedTo(Event $event);
}