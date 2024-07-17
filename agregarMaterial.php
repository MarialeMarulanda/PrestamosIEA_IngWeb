<?php
session_start();
if (@!$_SESSION['user']) {
    header("Location:index.php");
}elseif ($_SESSION['rol']==2) {
    header("Location:iniciouser.php");
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
            <h1 class="text-center">Agregar Nuevo Material</h1>
        </div>
        <form method="POST" action="agregandoMaterial.php" class="form-horizontal">
            <div class="form-group">
                <label for="id" class="col-sm-2 control-label">ID:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="id" name="id" placeholder="ID del material" required>
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del material" required>
                </div>
            </div>
            <div class="form-group">
                <label for="tipo" class="col-sm-2 control-label">Tipo:</label>
                <div class="col-sm-5">
                    <select class="form-control" id="tipo" name="tipo" required>
                        <option value="equipo">Equipo</option>
                        <option value="componente">Componente</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="cantidad" class="col-sm-2 control-label">Cantidad:</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad disponible" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                    <button type="submit" class="btn btn-primary">Agregar Material</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
