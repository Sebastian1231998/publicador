<?php

namespace Controllers;

use GuzzleHttp\Psr7\Message;
use LengthException;
use Model\ActiveRecord;
use Model\Usuario;
use Model\Messages;

use MVC\Router;

class MessageController
{



    public static function messagePage(Router $router)
    {




        if ($_SERVER["REQUEST_METHOD"] == 'POST') {



            $contenido = $_POST["contenido"];
            $idUsuarioRecibe = $_POST["idUsuarioRecibe"];
            $idUsuarioEnvia = $_POST["idUsuarioEnvia"];
            $fecha_creacion = $_POST["fecha_creacion"];
            $cantidad_enviado = $_POST["cantidad_enviado"];




            $messageUser = new Messages($_POST);

            $respuesta = $messageUser->guardar();

            if ($respuesta) {

                $val = false;

                if ($cantidad_enviado == 1) {
                    //crear el update de notificacion 
                    Usuario::updateNotificacion($idUsuarioRecibe, $val);
                }




                $respuesta_arr = array(


                    "idUsuarioRecibe" => $idUsuarioRecibe,
                    "idUsuarioEnvia" => $idUsuarioEnvia,
                    "fecha_creacion" => $fecha_creacion,
                    "contenido" => $contenido,
                    "respuesta" => "correcto"


                );
            }


            echo json_encode($respuesta_arr);
        } else {



            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT) ?? null;

            $usuarios = Usuario::all();
            $usuario_ = Usuario::findId($id);

            $ids = Messages::getIds();

            session_start();




            $ultimate_message = [];


            $id_recibe = [];
            while ($id =  $ids->fetch_assoc()) {



                $id_recibe[] = $id['idUsuarioRecibe'];
                $id_envia[] = $id['idUsuarioEnvia'];
            }



            $ultimate_message_user = [];

            if (!is_null($id_recibe)) {


                $tempIds = [];
                for ($i = 0; $i < count($id_recibe); $i++) {

                    for ($j = 0; $j < count($id_envia); $j++) {




                        $tempIds[] = $id_recibe[$i];
                        $tempIds[] = $id_envia[$j];
                        $j = count($id_envia);
                    }
                }


                $Ids = array_unique($tempIds);





                foreach ($Ids as $id) {


                    if ($id != $_SESSION['profile_id']) {

                        $ultimate_message[] = Messages::getUltimateMessage($_SESSION['profile_id'], $id);
                    }
                }

                
                $ultimate_message_user = [];

                foreach ($ultimate_message as $ultimate) {

                    if ($ultimate->num_rows != 0) {


                        $ultimate_message_user[] = $ultimate->fetch_assoc();
                    }
                }
            }









            $header_inicio = true;


            if (!isset($_GET['id'])) {



                header('Location: /login');

                exit;
            }




            $user_notificacion = Usuario::consultProfileNotification($_SESSION['profile_id']);

            $router->render('/app/messages/user/messages', [
                "usuarios" => $usuarios,
                "header_inicio" =>  $header_inicio,
                "usuario_" => $usuario_,
                "ultimate_message_user" => $ultimate_message_user,
                "user_notificacion" => $user_notificacion,


            ]);
        }
    }


    public static function getMessage(Router $router)
    {



        $id_envia = filter_var($_GET['id'], FILTER_VALIDATE_INT) ?? null;
        $id_recibe = filter_var($_GET['recieve'], FILTER_VALIDATE_INT) ?? null;


        $usuarios = Usuario::all();



        session_start();



        $header_inicio = true;

        $messages = Messages::messagesProfile($id_recibe, $id_envia);


        $usuario_envia = Usuario::findId($id_envia);
        $usuario_recibe = Usuario::findId($id_recibe);


        $resultado = array(


            "resultado" => $messages,
            "usuario_envia_foto" => $usuario_envia->foto_perfil,
            "usuario_recibe_foto" => $usuario_recibe->foto_perfil,

        );



        echo json_encode($resultado);
    }


    public static function messageNotificacion()
    {

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {



       


            session_start();
            if ($_POST['elimina_notificacion'] != 0) {

                $val = true;
                //crear el update de notificacion 

             
                Usuario::updateNotificacion($_SESSION['profile_id'], $val);



                $user_notificacion = Usuario::consultProfileNotification($_SESSION['profile_id']);

                if (isset($user_notificacion)) {

                    $notify = $user_notificacion->fetch_assoc()["mensajes_recibidos"];
                }





                $respuesta = array(

                    "respuesta" => "correcto",
                    "notify" => $notify
                );
            }
        }



        echo json_encode($respuesta);
    }
}
