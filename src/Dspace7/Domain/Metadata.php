<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

use Maatwebsite\Excel\Concerns\ToArray;

class Metadata
{
    private string $_value;
    private ?string $_language;
    private ?string $_authority;
    private ?int $_confidence;
    private ?int $_place;
    public function __construct(
        string $value,
        ?string $language,
        ?string $authority,
        ?int $confidence,
        ?int $place
    ) {
        $this->_value = $value;
        $this->_language = $language;
        $this->_authority = $authority;
        $this->_confidence = $confidence;
        $this->_place = $place;
    }
    public function value(): string
    {
        return $this->_value;
    }
    public function language(): ?string
    {
        return $this->_language;
    }
    public function authority(): ?string
    {
        return $this->_authority;
    }
    public function confidence(): ?int
    {
        return $this->_confidence;
    }
    public function place(): ?int
    {
        return $this->_place;
    }
    public static function metadataArrayToArray(array $metadata): array
    {
        $metadataArray = [];
        foreach ($metadata as $key => $metadataElements) {
            foreach ($metadataElements as $metadataElement) {
                $metadataElement = is_object($metadataElement) ? $metadataElement->toArray() : $metadataElement;
                $metadataArray[$key][] = [
                    "value" => $metadataElement["value"],
                    "language" => $metadataElement["language"] ?? null,
                    "authority" => $metadataElement["authority"] ?? null,
                    "confidence" => $metadataElement["confidence"] ?? null,
                    "place" => $metadataElement["place"] ?? null,
                ];
            }
        }
        return $metadataArray;
    }
    public static function arrayToMetadataArray(array $metadata): array
    {
        $metadataArray = [];
        foreach ($metadata as $key => $metadataElements) {
            foreach ($metadataElements as $metadataElement) {
                $metadataElement = is_object($metadataElement) ? $metadataElement->toArray() : $metadataElement;
                $metadataArray[$key][] = new Metadata(
                    $metadataElement["value"],
                    $metadataElement["language"] ?? null,
                    $metadataElement["authority"] ?? null,
                    $metadataElement["confidence"] ?? null,
                    $metadataElement["place"] ?? null,
                );
            }
        }
        return $metadataArray;
    }
    public function toCollection()
    {
        return collect($this);
    }
    public function toArray()
    {
        return [
            "value" => $this->_value,
            "language" => $this->_language,
            "authority" => $this->_authority,
            "confidence" => $this->_confidence,
            "place" => $this->_place
        ];
    }
}
