<?php

autenticar_sesion();


?>


<h3>



</h3>


<!-- estructura modal -->









<div class="grid-home" style="
    display: grid;
    grid-template-columns: 1fr 3fr 1fr;
    column-gap: 5rem;
    margin: 1rem 4rem;

">



    <div class="col s4" style="
    margin-top: 1rem;width: 28rem;">


        <h2>Categorias</h2>

        <ul class="collection">
            <li class="collection-item">Tecnologia</li>
            <li class="collection-item">Ciencia</li>
            <li class="collection-item">Deportes</li>
            <li class="collection-item">Literatura</li>
        </ul>

        <h2>Interes</h2>

        <ul class="collection">
            <li class="collection-item">Vaciones</li>
            <li class="collection-item">Musica</li>
            <li class="collection-item">Personas Famosas</li>
            <li class="collection-item">Populares</li>
        </ul>

        <h2 style="margin: 1rem;">Videos</h2>

        <hr style="    height: .4rem;
    background-color: #c0c0ea;" />

        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <div class="col s2">
                        <img src="/build/img/avatar_null.png" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                    </div>
                    <div class="col s10">
                        <span class="black-text">
                            This is a square image. Add the "circle" class to it to make it appear circular.
                        </span>
                    </div>

                </div>

                <video class="responsive-video" controls style="width: 60rem;height: 30rem;">
                    <source src="/videos/video_1.mp4" type="video/mp4">
                </video>




            </div>


        </div>

        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <div class="col s2">
                        <img src="/build/img/avatar_null.png" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                    </div>
                    <div class="col s10">
                        <span class="black-text">
                            This is a square image. Add the "circle" class to it to make it appear circular.
                        </span>
                    </div>
                </div>
                <video class="responsive-video" controls style="width: 60rem;">
                    <source src="movie.mp4" type="video/mp4">
                </video>
            </div>
        </div>

        <div class="col s12 m8 offset-m2 l6 offset-l3">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <div class="col s2">
                        <img src="/build/img/avatar_null.png" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                    </div>
                    <div class="col s10">
                        <span class="black-text">
                            This is a square image. Add the "circle" class to it to make it appear circular.
                        </span>
                    </div>

                </div>

                <video class="responsive-video" controls style="width: 60rem;">
                    <source src="movie.mp4" type="video/mp4">
                </video>
            </div>


        </div>


    </div>


    <div class="col s6" style="padding: 1rem 8rem;margin:  5rem  auto;max-width: 1300px;">

        <p style="padding: 0;margin:0;font-size:10px; text-align:center">"La vida es una ruleta"</p>


        <div class="col s4 m6" style="max-width: 900px;">
            <div class="card grey lighten-5 z-depth-3" style="width: 54rem;padding:2rem;margin: 0 auto;">


                <form class="form">
                    <div class="flex">

                        <div class="avatar" style="text-align: -webkit-center;padding: 1rem;">
                            <img src="/build/img/foto_perfil.jpg" style="width: 70px;border-radius: 10rem;height: 70px;" alt="">

                        </div>
                        <div class="campo-publicador">
                            <textarea type="text" name="descripcion" id="descripcion" placeholder="¿que deseas escribir?" style="margin: 1rem 0 2rem 0;border: 2px solid #e1e1e1;padding: 1rem;height: 10rem;border-radius: 1rem;"></textarea>
                        </div>



                        <div class="flex-u" style="display: flex;justify-content:space-between">
                            <div class="campo-publicador">
                                <input type="file" id="imagen" name="imagen" accept="img/jpg , img/png">
                            </div>
                            <div class="campo-publicador">
                                <button style="padding: 1rem;border: none;background-color: #3b7ae2;color: white;text-transform: uppercase;cursor:pointer">Categoria</button>
                            </div>

                        </div>

                        <button style="padding: 1rem;border: none;background-color: #3b7ae2;color: white;text-transform: uppercase;cursor:pointer;display:block;width:50rem;margin:1rem 0">Editar</button>



                    </div>
                </form>
            </div>
        </div>



        <h2 style="text-align: center;">Publicaciones</h2>

        
        <?php $value = 0; ?>
        <?php foreach ($publicaciones as $publicacion) : ?>

            

            <?php include '../includes/templates/publicacion.php'; ?>
        <?php endforeach; ?>


    </div>

    <div class="collumn" style="margin-top: 1rem;width: 100%;">


        <h3 style="font-size: 1.8rem;">Contactos</h3>
        <hr style="    height: .4rem;
background-color: #c0c0ea;" />
        <ul class="collection">



            <?php foreach ($usuarios as $usuario) :    ?>



                <?php if ($usuario->id_usuario == $_SESSION["profile_id"]) : continue;
                endif; ?>
                <li class="collection-item avatar" style="padding: 0 1rem;height:1.2rem">
                    <div class="avatar" style="    text-align: -webkit-center;
                     padding: 1rem 1rem;
                     display: flex;  
                     margin: 0 0rem;  
                     align-items: center;">


                        <a href="/user/profile?id=<?php echo  $usuario->id_usuario; ?>"><img src="<?php echo $usuario->foto_perfil != '' ? '/imagenes/profile/' . $usuario->foto_perfil : '/build/img/avatar_null.png'; ?>" style="width: 50px;border-radius: 10rem;height: 50px;" alt=""></a>


                        <p style="font-size: 1.3rem;width: 26rem;;font-size:1.3rem"> <?php echo $usuario->nombre; ?> <?php echo $usuario->apellido; ?> </p>
                    </div>


                </li>

            <?php endforeach; ?>
        </ul>
    </div>

</div>

</div>