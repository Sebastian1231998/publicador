<?php


if(isset($user_notificacion)){

  $notify = $user_notificacion->fetch_assoc()["mensajes_recibidos"];
}



$avatar_profile;

if (isset($_SESSION["profile_id"])) {


  $avatar_profile = true;
} else {

  $avatar_profile = false;
}




?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Shrine (MDC Web Example App)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="/build/css/app.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />


  <style type="text/css">
  body::-webkit-scrollbar {
   width: 10px;

  
  
  }

  body::-webkit-scrollbar-thumb {


  border-radius: 5px;

  background-color: #63a2ea;
  }

  .barra-azul::-webkit-scrollbar-thumb{
    background-color: #63a2ea;
  border-radius: 5px;
  }

  .barra-azul::-webkit-scrollbar{
    width: 7px;
}


  .body-message-content::-webkit-scrollbar{

    width: 10px;
   }

  .body-message-content::-webkit-scrollbar-thumb{

    background-color: #63a2ea;
  border-radius: 5px;
  }
  

  </style>
</head>


<body class="shrine-login blue-grey lighten-5" >

  <header class="header">
    <nav class="blue darken-3">
      <div class="nav-wrapper container ">
        <a href="/homepage" class="brand-logo <?php echo isset($header_inicio) ? 'left' : 'center'; ?> "><i class="material-icons">cloud</i></a>

        <?php if (isset($header_inicio)) { ?>

          <ul class="right hide-on-med-and-down">

            <li style="position: relative;"><a href="/messages/user?id=<?php echo$_SESSION["profile_id"]; ?>">

            <i class="material-icons">message</i>
            <div class="notification" style="width: 20px;height: 20px;border-radius: 2rem;font-size: 1rem;position: absolute; background-color: red;top: 9px;right: 27px;">
            <p class="texto-notificacion" style="font-size: 1.4rem;position: relative;bottom: 36px;color: white;font-weight: bold;left: 6px;"><?php echo $notify; ?></p>
          </div>
          </a></li>

           
            <li><a href="#">

                <?php if (  isset($_SESSION['foto_perfil']) && $_SESSION['foto_perfil'] != '') : ?>
                  <a href="/user/profile?id=<?php echo $_SESSION["profile_id"]; ?>"><img src="/imagenes/profile/<?php echo $_SESSION['foto_perfil'] ?>" style="width: 60px;border-radius: 10rem;height: 55px;padding:1rem;margin-top:.3rem" alt=""></a>
                <?php else : ?>
                  <a href="/user/profile?id=<?php echo $_SESSION["profile_id"]; ?>"><img src="/build/img/avatar_null.png" style="width: 50px;border-radius: 10rem;height: 50px;padding:1rem;margin-top:.8rem" alt=""></a>
                <?php endif; ?>


              </a></li>
            <li><a href="/cerrar?cerrar_sesion=true"><i class="material-icons">redo</i></a></li>
          </ul>



        <?php   } ?>
      </div>
    </nav>
  </header>
  <?php echo $contenido; ?>


  <footer class="footer">


    <nav class="blue darken-3" style="height: 11.5vh;">
      <div class="nav-wrapper container ">

        <a href="#!" class="brand-logo right"><i class="material-icons">cloud</i>SHINRE</a>
        <p class="center " style="color: white;font-weight:bold;margin: 8rem;">Todos los derechos reservados &copy;</p>

      </div>

    </nav>



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="/build/js/bundle.min.js"></script>

  </footer>
</body>



</html>