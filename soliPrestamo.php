<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include("conexion.php");

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'todo';

if ($tipo == 'equipos') {
    $query = "SELECT ID, nombre, tipo, cantidad, disponibles FROM catalogo WHERE tipo = 'equipo'";
} elseif ($tipo == 'componentes') {
    $query = "SELECT ID, nombre, tipo, cantidad, disponibles FROM catalogo WHERE tipo = 'componente'";
} else {
    $query = "SELECT ID, nombre, tipo, cantidad, disponibles FROM catalogo";
}

$result = $mysqli->query($query);

$catalogo = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
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

    <script>
        function validateForm() {
            var checkboxes = document.querySelectorAll('input[name="materiales[]"]');
            var componentCheckboxes = [];
            var valid = true;
            var errorMessage = "";

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var type = checkbox.dataset.type;
                    var disponibles = parseInt(checkbox.dataset.disponibles);
                    var cantidadInput = document.querySelector('input[name="cantidad[' + checkbox.value + ']"]');
                    var cantidad = parseInt(cantidadInput.value);

                    if (type === 'componente' && cantidad > disponibles) {
                        valid = false;
                        errorMessage += "No puedes solicitar más de " + disponibles + " de " + checkbox.dataset.nombre + ".\n";
                    }
                }
            });

            if (!valid) {
                alert(errorMessage);
            }

            return valid;
        }

        function toggleQuantityInput(checkbox) {
            var cantidadInput = document.querySelector('input[name="cantidad[' + checkbox.value + ']"]');
            if (checkbox.checked) {
                cantidadInput.disabled = false;
                cantidadInput.required = true;
            } else {
                cantidadInput.disabled = true;
                cantidadInput.required = false;
                cantidadInput.value = "";
            }
        }
    </script>
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
                <h1 class="all-tittles"><center>Solicitar préstamo</center></h1>
            </div>
        </div>
        <form method="GET" action="soliPrestamo.php" class="form-inline">
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
        <div class="container-fluid" style="margin: 50px 0;">
             <form method="POST" action="confirmaPrestamo.php" onsubmit="return validateForm();">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
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
                                <td>
                                    <input type="checkbox" name="materiales[]" value="<?php echo $item['ID']; ?>" data-type="<?php echo $item['tipo']; ?>" data-disponibles="<?php echo $item['disponibles']; ?>" data-nombre="<?php echo $item['nombre']; ?>" onclick="toggleQuantityInput(this);">
                                </td>
                                <td><?php echo $item['ID']; ?></td>
                                <td><?php echo $item['nombre']; ?></td>
                                <td><?php echo $item['tipo']; ?></td>
                                <td>
                                <input type="number" name="cantidad[<?php echo $item['ID']; ?>]" min="1" max="<?php echo $item['tipo'] == 'componente' ? $item['disponibles'] : '1'; ?>" disabled>
                                </td>
                                <td><?php echo $item['disponibles']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay datos disponibles</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Confirmar Préstamo</button>
            </form>
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
