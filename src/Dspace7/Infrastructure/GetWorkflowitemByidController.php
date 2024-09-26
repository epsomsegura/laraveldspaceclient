<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetWorkflowitemByIdUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\WorkflowitemRequests;

final class GetWorkflowitemByIdController
{
    private $workflowitemRequests;
    public function __construct()
    {
        $this->workflowitemRequests = new WorkflowitemRequests();
    }
    public function handler(string $id)
    {
        return (new GetWorkflowitemByIdUseCase($this->workflowitemRequests))->handler($id);
    }
}
