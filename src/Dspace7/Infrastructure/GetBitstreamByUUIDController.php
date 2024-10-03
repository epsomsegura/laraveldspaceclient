<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetBitstreamByUUIDUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BitstreamRequests;

final class GetBitstreamByUUIDController
{
    private $bitstreamRequests;
    public function __construct()
    {
        $this->bitstreamRequests = new BitstreamRequests();
    }
    public function handler(string $uuid)
    {
        return (new GetBitstreamByUUIDUseCase($this->bitstreamRequests))->handler($uuid);
    }
}
