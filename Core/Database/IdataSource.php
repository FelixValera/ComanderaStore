<?php

namespace Core\Database;

interface IdataSource{

    public function getOdespa($orden,$deposito,$fecha);
    
    public function getOareti($orden,$deposito,$fecha);

    public function getItems($order,$nroOrder);
}