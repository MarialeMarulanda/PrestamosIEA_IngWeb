<?php
session_start();
include("conexion.php");

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$cantidad = $_POST['cantidad'];
$disponibles = $cantidad; // Por defecto, disponibles es igual a cantidad al inicio
$id = isset($_POST['id']) ? $_POST['id'] : null; // ID puede ser opcional

// Preparar la consulta SQL
if (!empty($id)) {
    // Si se ingresó manualmente un ID
    $query = "INSERT INTO catalogo (ID, nombre, tipo, cantidad, disponibles) VALUES ('$id', '$nombre', '$tipo', $cantidad, $disponibles)";
} else {
    // Si no se ingresó manualmente un ID, dejar que la base de datos lo genere automáticamente
    $query = "INSERT INTO catalogo (nombre, tipo, cantidad, disponibles) VALUES ('$nombre', '$tipo', $cantidad, $disponibles)";
}

// Ejecutar la consulta
if ($mysqli->query($query) === TRUE) {
    // Éxito en la inserción
    echo "<script>alert('Material agregado correctamente');</script>";
    header("Location: catalogo.php"); // Redirigir a la página del catálogo
    exit();
} else {
    // Error en la inserción
    echo "<script>alert('Error al agregar material: " . $mysqli->error . "');</script>";
    header("Location: catalogo.php"); // Redirigir a la página del catálogo
    exit();
}

// Cerrar la conexión
$mysqli->close();
?>
