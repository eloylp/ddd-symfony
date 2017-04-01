<?php
use DDD\Infrastructure\Persistence\Doctrine\Odm\Configuration\DoctrineOdmConfigurerAdapter;
use Symfony\Component\Console\Application;

// replace with file to your own project bootstrap
require_once __DIR__ . '/../../../../../../vendor/autoload.php';

$doctrineConfigurerAdapter = new DoctrineOdmConfigurerAdapter();
$documentManager = $doctrineConfigurerAdapter->getDocumentManager();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'dm' => new \Doctrine\ODM\MongoDB\Tools\Console\Helper\DocumentManagerHelper($documentManager),
));

$app = new Application('Doctrine MongoDB ODM');
$app->setHelperSet($helperSet);
$app->addCommands(array(
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateDocumentsCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateHydratorsCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateProxiesCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateRepositoriesCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\QueryCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\ClearCache\MetadataCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\CreateCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\DropCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\UpdateCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\ShardCommand(),
));

$app->run();