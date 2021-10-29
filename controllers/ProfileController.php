<?php

namespace Controllers;


use Model\ActiveRecord;
use Model\Usuario;
use Model\Publicaciones;
use Model\Like;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController
{


    public static function profile_prueba(Router $router)
    {



        $header_inicio = true;

        $router->render('app/profile/profile_prueba', [
            "header_inicio" => $header_inicio
        ]);
    }

    public static function profile(Router $router)
    {


        if (!isset($_GET['id'])) {



            header('Location: /login');

            exit;
        }

        session_start();


        if (empty($_SESSION)) {
            header('Location: /login');

            exit;
        }

        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT) ?? null;


        $usuario = Usuario::findId($id);


        $header_inicio = true;
        $usuario = Usuario::findId($id);

        $errores = Publicaciones::devolverErrores();

        $publicaciones = Publicaciones::publicacionProfile($id);

        $usuarios = Usuario::all();

        $consultLike = Like::consultLike($_SESSION['profile_id']);


      

        if (isset($_POST['accion'])) {

     

            if ($_SERVER["REQUEST_METHOD"] == 'POST' && $_POST['accion'] == 'publicar') {

                $errores = Publicaciones::devolverErrores();

                $publicacion = new Publicaciones($_POST);



                if (!is_dir(CARPETA_IMAGENES_PUBLIC)) {
                    mkdir(CARPETA_IMAGENES_PUBLIC);
                 }
 
                 
                $str = md5(uniqid(rand(), true)) . ".jpg";
                if ($_FILES['imagen']['tmp_name']) {
                    $imagen =  Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                    $publicacion->setImagen($str);
                }

                $publicacion->validarCampos();
                $errores = Publicaciones::devolverErrores();

                if (empty($errores)) {
                    // guardar en el servidor
                    // guardarla carpeta imagenes  
                    $imagen->save(CARPETA_IMAGENES_PUBLIC . $str);

                    $publicacion->setFecha();

                    $resultado = $publicacion->guardar();

                    

                    if ($resultado) {

                        header('location:/user/profile?id=' . $id . '&' . 'result=2');
                    
                    }
                }
            }
        }
    



        if ($_SERVER["REQUEST_METHOD"] == 'POST' &&  $_POST["accion"] == 'editar') {


   

            $usuario->sincronizar($_POST);


            if (!is_dir(CARPETA_IMAGENES_PROFILE)) {
                mkdir(CARPETA_IMAGENES_PROFILE);
            }


            $str = md5(uniqid(rand(), true)) . ".jpg";




            if ($_FILES['foto_perfil']['tmp_name']) {
                $imagen =  Image::make($_FILES['foto_perfil']['tmp_name'])->fit(800, 600);
                $val = true;
                $usuario->setImagen($str, $val);
            } else {

                $str = $usuario->foto_perfil;
                $imagen =  Image::make($_FILES['foto_perfil']['tmp_name'])->fit(800, 600);
                $val = false;
                $usuario->setImagen($str, $val);
            }

            $imagen->save(CARPETA_IMAGENES_PROFILE . $str);
            $resultado = $usuario->actualizarDatos();


            if ($resultado) {


                header('Location: /user/profile?id=' . $id . '&' . 'result=1');
                $_SESSION['foto_perfil'] = $str;
            }
        }

        
        $user_notificacion = Usuario::consultProfileNotification($_SESSION['profile_id']);


        $router->render('app/profile/profile', [
            "resultado" => $usuario,
            "header_inicio" => $header_inicio,
            "errores" => $errores,
            "publicaciones" => $publicaciones,
            "usuarios" => $usuarios,
            "consultLike" => $consultLike,
            "user_notificacion" => $user_notificacion
        ]);
    }
}


