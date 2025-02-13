<?php
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $pais = $_POST['country'];
    $telefono = $_POST['Telefono'];
    $tipoUsuario = $_POST['user-type'];

    if ($tipoUsuario === 'buscador') {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            mostrarAlerta('Error', 'El correo ya está registrado como usuario.', 'error', false);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_completo, email, contraseña, pais, telefono) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $password, $pais, $telefono]);

        mostrarAlerta('¡Registro Exitoso!', 'Usuario registrado con éxito.', 'success', true);

    } elseif ($tipoUsuario === 'empleador') {
        $cuit = $_POST['cuit'];
        $identificadorEmpresa = $_POST['business-id'];

        $stmt = $pdo->prepare("SELECT id FROM empresas WHERE email = ? OR cuit = ?");
        $stmt->execute([$email, $cuit]);

        if ($stmt->rowCount() > 0) {
            mostrarAlerta('Error', 'El correo o CUIT ya están registrados como empresa.', 'error', false);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO empresas (nombre_completo, email, contraseña, pais, telefono, cuit, identificador_empresa) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $password, $pais, $telefono, $cuit, $identificadorEmpresa]);

        $empresaId = $pdo->lastInsertId();

        if (!empty($_POST['branch-country']) && !empty($_POST['branch-city'])) {
            $paisesSedes = $_POST['branch-country'];
            $ciudadesSedes = $_POST['branch-city'];

            $stmt = $pdo->prepare("INSERT INTO sedes (empresa_id, pais, ciudad) VALUES (?, ?, ?)");

            for ($i = 0; $i < count($paisesSedes); $i++) {
                $stmt->execute([$empresaId, $paisesSedes[$i], $ciudadesSedes[$i]]);
            }
        }

        mostrarAlerta('¡Registro Exitoso!', 'Empresa registrada con éxito.', 'success', true);
    } else {
        mostrarAlerta('Error', 'Tipo de usuario no válido.', 'error', false);
    }
} else {
    mostrarAlerta('Acceso Denegado', 'Acceso no autorizado.', 'error', false);
}

// Función para mostrar la alerta y redirigir o recargar según corresponda
function mostrarAlerta($titulo, $mensaje, $icono, $redirigir) {
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$titulo</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: '$titulo',
                text: '$mensaje',
                icon: '$icono',
                confirmButtonText: 'Aceptar',
                timer: 5000,
                timerProgressBar: true
            }).then((result) => {
                // Si es un éxito, redirige al index
                ".($redirigir ? "window.location.href = '/WorkOnline/index.php';" : "")."
            });

            // Si no es un éxito, recarga la página después de que termine el temporizador
            ".(!$redirigir ? "
            setTimeout(() => {
                window.location.href = '/WorkOnline/templates/gestorSesion/Registro_Usuario.php';;
            }, 5000);" : "")."
        </script>
    </body>
    </html>
    ";
}
?>
