<?php 

namespace App\Framework;

use App\Framework\Request\Request;

class App 
{
    public function __construct() 
    {
        $request = new Request();
    }
}