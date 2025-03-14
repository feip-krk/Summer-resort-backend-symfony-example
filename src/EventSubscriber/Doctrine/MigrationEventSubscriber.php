<?php

declare(strict_types=1);

namespace App\EventSubscriber\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;
use Doctrine\ORM\Tools\ToolEvents;

/** @psalm-suppress UnusedClass */
class MigrationEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [ToolEvents::postGenerateSchema];
    }

    public function postGenerateSchema(GenerateSchemaEventArgs $args): void
    {
        $schema = $args->getSchema();

        // https://github.com/doctrine/dbal/issues/1110
        if (!$schema->hasNamespace('public')) {
            $schema->createNamespace('public');
        }
    }
}
