<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Collection;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CollectionContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\CollectionExceptions;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class CollectionRequests implements CollectionContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function findOneByName(string $name): Collection
    {
        $collection = $this->requester->setMethod('get')->setEndpoint('core/collections/search/findAdminAuthorized')->setQuery(["query" => $name])->request();
        if (!array_key_exists('_embedded', get_object_vars($collection))) {
            throw CollectionExceptions::notFound();
        }
        if (sizeof($collection->_embedded->collections) <= 0) {
            throw CollectionExceptions::empty();
        }
        return $this->getCollection($collection->_embedded->collections, $name);
    }

    private function getCollection(array $collections, string $name) : Collection
    {
        $uniqueCollections = [];
        foreach ($collections as $collection) {
            if ($collection->name == $name) {
                $uniqueCollections[] = new Collection(
                    $collection->id,
                    $collection->uuid,
                    $collection->name,
                    $collection->handle,
                    json_decode(json_encode($collection->metadata), true)
                );
            }
        }
        return $uniqueCollections[0];
    }
}
