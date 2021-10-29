<?php

session_start();

if(isset($_SESSION['profile_id'])){

    header('Location: user/profile?id='. $_SESSION['profile_id']);
}

?>


<div class="container" style="margin: 0 auto; max-width:500px">
    <!-- Page Content goes here -->

    <div class="row" style="margin-top: 3rem;">

        <h3 style="margin-bottom: 5rem; font-weight:bold; color: #1d405f;font-weight:bold">Login</h3>

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

        <form class="col s12" method="POST">

            <div class="row">
                <div class="input-field col s12">
                    <input id="correo" placeholder="Correo" type="email" value="<?php echo sanitizar($usuario->correo); ?>" class="validate" name="correo">
                    <label for="email"></label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password" placeholder="Password"type="password" class="validate" name="password">
                    <label for="password"></label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" style="width: 100%; color: black;background-color:#e4e5e6" type="submit">Submit
                <i class="material-icons right">send</i>
            </button>




        </form>
    </div>
</div>