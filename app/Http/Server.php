<?php

namespace App\Http;

use App\Http\Middlewares\ClosureMiddleware;
use App\Http\Routing\Router;
use App\Http\Routing\RoutingMiddleware;

class Server{

    private $_router;
    private $_pipeline;
    private $_request;

    public function __construct(Request $request){
        
        $this->_router = new Router();
        $this->_pipeline = new RequestPipeline();
        $this->_request = $request;
    }

    public function router(){

        return $this->_router;
    }
    
    public function use($middleware){

        if(is_callable($middleware)){

            $this->_pipeline->use(new ClosureMiddleware($middleware));
        }
        else{

            $this->_pipeline->use($middleware);
        }
    }

    public function handler(){

        $this->use(new RoutingMiddleware($this->_router));

        $this->_pipeline->handler($this->_request);
    }
}