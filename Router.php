<?php 

namespace MVC; 

class Router{

private $Controller_request_get = [];
private $Controller_request_post = []; 


public function requestGet($url, $fn)
{

    $this->Controller_request_get[$url] = $fn; 

  }

  public function requestPost($url, $fn)
{

    $this->Controller_request_post[$url] = $fn; 


}


public function validaRequest(){

     $url_actual = $_SERVER["PATH_INFO"] ?? '/';

     $metodo = $_SERVER["REQUEST_METHOD"];


     if ($metodo === 'GET') {
         $fn = $this->Controller_request_get[$url_actual] ?? null;    
     }else {
         $fn = $this->Controller_request_post[$url_actual] ?? null;
     }

   

     if(!is_null($fn)){

         call_user_func($fn,$this); 

     }else{
        header("Location: /");
     }

}

public function render($view, $datos = [])
{
    foreach ($datos as $key => $value) {
        $$key = $value;
    }

    ob_start(); //almacenamiento de memoria temporal
    include __DIR__ . "/views/$view.php";

    $contenido = ob_get_clean();



    include 'views/layout.php';
}


}

















