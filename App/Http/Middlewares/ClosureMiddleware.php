<?php
namespace App\Http\Middlewares;

class ClosureMiddleware extends Middleware{
    
    private $_callable;

    public function __construct($callable){

        $this->_callable = $callable;
    }
    
    private function getCallable(){

        return $this->_callable;
    }

    public function handler($request){

        $callable = $this->getCallable();

        return $callable($request,$this);
    }
}