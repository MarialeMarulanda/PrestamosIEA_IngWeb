<?php
session_start();
include("conexion.php");

// Obtener el ID del préstamo desde la URL
if (isset($_GET['id'])) {
    $id_prestamo = $_GET['id'];

    // Obtener información del préstamo para actualizar el catálogo
    $query_prestamo = "SELECT id_material, cantidad FROM prestamos WHERE id = $id_prestamo";
    $result_prestamo = $mysqli->query($query_prestamo);

    if ($result_prestamo) {
        $prestamo = $result_prestamo->fetch_assoc();
        $id_material = $prestamo['id_material'];
        $cantidad_devuelta = $prestamo['cantidad'];

        // Actualizar el estatus del préstamo a 'entregado'
        $query_update_prestamo = "UPDATE prestamos SET estatus = 'entregado' WHERE id = $id_prestamo";

        // Actualizar la cantidad disponible en el catálogo
        $query_update_catalogo = "UPDATE catalogo SET disponibles = disponibles + $cantidad_devuelta WHERE ID = $id_material";

        // Ejecutar las consultas en una transacción
        $mysqli->autocommit(FALSE);

        $error = false;

        if (!$mysqli->query($query_update_prestamo)) {
            $error = true;
        }

        if (!$mysqli->query($query_update_catalogo)) {
            $error = true;
        }

        if ($error) {
            $mysqli->rollback();
            echo "Error al actualizar el estatus del préstamo y/o la disponibilidad del material.";
        } else {
            $mysqli->commit();
            // Redireccionar de vuelta a la página de préstamos después de actualizar
            header("Location: prestamos.php");
            exit();
        }
    } else {
        echo "Error al obtener información del préstamo: " . $mysqli->error;
    }
} else {
    echo "ID de préstamo no especificado.";
}

// Cerrar la conexión
$mysqli->close();
?>
