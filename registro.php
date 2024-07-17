<!DOCTYPE html>

<?php
    session_start();

    if (isset($_POST['validar'])) {
        $_SESSION['userID'] = $_POST['userID'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['picture'] = $_POST['picture'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['accessToken'] = $_POST['accessToken'];

        exit("success");
    }
?>

<html lang="es">
<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/icono.png" />
    <script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
</head>



<body class="full-cover-background" style="background-image:url(assets/img/login_lab.jpg);">

    <div class="form-container">

        <p class="text-center" style="margin-top: 17px;">

           <img src="assets/img/user02.png" width="100" height="100">
       </p>

       <h4 class="text-center all-tittles" style="margin-bottom: 30px;">Registro</h4>

       <form action="validaregistro.php" method="POST">

            <div class="group-material-login">
              <input type="text" class="material-login-control" name="realname" required="" maxlength="70">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-account"></i> &nbsp; Nombre</label>
            </div><br>
            <div class="group-material-login">
              <input type="email" class="material-login-control" name="nick" required="" maxlength="70">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-account"></i> &nbsp; Email</label>
            </div><br>
            <div class="group-material-login">
              <input type="password" class="material-login-control" name="pass" required="" maxlength="70">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-account"></i> &nbsp; Contraseña</label>
            </div><br>
            <div class="group-material">
                <select class="material-control-login" required >
                    <option value="" disabled="" selected="">Tipo de usuario</option>
                    <option value="Investigador">Investigador</option>
                </select>
            </div>
            <button class="btn-login" type="submit">Registrarse &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>
          </form>
            <a href="index.php">
            <button class="btn-login2" type="submit"><i class="zmdi zmdi-arrow-left"></i> &nbsp; Login </button>
          </a>
            
        
    </div>  

    <?php
    if(isset($_POST['submit'])){
      require("validaregistro.php");
    }
  ?>

</body>

</html>