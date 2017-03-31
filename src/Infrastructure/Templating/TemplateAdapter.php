<?php


namespace DDD\Infrastructure\Templating;


use DDD\Infrastructure\Templating\Exception\TemplatingEngineException;
use Exception;
use Twig_Environment;
use Twig_Loader_Filesystem;

class TemplateAdapter
{
    private $folderRegistry;
    private $templatingEngine;

    function __construct(FolderRegistry $foldersRegistry)
    {
        $this->folderRegistry = $foldersRegistry;
        $loader = new Twig_Loader_Filesystem($foldersRegistry->getFolders());
        $this->templatingEngine = new Twig_Environment($loader, array(
            'cache' => __DIR__ . '/cache',
        ));
    }

    public function render(string $name, array $data)
    {
        try {

            $rendered = $this->templatingEngine->render($name, $data);
            return $rendered;

        } catch (Exception $e) {

            throw new TemplatingEngineException($e->getMessage());
        }
    }
}