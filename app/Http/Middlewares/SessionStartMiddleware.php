<?php
namespace App\Http\Middlewares;

class SessionStartMiddleware extends Middleware{

    public function handler($request){

        session_start();

        if (!isset($_SESSION['ultima_actualizacion'])){ //Si no existe la variable de session la crea

            $_SESSION['ultima_actualizacion'] = date('Y-m-d H:i:s.v');
        }
        
        $this->next($request);
    }
}