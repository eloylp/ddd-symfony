<?php

namespace DDD\Infrastructure\Persistence\Doctrine\Orm\Configuration;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class DoctrineOrmConfigurerAdapter
{

    public function getEntityManager()
    {
        $dbParams = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
        $paths = [
            __DIR__ . '/../../../../../Calculator/Infrastructure/Persistence/Doctrine/Orm/Mappings'
        ];
        $config = Setup::createXMLMetadataConfiguration($paths);
        $entityManager = EntityManager::create($dbParams, $config);
        return $entityManager;

    }

}