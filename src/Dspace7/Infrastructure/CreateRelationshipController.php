<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateRelationshipUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\RelationshipRequests;
use Illuminate\Http\Request;

final class CreateRelationshipController
{
    private $relationshipRequests;
    public function __construct()
    {
        $this->relationshipRequests = new RelationshipRequests();
    }
    public function handler(string $relationType, string $uuids)
    {
        return (new CreateRelationshipUseCase($this->relationshipRequests))->handler($relationType, $uuids);
    }
}
