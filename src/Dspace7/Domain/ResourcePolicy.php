<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

class ResourcePolicy
{
    private int $_id;
    private ?string $_name;
    private ?string $_description;
    private string $_policyType;
    private string $_action;
    private ?string $_startDate;
    private ?string $_endDate;
    private string $_type;
    public function __construct(
        int $id,
        ?string $name,
        ?string $description,
        string $policyType,
        string $action,
        ?string $startDate,
        ?string $endDate,
        string $type,
    ) {
        $this->_id = $id;
        $this->_name = $name;
        $this->_description = $description;
        $this->_policyType = $policyType;
        $this->_action = $action;
        $this->_startDate = $startDate;
        $this->_endDate = $endDate;
        $this->_type = $type;
    }

    public function id(): int
    {
        return $this->_id;
    }
    public function name(): ?string
    {
        return $this->_name;
    }
    public function description(): ?string
    {
        return $this->_description;
    }
    public function policyType(): string
    {
        return $this->_policyType;
    }
    public function action(): string
    {
        return $this->_action;
    }
    public function startDate(): ?string
    {
        return $this->_startDate;
    }
    public function endDate(): ?string
    {
        return $this->_endDate;
    }
    public function type(): string
    {
        return $this->_type;
    }
}
