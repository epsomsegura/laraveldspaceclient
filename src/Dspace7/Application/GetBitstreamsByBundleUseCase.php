<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BitstreamContract;

final class GetBitstreamsByBundleUseCase
{
    private $bitstreamContract;
    public function __construct(
        BitstreamContract $bitstreamContract
    ) {
        $this->bitstreamContract = $bitstreamContract;
    }
    public function handler(string $bundleUUID, int $page): array
    {
        return $this->bitstreamContract->findAllByBundleUUID($bundleUUID, $page);
    }
}
