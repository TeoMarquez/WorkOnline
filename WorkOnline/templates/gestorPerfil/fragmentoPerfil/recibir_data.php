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

// Consultar los datos del usuario
$query = "SELECT nombre_completo, email, pais, telefono, direccion, telefono_adicional FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch();

// Consultar el currículum del usuario
$query_cv = "SELECT * FROM curriculums WHERE usuario_id = ?";
$stmt_cv = $pdo->prepare($query_cv);
$stmt_cv->execute([$usuario_id]);
$cv = $stmt_cv->fetch();

// Consultar el historial de trabajos del usuario
$query_historial = "SELECT * FROM historial_trabajos WHERE usuario_id = ?";
$stmt_historial = $pdo->prepare($query_historial);
$stmt_historial->execute([$usuario_id]);
$historial_trabajos = $stmt_historial->fetchAll();

// Consultar las postulaciones del usuario, asegurando que no haya duplicados
$query_postulaciones = "
    SELECT DISTINCT p.id, p.estado, o.titulo_oferta, o.descripcion_oferta, e.nombre_completo AS empresa_nombre, e.telefono AS contacto, s.ciudad AS sede, p.fecha_postulacion 
    FROM postulaciones p 
    JOIN ofertas_empleo o ON p.oferta_empleo_id = o.id 
    JOIN empresas e ON o.empresa_id = e.id
    LEFT JOIN sedes s ON e.id = s.empresa_id
    WHERE p.usuario_id = ?";
    
$stmt_postulaciones = $pdo->prepare($query_postulaciones);
$stmt_postulaciones->execute([$usuario_id]);
$postulaciones = $stmt_postulaciones->fetchAll();


