<?php 

namespace App\Framework;

use App\Framework\Request\Interfaces\RequestInterface;
use App\Framework\Request\Request;

class App 
{
    /**
     * @param RequestInterface $request 
     */
    public function __construct(RequestInterface $request = null) 
    {  
        if($request === null) {
            $request = new Request();
            var_dump($request->getUrlAsArray());
        }
    }
}