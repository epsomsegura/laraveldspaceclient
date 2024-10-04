<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BitstreamContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Bitstream;

final class GetBitstreamByUUIDUseCase
{
    private $bitstreamContract;
    public function __construct(
        BitstreamContract $bitstreamContract
    ) {
        $this->bitstreamContract = $bitstreamContract;
    }
    public function handler(string $uuid): ?Bitstream
    {
        return $this->bitstreamContract->findOneByUUID($uuid);
    }
}
