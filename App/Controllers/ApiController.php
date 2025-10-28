<?php
namespace App\Controllers;

use Domain\Repositories\OtomadasRepository;

class ApiController{

    public static function TomarOrden($req,$param){
        
       $body = $req->body();

       echo '<pre>';
        var_dump($body);
       echo '</pre>';
    }
}