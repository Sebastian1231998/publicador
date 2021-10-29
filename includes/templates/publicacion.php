<?php


use Model\Usuario;
use Model\Like;

$usuarios_like; 



echo "<pre>";   
var_dump($publicacion->id_publicaciones);    
echo "</pre>";
    
  $usuarios_like = Usuario::usersLikes($publicacion->id_publicaciones); 




$value++;




/* <?php echo "<pre>; 
 var_dump();
 echo "</pre>; */
 



$id_user;
$foto_perfil_publicacion;
$nombre_perfil_publicacion;
$apellido;
foreach ($usuarios as $usuario) {

    if ($publicacion->usuarioId == $usuario->id_usuario) {

        $id_user = $usuario->id_usuario;
        $nombre_perfil_publicacion = $usuario->nombre;
        $apellido = $usuario->apellido;
        $foto_perfil_publicacion = $usuario->foto_perfil;
    }
}







?>



<div id="likesModal<?php echo $value; ?>" class="modal" value-id="<?php echo $value; ?>">
<h4 style="text-align: center; padding: 2rem; font-size:1.5rem;text-transform:uppercase;font-weight:bold">Me gusta</h4>
    <div class="modal-content">
       

        <?php while($resultado_like = $usuarios_like->fetch_assoc()):   ?>

            <?php  if($resultado_like["local_like"] == 1): ?>



            <li class="collection-item avatar" style="padding: 1rem 1rem;height:8rem;list-style:none;">
                <div class="avatar" style=" text-align: -webkit-center;
                     padding: 1rem 1rem;
                     display: flex;  
                     margin: 0 0rem;  
                     align-items: center;
                     justify-content:space-between
                     ">

                    <div class="avatar" style="text-align: -webkit-center;padding: 1rem 1rem;display: flex;  margin: 0 0rem;  align-items: center;">
                        <a href="/user/profile?id=<?php echo  $resultado_like["id_usuario"]; ?>"><img src="<?php echo $resultado_like["foto_perfil"] != '' ? '/imagenes/profile/' . $resultado_like["foto_perfil"] : '/build/img/avatar_null.png'; ?>" style="width: 50px;border-radius: 10rem;height: 50px;" alt=""></a>
                        <p style="font-size: 1.3rem;width: 26rem;;font-size:1.3rem"> <?php echo $resultado_like["nombre"]; ?> <?php echo $resultado_like["apellido"]; ?> </p>
                    </div>


                    <a href="/user/profile?id=<?php echo  $resultado_like["id_usuario"]; ?>" style=" padding: 1rem 2rem;color: white;border-radius: 1rem;background-color: #4c77ff;">Ver perfil</a>


                </div>
            </li>

            
            <?php endif; ?>
            
        <?php endwhile; ?>

        <hr/>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat"> <i class="material-icons">clear</i></a>
    </div>
</div>




<div class="card z-depth-5" style="margin-bottom: 2rem;width: 60rem;">
    <div class="card-image waves-effect waves-block waves-light">
        <img class="activator" src="/imagenes/publicaciones/<?php echo $publicacion->imagen; ?>" style=" height: 450px;">
    </div>

    <div class="card-content">


        <?php if (isset($_SESSION['foto_perfil']) && $_SESSION['foto_perfil'] != '') : ?>
            <div class="content-flex-user" style="    display: flex;justify-content: center;align-items: center;margin: 0 auto;padding: 0 0 3rem;">

                <a href="/user/profile?id=<?php echo $id_user ?>"><img src="/imagenes/profile/<?php echo $foto_perfil_publicacion  ?  $foto_perfil_publicacion: 'avatar_null.png'; ?>" style="width: 80px;border-radius: 10rem;height: 80px;padding:1rem;margin-top:.3rem;" alt=""></a>



                <div class="flex-publicado" style="display: flex;flex-direction: column;font-size: 1rem;">
                    <span>Publicado por: <?php echo $nombre_perfil_publicacion ?> <?php echo  $apellido ?> </span>
                    <span><?php echo $publicacion->fecha; ?></span>
                </div>

            </div>
        <?php else : ?>
            <img src="/build/img/avatar_null.png" style="width: 50px;border-radius: 10rem;height: 50px;padding:1rem;margin-top:.8rem" alt="">
        <?php endif; ?>
        <span class="card-title activator grey-text text-darken-4"><?php echo $publicacion->titulo; ?><i class="material-icons right">more_vert</i></span>
        <p><a href="#"></a> <?php echo $publicacion->contenido; ?></p>


    </div>



    <hr />



    <div class="body-like">

        <div class="">

            <li style="list-style:none;padding:1rem;">


                <?php
                $validate = false;
                $local = 0;


                if (!empty($consultLike)) {



                    foreach ($consultLike as $like) {


                        if ($like->idPublicacion == $publicacion->id_publicaciones && $like->local_like == 1) {
                            $validate = true;
                            $local = $like->local_like;
                        }
                    }
                }



                ?>


                <div class="flex-like" style="  display: flex;width: 51rem; align-items: center;justify-content: space-between;    margin: 0 auto;">

                    <div style="align-items: center;display: flex;">
                        <i 
                        class="material-icons   darken-2 like-publicador" 
                        style="background-color: <?php echo $validate ?  'red'  :  'white'; ?>;cursor:pointer" 
                        validate-data="<?php echo $local ?>" validate-id="<?php echo $value; ?>" 
                        user-id="<?php echo $_SESSION["profile_id"] ?> " 
                        data-like="<?php echo $publicacion->likes; ?>" 
                        id-publicaciones="<?php echo $publicacion->id_publicaciones; ?> ">favorite</i>

                        <a href="#likesModal<?php echo $value; ?>" style="font-size:1.2rem;display:flex" class="you-like-href modal-trigger" >
                        <div class="you-like" style="padding-right: .3rem; display:<?php echo $validate  ? 'block'  :  'none'   ?>"> </div> <span style="padding-right:.3rem;" class="data-like-class">
                        
                        <?php 
                        
                        if($publicacion->likes == 1 && $validate){

                            echo "a ti te gusta";
                        }else if($publicacion->likes-1 > 0 && $validate){
                            echo "a ti te gusta y a " . ($publicacion->likes -1) . " personas mas les gusta esta publicación";
                        } else if($publicacion->likes > 0 && !$validate){

                            echo ($publicacion->likes) . " personas mas les gusta esta publicación";
                        }else if($publicacion->likes == 0 && !$validate){

                            echo ($publicacion->likes) . " personas les gusta esta publicación";
                        }
                        
                       ?>
                     </span>
                    </a>

                    </div>


                    <i 
                    style="cursor: pointer;"
                    class="material-icons consultaComment" 
                    id-publicaciones="<?php echo $publicacion->id_publicaciones; ?>"
                    user-id="<?php echo $_SESSION["profile_id"] ?> "
                    >comment</i>
                </div>
            </li>
           
        </div>

        

        



    </div>


    <hr />

    <div class="body-comments" style="padding: 1rem;display:none"
    body-publicaciones="<?php echo $publicacion->id_publicaciones; ?>">

        comentarios

       

        
        <li style="list-style:none" class="user-comment" id="unique-comment-user">
            <span style="font-size: 1rem;padding:1rem"><?php echo $resultado->nombre ?> <?php echo $resultado->apellido ?></span>
            <div class="avatar" style="text-align: -webkit-center;padding: 1rem;display:flex">

                <?php if (isset($_SESSION['foto_perfil']) && $_SESSION['foto_perfil'] != '') : ?>
                    <img src="/imagenes/profile/<?php echo $_SESSION['foto_perfil'] ?>" style="width: 70px;border-radius: 10rem;height: 70px;" alt="">
                <?php else : ?>
                    <img src="/build/img/avatar_null.png" style="width: 70px;border-radius: 10rem;height: 70px;" alt="">
                <?php endif; ?>

                <div class="campo-publicador">


                        <textarea 
                        type="text"
                        user-id="<?php echo $_SESSION["profile_id"] ?> " 
                        id-publicaciones="<?php echo $publicacion->id_publicaciones; ?>"
                        name="comentario" 
                        id="comentario" 
                        placeholder="¿que deseas escribir?"
                        style="margin:2rem;border: 2px solid #e1e1e1;padding: .8rem;;height: 4rem;width: 28rem; border-radius: 1rem;"></textarea>
                 
                </div>
            </div>
        </li>
    </div>
</div>