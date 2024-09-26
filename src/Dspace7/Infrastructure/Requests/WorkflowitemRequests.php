<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\WorkflowitemContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\WorkflowitemExceptions;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Item;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Metadata;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Workflowitem;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class WorkflowitemRequests implements WorkflowitemContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function findAllByCollectionUUID(string $collectionUUID, int $page) : array
    {
        $items = $this->requester->setMethod('get')->setEndpoint('discover/search/objects')->setQuery(["scope"=>$collectionUUID,"page"=>$page,'dsoType'=>'xmlworkflowitem','configuration'=>'workspace'])->request();
        if (!array_key_exists('_embedded', get_object_vars($items))) {
            throw WorkflowitemExceptions::empty();
        }
        if ($items->_embedded->searchResult && !array_key_exists('_embedded', get_object_vars($items->_embedded->searchResult))) {
            throw WorkflowitemExceptions::empty();
        }
        $page = $items->_embedded->searchResult->page;
        $workflowitemobjects = array_filter($items->_embedded->searchResult->_embedded->objects, function($object){
            $object = $object->_embedded->indexableObject;
            return ($object->type === "workflowitem");
        });
        return ['workflowitems' => $this->getWorkflowitems($workflowitemobjects), 'page' => $page ];
    }
    public function findOneById(string $id): Workflowitem
    {
        $workflowitem = $this->requester->setMethod('get')->setEndpoint('workflow/workflowitems/' . $id)->request();
        $itemobject = $workflowitem->_embedded->item;
        $item = new Item(
            $itemobject->id,
            $itemobject->uuid,
            $itemobject->name,
            $itemobject->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($itemobject->metadata), TRUE)),
            $itemobject->inArchive,
            $itemobject->discoverable,
            $itemobject->withdrawn,
            $itemobject->type
        );
        $workflowitem = new Workflowitem(
            $workflowitem->id,
            $workflowitem->lastModified,
            $workflowitem->step ?? null,
            $workflowitem->sections,
            $item,
            $workflowitem->type
        );
        return $workflowitem;
    }

    private function getWorkflowitems(array $workflowitemobjects): array
    {
        $uniqueItems = [];
        foreach ($workflowitemobjects as $workflowitemobject) {
            $workflowitem = (is_array($workflowitemobject) ? (object)$workflowitemobject : (property_exists($workflowitemobject,"_embedded") ? $workflowitemobject->_embedded->indexableObject : $workflowitemobject));
            $itemobject = $workflowitem->_embedded->item;
            $item = new Item(
                $itemobject->id,
                $itemobject->uuid,
                $itemobject->name,
                $itemobject->handle,
                Metadata::arrayToMetadataArray(json_decode(json_encode($itemobject->metadata), TRUE)),
                $itemobject->inArchive,
                $itemobject->discoverable,
                $itemobject->withdrawn,
                $itemobject->type
            );
            $uniqueItems[] = new Workflowitem(
                $workflowitem->id,
                $workflowitem->lastModified,
                $workflowitem->step ?? null,
                $workflowitem->sections,
                $item,
                $workflowitem->type
            );
        }
        return $uniqueItems;
    }
}
