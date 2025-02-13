<?php
session_start();
require '../../scriptControl/db/db.php';

$error_message = ''; // Iniciar variable para errores

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
            header('Location: /WorkOnline/templates/gestorPerfil/Perfil.php');
            exit;
        } else {
            $error_message = "Contraseña incorrecta";
        }
    } else {
        // Verificar si es una empresa
        $stmt = $pdo->prepare("SELECT * FROM empresas WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            // Empresa encontrada
            $empresa = $stmt->fetch();
            if (password_verify($password, $empresa['contraseña'])) {
                $_SESSION['empresa'] = [
                    'id' => $empresa['id'],
                    'nombre_completo' => $empresa['nombre_completo'],
                    'email' => $empresa['email'],
                    'pais' => $empresa['pais'],
                    'telefono' => $empresa['telefono'],
                    'cuit' => $empresa['cuit'],
                    'identificador_empresa' => $empresa['identificador_empresa'],
                ];
                header('Location: /WorkOnline/templates/gestorPerfil/Perfiles_Empresa.php');
                exit;
            }
        } else {
            $error_message = "Correo no registrado";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - WorkOnline</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<style>
    /* Estilos para el formulario */
    *{
        max-height:78vh !important;
    }
    body{
        overflow: hidden;
    }
    #login {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f7f7f7; /* Gris suave casi blanco */
    }

    .container {
        width: 100%;
        max-width: 500px; /* Limitar el tamaño máximo del contenedor */
        height:50%; 
        background-color: rgb(243, 236, 236);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 8px 6px rgba(0, 0, 0, 0.12);
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    #login label {
        display: block;
        margin: 12px 0 6px;
        font-weight: 600;
        color: #333;
    }

    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 18px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 16px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease-in-out;
    }

    input:focus {
        border-color: #007BFF;
        background-color: #fff;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    #login p {
        margin-top: 18px;
        font-size: 14px;
    }

    #login a {
        color: #007BFF;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Filtro de carga */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .loading-overlay.active {
        display: flex;
    }

    .loader {
        border: 6px solid #f3f3f3;
        border-top: 6px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Estilos para las alertas de error */
    .alert {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
</style>

<body>
    <?php include '../fragmento/header.php'; ?>

    <div class="loading-overlay" id="loading-overlay">
        <div class="loader"></div>
    </div>

    <section id="login" class="login">
        <div class="container">
            <h2>Iniciar Sesión</h2>
            
            <?php if ($error_message): ?>
                <!-- Alerta de error con Tailwind -->
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Parece que algo ha pasado!</strong>
                    <span class="block sm:inline"><?php echo $error_message; ?></span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <!-- Icono de cerrar si se quiere agregar -->
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-11a1 1 0 011.414 0L10 8.586l1.293-1.293a1 1 0 111.414 1.414L11.414 10l1.293 1.293a1 1 0 01-1.414 1.414L10 11.414l-1.293 1.293a1 1 0 01-1.414-1.414L8.586 10l-1.293-1.293a1 1 0 011.414-1.414L9 8.586l-1.293-1.293a1 1 0 011.293-1.707z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            <?php endif; ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="showLoading()">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required placeholder="Ingresá tu Gmail">
                
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required placeholder="********">
                
                <button type="submit">Iniciar Sesión</button>
            </form>

            <p>¿No tienes cuenta? <a href="/WorkOnline/templates/gestorSesion/Registro_Usuario.php">Regístrate aquí</a></p>
        </div>
    </section>

    <?php include '../fragmento/footer.php'; ?>
    
    <script>
        function showLoading() {
            document.getElementById('loading-overlay').classList.add('active');
        }
    </script>
</body>
</html>
