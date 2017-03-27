<?php

namespace DDD\Infrastructure\Persistence\Mongo\Configuration;


use MongoDB\Client;

class MongoConfigurerAdapter
{

    public function getMongoClient()
    {
        $dbParams = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
        $database = $dbParams['database'];
        return (new Client($dbParams['uri']))->$database;
    }

}