<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetWorkflowitemsByCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\WorkflowitemRequests;

final class GetWorkflowitemsByCollectionUuidController
{
    private $workflowitemRequests;
    public function __construct()
    {
        $this->workflowitemRequests = new WorkflowitemRequests();
    }
    public function handler(string $collectionUuid, ?int $page)
    {
        return (new GetWorkflowitemsByCollectionUseCase($this->workflowitemRequests))->handler($collectionUuid,($page ?? 0));
    }
}
