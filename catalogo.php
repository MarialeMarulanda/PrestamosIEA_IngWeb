<?php
session_start();
if (@!$_SESSION['user']) {
    header("Location:index.php");
}

include("conexion.php");

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'todo';

// Construir la consulta SQL basada en el filtro
if ($tipo == 'equipos') {
    $query = "SELECT ID, nombre, tipo, cantidad, disponibles FROM catalogo WHERE tipo = 'equipo'";
} elseif ($tipo == 'componentes') {
    $query = "SELECT ID, nombre, tipo, cantidad, disponibles FROM catalogo WHERE tipo = 'componente'";
} else {
    $query = "SELECT ID, nombre, tipo, cantidad, disponibles FROM catalogo";
}

$result = $mysqli->query($query);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    $catalogo = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $catalogo = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Catálogo</title>
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
                            <li><a href="catalogo.php?tipo=todo"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Todo</a></li>
                            <li><a href="catalogo.php?tipo=equipos"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Equipos o herramientas</a></li>
                            <li><a href="catalogo.php?tipo=componentes"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Componentes</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-alarm zmdi-hc-fw"></i>&nbsp;&nbsp; Préstamos <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href=""><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp; Mis préstamos</a></li>
                            <li><a href=""><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Solicitar préstamo <span class="label label-danger pull-right label-mhover"></span></a></li>
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
                    <span class="all-tittles"><strong><?php echo $_SESSION['user']; ?></strong></span>
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
                <h1 class="all-tittles"><center>Catálogo</center></h1>
            </div>
            <form method="GET" action="catalogo.php" class="form-inline">
                <div class="form-group">
                    <label for="tipo">Mostrar:</label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="todo" <?php if ($tipo == 'todo') echo 'selected'; ?>>Todo</option>
                        <option value="equipos" <?php if ($tipo == 'equipos') echo 'selected'; ?>>Equipos o herramientas</option>
                        <option value="componentes" <?php if ($tipo == 'componentes') echo 'selected'; ?>>Componentes</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
        <div class="container-fluid" style="margin: 50px 0;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Disponibles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($catalogo)): ?>
                        <?php foreach ($catalogo as $item): ?>
                            <tr>
                                <td><?php echo $item['ID']; ?></td>
                                <td><?php echo $item['nombre']; ?></td>
                                <td><?php echo $item['tipo']; ?></td>
                                <td><?php echo $item['cantidad']; ?></td>
                                <td><?php echo $item['disponibles']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay datos disponibles</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
