<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkOnline Oficial</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/@mui/material@5.0.0-alpha.35/dist/material-ui.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <?php include 'templates/fragmento/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-img text-center py-32 bg-blue-500 text-white" data-aos="fade-up">
        <h1 class="text-4xl font-bold">Bienvenido a WorkOnline</h1>
        <p class="mt-4 text-lg">Conéctate con las mejores oportunidades de empleo en diversas industrias</p>
    </section>

    <!-- Carrusel de imágenes -->
    <section class="py-16" data-aos="fade-up">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Explora nuestras oportunidades</h2>
            <div class="relative">
                <!-- Contenedor de las imágenes del carrusel -->
                <div class="carousel-inner relative overflow-hidden w-full">
                    <div class="carousel-item w-full hidden">
                        <img src="/workOnline/imgResources/landingPage/Carrousel/carrousel1.jpg" alt="Oportunidades de empleo 1" class="w-full h-64 object-cover">
                    </div>
                    <div class="carousel-item w-full hidden">
                        <img src="/workOnline/imgResources/landingPage/Carrousel/carrousel2.jpg" alt="Oportunidades de empleo 2" class="w-full h-64 object-cover">
                    </div>
                    <div class="carousel-item w-full hidden">
                        <img src="/workOnline/imgResources/landingPage/Carrousel/carrousel3.jpg" alt="Oportunidades de empleo 3" class="w-full h-64 object-cover">
                    </div>
                </div>

                <!-- Botones de navegación -->
                <button class="absolute top-1/2 left-0 bg-gray-800 text-white p-2" id="prevButton">
                    <span class="material-icons">chevron_left</span>
                </button>
                <button class="absolute top-1/2 right-0 bg-gray-800 text-white p-2" id="nextButton">
                    <span class="material-icons">chevron_right</span>
                </button>
            </div>
        </div>

        <style>
            /* Estilos generales para el carrusel */
            .carousel-inner {
                position: relative;
            }
            .carousel-item {
                opacity: 1;
                transition: opacity 0.5s ease-in-out;
            }
            .carousel-item.active {
                opacity: 0;
            }

            /* Estilos de los botones */
            .carousel-control-prev, .carousel-control-next {
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                padding: 10px;
                border-radius: 50%;
                cursor: pointer;
            }

            /* Estilo adicional de la imagen */
            .carousel-item img {
                max-height: 400px; /* Puedes ajustar la altura a tus necesidades */
                height:700px;
                width: 100%;
                object-fit: cover;
                width: 100%;
            }
        </style>
    </section>

    <!-- Más Información Promocional -->
    <section class="bg-blue-500 text-white py-16" data-aos="fade-up">
        <div class="container mx-auto flex items-center justify-between">
            <div class="w-1/2">
                <h2 class="text-3xl font-bold">Únete a la Red de Profesionales</h2>
                <p class="mt-4">Descubre oportunidades laborales únicas y haz crecer tu carrera con las mejores empresas. Regístrate hoy mismo y comienza tu búsqueda.</p>
            </div>
            <div class="w-1/2">
                <img src="/workOnline/imgResources/landingPage/PromotionalImages/interview.webp" alt="Imagen promocional" class="w-full h-auto rounded-lg">
            </div>
        </div>
    </section>

    <!-- Servicios / Características -->
    <section class="py-16" data-aos="fade-up">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold">Lo que ofrecemos</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <i class="material-icons text-blue-500 text-4xl">search</i>
                    <h3 class="mt-4 text-xl font-semibold">Búsqueda Avanzada</h3>
                    <p class="mt-2">Encuentra el trabajo perfecto filtrando por categoría, ubicación, salario y más.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <i class="material-icons text-blue-500 text-4xl">work</i>
                    <h3 class="mt-4 text-xl font-semibold">Oportunidades de Crecimiento</h3>
                    <p class="mt-2">Desarrolla tu carrera con las mejores empresas y ofertas laborales.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <i class="material-icons text-blue-500 text-4xl">group</i>
                    <h3 class="mt-4 text-xl font-semibold">Red de Conexiones</h3>
                    <p class="mt-2">Conecta con empresas y otros profesionales a través de nuestra plataforma.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section id="testimonios" class="py-16 bg-gray-200" data-aos="fade-up">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold">Lo que dicen nuestros usuarios</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="/workOnline/imgResources/landingPage/Users/userMasc1.jpg" alt="User 1" class="w-24 h-24 rounded-full mx-auto">
                    <p class="mt-4 font-semibold">Juan Pérez</p>
                    <p>"WorkOnline me ayudó a encontrar el trabajo de mis sueños. La plataforma es fácil de usar y tiene excelentes opciones."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="/workOnline/imgResources/landingPage/Users/userFem1.jpg" alt="User 2" class="w-24 h-24 rounded-full mx-auto">
                    <p class="mt-4 font-semibold">Ana García</p>
                    <p>"Gracias a WorkOnline, encontré el empleo freelance que necesitaba. Es una plataforma confiable y eficiente."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <img src="/workOnline/imgResources/landingPage/Users/userMasc2.jpg" alt="User 3" class="w-24 h-24 rounded-full mx-auto">
                    <p class="mt-4 font-semibold">Carlos López</p>
                    <p>"Una de las mejores plataformas para buscar trabajos en tecnología. Estoy muy satisfecho con mi experiencia."</p>
                </div>
            </div>
        </div>
        <style>
            #testimonios img{

            }
        </style>
    </section>

    <!-- Formulario de Búsqueda de Empleo -->
    <section id="home" class="welcome py-16" data-aos="fade-up">
        <div class="container mx-auto text-center">
            <h3 class="text-xl font-bold">Busca empleo de manera avanzada</h3>
            <form action="./Templates/busqueda/BusquedaEmpleo.php" method="GET" class="mt-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="rol" class="block text-left font-medium">Rol</label>
                        <input type="text" id="rol" name="rol" placeholder="Ej. Desarrollador, Diseñador" class="w-full p-3 border rounded-lg">
                    </div>
                    <div>
                        <label for="ubicacion" class="block text-left font-medium">Ubicación</label>
                        <input type="text" id="ubicacion" name="ubicacion" placeholder="Ciudad o provincia" class="w-full p-3 border rounded-lg">
                    </div>
                    <div>
                        <label for="tipo" class="block text-left font-medium">Tipo de trabajo</label>
                        <select id="tipo" name="tipo" class="w-full p-3 border rounded-lg">
                            <option value="">Seleccionar tipo</option>
                            <option value="hibrido">Híbrido</option>
                            <option value="presencial">Presencial</option>
                            <option value="virtual">Virtual</option>
                        </select>
                    </div>
                    <div>
                        <label for="sueldo" class="block text-left font-medium">Salario estimado (mínimo)</label>
                        <input type="number" id="sueldo" name="sueldo" placeholder="0000" min="0" class="w-full p-3 border rounded-lg">
                    </div>
                    <div>
                        <label for="fecha" class="block text-left font-medium">Fecha de publicación (recientes primero)</label>
                        <input type="date" id="fecha" name="fecha" class="w-full p-3 border rounded-lg">
                    </div>
                </div>
                <button type="submit" class="mt-6 bg-blue-500 text-white py-3 px-6 rounded-lg">Buscar</button>
            </form>
        </div>
    </section>


    <?php include 'templates/fragmento/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script> AOS.init(); </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const items = document.querySelectorAll('.carousel-item');
            let currentIndex = 0;

            function showItem(index) {
                // Ocultar todas las imágenes
                items.forEach(item => item.classList.add('hidden'));
                // Mostrar la imagen actual
                items[index].classList.remove('hidden');
            }

            prevButton.addEventListener('click', function() {
                currentIndex = (currentIndex === 0) ? items.length - 1 : currentIndex - 1;
                showItem(currentIndex);
            });

            nextButton.addEventListener('click', function() {
                currentIndex = (currentIndex === items.length - 1) ? 0 : currentIndex + 1;
                showItem(currentIndex);
            });

            // Mostrar la primera imagen al cargar la página
            showItem(currentIndex);

            // Carrusel auto-desplazable
            setInterval(function() {
                nextButton.click();
            }, 5000); // Cambia la imagen cada 5 segundos
        });
    </script>

</body>
</html>
