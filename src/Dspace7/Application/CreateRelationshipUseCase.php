<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\RelationshipContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Relationship;

final class CreateRelationshipUseCase
{
    private $relationshipContract;
    public function __construct(
        RelationshipContract $relationshipContract
    ) {
        $this->relationshipContract = $relationshipContract;
    }
    public function handler($relationType, $uuids): ?Relationship
    {
        return $this->relationshipContract->create($relationType, $uuids);
    }
}
