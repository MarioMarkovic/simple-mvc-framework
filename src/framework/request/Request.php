<?php 

namespace App\Framework\Request;

use App\Framework\Helpers\Str;
use App\Framework\Helpers\Arr;
use App\Framework\Request\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    private $fullUrl;
    private $url;
    private $splUrl;
    private $method;

    public function __construct()
    {   
        $this->fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $this->resolveUrl($this->fullUrl);
    }

    /**
     * @param string $fullUrl
     * @return self
     * @throws \Exception
     */
    private function resolveUrl(string $fullUrl): ?self
    {
        $this->setMethod(getenv("REQUEST_METHOD"));

        if($this->validateUrl($fullUrl)) {
            $this->setUrl();
            return $this;
        } else {
            throw new \Exception("Url is not valid");
        }   
    }

    private function setUrl()
    {
        $this->url = Str::explodeString("?", $this->sanitizeUrl(getenv('REQUEST_URI')))[0];
    }

    /**
     * @param string $url
     * @return string
     */
    private function sanitizeUrl(string $url): string 
    {
        return filter_var(ltrim($url), FILTER_SANITIZE_URL);
    }

    /**
     * @param string $url
     * @return boolean
     */
    private function validateUrl(string $fullUrl): bool
    {
        return filter_var($fullUrl, FILTER_VALIDATE_URL) ? true : false;
    }

    /**
     * @return string 
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return array 
     */
    public function getUrlAsArray(): array
    {
        return Arr::removeEmptyElementsFromArray(Str::explodeString("/", $this->url));
    }

    /**
     * @param string $method
     * @throws \Exception
     * allowed methods: GET, POST
     */
    private function setMethod(string $method) 
    {
        switch ($method) {
            case 'GET':
            case 'POST':
                $this->method = $method;    
                break;
            default:
                throw new \Exception("Request method is not valid");
                break;
        }
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

}