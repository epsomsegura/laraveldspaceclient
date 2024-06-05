<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

class Relationship
{
    private int $_id;
    private string $_leftUuid;    
    private string $_rightUuid;

    public function __construct(
        int $id,
        string $leftUuid,
        string $rightUuid,        
    ) {
        $this->_id = $id;
        $this->_leftUuid = $leftUuid;
        $this->_rightUuid = $rightUuid;
    }
    public function id(): ?int
    {
        return $this->_id;
    }
    public function leftUuid(): ?string
    {
        return $this->_leftUuid;
    }
    public function rightUuid(): ?string
    {
        return $this->_rightUuid;
    }
    public function toArray()
    {
        return [
            "id" => $this->_id,
            "leftUuid" => $this->_leftUuid,
            "rightUuid" => $this->_rightUuid,
        ];
    }
}
