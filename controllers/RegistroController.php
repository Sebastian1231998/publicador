<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class RegistroController
{


    public static function redirect(Router $router){


        header('Location: ./login');
    }

    public static function registro(Router $router)
    {

        $errores = Usuario::devolverErrores();
        $router->render('/app/login/registro', [

           'errores' => $errores
        ]);
    }

    public static function login(Router $router)
    {

        $errores = Usuario::devolverErrores();
        $usuario = new usuario;

        


        if($_SERVER["REQUEST_METHOD"] === "POST" ){
            


                filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL); 
                filter_var($_POST["password"], FILTER_SANITIZE_STRING);
             
                $usuario = new Usuario($_POST); 
                $sanitzado = $usuario->santitizarDatos();
             
             
                $usuario->validarCampos(); 
                $errores = Usuario::devolverErrores();
             
                if (empty($errores)) {
                   //consulta a la base de datos
                    $result =  $usuario->findCorreo($sanitzado['correo']); 

                    
                   if ($result->num_rows) {
             
                      $usuario->consultarUsuario($result);
                      $errores = Usuario::devolverErrores();
             
                   } else {
                      $errores[] = "El usuario no existe";
                   }
                }
             


        }

            $router->render('/app/login/login', [
                "errores" => $errores,
                "usuario" => $usuario
            ]);
        

   
    }


    public static function  registrarUsuario()
    {


        if ($_POST["accion"] == "registro") {

            $password = $_POST["password"];

            $passwordHash = password_hash($password , PASSWORD_BCRYPT);

            $_POST["password"] = $passwordHash;
            $registro = new Usuario($_POST);
            $respuesta = $registro->guardar();

            echo json_encode($respuesta);
        }


    }

    public static function cerrar(){

        if($_GET["cerrar_sesion"]){
    
            session_start(); 
            $_SESSION = []; 
            header('Location: ./login');
        }
    
    }
}



