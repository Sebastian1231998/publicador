
<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES_PROFILE', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/profile/');
define('CARPETA_IMAGENES_PUBLIC', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/publicaciones/');




function autenticar_sesion()
{


     if(is_null($_SESSION)){

          session_start();
     }
  
     if (!isset($_SESSION["login"])) {

          header('Location: ../');
     }

     return false;
}

function debugear($variable)
{

     echo "<pre>";
     var_dump($variable);
     echo "</pre>";

}


function sanitizar($propiedad)
{

     $propiedad_sanitizada = htmlspecialchars($propiedad);

     return $propiedad_sanitizada;
}

