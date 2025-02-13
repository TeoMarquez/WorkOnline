<?php
session_start();
require '../../scriptControl/db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si el correo está registrado como usuario o empresa
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // Usuario encontrado
        $user = $stmt->fetch();
        if (password_verify($password, $user['contraseña'])) {
            $_SESSION['user'] = $user;
            header('Location: /WorkOnline/perfil.php');
            exit;
        } else {
            $error_message = "Usuario o Contraseña incorrecta";
        }
    } else {
        // Verificar si es una empresa
        $stmt = $pdo->prepare("SELECT * FROM empresas WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            // Empresa encontrada
            $empresa = $stmt->fetch();
            if (password_verify($password, $empresa['contraseña'])) {
                $_SESSION['empresa'] = $empresa;
                header('Location: /WorkOnline/perfil_empresa.php');
                exit;
            } else {
                $error_message = "Usuario o Contraseña incorrecta";
            }
        } else {
            $error_message = "Correo no registrado";
        }
    }
}
?>
