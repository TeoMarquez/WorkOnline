<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkOnline - Conectamos Talento con Oportunidades</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<?php include '../fragmento/header.php'; ?>
<body class="bg-gray-50">

    <!-- Sección de Introducción -->
    <section class="py-20 bg-blue-600 text-white text-center" data-aos="fade-up">
        <h1 class="text-5xl font-bold">WorkOnline</h1>
        <p class="text-xl mt-4">Conectamos talento con oportunidades de trabajo en un solo lugar</p>
    </section>

    <!-- Sección: Historia de la Empresa -->
    <section id="about" class="py-16 bg-gray-50">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-blue-600">Nuestra Historia</h2>
            <p class="text-lg text-gray-500 mt-4">Somos más que una plataforma de empleo, somos tu socio en la búsqueda de oportunidades.</p>
        </div>

        <!-- Quiénes Somos -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12">
                <div class="space-y-4" data-aos="fade-up">
                    <h3 class="text-2xl font-semibold text-blue-600">¿Quiénes Somos?</h3>
                    <p class="text-lg text-gray-700">En WorkOnline, nos dedicamos a simplificar el proceso de búsqueda de empleo para miles de personas, ayudando tanto a empresas como a empleados a conectarse de manera rápida y eficaz. Fundada en 2022, nuestra misión es proporcionar una plataforma unificada que reduzca las barreras entre el talento y las oportunidades laborales.</p>
                </div>
                <div class="flex justify-center items-center" data-aos="fade-left">
                    <img src="/WorkOnline/imgResources/about/weWork.jpg" alt="Imagen sobre nosotros" class="rounded-lg shadow-xl w-full max-w-md"/>
                </div>
            </div>
        </div>

        <!-- Visión y Misión -->
        <div class="bg-blue-100 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12">
                    <!-- Visión -->
                    <div class="space-y-4" data-aos="fade-up">
                        <h3 class="text-2xl font-semibold text-blue-600">Nuestra Visión</h3>
                        <p class="text-lg text-gray-700">Ser la plataforma líder en la conexión entre empresas y trabajadores, facilitando un mercado laboral más justo, transparente y accesible para todos. Nuestra visión es crear un futuro en el que la búsqueda de empleo sea rápida, intuitiva y sin barreras.</p>
                    </div>

                    <!-- Misión -->
                    <div class="space-y-4" data-aos="fade-up">
                        <h3 class="text-2xl font-semibold text-blue-600">Nuestra Misión</h3>
                        <p class="text-lg text-gray-700">Conectar de forma eficiente a empleadores y empleados a través de una plataforma digital que simplifique la búsqueda y publicación de vacantes, brindando un servicio ágil, intuitivo y accesible para todas las partes involucradas.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historia -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12" data-aos="fade-up">
                <h3 class="text-2xl font-semibold text-blue-600">Nuestra Historia</h3>
                <p class="text-lg text-gray-700">WorkOnline nació con la idea de cambiar la manera en que los profesionales y las empresas se conectan. En 2022, un grupo de emprendedores decidió crear una plataforma digital donde tanto las pequeñas empresas como los grandes corporativos pudieran acceder a una comunidad de talentos diversa y accesible.</p>
                <p class="text-lg text-gray-700 mt-4">Hoy en día, WorkOnline es una plataforma confiable utilizada por miles de personas para publicar vacantes, buscar oportunidades y gestionar perfiles de empleo, todo en un solo lugar. Nuestro compromiso es seguir innovando para hacer el proceso de búsqueda de empleo más eficiente y humano.</p>
            </div>
        </div>

        <!-- Contacto y Ubicación -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" data-aos="fade-up">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Información de contacto -->
                <div class="space-y-4">
                    <h3 class="text-2xl font-semibold text-blue-600">Contacto</h3>
                    <p class="text-lg text-gray-700">¿Tienes preguntas o necesitas más información? ¡Estamos aquí para ayudarte!</p>
                    <ul class="space-y-2">
                        <li class="text-lg text-gray-700"><strong>Email:</strong> contacto@workonline.com</li>
                        <li class="text-lg text-gray-700"><strong>Teléfono:</strong> +54 387 577 6260</li>
                        <li class="text-lg text-gray-700"><strong>Horario:</strong> Lunes a Viernes, 9:00 AM - 6:00 PM</li>
                    </ul>
                </div>

                <!-- Ubicación -->
                <div class="space-y-4">
                    <h3 class="text-2xl font-semibold text-blue-600">Nuestra Ubicación</h3>
                    <p class="text-lg text-gray-700">Visítanos en nuestras oficinas o coordina una reunión con nosotros. Estamos ubicados en una zona central de la ciudad.</p>
                    <div class="flex justify-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.972083219015!2d-65.22533613941039!3d-26.840840219195925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x941bc3b3a8313149%3A0x5bc1941e70a9b210!2sEscuela%20de%20Educaci%C3%B3n%20T%C3%A9cnica%20N%C2%B0%203139%20Gral.%20M.%20M.%20de%20G%C3%BCemes!5e0!3m2!1ses-419!2sar!4v1739244229934!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Sección: Síguenos en Nuestras Redes -->
    <section class="py-16 bg-gray-100">
        <div class="text-center mb-8" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-blue-600">¡Síguenos en nuestras redes para que no te pierdas de nada!</h2>
        </div>
        <div class="flex justify-center space-x-6" data-aos="fade-up">
            <!-- Íconos de Redes Sociales -->
            <a href="https://www.facebook.com" target="_blank" class="text-3xl text-blue-600 hover:text-blue-800">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://www.twitter.com" target="_blank" class="text-3xl text-blue-600 hover:text-blue-800">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" class="text-3xl text-blue-600 hover:text-blue-800">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.linkedin.com" target="_blank" class="text-3xl text-blue-600 hover:text-blue-800">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="https://www.youtube.com" target="_blank" class="text-3xl text-blue-600 hover:text-blue-800">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    </section>

    <script>
        // Inicializar animaciones de AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
        });
    </script>
    <?php include '../fragmento/footer.php'; ?>

</body>
</html>
