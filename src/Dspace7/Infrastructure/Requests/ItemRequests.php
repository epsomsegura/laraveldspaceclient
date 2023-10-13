<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\ItemExceptions;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Item;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class ItemRequests implements ItemContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function create($item, string $collectionUUID) : ?Item
    {
        $item = $this->requester->setMethod('post')->setEndpoint('core/items')->setQuery(["owningCollection" => $collectionUUID])->setBody(json_encode($item))->setHeaders(['Content-Type'=>'application/json'])->request();
        return new Item(
            $item->id,
            $item->uuid,
            $item->name,
            $item->handle,
            json_decode(json_encode($item->metadata), true),
            $item->inArchive,
            $item->discoverable,
            $item->withdrawn,
            $item->type
        );;
    }

    public function findOneByHandle(string $handle): ?Item
    {
        $item = $this->requester->setMethod('get')->setEndpoint('discover/search/objects')->setQuery(["query" => $handle])->request();
        if (!array_key_exists('_embedded', get_object_vars($item))) {
            throw ItemExceptions::notFound();
        }
        if ($item->_embedded->searchResult && !array_key_exists('_embedded', get_object_vars($item->_embedded->searchResult))) {
            throw ItemExceptions::notFound();
        }
        if (sizeof($item->_embedded->searchResult->_embedded->objects) <= 0) {
            throw ItemExceptions::empty();
        }
        return $this->getItem($item->_embedded->searchResult->_embedded->objects, $handle);
    }

    private function getItem(array $items, string $handle): Item
    {
        $uniqueItems = [];
        foreach ($items as $item) {
            $item = $item->_embedded->indexableObject;
            if ($item->handle === $handle && $item->type === 'item') {
                $uniqueItems[] = new Item(
                    $item->id,
                    $item->uuid,
                    $item->name,
                    $item->handle,
                    json_decode(json_encode($item->metadata), true),
                    $item->inArchive,
                    $item->discoverable,
                    $item->withdrawn,
                    $item->type
                );
            }
        }
        return $uniqueItems[0];
    }
}
