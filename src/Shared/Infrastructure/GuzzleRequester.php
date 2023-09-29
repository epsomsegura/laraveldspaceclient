<?php

namespace Epsomsegura\Laraveldspaceclient\Shared\Infrastructure;

use GuzzleHttp\Cookie\CookieJar;

class GuzzleRequester
{
    private $bearerToken;
    private $client;
    private $dspaceCookie;
    private $dspaceToken;
    private $endpoint;
    private $headers;
    private $method;
    private $options;
    private $query;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => getenv('DSPACE_API_URL'),
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        $this->getBearerToken();
    }

    public function bearerToken()
    {
        return $this->bearerToken;
    }
    
    public function dspaceCookie()
    {
        return $this->dspaceCookie;
    }
    
    public function dspaceToken()
    {
        return $this->dspaceToken;
    }
    
    public function headers()
    {
        return $this->headers;
    }
    
    public function method()
    {
        return $this->method;
    }
    
    public function options()
    {
        return $this->options;
    }
    
    public function query()
    {
        return $this->query;
    }

    public function request()
    {
        $response = null;
        $this->setRequestOptions();
        switch ($this->method) {
            case 'get':
                $response = json_decode($this->client->get($this->endpoint, $this->options)->getBody()->getContents());
                break;
            case 'post':
                $response = json_decode($this->client->post($this->endpoint, $this->options)->getBody()->getContents());
                break;
            case 'put':
                $response = json_decode($this->client->put($this->endpoint, $this->options)->getBody()->getContents());
                break;
            case 'patch':
                $response = json_decode($this->client->patch($this->endpoint, $this->options)->getBody()->getContents());
                break;
            case 'delete':
                $response = json_decode($this->client->delete($this->endpoint, $this->options)->getBody()->getContents());
                break;
        }
        return $response;
    }

    public function setCookie(CookieJar $cookie)
    {
        $this->dspaceCookie = $cookie;
        return $this;
    }

    public function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function setHeaders(?array $headers)
    {
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        if ($this->dspaceToken) {
            $this->headers['X-XSRF-TOKEN'] = $this->dspaceToken;
        }
        if ($this->bearerToken) {
            $this->headers['Authorization'] = $this->bearerToken;
        }
        if (isset($headers)) {
            $this->headers = array_merge($this->headers, $headers);
        }
        return $this;
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }

    public function setQuery(?array $query)
    {
        $this->query = $query;
        return $this;
    }

    protected function getBearerToken()
    {
        $this->setDspaceToken();
        $this->setDspaceCookie();
        $this->setQuery(['user' => getenv('DSPACE_API_EMAIL'), 'password' => getenv('DSPACE_API_PASS')]);
        $this->setHeaders(null);

        $options = [
            'headers' => $this->headers,
            'cookies' => $this->dspaceCookie,
            'query' => $this->query
        ];
        $this->bearerToken = $this->client->post("authn/login", $options)->getHeaders()['Authorization'][0];

        $this->setQuery(null);
        $this->setHeaders(null);
    }

    protected function setDspaceCookie()
    {
        $this->dspaceCookie = CookieJar::fromArray(['DSPACE-XSRF-COOKIE' => $this->dspaceToken], getenv('DSPACE_API_DOMAIN'));
    }

    protected function setDspaceToken()
    {
        $this->dspaceToken = $this->client->get("")->getHeaders()['DSPACE-XSRF-TOKEN'][0];
    }

    protected function setRequestOptions()
    {
        if ($this->headers) {
            $this->options['headers'] = $this->headers;
        }
        if ($this->dspaceCookie) {
            $this->options['cookies'] = $this->dspaceCookie;
        }
        if ($this->query) {
            $this->options['query'] = $this->query;
        }
    }
}
