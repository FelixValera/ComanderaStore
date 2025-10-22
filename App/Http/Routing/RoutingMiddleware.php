<?php
namespace App\Http\Routing;

use app\http\Middlewares\Middleware;

class RoutingMiddleware extends Middleware{

    private $_router;
    
    public function __construct($router)
    {
        $this->_router = $router;
    }

    public function router(){

        return $this->_router;
    }

    public function handler($request){

        return $this->router()->handler($request);
    }

}