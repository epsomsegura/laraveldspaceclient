<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Collection;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\WorkflowitemContract;

final class GetWorkflowitemsByCollectionUseCase
{
    private $workflowitemContract;
    public function __construct(
        WorkflowitemContract $workflowitemContract
    ) {
        $this->workflowitemContract = $workflowitemContract;
    }
    public function handler(string $collectionUUID, int $page): array
    {
        return $this->workflowitemContract->findAllByCollectionUUID($collectionUUID, $page);
    }
}
