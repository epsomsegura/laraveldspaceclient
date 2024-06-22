<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BitstreamContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Bitstream;

final class CreateBitstreamUseCase
{
    private $bitstreamContract;
    public function __construct(
        BitstreamContract $bitstreamContract
    ) {
        $this->bitstreamContract = $bitstreamContract;
    }

    public function handler($filestream, $filename, $contentType, string $bundleUUID): ?Bitstream
    {
        return $this->bitstreamContract->create($filestream, $filename, $contentType, $bundleUUID);
    }
}
