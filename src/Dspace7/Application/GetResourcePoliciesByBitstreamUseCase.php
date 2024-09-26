<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ResourcePolicyContract;

final class GetResourcePoliciesByBitstreamUseCase
{
    private $resourcePolicyContract;
    public function __construct(
        ResourcePolicyContract $resourcePolicyContract
    ) {
        $this->resourcePolicyContract = $resourcePolicyContract;
    }
    public function handler(string $bitstreamUUID, int $page): array
    {
        return $this->resourcePolicyContract->findAllByBitstreamUuid($bitstreamUUID, $page);
    }
}
