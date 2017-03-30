<?php


namespace DDD\Infrastructure\Event;

use DDD\Infrastructure\Persistence\Mongo\Configuration\MongoConfigurerAdapter;

class EventStoreRepository
{
    private $mongoClient;

    function __construct(MongoConfigurerAdapter $mongoConfigurerAdapter)
    {
        $this->mongoClient = $mongoConfigurerAdapter->getMongoClient();
    }

    public function append(array $event)
    {
        $this->mongoClient->events->insertOne($event);
    }
}