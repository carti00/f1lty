<?php
$conexion = new mysqli("localhost","root","","onix");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recuperar datos del formulario
$id_venta = $_POST['id_venta'];
$fecha= $_POST['fecha'];
$rfc = $_POST['rfc'];
$pago= $_POST['pago'];
$no_serie= $_POST['no_serie'];
$total = $_POST['total'] ;
$accion = $_POST['accion'] ;


switch ($accion) {
    case 'registrar':
        $sql = "INSERT INTO venta (ID_Venta, Fecha, MetodoPago,RFC,No_Serie,Total) 
                VALUES ('$id_venta', '$fecha', '$pago', '$rfc', '$no_serie', '$total')";
        if ($conexion->query($sql) === TRUE) {
            echo "Venta agregada correctamente.";
        } else {
            echo "Error al registrar: " . $conexion->error;
        }
        break;

    case 'eliminar':
        $sql = "DELETE FROM venta WHERE ID_Venta = '$id_venta'";
        if ($conexion->query($sql) === TRUE) {
            echo "Venta eliminada correctamente.";
        } else {
            echo "Error al eliminar: " . $conexion->error;
        }
        break;

    case 'modificar':
        $sql = "UPDATE venta SET Fecha='$fecha', MetodoPago='$metodopago'
                WHERE ID_Venta='$id_venta'";
                
                
        if ($conexion->query($sql) === TRUE) {
            echo "Venta modificada correctamente.";
        } else {
            echo "Error al modificar: " . $conexion->error;
        }
        break;

    case 'buscar':
        $sql = "SELECT * FROM venta WHERE ID_Venta = '$id_venta'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            echo "Fecha: " . $fila['fecha'] . "<br>";
             echo "MetodoPago: " . $fila['pago'] . "<br>";
            echo "RFC: " . $fila['rfc'] . "<br>";
            echo "No_Serie: " . $fila['no_serie'] . "<br>";
            echo "Total: " . $fila['total'] . "<br>";
        } else {
            echo "Venta no encontrada.";
        }
        break;

    default:
        echo "Acción no válida.";
}



$conexion->close();
?>