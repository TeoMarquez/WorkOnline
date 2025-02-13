<?php
session_start();
require '../../scriptControl/db/db.php';

if (!isset($_SESSION['empresa'])) {
    header('Location: /WorkOnline/templates/login.php');
    exit;
}

// Obtener los datos de la empresa desde la sesión
$empresa = $_SESSION['empresa'];

// Consultar las sedes de la empresa
$stmt = $pdo->prepare("SELECT id, pais, ciudad FROM sedes WHERE empresa_id = ?");
$stmt->execute([$empresa['id']]);
$sedes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Empresa - WorkOnline</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <style>
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .container-empresa section {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
   
    </style>

    <?php include '../fragmento/header.php'; ?>

    <main class="container-empresa">
    
        <?php include './fragmentoPerfilEmpresa/infoEmpresa.php'; ?>

        <?php include './fragmentoPerfilEmpresa/infoSede.php'; ?>

        <?php include './fragmentoPerfilEmpresa/infoOfertas.php'; ?>

        <?php include './fragmentoPerfilEmpresa/postulaciones.php'; ?>

    </main>


    <?php include '../fragmento/footer.php'; ?>

</body>
</html>
