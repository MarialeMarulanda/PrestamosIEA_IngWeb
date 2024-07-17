<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$prestamos = isset($_SESSION['prestamos']) ? $_SESSION['prestamos'] : [];
unset($_SESSION['prestamos']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Principal</title>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>


    <style>

.biblioteca{


	margin-top: 5px;
	color: white;
	font-size: 35px;
}

</style>
</head>
<body>
    <!-- Navegación y otros elementos del encabezado -->

    <div class="container">
        <div class="page-header">
            <h1 class="all-tittles"><center>Resumen del Préstamo</center></h1>
        </div>
        <div class="container-fluid" style="margin: 50px 0;">
            <div class="alert alert-success" role="alert">
                <strong>¡Préstamo exitoso!</strong> Tus materiales han sido prestados correctamente.
            </div>
            <?php if (!empty($prestamos)): ?>
                <h3>Materiales solicitados:</h3>
                <ul>
                    <?php foreach ($prestamos as $prestamo): ?>
                        <li><?php echo $prestamo['nombre']; ?> - Cantidad: <?php echo $prestamo['cantidad']; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No se han solicitado materiales.</p>
            <?php endif; ?>
           <center><a href="misPrestamos.php" class="btn btn-primary">Ver mis préstamos</a></center> 
        </div>
    </div>
<div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    <center><h2>Contactanos:</h2></center><br>
                    <center><img src="assets/img/whatsapp.png" width="50"><font size="5" >whatsapp</font><br><font size="4" ><a href="">+52 55 1234 5678</a></font></center>
                    <br>
                    <br>
                    <center><img src="assets/img/Facebook.png" width="50"><font size="5" >Facebook</font><br><font size="4" >Préstamos IEA</font></center>
                    <br>
                    <br>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <footer class="footer full-reset">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h4 class="all-tittles">Acerca de</h4>
                        <p>
Proyecto de préstamo para IEA<br>
Directorio <br>
Normatividad<br>
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h4 class="all-tittles">Desarrolladora</h4>
                        <ul class="list-unstyled">
                            <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; Alejandra Marulanda</li>
                        </ul>
                        <h4 class="all-tittles">Plantilla</h4>
                        <ul class="list-unstyled">
                            <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; Jhonatan Cardona </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright full-reset all-tittles">© 2024 Alejandra Marulanda</div>
        </footer>
</body>
</html>
