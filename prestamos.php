<?php
session_start();
include("conexion.php");

// Determinar el tipo de filtro
$estatus = isset($_GET['estatus']) ? $_GET['estatus'] : 'todos';

// Consulta SQL base para obtener los préstamos con los nombres de usuario y material
$query = "SELECT prestamos.id, prestamos.id_usuario, login.user AS nombre_usuario, 
                 prestamos.id_material, catalogo.nombre AS nombre_material, 
                 prestamos.cantidad, prestamos.fecha_prestamo, prestamos.estatus
          FROM prestamos
          INNER JOIN login ON prestamos.id_usuario = login.ID
          INNER JOIN catalogo ON prestamos.id_material = catalogo.ID";

// Aplicar filtro según el estatus seleccionado
if ($estatus == 'vigentes') {
    $query .= " WHERE prestamos.estatus = 'vigente'";
} elseif ($estatus == 'entregados') {
    $query .= " WHERE prestamos.estatus = 'entregado'";
}

// Ordenar por fecha de préstamo (más reciente primero)
$query .= " ORDER BY prestamos.fecha_prestamo DESC";

$result = $mysqli->query($query);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    $prestamos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $prestamos = [];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Administradores</title>
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
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
                Prestamos IEA
            </div>
            <div class="full-reset" style="background-color:#2B3D51; padding: 10px 0; color:#fff;">
                <figure>
                    <img src="assets/img/logo1.png" alt="Biblioteca" class="img-responsive center-box" style="width:55%;">
                </figure>
                <p class="text-center" style="padding-top: 15px;">Sistema Préstamos IEA Admin</p>
            </div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <li><a href="admin.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a></li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp; Administración <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="registros.php"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp; Ver registros</a></li>
                            <li><a href="registradmin.php"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp; Registrar nuevo administrador</a></li>
                            <li><a href="agregarMaterial.php"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Agregar material</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp; Catálogo <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="catalogoAdmin.php"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Todo</a></li>
                            <li><a href="catalogoAdmin.php?tipo=equipos"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Equipos o herramientas</a></li>
                            <li><a href="catalogoAdmin.php?tipo=componentes"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Componentes</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-alarm zmdi-hc-fw"></i>&nbsp;&nbsp; Préstamos y reservaciones <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="prestamos.php"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp; Todos los préstamos</a></li>
                            <li>
                                <a href="prestamos.php?estatus=vigentes"><i class="zmdi zmdi-time-restore zmdi-hc-fw"></i>&nbsp;&nbsp; Devoluciones pendientes</a>
                            </li>
                            <li>
                                <a href="prestamos.php?estatus=entregados"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Prestamos concluídos</a>
                            </li>
                        </ul>
                    </li>
            </div>
        </div>
    </div>
    <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                   <img src="assets/img/user01.png" alt="user-picture" class="img-responsive img-circle center-box">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <strong><?php echo $_SESSION['user'];?></strong>
                </li>
                <li  class="tooltips-general exit-system-button" data-href="index.php" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li>
                <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Lista de Préstamos</h1>
            </div>
            </div>
        <div class="form-group">
            <label for="estatus">Mostrar:</label>
            <select name="estatus" id="estatus" class="form-control" onchange="filtroPrestamos()">
                <option value="todos" <?php if ($estatus == 'todos') echo 'selected'; ?>>Todos</option>
                <option value="vigentes" <?php if ($estatus == 'vigentes') echo 'selected'; ?>>Vigentes</option>
                <option value="entregados" <?php if ($estatus == 'entregados') echo 'selected'; ?>>Entregados</option>
            </select>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID User</th>
                        <th>User</th>
                        <th>ID Material</th>
                        <th>Material</th>
                        <th>Cantidad</th>
                        <th>Fecha de Préstamo</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestamos as $prestamo): ?>
                        <tr>
                            <td><?php echo $prestamo['id']; ?></td>
                            <td><?php echo $prestamo['id_usuario']; ?></td>
                            <td><?php echo $prestamo['nombre_usuario']; ?></td>
                            <td><?php echo $prestamo['id_material']; ?></td>
                            <td><?php echo $prestamo['nombre_material']; ?></td>
                            <td><?php echo $prestamo['cantidad']; ?></td>
                            <td><?php echo $prestamo['fecha_prestamo']; ?></td>
                            <td><?php echo $prestamo['estatus']; ?></td>
                            <td>
                                <?php if ($prestamo['estatus'] == 'vigente'): ?>
                                    <a href="cambiarEstatus.php?id=<?php echo $prestamo['id']; ?>" class="btn btn-success btn-sm">Marcar como entregado</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
    </div>

    <script>
        // Función para redireccionar con el filtro seleccionado
        function filtroPrestamos() {
            var estatus = document.getElementById("estatus").value;
            window.location.href = "prestamos.php?estatus=" + estatus;
        }
    </script>
</body>
</html>

<?php
// Cerrar la conexión
$mysqli->close();
?>
