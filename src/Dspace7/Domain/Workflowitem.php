<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

class Workflowitem
{
    private int $_id;
    private string $_lastModified;
    private ?string $_step;
    private ?object $_sections;
    private ?Item $_item;
    private string $_type;
    public function __construct(
        int $id,
        string $lastModified,
        ?string $step,
        ?object $sections,
        ?Item $item,
        string $type,
    ) {
        $this->_id = $id;
        $this->_lastModified = $lastModified;
        $this->_step = $step;
        $this->_sections = $sections;
        $this->_item = $item;
        $this->_type = $type;
    }

    public function id(): int
    {
        return $this->_id;
    }
    public function lastModified(): string
    {
        return $this->_lastModified;
    }
    public function step(): ?string
    {
        return $this->_step;
    }
    public function sections(): ?object
    {
        return $this->_sections;
    }
    public function item(): ?Item
    {
        return $this->_item;
    }
    public function type(): string
    {
        return $this->_type;
    }
}
