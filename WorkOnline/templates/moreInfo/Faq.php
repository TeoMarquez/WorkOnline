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
    <link rel="stylesheet" href="../../css/Faq.css">

</head>
    <?php include '../fragmento/header.php'; ?>

<body>
<main>
        <section id="faq" class="faq-section">
            <aside class="faq-sidebar">
                <h3 class="font-bold text-xl mb-4">Índice de Preguntas</h3>
                <ul id="faq-index">
                </ul>
            </aside>

            <!-- Acordeones de preguntas frecuentes -->
            <div class="faq-accordion w-full">
                <div class="faq-item" id="faq-item-1">
                    <button class="faq-title">¿Cómo puedo postularme a un empleo?</button>
                    <div class="faq-content">
                        <p>Para postularte a un empleo, ingresa a tu perfil, busca las ofertas disponibles y haz clic en "Postularse". Completa el formulario y envía tu postulación.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-item-2">
                    <button class="faq-title">¿Cómo puedo publicar una oferta de empleo?</button>
                    <div class="faq-content">
                        <p>Para publicar una oferta de empleo, accede a tu cuenta de empleador, dirígete a "Publicar oferta" y completa los campos requeridos.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-item-3">
                    <button class="faq-title">¿Qué hago si olvido mi contraseña?</button>
                    <div class="faq-content">
                        <p>Si olvidas tu contraseña, haz clic en "¿Olvidaste tu contraseña?" en la página de inicio de sesión y sigue las instrucciones para restablecerla.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-item-4">
                    <button class="faq-title">¿Puedo editar mi perfil?</button>
                    <div class="faq-content">
                        <p>Sí, puedes editar tu perfil en cualquier momento desde la sección de "Ajustes" en tu cuenta.</p>
                    </div>
                </div>
                <!-- Agregar más preguntas de empleados y empleadores aquí -->
                <div class="faq-item" id="faq-item-5">
                    <button class="faq-title">¿Cómo puedo contactar a un empleado para una entrevista?</button>
                    <div class="faq-content">
                        <p>Desde tu perfil de empleador, puedes enviar un mensaje a los candidatos seleccionados para agendar entrevistas o pedir más información.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-item-6">
                    <button class="faq-title">¿Puedo ver las postulaciones de los empleados?</button>
                    <div class="faq-content">
                        <p>Sí, puedes revisar todas las postulaciones recibidas desde tu panel de control de empleador, organizarlas por fecha, puesto o nombre del candidato.</p>
                    </div>
                </div>
            </div>
        </section>

        <?php include '../fragmento/footer.php'; ?>

        <script>
            // Función para alternar acordeones
            document.querySelectorAll('.faq-title').forEach(button => {
                button.addEventListener('click', () => {
                    const content = button.nextElementSibling;
                    content.classList.toggle('hidden');
                });
            });

            // Función de búsqueda para el índice de FAQ
            function searchFAQ() {
                const searchTerm = document.getElementById('faq-search').value.toLowerCase();
                const faqItems = document.querySelectorAll('.faq-item');
                const faqIndex = document.getElementById('faq-index');
                faqIndex.innerHTML = ''; // Limpiar índice

                faqItems.forEach((item, index) => {
                    const question = item.querySelector('.faq-title').textContent.toLowerCase();
                    if (question.includes(searchTerm)) {
                        const listItem = document.createElement('li');
                        listItem.innerHTML = `<a href="#faq-item-${index + 1}" class="text-blue-600 hover:text-blue-800">${item.querySelector('.faq-title').textContent}</a>`;
                        faqIndex.appendChild(listItem);
                    }
                });
            }

            // Llenar el índice de preguntas
            document.addEventListener('DOMContentLoaded', () => {
                const faqItems = document.querySelectorAll('.faq-item');
                faqItems.forEach((item, index) => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `<a href="#faq-item-${index + 1}" class="text-blue-600 hover:text-blue-800">${item.querySelector('.faq-title').textContent}</a>`;
                    document.getElementById('faq-index').appendChild(listItem);
                });
            });
        </script>
</body>
