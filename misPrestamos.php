<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['id'];

$query = "
    SELECT p.id, c.nombre, c.tipo, p.cantidad, p.fecha_prestamo, p.estatus
    FROM prestamos p
    JOIN catalogo c ON p.id_material = c.ID
    WHERE p.id_usuario = ?
";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$prestamos = $result->fetch_all(MYSQLI_ASSOC);
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
        .biblioteca {
            margin-top: 5px;
            color: white;
            font-size: 35px;
        }
    </style>
</head>
<body>
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
                <div class="biblioteca">
                    <center>Investigación en Electrónica Avanzada</center>
                </div>
            </div>
            <div class="full-reset" style="background-color:#2B3D51; padding: 10px 0; color:#fff;">
                <figure>
                    <img src="assets/img/logo1.png" alt="Biblioteca" class="img-responsive center-box" style="width:55%;">
                </figure>
                <p class="text-center" style="padding-top: 15px;">Investigación en Electrónica Avanzada</p>
            </div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <li><a href="iniciouser.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a></li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp; Ver disponibilidad <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="catalogo.php"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Todo</a></li>
                            <li><a href="catalogo.php?tipo=equipos"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Equipos o herramientas</a></li>
                            <li><a href="catalogo.php?tipo=componentes"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Componentes</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-alarm zmdi-hc-fw"></i>&nbsp;&nbsp; Préstamos <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="misPrestamos.php"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp; Mis préstamos</a></li>
                            <li>
                                <a href="soliPrestamo.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Solicitar préstamo <span class="label label-danger pull-right label-mhover"></span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                    <img src="assets/img/user03.png" alt="user-picture" class="img-responsive img-circle center-box">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <span class="all-tittles"><strong><?php echo $_SESSION['user'];?></strong></span>
                </li>
                <li class="tooltips-general exit-system-button" data-href="index.php" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li>
                <li class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles"><center>Mis préstamos</center></h1>
            </div>
            <?php if (!empty($prestamos)): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Préstamo</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Fecha de Préstamo</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prestamos as $prestamo): ?>
                            <tr>
                                <td><?php echo $prestamo['id']; ?></td>
                                <td><?php echo $prestamo['nombre']; ?></td>
                                <td><?php echo $prestamo['tipo']; ?></td>
                                <td><?php echo $prestamo['cantidad']; ?></td>
                                <td><?php echo $prestamo['fecha_prestamo']; ?></td>
                                <td><?php echo $prestamo['estatus']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-prestamos">
                    <p>No has solicitado ningún préstamo aún.</p>
                </div>
            <?php endif; ?>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                    </div>
                    <div class="modal-body">
                        <center><h2>Contactanos:</h2></center><br>
                        <center><img src="assets/img/whatsapp.png" width="50"><font size="5">whatsapp</font><br><font size="4"><a href="">+52 55 1234 5678</a></font></center>
                        <br><br>
                        <center><img src="assets/img/Facebook.png" width="50"><font size="5">Facebook</font><br><font size="4">Préstamos IEA</font></center>
                        <br><br>
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
    </div>
</body>
</html>