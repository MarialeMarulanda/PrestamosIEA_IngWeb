<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location:index.php");
}
?>  
<html lang="es">
<head>
    <title>Registrar Administrador</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/icono.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style>
        .biblioteca {
            margin-top: 5px;
            color: white;
            font-size: 35px;
        }
    </style>
</head>
<body>
    <!-- Navbar lateral y contenido omitido por brevedad -->

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Registrar Nuevo Administrador</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="guardar_administrador.php">
                            <div class="form-group">
                                <label for="user">Usuario:</label>
                                <input type="text" class="form-control" id="user" name="user" placeholder="Nombre de usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <a href="admin.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer y otros elementos omitidos por brevedad -->
</body>
</html>
