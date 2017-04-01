<?php
use DDD\Infrastructure\Persistence\Doctrine\Orm\Configuration\DoctrineConfigurerAdapter;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once __DIR__.'/../../../../../../vendor/autoload.php';

// replace with mechanism to retrieve EntityManager in your app
$doctrineConfigurerAdapter = new DoctrineConfigurerAdapter();
$entityManager = $doctrineConfigurerAdapter->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
