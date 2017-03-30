<?php


namespace DDD\Infrastructure\Templating;


class FolderRegistry
{
    public function getFolders()
    {
        return [
            __DIR__ . "/../../Calculator/Infrastructure/Templating/templates"
        ];
    }
}