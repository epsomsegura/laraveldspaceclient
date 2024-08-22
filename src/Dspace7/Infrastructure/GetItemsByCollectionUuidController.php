<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemsByCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class GetItemsByCollectionUuidController
{
    private $itemRequests;
    public function __construct()
    {
        $this->itemRequests = new ItemRequests();
    }
    public function handler(string $collectionUuid, ?int $page)
    {
        return (new GetItemsByCollectionUseCase($this->itemRequests))->handler($collectionUuid,($page ?? 0));
    }
}
