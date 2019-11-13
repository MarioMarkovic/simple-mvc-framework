<?php 

namespace App\Framework\Request\Interfaces;

interface RequestInterface
{

    /**
     * @return string
     */
    public function getUrl(): string;
    
    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return array
     */
    public function getUrlAsArray() :array;
}