<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\ItemExceptions;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Item;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Metadata;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class ItemRequests implements ItemContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function create($item, string $collectionUUID): ?Item
    {
        $item = $this->requester->setMethod('post')->setEndpoint('core/items')->setQuery(["owningCollection" => $collectionUUID])->setBody(json_encode($item))->setHeaders(['Content-Type' => 'application/json','Accept'=>'application/json'])->request();
        return new Item(
            $item->id,
            $item->uuid,
            $item->name,
            $item->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($item->metadata), TRUE)),
            $item->inArchive,
            $item->discoverable,
            $item->withdrawn,
            $item->type
        );
    }
    public function delete($uuid): string
    {
        $this->requester->setMethod('delete')->setEndpoint('core/items/' . $uuid)->setHeaders(['Content-Type' => 'application/json'])->request();
        return "success";
    }
    public function findAll(int $page): array
    {
        $items = $this->requester->setMethod('get')->setEndpoint('core/items')->setQuery(["page"=>$page])->request();
        if (!array_key_exists('_embedded', get_object_vars($items))) {
            throw ItemExceptions::notFound();
        }
        return ["items" => $items->_embedded->items,"page" => $items->page];
    }
    public function findAllByCollectionUUID(string $collectionUUID, int $page) : array
    {
        $items = $this->requester->setMethod('get')->setEndpoint('discover/search/objects')->setQuery(["scope"=>$collectionUUID,"page"=>$page])->request();
        if (!array_key_exists('_embedded', get_object_vars($items))) {
            throw ItemExceptions::notFound();
        }
        if ($items->_embedded->searchResult && !array_key_exists('_embedded', get_object_vars($items->_embedded->searchResult))) {
            throw ItemExceptions::notFound();
        }
        $page = $items->_embedded->searchResult->page;
        $items = array_filter($items->_embedded->searchResult->_embedded->objects, function($item){
            $item = $item->_embedded->indexableObject;
            return ($item->type === "item");
        });
        return ['items' => $this->getItems($items), 'page' => $page ];
    }
    public function findOneByHandle(string $handle): ?Item
    {
        $items = $this->requester->setMethod('get')->setEndpoint('discover/search/objects')->setQuery(["query" => $handle])->request();
        if (!array_key_exists('_embedded', get_object_vars($items))) {
            throw ItemExceptions::notFound();
        }
        if ($items->_embedded->searchResult && !array_key_exists('_embedded', get_object_vars($items->_embedded->searchResult))) {
            throw ItemExceptions::notFound();
        }
        $items = array_filter($items->_embedded->searchResult->_embedded->objects, function($item) use ($handle){
            $item = $item->_embedded->indexableObject;
            return ($item->handle === $handle && $item->type === "item");
        });
        if (sizeof($items) <= 0) {
            throw ItemExceptions::empty();
        }
        return $this->getItems($items)[0];
    }
    public function findOneByName(string $name): ?Item
    {
        $name = preg_replace('/[°!"#$%&\/()=?\'¡]/', '',mb_strimwidth($name,0,50));
        $items = $this->requester->setMethod('get')->setEndpoint('discover/search/objects')->setQuery(["query" => $name])->request();
        if (!array_key_exists('_embedded', get_object_vars($items))) {
            throw ItemExceptions::notFound();
        }
        if ($items->_embedded->searchResult && !array_key_exists('_embedded', get_object_vars($items->_embedded->searchResult))) {
            throw ItemExceptions::notFound();
        }
        $items = array_filter($items->_embedded->searchResult->_embedded->objects,function($item) use ($name){
            $itemName = preg_replace('/[°!"#$%&\/()=?\'¡]/', '',$item->_embedded->indexableObject->name);
            return (str_contains($itemName, $name) && $item->_embedded->indexableObject->type === "item");
        });
        if (sizeof($items) <= 0) {
            throw ItemExceptions::empty();
        }
        return $this->getItems($items)[0];
    }
    public function findOneByUUID(string $uuid): Item
    {
        $item = $this->requester->setMethod('get')->setEndpoint('core/items/' . $uuid)->request();
        return $this->getItems([$item])[0];
    }
    public function update($item, string $uuid): ?Item
    {
        $item = $this->requester->setMethod('put')->setEndpoint('core/items/'.$uuid)->setBody(json_encode($item))->setHeaders(['Content-Type' => 'application/json'])->request();
        return new Item(
            $item->id,
            $item->uuid,
            $item->name,
            $item->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($item->metadata), TRUE)),
            $item->inArchive,
            $item->discoverable,
            $item->withdrawn,
            $item->type
        );
    }
    private function getItems(array $items): array
    {
        $uniqueItems = [];
        foreach ($items as $item) {
            $item = (is_array($item) ? (object)$item : (property_exists($item,"_embedded") ? $item->_embedded->indexableObject : $item));
            $uniqueItems[] = new Item(
                $item->id,
                $item->uuid,
                $item->name,
                $item->handle,
                Metadata::arrayToMetadataArray(json_decode(json_encode($item->metadata), TRUE)),
                $item->inArchive,
                $item->discoverable,
                $item->withdrawn,
                $item->type,
                $item->_links
            );
        }
        return $uniqueItems;
    }
}
