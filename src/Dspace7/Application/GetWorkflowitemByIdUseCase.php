<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\WorkflowitemContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Workflowitem;

final class GetWorkflowitemByIdUseCase
{
    private $workflowitemContract;
    public function __construct(
        WorkflowitemContract $workflowitemContract
    ) {
        $this->workflowitemContract = $workflowitemContract;
    }
    public function handler(string $id): ?Workflowitem
    {
        return $this->workflowitemContract->findOneById($id);
    }
}
