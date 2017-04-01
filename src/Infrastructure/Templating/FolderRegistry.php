<?php


namespace DDD\Infrastructure\Templating;


class FolderRegistry
{
    public function getFolders()
    {
        return [
            __DIR__ . "/../Web/Symfony/src/CalculatorBundle/Resources/mail"
        ];
    }
}