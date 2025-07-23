<?php
$conexion = new mysqli("localhost","root","","onix");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recuperar datos del formulario
$rfc = $_POST['rfc'];
$nombre= $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion= $_POST['direccion'];
$accion = $_POST['accion'] ;


switch ($accion) {
    case 'registrar':
        $sql = "INSERT INTO cliente (RFC, Nombre, Telefono, Direccion) 
                VALUES ('$rfc', '$nombre', '$telefono', '$direccion')";
        if ($conexion->query($sql) === TRUE) {
            echo "Cliente agregado correctamente.";
        } else {
            echo "Error al registrar: " . $conexion->error;
        }
        break;

    case 'eliminar':
        $sql = "DELETE FROM cliente WHERE RFC = '$rfc'";
        if ($conexion->query($sql) === TRUE) {
            echo "Cliente eliminado correctamente.";
        } else {
            echo "Error al eliminar: " . $conexion->error;
        }
        break;

    case 'modificar':
        $sql = "UPDATE cliente SET Nombre='$nombre', Telefono='$telefono', Direccion='$direccion' 
                WHERE RFC='$rfc'";
        if ($conexion->query($sql) === TRUE) {
            echo "Cliente modificado correctamente.";
        } else {
            echo "Error al modificar: " . $conexion->error;
        }
        break;

    case 'buscar':
        $sql = "SELECT * FROM cliente WHERE RFC = '$rfc'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            echo "Nombre: " . $fila['Nombre'] . "<br>";
            echo "Teléfono: " . $fila['Telefono'] . "<br>";
            echo "Dirección: " . $fila['Direccion'] . "<br>";
        } else {
            echo "Cliente no encontrado.";
        }
        break;

    default:
        echo "Acción no válida.";
}


/* Insertar en la tabla específica
$sql = "INSERT INTO cliente (RFC,Nombre,Telefono,Direccion ) VALUES ('$rfc', '$nombre', '$telefono', '$direccion')";

if ($conexion->query($sql) === TRUE) {
    echo "Cliente agregado correctamente.";
} else {
    echo "Error: " . $conexion->error;
}*/


$conexion->close();
?>