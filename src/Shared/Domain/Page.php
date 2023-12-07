<?php 

namespace Epsomsegura\Laraveldspaceclient\Shared\Domain;

class Page
{
    public int $_size;
    public int $_totalElements;
    public int $_totalPages;
    public int $_number;

    public function __construct(
        int $size,
        int $totalElements,
        int $totalPages,
        int $number
    ){
        $this->_size = $size;
        $this->_totalElements = $totalElements;
        $this->_totalPages = $totalPages;
        $this->_number = $number;
    }

    public function size(): int
    {
        return $this->_size;
    }

    public function totalElements(): int
    {
        return $this->_totalElements;
    }

    public function totalPages(): int
    {
        return $this->_totalPages;
    }
    
    public function number(): int
    {
        return $this->_number;
    }

    public function toCollection()
    {
        return collect($this);
    }

    public function toArray() : array
    {
        return [
            "size" => $this->size,
            "totalElements" => $this->totalElements,
            "totalPages" => $this->totalPages,
            "number" => $this->number
        ];
    }
}