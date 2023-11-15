<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

class Collection
{

    private ?string $_id;
    private ?string $_uuid;
    private string $_name;
    private ?string $_handle;
    private $_metadata;

    public function __construct(
        string $id,
        string $uuid,
        string $name,
        string $handle,
        array $metadata
    ) {
        $this->_id = $id;
        $this->_uuid = $uuid;
        $this->_name = $name;
        $this->_handle = $handle;
        $this->_metadata = $metadata ?? [];
    }

    public function id(): string
    {
        return $this->_id;
    }
    public function uuid(): string
    {
        return $this->_uuid;
    }
    public function name(): string
    {
        return $this->_name;
    }
    public function handle(): string
    {
        return $this->_handle;
    }
    public function metadata(): array
    {
        return $this->_metadata;
    }

    public function toCollection()
    {
        return collect($this);
    }

    public function toArray()
    {
        $metadataItems = [];
        foreach ($this->_metadata as $key => $metadata) {
            foreach ($metadata as $metadataItem) {
                $metadataItems[$key][] = $metadataItem->toArray();
            }
        }
        return [
            "id" => $this->_id,
            "uuid" => $this->_uuid,
            "name" => $this->_name,
            "handle" => $this->_handle,
            "metadata" => $metadataItems
        ];
    }
}
