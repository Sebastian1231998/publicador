
<?php ;
use Model\Usuario;

$user_messages = []; 

autenticar_sesion();
      
$mensaje = ''; 

foreach($ultimate_message_user as $ultimate){

 
   if($_SESSION['profile_id'] == $ultimate['idUsuarioRecibe']){


    $ultimate['idUsuarioRecibe'] =  $ultimate['idUsuarioEnvia'];
   
   }else if($_SESSION['profile_id'] == $ultimate['idUsuarioEnvia']){

    $ultimate['idUsuarioEnvia'] = $ultimate['idUsuarioRecibe'];
   }

   $user_messages[] = $ultimate;


}




usort($user_messages, function ($a, $b) {
    return strcmp($a["fecha_creacion"], $b["fecha_creacion"]);
});




$user_message_inverse = array_reverse($user_messages);







$definive_user_temp = [];

foreach( $user_message_inverse as $user_message){



$definive_user_temp[] = Usuario::findId($user_message['idUsuarioEnvia']);


}






?>
<div class="collumn" style="margin-top: 1rem;width: 100%;">



    <div class="row" style="padding: 1rem;">

        <div class="col s12 m4 l2 special-collumn-messages">

            <h3 style="font-size: 1.8rem;">Mensajes</h3>
            <hr style="    height: .4rem;
background-color: #c0c0ea;" />
            <ul class="collection barra-azul" style="height: 67vh; overflow:auto">

                <?php foreach ($definive_user_temp as $usuario) :    ?>



                    <?php if ($usuario->id_usuario == $_SESSION["profile_id"]) : continue;
                    endif; ?>

                  <a href="#ultimateMessage">
                        <li class="collection-item avatar user-message special-messages" user-id="<?php echo $usuario->id_usuario ?>" foto-perfil="<?php echo $usuario->foto_perfil ?>" user-nombre=" <?php echo $usuario->nombre; ?>" user-apellido=" <?php echo $usuario->apellido; ?>" style="padding: 0 1rem;height:auto;cursor:pointer">
                            <div class="avatar" style="    text-align: -webkit-center;padding: 1rem 1rem;display: flex;  margin: 0 0rem;  align-items: center;">


                                <a href="/user/profile?id=<?php echo  $usuario->id_usuario; ?>"><img src="<?php echo $usuario->foto_perfil != '' ? '/imagenes/profile/' . $usuario->foto_perfil : '/build/img/avatar_null.png'; ?>" style="width: 50px;border-radius: 10rem;height: 50px;" alt=""></a>


                                <p style="font-size: 1.3rem;width: 26rem;;font-size:1.3rem"> <?php echo $usuario->nombre; ?> <?php echo $usuario->apellido; ?> </p>

                                
                           <?php
                     
                     foreach($user_messages as $user_message): 

                     
                       if($user_message["idUsuarioEnvia"] == $usuario->id_usuario): 
                      $mensaje = $user_message["contenido"];
                       endif; 

                     endforeach; ?>

                      <p class="mensaje" style="font-size: 3rem;width: 26rem;;font-size:1.3rem;font-weight:bold;padding: 1rem;">
                      
                      <?php 
                      

                      $mensaje_recortado = substr($mensaje, 0 , 30);
                      echo $mensaje_recortado . "...";
                      
                      
                      ?>  
                  
                  </p>
                               
                            </div>
                        
                        </li>

                        </a>

                <?php endforeach; ?>
            </ul>


        </div>



        <div class="col s12 m4 l8">

            <div class="body-messages" style="width: 100%;height: 91vh;width: 122rem;">

                <div class="header-message">

                    <ul class="collection">


                        <li class="collection-item avatar user-contact" style="padding: 0 1rem;height:1.2rem;">
                            <div class="avatar" style="    text-align: -webkit-center;padding: 1rem 1rem;display: flex;  margin: 0 0rem;  align-items: center;">


                                <a href="/user/profile?id=<?php echo  $usuario_->id_usuario; ?>"><img src="<?php echo $usuario_->foto_perfil != '' ? '/imagenes/profile/' . $usuario_->foto_perfil : '/build/img/avatar_null.png'; ?>" style="width: 50px;border-radius: 10rem;height: 50px;" alt=""></a>


                                <p style="font-size: 1.3rem;width: 26rem;;font-size:1.3rem"></p>
                            </div>


                        </li>

                    </ul>



                </div>

                <div class="body-message-content" style="    width: 100%;height: 50vh;background-color: #f3f3f3;overflow:auto">

                    <ul class="collection message-user-collection" style="margin: 0 auto;max-width: 60%">





                    </ul>


                </div>

                <div class="campo-message">

                    <ul class="collection">


                        <li class="collection-item avatar" style="padding: 0 1rem;height:13.2rem; ">
                            <div class="avatar" style="    text-align: -webkit-center;padding: 1rem 1rem;display: flex;  margin: 0 0rem;">


                                <div style="width: 100%;display:flex;align-items: center;" class="form-message">


                                    <input type="text" class="input-message" foto-perfil-userActive="<?php echo  $_SESSION['foto_perfil']; ?>" data-userId-send="<?php echo $_SESSION["profile_id"] ?>" style="width:100%; margin:3rem " name="mensaje">
                                    <input style="width: 15rem;/* line-break: anywhere; */ height: 4rem; cursor: pointer;color: white; border: none; background-color: #a9d5fb;" type="submit" value="enviar" class="submitMensaje" name="enviarMensaje">

                                </div>




                            </div>


                        </li>

                    </ul>



                </div>

            </div>

        </div>

        <div class="col s12 m4 l2">

            <h3 style="font-size: 1.8rem;">Contactos</h3>
            <hr style="    height: .4rem;
background-color: #c0c0ea;" />
            <ul class="collection barra-azul" style="height: 67vh; overflow:auto">

                <?php foreach ($usuarios as $usuario) :    ?>



                    <?php if ($usuario->id_usuario == $_SESSION["profile_id"]) : continue;
                    endif; ?>

                    <a href="/messages/user?id=<?php echo $_SESSION["profile_id"] . "&response=" . $usuario->id_usuario; ?>">

                        <li class="collection-item avatar user-message" user-id="<?php echo $usuario->id_usuario ?>" foto-perfil="<?php echo $usuario->foto_perfil ?>" user-nombre=" <?php echo $usuario->nombre; ?>" user-apellido=" <?php echo $usuario->apellido; ?>" style="padding: 0 1rem;height:1.2rem;cursor:pointer">
                            <div class="avatar" style="    text-align: -webkit-center;padding: 1rem 1rem;display: flex;  margin: 0 0rem;  align-items: center;">


                                <a href="/user/profile?id=<?php echo  $usuario->id_usuario; ?>"><img src="<?php echo $usuario->foto_perfil != '' ? '/imagenes/profile/' . $usuario->foto_perfil : '/build/img/avatar_null.png'; ?>" style="width: 50px;border-radius: 10rem;height: 50px;" alt=""></a>


                                <p style="font-size: 1.3rem;width: 26rem;;font-size:1.3rem"> <?php echo $usuario->nombre; ?> <?php echo $usuario->apellido; ?> </p>
                            </div>


                        </li>

                    </a>


                <?php endforeach; ?>
            </ul>


        </div>
    </div>







</div>