<?php
session_start();
require_once("conexion.php");

$user = $_POST['user'];
$pass = $_POST['pass']; // Se podría encriptar contraseña
$email = $_POST['email'];
$rol = $_POST['rol']; 


$sql = "INSERT INTO login (user, pasadmin, email, rol) VALUES ('$user', '$pass', '$email', '$rol')";

if (mysqli_query($mysqli, $sql)) {
    $_SESSION['message'] = 'Administrador registrado correctamente';
} else {
    $_SESSION['message'] = 'Error al registrar el administrador: ' . mysqli_error($mysqli);
}

header('Location: registros.php');
exit();
?>
