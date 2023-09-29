<?php
namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

class Item{

    private string $_id;
    private string $_uuid;
    private string $_name;
    private string $_handle;
    private array $_metadata;
    private string $_type;

    public function __construct(
        string $id,
        string $uuid,
        string $name,
        string $handle,
        array $metadata,
        string $type
    )
    {
        $this->_id = $id;
        $this->_uuid = $uuid;
        $this->_name = $name;
        $this->_handle = $handle;
        $this->_metadata = $metadata;
        $this->_type = $type;
    }

    public function id(){
        return $this->_id;
    }
    public function uuid(){
        return $this->_uuid;
    }
    public function name(){
        return $this->_name;
    }
    public function handle(){
        return $this->_handle;
    }
    public function metadata(){
        return $this->_metadata;
    }
    public function type(){
        return $this->_type;
    }

    public function toCollection()
    {
        return collect($this);
    }
}