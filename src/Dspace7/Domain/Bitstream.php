<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

class Bitstream
{    
    private ?string $_uuid;
    private ?string $_name;
    private ?string $_handle;
    private $_metadata;
    private int $_sizeBytes;
    private $_checkSum;
    private ?int $_sequenceId;
    private string $_type;
    public function __construct(
        ?string $uuid,
        ?string $name,
        ?string $handle,
        $metadata,
        int $sizeBytes,
        $checkSum,
        ?int $sequenceId,
        string $type,
    ) {
        $this->_uuid = $uuid;
        $this->_name = $name;
        $this->_handle = $handle;
        $this->_metadata = $metadata;
        $this->_sizeBytes = $sizeBytes;
        $this->_checkSum = $checkSum;
        $this->_sequenceId = $sequenceId;
        $this->_type = $type;
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
    public function metadata(): mixed
    {
        return $this->_metadata;
    }
    public function sizeBytes(): int
    {
        return $this->_sizeBytes;
    }
    public function checkSum(): mixed
    {
        return $this->_checkSum;
    }
    public function sequenceId(): ?int
    {
        return $this->_sequenceId;
    }
    public function type(): string
    {
        return $this->_type;
    }
}
