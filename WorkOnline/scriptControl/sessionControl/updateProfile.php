<?php
// Iniciar sesión
session_start();

// Asegurarse de que el usuario esté logueado
if (!isset($_SESSION['user'])) {
    header('Location: /WorkOnline/login.php');
    exit();
}

// Conectar a la base de datos
include '../../scriptControl/db/db.php';

// Obtener el ID del usuario desde la sesión
$usuario_id = $_SESSION['user']['id']; // Acceder al ID del usuario

// Obtener los datos del formulario
$nombre_completo = $_POST['nombre_completo'];
$email = $_POST['email'];
$pais = $_POST['pais'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$telefono_adicional = $_POST['telefono_adicional'];

// Actualizar los datos en la base de datos
$query = "UPDATE usuarios SET nombre_completo = ?, pais = ?, telefono = ?, direccion = ?, telefono_adicional = ? WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$nombre_completo, $pais, $telefono, $direccion, $telefono_adicional, $usuario_id]);

// Redirigir a la página de perfil o mostrar un mensaje de éxito
header('Location: /workOnline/templates/gestorPerfil/Perfil.php'); // O puedes redirigir a otra página si lo deseas
exit();
?>
