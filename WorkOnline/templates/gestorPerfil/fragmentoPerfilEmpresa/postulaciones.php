<?php
require '../../scriptControl/db/db.php';

// Verificar si el usuario ha iniciado sesión como empresa
if (!isset($_SESSION['empresa'])) {
    header('Location: /WorkOnline/templates/gestorSesion/login.php');
    exit;
}

// Obtener el ID de la empresa desde la sesión
$empresa_id = $_SESSION['empresa']['id'];

// Consultar las postulaciones de la empresa, incluyendo la propuesta a la que se aplica
$stmt = $pdo->prepare("
    SELECT p.*, u.nombre_completo AS candidato_nombre, u.email AS candidato_email, oe.titulo_oferta AS propuesta_titulo
    FROM postulaciones p
    JOIN usuarios u ON p.usuario_id = u.id
    JOIN ofertas_empleo oe ON p.oferta_empleo_id = oe.id
    WHERE p.empresa_id = ?
");
$stmt->execute([$empresa_id]);

$postulaciones = $stmt->fetchAll();

// Si no hay postulaciones
if (empty($postulaciones)) {
    $mensaje = "No tienes postulaciones aún.";
} else {
    $mensaje = "Tienes " . count($postulaciones) . " postulaciones.";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulaciones Recibidas - WorkOnline</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<section id="postulaciones" class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Postulaciones Recibidas</h2>

    <?php if (isset($mensaje)): ?>
        <p class="text-gray-700"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <?php if (!empty($postulaciones)): ?>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Nombre del Candidato</th>
                    <th class="py-2 px-4 border-b text-left">Correo Electrónico</th>
                    <th class="py-2 px-4 border-b text-left">Propuesta Aplicada</th>
                    <th class="py-2 px-4 border-b text-left">Fecha de Postulación</th>
                    <th class="py-2 px-4 border-b text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($postulaciones as $postulacion): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo $postulacion['candidato_nombre']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $postulacion['candidato_email']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $postulacion['propuesta_titulo']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $postulacion['fecha_postulacion']; ?></td>
                        <td class="py-2 px-4 border-b">
                            <button class="text-blue-500" onclick="openModal(<?php echo $postulacion['usuario_id']; ?>, <?php echo $postulacion['id']; ?>)">Ver detalles</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg max-w-lg w-full">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-red-500">X</button>
        <h3 class="text-xl font-bold mb-4">Detalles del Postulante</h3>
        <div id="modal-content"></div>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    // Cerrar modal al hacer clic fuera del contenido
    document.getElementById('modal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });

</script>

<script>
    function changePostulacionState(postulacionId, nuevoEstado) {
    console.log('postulacionId:', postulacionId);
    console.log('nuevoEstado:', nuevoEstado);

    // Verificar que los datos son válidos
    if (!postulacionId || !nuevoEstado) {
        alert('Datos incompletos');
        return;
    }

    // Enviar la solicitud POST con datos en formato JSON
    fetch('/workOnline/scriptControl/ofertasControl/controlPropuesta.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',  // Establece el tipo de contenido a JSON
        },
        body: JSON.stringify({
            postulacion_id: postulacionId,
            nuevo_estado: nuevoEstado
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Estado actualizado');
            closeModal();  // Cerrar el modal al actualizar el estado
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error al actualizar el estado:', error);
        alert('Ocurrió un error al intentar actualizar el estado');
    });
    }

</script>

<script>
        function openModal(usuarioId, postulacionId) {
        fetch(`/workOnline/templates/gestorPerfil/fragmentoPerfilEmpresa/get_postulante_details.php?postulacionId=${postulacionId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al obtener los detalles del postulante.");
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    document.getElementById('modal-content').innerHTML = `<p>Error: ${data.error}</p>`;
                } else {
                    let experienciaLaboral = data.experiencia_laboral && data.experiencia_laboral.length > 0 ? JSON.parse(data.experiencia_laboral) : ['No disponible'];
                    let educacion = data.educacion && data.educacion.length > 0 ? JSON.parse(data.educacion) : ['No disponible'];
                    let habilidades = data.habilidades && data.habilidades.length > 0 ? JSON.parse(data.habilidades) : ['No disponible'];

                    let content = `
                        <p><strong>Nombre:</strong> ${data.nombre_completo}</p>
                        <p><strong>Correo Electrónico:</strong> ${data.email}</p>
                        <p><strong>País:</strong> ${data.pais}</p>
                        <p><strong>Teléfono:</strong> ${data.telefono}</p>
                        <h4 class="mt-4 font-semibold">Currículum:</h4>
                        <p><strong>Título:</strong> ${data.titulo_cv || 'No disponible'}</p>
                        <p><strong>Descripción:</strong> ${data.descripcion || 'No disponible'}</p>
                        <h5 class="mt-2 font-semibold">Experiencia Laboral:</h5>
                        <ul>
                            ${experienciaLaboral.map(item => `<li>${item}</li>`).join('')}
                        </ul>
                        <h5 class="mt-2 font-semibold">Educación:</h5>
                        <ul>
                            ${educacion.map(item => `<li>${item}</li>`).join('')}
                        </ul>
                        <h5 class="mt-2 font-semibold">Habilidades:</h5>
                        <ul>
                            ${habilidades.map(item => `<li>${item}</li>`).join('')}
                        </ul>
                        <div class="mt-4">
                            <button onclick="changePostulacionState(${postulacionId}, 'aceptada')" class="px-4 py-2 bg-green-500 text-white rounded mr-2">Aceptar</button>
                            <button onclick="changePostulacionState(${postulacionId}, 'rechazada')" class="px-4 py-2 bg-red-500 text-white rounded">Rechazar</button>
                        </div>
                    `;

                    document.getElementById('modal-content').innerHTML = content;
                    document.getElementById('modal').classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error fetching postulante details:', error);
                document.getElementById('modal-content').innerHTML = `<p>Error al cargar los detalles del postulante. Intenta de nuevo más tarde.</p>`;
                document.getElementById('modal').classList.remove('hidden');
            });
    }

</script>
</body>
</html>
