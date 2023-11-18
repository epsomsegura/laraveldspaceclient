<?php

namespace Epsomsegura\Laraveldspaceclient\Shared\Domain;

class UrlValidator
{
    public ?string $url;
    public function __construct(?string $url)
    {
        $this->url = $url;
    }
    public function isValid(): bool
    {
        return filter_var($this->url, FILTER_VALIDATE_URL);
    }
    public function invalidMessage(): string
    {
        return "'" . $this->url . "' is not URL string";
    }
    public function urlExists(): bool
    {
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        $result = curl_exec($curl);
        return ($result ? !(curl_getinfo($curl, CURLINFO_HTTP_CODE == 404)) : false);
    }
}
