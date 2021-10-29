<?php

namespace Controllers;

use LengthException;
use Model\Comments;
use Model\Publicaciones;
use Model\Usuario;
use Model\Like;


use MVC\Router;


class AppController
{

    public static function homepage(Router $router)
    {

        $validate_like = false;
        $header_inicio = true;

        $usuario_actual = new Usuario;

        $usuarios = Usuario::all();
        session_start();



        $publicaciones = Publicaciones::publicacionProfileHome();



        if(!empty($_SESSION)){

            $consultLike = Like::consultLike($_SESSION['profile_id']);
        }


        if ($_SERVER["REQUEST_METHOD"] == 'POST') {


            $like = (int)$_POST["likes"];
            $id = $_POST["usuarioId"];
            $id_publicaciones = $_POST["id_publicaciones"];
            $local_like = $_POST["local_like"];




            $publicacion = Publicaciones::publicacionProfileLike($id_publicaciones);
            $like_exists = Like::consultLikePublic($id, $id_publicaciones);
            $usuario_actual = Usuario::findId($id);
            






            if ($local_like == 0) {




                $valLike = array(


                    "local_like" => 1,
                    "idUsuario" => $id,
                    "idPublicacion" => $id_publicaciones

                );





                if (empty($like_exists)) {



                    $obj_like = new Like($valLike);
                    $obj_like->guardar();
                } else {

                    $like_exists[0]->sincronizar($valLike);
                    $like_exists[0]->actualizarDatos();
                }

             
                $publicacion[0]->setLikes($like, $valLike,$id_publicaciones);
                

                $campo = Publicaciones::consultLikeCount($id_publicaciones);
               
                $count_like = $campo->fetch_assoc()["likes"];

           
            


                $respuesta = array(

                    "like" => true,
                    "id_usuario" => $id,
                    "id_publicaciones" => $id_publicaciones,
                    "count_likes" => $count_like,
                    "local_like" => 1,
                    "foto_perfil" => $usuario_actual->foto_perfil,
                    "nombre" => $usuario_actual->nombre,
                    "apellido" => $usuario_actual->apellido

                );
            } else if ($local_like == 1) {




                $valLike = array(


                    "local_like" => 0,
                    "idUsuario" => $id,
                    "idPublicacion" => $id_publicaciones

                );





                if (empty($like_exists)) {

                    $obj_like = new Like($valLike);
                    $obj_like->guardar();
                } else {

                    $like_exists[0]->sincronizar($valLike);
                    $like_exists[0]->actualizarDatos();
                }

             
                $publicacion[0]->setLikes($like, $valLike,$id_publicaciones);

                $campo = Publicaciones::consultLikeCount($id_publicaciones);
               
                $count_like = $campo->fetch_assoc()["likes"];



                $respuesta = array(

                    "like" => true,
                    "id_usuario" => $id,
                    "id_publicaciones" => $id_publicaciones,
                    "count_likes" =>  $count_like,
                    "local_like" => 0,
                    "foto_perfil" => $usuario_actual->foto_perfil,
                    "nombre" => $usuario_actual->nombre,
                    "apellido" => $usuario_actual->apellido

                );
            }




            echo json_encode($respuesta);
        } else {


            $user_notificacion = Usuario::consultProfileNotification($_SESSION['profile_id']);

            if (isset($_SESSION['profile_id'])) {

                for ($i = 0; $i < count($usuarios); $i++) {

                    if ($_SESSION["profile_id"] == $usuarios[$i]->id_usuario) {

                        $usuario_actual = $usuarios[$i];
                    }
                }
            }

            $router->render('app/homepage', [

                "header_inicio" => $header_inicio,
                "resultado" => $usuario_actual,
                "usuarios" => $usuarios,
                "publicaciones" => $publicaciones,
                "validate_like" =>  $validate_like,
                "consultLike" => $consultLike,
                "user_notificacion" => $user_notificacion
            ]);
        }
    }

    public static function comments(Router $router){


        if($_SERVER["REQUEST_METHOD"] == 'POST'){

              
           $descripcion_comentario  = filter_var($_POST["descripcion_comentario"], FILTER_SANITIZE_STRING);

           $comment = new Comments($_POST);
           
           $resultado =  $comment->guardar(); 


           if($resultado){

            $respuesta = array(

                "respuesta"=> "correcto",
                "idUsuario" => $_POST['idUsuario'],
                "idPublicacion"=> $_POST['idPublicacion'],
                "descripcionComentario" => $descripcion_comentario
            );


              echo json_encode($respuesta); 
           }


        }




    }


    public static function commentsGet(){


      $id_publicacion = filter_var($_GET['id_publicacion'] , FILTER_VALIDATE_INT);



      $comment = Comments::consultaComment($id_publicacion);



      $response = [];

      while($resultado = $comment->fetch_assoc())
{
    $response[] = $resultado;
    
   
}

echo json_encode($response);



    }
}
