<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class GetItemByNameController
{

    private $itemRequests;

    public function __construct()
    {
        $this->itemRequests = new ItemRequests();
    }

    public function handler(string $name)
    {
        return (new GetItemByNameUseCase($this->itemRequests))->handler($name);
    }

}