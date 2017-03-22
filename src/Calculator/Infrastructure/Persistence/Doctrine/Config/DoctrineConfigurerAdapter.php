<?php

namespace DDD\Calculator\Infrastructure\Persistence\Doctrine\Config;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class DoctrineConfigurerAdapter
{

    public function getEntityManager()
    {
        $dbParams = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
        $paths = [__DIR__ . '/../Mappings'];
        $config = Setup::createXMLMetadataConfiguration($paths);
        $entityManager = EntityManager::create($dbParams, $config);
        return $entityManager;

    }

}