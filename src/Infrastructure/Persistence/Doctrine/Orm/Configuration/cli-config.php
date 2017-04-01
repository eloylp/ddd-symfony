<?php
use DDD\Infrastructure\Persistence\Doctrine\Orm\Configuration\DoctrineOrmConfigurerAdapter;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once __DIR__.'/../../../../../../vendor/autoload.php';

// replace with mechanism to retrieve EntityManager in your app
$doctrineConfigurerAdapter = new DoctrineOrmConfigurerAdapter();
$entityManager = $doctrineConfigurerAdapter->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
