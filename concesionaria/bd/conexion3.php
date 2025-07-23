<?php
$conexion = new mysqli("localhost","root","","onix");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recuperar datos del formulario
$no_serie = $_POST['no_serie'];
$marca= $_POST['marca'];
$modelo = $_POST['modelo'];
$ano= $_POST['ano'];
$precio = $_POST['precio'] ;
$accion = $_POST['accion'] ;



switch ($accion) {
    case 'agregar':
        $sql = "INSERT INTO vehiculo (No_Serie,Marca, Modelo, Ano, Precio) 
                VALUES ('$no_serie', '$marca', '$modelo', '$ano', '$precio')";
        if ($conexion->query($sql) === TRUE) {
            echo "Vehiculo agregado correctamente.";
        } else {
            echo "Error al registrar: " . $conexion->error;
        }
        break;

    case 'actualizar':
        $sql = "UPDATE vehiculo SET Marca='$marca', Modelo='$modelo', Ano='$ano', Precio='$precio' 
                WHERE No_Serie='$no_serie'";
        if ($conexion->query($sql) === TRUE) {
            echo "Vehiculo modificado correctamente.";
        } else {
            echo "Error al modificar: " . $conexion->error;
        }
        break;
    default:
        echo "Acción no válida.";
}
$conexion->close();
?>