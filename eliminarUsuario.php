<?php
session_start();
require_once("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realiza la consulta para eliminar el usuario
    $sql = "DELETE FROM login WHERE id = $id";

    if (mysqli_query($mysqli, $sql)) {
        $_SESSION['message'] = 'Usuario eliminado correctamente';
    } else {
        $_SESSION['message'] = 'Error al eliminar el usuario: ' . mysqli_error($mysqli);
    }
}

header('Location: registros.php');
exit();
?>
