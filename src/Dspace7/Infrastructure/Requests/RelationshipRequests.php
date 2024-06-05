<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\RelationshipContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Relationship;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class RelationshipRequests implements RelationshipContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function create($relationType, $uuids): ?Relationship
    {
        $item = $this->requester->setMethod('post')->setEndpoint('core/relationships')->setQuery(["relationshipType" => $relationType])->setBody($uuids)->setHeaders(['Content-Type' => 'text/uri-list'])->request();
        return new Relationship(
            $item->id,
            $item->_links->leftItem->href,
            $item->_links->rightItem->href,
        );
    } 
}
