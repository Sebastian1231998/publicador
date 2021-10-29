<section class="header">


</section>

<div class="container">
    <!-- Page Content goes here -->

    <div class="row" style="margin-top: 3rem;">

        <h3 style="margin-bottom: 5rem; font-weight:bold; color: #1d405f;font-weight:bold">Registro</h3>
        <div class="col s6">



            <form class="col s12 form-registro">
                <div class="row">
                    <div class="input-field col s6">
                        <label for="nombre"></label>
                        <input id="nombre" placeholder="Nombre" name="nombre" type="text" class="validate">

                    </div>
                    <div class="input-field col s6">
                        <input id="apellido" placeholder="Apellido" name="apellido" type="text" class="validate">
                        <label for="apellido"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="fecha" type="date" class="validate" name="fecha">
                        <label for="fecha">Fecha de nacimiento</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Password" id="password" type="password" class="validate" name="password">
                        <label for="password"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Email " id="email" name="email" type="email" class="validate">
                        <label for="email"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <p>
                            <label>
                                <input name="genero" class="genero" type="radio" value="masculino" />
                                <span>Masculino</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="genero" class="genero" type="radio" value="femenino" />
                                <span>Femenino</span>
                            </label>
                        </p>
                    </div>
                    <input type="submit" class="btn waves-effect waves-light submit" style="width: 100%; color: black;background-color:#e4e5e6" value="registro">
                </form>

              

                <a href="/login" class="btn waves-effect waves-light" style="width: 100%; color: black;background-color:#e4e5e6;margin:1rem 0 0 0">Si ya tienes una cuenta inicia sesión
                    <i class="material-icons right"></i>
                </a>

            </div>

            <?php foreach ($errores as $error) : ?>


                <div class="alerta error" style="margin: 1rem 0;
padding: 1rem;
color: white;
text-align: center;
font-weight: bold;
-webkit-box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
-moz-box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
box-shadow: 3px 9px 5px -8px rgba(0, 0, 0, 0.45);
text-transform: uppercase;
border-radius: 1rem;
background-color: #ea4e4e;
max-width: 60rem; 
width:95%;
margin: 2rem auto;

">

                    <?php echo $error; ?>



                </div>


            <?php endforeach; ?>

        </div>


        <div class="col s6">

            <h4 style="font-family: 'Roboto', sans-serif;text-align: center;color: #1d405f; margin: 0;">Registrate y vive una experiencia unica</h4>
            <div class="container">
                <p style="font-family: 'Roboto', sans-serif;text-align: center;color: #4b4e52;font-size: 1.7rem;">Podras publicar con solo dar un click ven y empecemos con esta aventura!!</p>

                <img src="/build/img/imagen_registro.jpg" style="border-radius: 50rem;height: 40rem;width: 40rem;">
            </div>

        </div>
    </div>


</div>