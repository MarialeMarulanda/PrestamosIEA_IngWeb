<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['materiales'])) {
    include("conexion.php");

    $usuario_id = $_SESSION['id'];
    $materiales = $_POST['materiales'];
    $cantidades = $_POST['cantidad']; // Array con las cantidades solicitadas
    $fecha_prestamo = date("Y-m-d H:i:s");
    $estatus = 'vigente'; // Puedes cambiar esto según tu lógica de negocio

    $prestamos = [];

    foreach ($materiales as $id_material) {
        $cantidad_solicitada = $cantidades[$id_material];

        // Insertar en la tabla prestamos
        $stmt = $mysqli->prepare("INSERT INTO prestamos (id_usuario, id_material, cantidad, fecha_prestamo, estatus) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $usuario_id, $id_material, $cantidad_solicitada, $fecha_prestamo, $estatus);
        $stmt->execute();
        
        // Actualizar cantidad disponible en la tabla catalogo
        $stmt = $mysqli->prepare("UPDATE catalogo SET disponibles = disponibles - ? WHERE ID = ? AND disponibles >= ?");
        $stmt->bind_param("iii", $cantidad_solicitada, $id_material, $cantidad_solicitada);
        $stmt->execute();

        // Guardar detalles del préstamo para mostrar en el resumen
        $stmt = $mysqli->prepare("SELECT nombre FROM catalogo WHERE ID = ?");
        $stmt->bind_param("i", $id_material);
        $stmt->execute();
        $result = $stmt->get_result();
        $material = $result->fetch_assoc();
        
        $prestamos[] = [
            'nombre' => $material['nombre'],
            'cantidad' => $cantidad_solicitada
        ];
    }

    // Guardar los préstamos en la sesión para mostrarlos en el resumen
    $_SESSION['prestamos'] = $prestamos;

    // Redirigir a la página de resumen o éxito
    header("Location: resumenPrestamo.php");
    exit();
} else {
    header("Location: soliPrestamo.php");
    exit();
}
?>
