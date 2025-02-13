<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /WorkOnline/login.php');
    exit();
}

include '../../scriptControl/db/db.php';
$usuario_id = $_SESSION['user']['id'];

// Obtener los datos del formulario
$titulo_cv = $_POST['titulo_cv'];
$descripcion = $_POST['descripcion'];
$experiencia_laboral = json_encode(explode("\n", $_POST['experiencia_laboral']));
$habilidades = json_encode(explode("\n", $_POST['habilidades']));
$educacion = json_encode(explode("\n", $_POST['educacion']));

// Si el usuario ya tiene un CV, actualizarlo
$query = "SELECT * FROM curriculums WHERE usuario_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$usuario_id]);
$cv = $stmt->fetch();

if ($cv) {
    // Actualizar
    $query = "UPDATE curriculums SET titulo_cv = ?, descripcion = ?, experiencia_laboral = ?, habilidades = ?, educacion = ?, fecha_actualizacion = CURRENT_TIMESTAMP WHERE usuario_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$titulo_cv, $descripcion, $experiencia_laboral, $habilidades, $educacion, $usuario_id]);
} else {
    // Insertar
    $query = "INSERT INTO curriculums (usuario_id, titulo_cv, descripcion, experiencia_laboral, habilidades, educacion, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$usuario_id, $titulo_cv, $descripcion, $experiencia_laboral, $habilidades, $educacion]);
}

echo json_encode(['success' => true]);
header('Location: /WorkOnline/templates/gestorPerfil/Perfil.php');
?>
