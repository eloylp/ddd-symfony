<?php

namespace DDD\Calculator\Domain\Model;


interface CommandSubscriber
{
    public function handle(Command $command);
    public function isSubscribedTo(Command $command);
}