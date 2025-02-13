<header>
    <div class="header-container">
        <h1>WorkOnline</h1>
        <nav>
            <ul class="flex space-x-8 justify-center">
                <li><a href="/WorkOnline" class="text-white hover:text-green-400 transition-colors">Inicio</a></li>
                <li><a href="/WorkOnline/Templates/busqueda/Novedades.php" class="text-white hover:text-green-400 transition-colors">Novedades</a></li>
                <li><a href="/WorkOnline/Templates/moreInfo/Faq.php" class="text-white hover:text-green-400 transition-colors">FAQ</a></li>
                <li><a href="/WorkOnline/Templates/moreInfo/Contacto.php" class="text-white hover:text-green-400 transition-colors">Acerca de nosotros</a></li>
                <li><a href="javascript:void(0);" onclick="toggleSidebar()" class="text-white hover:text-green-400 transition-colors">Mi Perfil</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Sidebar de perfil -->
<div id="sidebar" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-end items-start pt-16 z-50" hidden>
    <div id="sidebar-space" class="bg-white w-64 p-6 h-full">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Mi Perfil</h2>
            <span id="close-sidebar" onclick="toggleSidebar()" class="cursor-pointer text-2xl">×</span>
        </div>

        <!-- Información del usuario (basado en la sesión) -->
        <div id="profile-info" class="mt-4 mb-6"></div>

        <!-- Opciones de perfil -->
        <div id="sidebar-options">
            <ul class="space-y-4">
                <li><a class='linksPerfil' href="/perfil">Ver Perfil</a></li>
                <li><a class='links' href="javascript:void(0);" onclick="logout()">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</div>

<script>
    // Función para alternar el sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const sessionInfo = document.getElementById('profile-info');
        const sidebarOptions = document.getElementById('sidebar-options');

        // Obtener el nombre del usuario desde la sesión PHP
        const userName = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Invitado'; ?>"; // Si no hay sesión, muestra 'Invitado'

        if (userName !== 'Invitado') {
            sessionInfo.innerHTML = `<p>Bienvenido, <strong>${userName}</strong>.</p>`;
            sidebarOptions.innerHTML = ` 
                <ul class="space-y-4">
                    <li><a href="/WorkOnline/Templates/gestorPerfil/Perfil.php" class="linksPerfil">Ver Perfil</a></li>
                    <li><a href="javascript:void(0);" onclick="logout()" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-colors font-semibold">Cerrar sesión</a></li>
                </ul>
            `;
        } else {
            sessionInfo.innerHTML = ` 
                <button class='linksPerfil'  onclick="window.location.href='/WorkOnline/Templates/gestorSesion/Inicio_Sesion.php'" >Iniciar sesión</button>
                <button class='linksRegistrarse' onclick="window.location.href='/WorkOnline/Templates/gestorSesion/Registro_Usuario.php'">Registrarse</button>
            `;
            sidebarOptions.innerHTML = '';
        }

        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('flex');
    }

    // Función de cierre de sesión
    function logout() {
        // Redirigir a un script PHP para cerrar sesión
        window.location.href = '/logout.php';
    }
</script>


<style>
    /* Reset de estilos básicos */
    body, h1, nav, ul, li, a {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
    }

    /* Contenedor principal */
    header {
        background-color: #1a1a1a;
        color: white;
        padding: 20px 0;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Contenedor de la página */
    .header-container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Estilo del título */
    .header-container h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    /* Estilo del menú de navegación */
    .header-container nav ul {
        list-style-type: none;
        display: flex;
        justify-content: center;
        gap: 25px;
    }

    .header-container nav ul li {
        display: inline-block;
    }

    .header-container nav ul li a {
        color: white;
        text-decoration: none;
        font-size: 1.1rem;
        border-radius: 5px;
        padding: 8px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Efecto hover */
    .header-container nav ul li a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #34D399; /* Verde al pasar el mouse */
    }

    /* Estilo de los botones de iniciar sesión y registrarse */
    .header-container nav ul li a:active {
        transform: scale(0.98);
    }

    #sidebar-space {
        width: 35%;
        height: 100vh;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
    }

    .linksPerfil {
        display: block;
        width: 80%; /* 80% del ancho del contenedor */
        margin: 10px auto; /* Centra el botón y agrega separación */
        padding: 12px;
        color: white;
        background-color: green;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .linksPerfil:hover {
        background-color: #1a202c;
    }

    .linksPerfil:active {
        background-color: #e2e8f0;
        transform: scale(0.98);
    }

    .linksRegistrarse {
        display: block;
        width: 80%; /* 80% del ancho del contenedor */
        margin: 10px auto; /* Centra el botón y agrega separación */
        padding: 12px;
        color: black;
        background-color: cyan;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .linksRegistrarse:hover {
        background-color: #1a202c;
    }

    .linksRegistrarse:active {
        background-color: #e2e8f0;
        transform: scale(0.98);
    }

</style>