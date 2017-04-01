<?php

namespace DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration;

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\XmlDriver;

class DoctrineOdmConfigurerAdapter
{

    public function getDocumentManager()
    {
        $dbParams = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
        $paths = [
            __DIR__ . '/../Mappings'
        ];

        $connection = new Connection($dbParams['uri']);

        $config = new Configuration();
        $config->setProxyDir(__DIR__ . '/Proxies');
        $config->setProxyNamespace('Proxies');
        $config->setHydratorDir(__DIR__ . '/Hydrators');
        $config->setHydratorNamespace('Hydrators');
        $config->setDefaultDB($dbParams['database']);
        $driver = new XmlDriver($paths);
        $config->setMetadataDriverImpl($driver);
        $documentManager = DocumentManager::create($connection, $config);
        return $documentManager;
    }

}