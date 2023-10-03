<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

class Item
{

    private ?string $_id;
    private ?string $_uuid;
    private string $_name;
    private ?string $_handle;
    private array $_metadata;
    private ?bool $_inArchive;
    private ?bool $_discoverable;
    private ?bool $_withdraw;
    private string $_type;

    public function __construct(
        ?string $id,
        ?string $uuid,
        string $name,
        ?string $handle,
        array $metadata,
        ?bool $inArchive,
        ?bool $discoverable,
        ?bool $withdraw,
        string $type
    ) {
        $this->_id = $id;
        $this->_uuid = $uuid;
        $this->_name = $name;
        $this->_handle = $handle;
        $this->_metadata = $metadata;
        $this->_inArchive = $inArchive;
        $this->_discoverable = $discoverable;
        $this->_withdraw = $withdraw;
        $this->_type = $type;
    }

    public function id() : ?string
    {
        return $this->_id;
    }
    public function uuid() : ?string
    {
        return $this->_uuid;
    }
    public function name() : ?string
    {
        return $this->_name;
    }
    public function handle() : ?string
    {
        return $this->_handle;
    }
    public function metadata() : ?array
    {
        return $this->_metadata;
    }
    public function inArchive() : ?bool
    {
        return $this->_inArchive;
    }
    public function discoverable() : ?bool
    {
        return $this->_discoverable;
    }
    public function withdraw() : ?bool
    {
        return $this->_withdraw;
    }
    public function type() : string
    {
        return $this->_type;
    }

    public function toCollection()
    {
        return collect($this);
    }
}
