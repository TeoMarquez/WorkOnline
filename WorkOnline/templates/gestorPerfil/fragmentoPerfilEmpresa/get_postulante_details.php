<?php
require '../../../scriptControl/db/db.php';

// Verificar que se haya recibido el ID de la postulación
if (!isset($_GET['postulacionId'])) {
    echo json_encode(['error' => 'Faltan parámetros necesarios']);
    exit;
}

$postulacionId = $_GET['postulacionId'];

// Consulta SQL para obtener los detalles del postulante y su currículum, usando solo la ID de la postulación
$stmt = $pdo->prepare("
    SELECT u.id AS usuario_id, u.nombre_completo, u.email, u.pais, u.telefono, 
           c.titulo_cv, c.descripcion, c.experiencia_laboral, c.educacion, c.habilidades
    FROM postulaciones p
    JOIN usuarios u ON p.usuario_id = u.id
    LEFT JOIN curriculums c ON u.id = c.usuario_id
    WHERE p.id = ?
");
$stmt->execute([$postulacionId]);

$postulacionDetalles = $stmt->fetch();

if ($postulacionDetalles) {
    // Convertir los campos JSON (experiencia_laboral, educacion, habilidades) en arrays
    $postulacionDetalles['experiencia_laboral'] = json_decode($postulacionDetalles['experiencia_laboral']);
    $postulacionDetalles['educacion'] = json_decode($postulacionDetalles['educacion']);
    $postulacionDetalles['habilidades'] = json_decode($postulacionDetalles['habilidades']);
    
    // Devolver la información como JSON
    echo json_encode($postulacionDetalles);
} else {
    // Si no se encuentran datos
    echo json_encode(['error' => 'No se encontraron detalles para esta postulación']);
}
?>
