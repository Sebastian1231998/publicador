<?php

autenticar_sesion();

if (isset($_SESSION["profile_id"])) {



    if ($_SESSION["profile_id"] == (int)$_GET["id"]) {

        $modificar = true;
    }
}


if (is_null($resultado)) {

    header('Location: user/profile?id=' . $_SESSION['profile_id']);
}





?>
<div class="">

    <!-- estructura modal -->

    <div id="perfilModal" class="modal">
        <div class="modal-content">
            <h4 style="text-align: center; padding: 2rem;">Edita tu foto de perfil</h4>

            <hr style="    height: .4rem;
    background-color: #c0c0ea;" />

            <form enctype="multipart/form-data" method="POST">

                <input id="fichero" type="file" name="foto_perfil" accept="img/jpg , img/png" required>
                <label for="fichero" class="circle" style="display: inline-block;border-radius: 0;width: 100%;height: 4rem;background-color: #444192;cursor: pointer;color: white;font-size: 2rem;margin: 3rem 0;text-align: center;">Elige tu foto</label>


                <div style="text-align: center;">
                    <input style="cursor:pointer" type="submit" class="btn-flat blue" value="editar" name="accion"></a>
                </div>

            </form>
        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat"> <i class="material-icons">clear</i></a>
        </div>
    </div>


    <!-- cierre modal -->

    <div class="">

        <!-- estructura modal -->

        <div id="categoriaModal" class="modal">
            <div class="modal-content">
                <h4 style="text-align: center; padding: 2rem;">Elige una categoria</h4>
            </div>

            <ul class="collection with-header" style="margin: 0 auto; width:900px">
                <li class="collection-header">
                    <h4>First Names</h4>
                </li>
                <li class="collection-item">
                    <div>Tecnologia<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div>
                </li>
                <li class="collection-item">
                    <div>Ciencia<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div>
                </li>
                <li class="collection-item">
                    <div>Literatura<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div>
                </li>
                <li class="collection-item">
                    <div>Deportes<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div>
                </li>
            </ul>

            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat"> <i class="material-icons">clear</i></a>
            </div>
        </div>


        <!-- cierre modal -->




        <?php if (isset($_GET['result']) &&  $_GET['result'] == 1) : ?>

            <div class="" style="margin: 1rem 0;
  padding: 1rem;
  margin:2rem auto;
  width:900px;
  text-align: center;
  font-weight: bold;
  -webkit-box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
  -moz-box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
  box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
  text-transform: uppercase;
  border-radius: 1rem;
  background-color: #32b532;
  margin-bottom:3rem;
  
  ">
                <p style="color: white;">Se ha editado correctamente tu foto de perfil</p>
            </div>


        <?php elseif (isset($_GET['result']) &&  $_GET['result'] == 2) : ?>


            <div class="" style="margin: 1rem 0;
  padding: 1rem;
  margin:2rem auto;
  width:900px;
  text-align: center;
  font-weight: bold;
  -webkit-box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
  -moz-box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
  box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
  text-transform: uppercase;
  border-radius: 1rem;
  background-color: #32b532;
  margin-bottom:3rem;
  
  ">
                <p style="color: white;">Se ha publicado correctamente tu contenido</p>
            </div>



        <?php endif; ?>









        <div class="container">
            <div class="portada" style=>
                <div class="image_portada" style="margin-top: 5rem;">

                    <img src="/build/img/portada_defecto.jpg" style="width:100%;height: 40vh; border-radius: 5rem;position: relative;" alt="">



                    <div class="image_profile">

                        <?php if ($resultado->foto_perfil == '') : ?>
                            <a href="#perfilModal" class="modal-trigger"><img href="#modal1" src="/build/img/avatar_null.png" alt="" style=" width: 160px;height: 150px;border-radius: 54rem;border: 2px solid darkgoldenrod;position: absolute;top: 30rem;right: 87rem;<?php echo isset($modificar) ? 'cursor:pointer'  :  null;  ?>" class="<?php echo isset($modificar) ? 'imagen_perfil'  :  null;  ?>"></a>
                        <?php elseif ($resultado->foto_perfil != '') : ?>
                            <a href="#perfilModal" class="modal-trigger"><img src="/imagenes/profile/<?php echo $resultado->foto_perfil; ?>" alt="" style=" width: 160px;height: 150px;border-radius: 54rem;border: 2px solid darkgoldenrod;position: absolute;top: 30rem;right: 87rem;<?php echo isset($modificar) ? 'cursor:pointer'  :  null;  ?>" class="<?php echo isset($modificar) ? 'imagen_perfil'  :  null;  ?>"></a>
                        <?php endif; ?>


                    </div>
                    <h2 style="margin: 1.5rem;font-weight:bold;"> <span><?php echo $resultado->nombre . "  " . $resultado->apellido; ?> </span><br><span style="font-size:1rem">nacimiento:<?php echo $resultado->fecha_nacimiento; ?></span></h2>

                    <hr />



                    <div class="row" style="margin-top: 1rem;">


                        <div class="col s6">

                            <div>

                                <p style="margin-bottom: 5rem; font-weight:bold; color: #1d405f;font-weight:bold;margin:1rem;text-align:center;">Fotos(6)</p>
                                <button style="padding: 1rem;border: none;background-color: #3b7ae2;color: white;text-transform: uppercase;cursor:pointer;display:block;width:60rem;margin:1rem">Editar</button>
                            </div>

                            <section id="galeria" class="contenedor galeria">

                                <?php if (isset($modificar)) : ?>

                                    <p style="text-align: center;">No Hay Imagenes En La Galeria</p>


                            </section>

                        <?php else : ?>


                            <section id="galeria" class="contenedor galeria">
                                <p style="text-align: center;">No Hay Imagenes En La Galeria del usuario <?php echo $resultado->nombre ?> </p>
                            </section>

                        <?php endif; ?>

                        <div class="card white" style="margin: 2rem;">
                            <div class="card-content black-text">

                                <span style="text-align:center" class="card-title">Detalles</span>
                                <p><span style="font-weight: bold;">Nombre: </span><?php echo $resultado->nombre . "  " . $resultado->apellido; ?></p>
                                <p><span style="font-weight: bold;">Correo: </span><?php echo $resultado->correo; ?></p>
                                <p><span style="font-weight: bold;">Fecha de nacimiento: </span><?php echo $resultado->fecha_nacimiento; ?> </p>

                                <p><span style="font-weight: bold;">Fecha de creación de usuario: </span><?php echo $resultado->fecha_creacion; ?></p>
                            </div>
                            <div class="card-action" style="text-align: center;">
                                <a href="#">Editar</a>

                            </div>



                        </div>




                        </div>









                        <div class="col s6" style="padding: 1rem 8rem;">



                            <?php if (isset($modificar)) : ?>
                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="card grey lighten-5 z-depth-3" style="width: 48rem;padding:2rem">


                                            <form class="form" enctype="multipart/form-data" method="POST">
                                                <div class="flex">

                                                    <?php if ($resultado->foto_perfil == '') : ?>
                                                        <div class="avatar" style="text-align: -webkit-center;padding: 1rem;">
                                                            <img src="/build/img/avatar_null.png" style="width: 70px;border-radius: 10rem;height: 70px;" alt="">
                                                        </div>
                                                    <?php elseif ($resultado->foto_perfil != '') : ?>
                                                        <div class="avatar" style="text-align: -webkit-center;padding: 1rem;">
                                                            <img src="/imagenes/profile/<?php echo $resultado->foto_perfil; ?>" style="width: 70px;border-radius: 10rem;height: 70px;" alt="">
                                                        </div> <?php endif; ?>




                                                    <div class="campo-publicador">

                                                        <input type="text" name="titulo" id="titulo" placeholder="titulo" style="margin: 1rem 0;border: 2px solid #e1e1e1;padding: 1rem 0;height: 2rem;border-radius: 1rem;" required></textarea>
                                                        <textarea type="text" name="contenido" id="contenido" required placeholder="¿que deseas escribir?" style="margin: 1rem 0 2rem 0;border: 2px solid #e1e1e1;padding: 1rem;height: 10rem;border-radius: 1rem;"></textarea>


                                                    </div>



                                                    <div class="flex-u" style="display: flex;">
                                                        <div class="campo-publicador">
                                                            <input type="file" id="imagen" required name="imagen" accept="img/jpg , img/png">
                                                        </div>
                                                        <div class="campo-publicador">
                                                            <a href="#categoriaModal" class="categoria-publicador modal-trigger" style="padding: 1rem;border: none;background-color: #3b7ae2;color: white;text-transform: uppercase;cursor:pointer">Categoria</a>

                                                            <input type="hidden" required class="categoria-input" name="categoria">


                                                        </div>
                                                    </div>


                                                    <div class="categoria-seleccionada" style="
                                                            text-align: center;
                                                            padding: 1rem;
                                                            background: #79baf3;
                                                            height: 3rem;
                                                            padding: 0;
                                                            margin: 2rem 2rem 0 1rem;
                                                            display:none;
                                                           ">



                                                    </div>
                                                </div>


                                                <input type="hidden" name="usuarioId" value="<?php echo $_SESSION['profile_id'] ?>">
                                                <button class="public_submit" name="accion" value="publicar" style="padding: 1rem;border: none;background-color: #3b7ae2;color: white;text-transform: uppercase;cursor:pointer;display:block;width:41rem;margin:1rem">Publicar</button>

                                        </div>


                                        </form>
                                    </div>
                                </div>

                            <?php endif; ?>


                            <?php if (empty($publicaciones)) : ?>


                                <h3>Este usuario no tiene publicaciones</h3>

                            <?php endif; ?>


                            <?php echo $value = 0; ?>

                            <?php foreach ($publicaciones as $publicacion) : ?>

                            <?php include '../includes/templates/publicacion.php'; ?>
                            <?php endforeach; ?>

                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>