<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Workflowitem;

interface WorkflowitemContract
{
    public function findAllByCollectionUUID(string $collectionUUID, int $page) : array;
    public function findOneById(string $id) : ?Workflowitem;
}