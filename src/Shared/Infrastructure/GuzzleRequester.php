<?php

namespace Epsomsegura\Laraveldspaceclient\Shared\Infrastructure;

use Exception;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Log;

class GuzzleRequester
{
    private $bearerToken;
    private $body;
    private $client;
    private $dspaceCookie;
    private $dspaceToken;
    private $endpoint;
    private $formParams;
    private $headers;
    private $method;
    private $multipart;
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
    public function body()
    {
        return $this->body;
    }
    public function dspaceCookie()
    {
        return $this->dspaceCookie;
    }
    public function dspaceToken()
    {
        return $this->dspaceToken;
    }
    public function formParams()
    {
        return $this->formParams;
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
    public function multipart()
    {
        return $this->multipart;
    }
    public function request()
    {
        try{
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
        catch(Exception $e){
            Log::error($e);
            return "Error";
        }
    }
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
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
    public function setFormParams(?array $formParams)
    {
        $this->formParams = $formParams;
        return $this;
    }
    public function setHeaders(?array $headers)
    {
        $this->headers = [
            'Accept' => 'application/json',
        ];
        if (!$this->multipart) {
            $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }
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
    public function setMultipart($multipart)
    {
        $this->multipart = $multipart;
        return $this;
    }
    protected function getBearerToken()
    {
        $this->setDspaceToken();
        $this->setDspaceCookie();
        $this->setFormParams(['user' => getenv('DSPACE_API_EMAIL'), 'password' => getenv('DSPACE_API_PASS')]);
        $this->setHeaders(null);
        $options = [
            'headers' => $this->headers,
            'cookies' => $this->dspaceCookie,
            'form_params' => $this->formParams
        ];
        $this->bearerToken = $this->client->post("authn/login", $options)->getHeaders()['Authorization'][0];
        $this->setFormParams(null);
        $this->setHeaders(null);
    }
    protected function setDspaceCookie()
    {
        $this->dspaceCookie = CookieJar::fromArray(['DSPACE-XSRF-COOKIE' => $this->dspaceToken], getenv('DSPACE_API_DOMAIN'));
    }
    protected function setDspaceToken()
    {
        try {
            $response = $this->client->get("/");
            $headers = $response->getHeaders();
            if (array_key_exists('DSPACE-XSRF-TOKEN', $headers)) {
                $this->dspaceToken = $headers['DSPACE-XSRF-TOKEN'][0];
            } else {
                throw new Exception("DSPACE-XSRF-TOKEN not found at '/'");
            }
        } catch (Exception $e) {
            try {
                $response = $this->client->get("");
                $headers = $response->getHeaders();
                if (array_key_exists('DSPACE-XSRF-TOKEN', $headers)) {
                    $this->dspaceToken = $headers['DSPACE-XSRF-TOKEN'][0];
                } else {
                    throw new Exception("DSPACE-XSRF-TOKEN not found at route empty");
                }
            } catch (Exception $e) {
                try {
                    $response = $this->client->get("security/csrf");
                    $headers = $response->getHeaders();
                    if (array_key_exists('DSPACE-XSRF-TOKEN', $headers)) {
                        $this->dspaceToken = $headers['DSPACE-XSRF-TOKEN'][0];
                    } else {
                        throw new Exception("DSPACE-XSRF-TOKEN not found at security/csrf");
                    }
                } catch (Exception $e) {
                    throw new Exception("DSPACE-XSRF-TOKEN not found");
                }
            }
        }
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
        if ($this->body) {
            $this->options['body'] = $this->body;
        }
        if ($this->multipart) {
            $this->options['multipart'] = $this->multipart;
        }
        if ($this->formParams) {
            $this->options['form_params'] = $this->formParams;
        }
    }
}
