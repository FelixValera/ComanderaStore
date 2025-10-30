<?php

namespace Core\Database;

interface IdataSource{

    public function getOdespa($orden,$deposito,$fecha);
    
    public function getOareti($orden,$deposito,$fecha);

    public function getItems($order,$nroOrder);

    public function getOdespaNuevas($order,$deposito,$dataTime);

    public function getOaretiNuevas($order,$deposito,$dataTime);

    public function create($table,array $data);

    public function deleteOtomadas($deposi,$fecha);

    public function getOtomadas($deposi,$fecha);
}