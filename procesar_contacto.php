<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$dbname = 'registros_portafolio';
$username = 'root';
$password = '';

// Crear una nueva conexión con MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener los datos enviados desde el formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$tema = $_POST['tema'];
$mensaje = $_POST['mensaje'];

// Consulta SQL para insertar los datos en la tabla "contacto"
$sql = "INSERT INTO contacto (nombre, telefono, correo, tema, mensaje) 
        VALUES (?, ?, ?, ?, ?)";

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Verificar si la consulta fue preparada correctamente
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Enlazar los parámetros a la consulta
$stmt->bind_param("sssss", $nombre, $telefono, $correo, $tema, $mensaje);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Redirigir a una página de éxito o mostrar un mensaje
    echo "Mensaje enviado con éxito";
} else {
    echo "Error al enviar el mensaje: " . $stmt->error;
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();
?>

