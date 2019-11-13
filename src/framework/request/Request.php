<?php 

namespace App\Framework\Request;

use App\Framework\Helpers\Str;

class Request 
{
    private $fullUrl;
    private $url;
    private $method;

    public function __construct()
    {   
        $this->fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $this->resolveUrl($this->fullUrl);
        $this->setMethod(getenv("REQUEST_METHOD"));
    }

    /**
     * @param string $fullUrl
     * @return self
     */
    private function resolveUrl(string $fullUrl): ?self
    {
        if($this->validateUrl($fullUrl)) {
            $this->setUrl();
            return $this;
        } else {
            die("Error: Invalid url!");
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
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * @param string $url
     * @return boolean
     */
    private function validateUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
    }

    /**
     * @return string 
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $method
     */
    private function setMethod(string $method) 
    {
        switch ($method) {
            case 'POST':
            case 'GET':
                $this->method = $method;    
                break;
            default:
                die("Error: invalid request method");  
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