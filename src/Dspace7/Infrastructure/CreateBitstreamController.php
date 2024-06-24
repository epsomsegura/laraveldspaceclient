<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateBitstreamUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BitstreamRequests;

final class CreateBitstreamController
{
    private $bitstreamRequests;    
    public function __construct()
    {
        $this->bitstreamRequests = new BitstreamRequests();
    }
    public function handler($filestream, $filename, $contentType, string $bundleUUID)
    {
        return (new CreateBitstreamUseCase($this->bitstreamRequests))->handler($filestream, $filename, $contentType, $bundleUUID);
    }
}
