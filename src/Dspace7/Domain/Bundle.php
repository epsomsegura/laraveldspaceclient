<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

use Maatwebsite\Excel\Concerns\ToArray;

class Bundle
{
    private ?string $_id;
    private ?string $_uuid;
    private string $_name;
    private ?string $_handle;
    private array $_metadata;
    private string $_type;
    public function __construct(
        ?string $id,
        ?string $uuid,
        string $name,
        ?string $handle,
        array $metadata,
        string $type
    ) {
        $this->_id = $id;
        $this->_uuid = $uuid;
        $this->_name = $name;
        $this->_handle = $handle;
        $this->_metadata = $metadata ?? [];
        $this->_type = $type;
    }
    public function id(): ?string
    {
        return $this->_id;
    }
    public function uuid(): ?string
    {
        return $this->_uuid;
    }
    public function name(): ?string
    {
        return $this->_name;
    }
    public function handle(): ?string
    {
        return $this->_handle;
    }
    public function metadata(): ?array
    {
        return $this->_metadata;
    }
    public function type(): string
    {
        return $this->_type;
    }
    public function toCollection()
    {
        return collect($this);
    }
    public function toArray()
    {
        return [
            "id" => $this->_id,
            "uuid" => $this->_uuid,
            "name" => $this->_name,
            "handle" => $this->_handle,
            "metadata" => Metadata::metadataArrayToArray($this->_metadata),
            "type" => $this->_type,
        ];
    }
}
