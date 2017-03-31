<?php


namespace DDD\Infrastructure\Web\Symfony\AppBundle\Log;


class AppLogProcessor
{
    public function __invoke(array $record): array
    {
        $record['extra']['app'] = "app_symfony";
        return $record;
    }
}