<?php

require '../../scriptControl/db/db.php';

if (!isset($_SESSION['empresa'])) {
    header('Location: /WorkOnline/templates/login.php');
    exit;
}

// Obtener los datos de la empresa desde la sesión
$empresa = $_SESSION['empresa'];

// Obtener las ofertas de empleo de la base de datos para la empresa actual
$empresa_id = $empresa['id'];  // Suponiendo que la información de la empresa ya está cargada
$query = "SELECT * FROM ofertas_empleo WHERE empresa_id = :empresa_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':empresa_id', $empresa_id);
$stmt->execute();
$ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section id="publicar-oferta">
    <h2>Publicar Oferta de Empleo</h2>
    <p>Crea y publica ofertas de empleo para encontrar el talento adecuado.</p>

    <?php if (empty($ofertas)): ?>
        <a href="javascript:void(0);" id="ir-a-publicar-oferta" class="btn">Ir a Publicar Oferta</a>
    <?php else: ?>
                <ul>
            <?php foreach ($ofertas as $oferta): ?>
                <li>
                    <h3><?php echo htmlspecialchars($oferta['titulo_oferta']); ?></h3>
                    <div class="oferta-info">
                        <p><span>Descripción:</span> <?php echo nl2br(htmlspecialchars($oferta['descripcion_oferta'])); ?></p>
                        <p><span>Rol:</span> <?php echo htmlspecialchars($oferta['rol']); ?></p>
                        <p><span>Sueldo:</span> $<?php echo number_format($oferta['sueldo'], 2); ?></p>
                        <p><span>Carga Horaria:</span> <?php echo htmlspecialchars($oferta['carga_horaria']); ?></p>
                        <p><span>Tipo:</span> <?php echo ucfirst(htmlspecialchars($oferta['tipo'])); ?></p>
                        <p><span>Fecha de Publicación:</span> <?php echo $oferta['fecha_publicacion']; ?></p>
                        <div class="fecha-cierre">
                            <p><span>Fecha de Cierre:</span> <?php echo $oferta['fecha_cierre'] ?? 'Sin fecha de cierre'; ?></p>
                            <?php if ($oferta['fecha_cierre']): ?>
                                <span class="fecha-indicador">⏳</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="oferta-acciones">
                        <a href="javascript:void(0);" class="btn eliminar-oferta-btn" data-id="<?php echo $oferta['id']; ?>">✖</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="javascript:void(0);" id="ir-a-publicar-oferta" class="btn">Publicar Nueva Oferta</a>
    <?php endif; ?>
</section>

<!-- Modal para publicar nueva oferta -->
<div id="modal-oferta" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" style="cursor: pointer; position: absolute; top: 10px; right: 10px; font-size: 20px;">&times;</span>
        <h2>Publicar Nueva Oferta</h2>
        <form id="form-publicar-oferta" action="/WorkOnline/scriptControl/ofertasControl/addOferta.php" method="POST">
            <input type="hidden" name="empresa_id" value="<?php echo $empresa['id']; ?>">
            
            <label for="titulo_oferta">Título de la oferta:</label>
            <input type="text" id="titulo_oferta" name="titulo_oferta" required>
            
            <label for="descripcion_oferta">Descripción:</label>
            <textarea id="descripcion_oferta" name="descripcion_oferta" rows="4" required></textarea>
            
            <label for="rol">Rol:</label>
            <input type="text" id="rol" name="rol" required>
            
            <label for="sueldo">Sueldo:</label>
            <input type="number" step="1000" id="sueldo" name="sueldo" required>
            
            <label for="carga_horaria">Carga Horaria:</label>
            <input type="text" id="carga_horaria" name="carga_horaria" required>
            
            <label for="tipo">Tipo de trabajo:</label>
            <select id="tipo" name="tipo" required>
                <option value="hibrido">Híbrido</option>
                <option value="presencial">Presencial</option>
                <option value="virtual">Virtual</option>
            </select>
            
            <label for="fecha_cierre">Fecha de Cierre:</label>
            <input type="date" id="fecha_cierre" name="fecha_cierre">
            
            <button type="submit" class="btn" id="btn-publicar">Publicar Oferta</button>
        </form>

    </div>
</div>

<script>

    document.querySelectorAll('.eliminar-oferta-btn').forEach(button => {
        button.addEventListener('click', function() {
            const ofertaId = this.getAttribute('data-id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta oferta será eliminada permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar la solicitud de eliminación al servidor
                    fetch('/WorkOnline/scriptControl/ofertasControl/deleteOferta.php', {
                        method: 'POST',
                        body: JSON.stringify({ id: ofertaId }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Eliminada!',
                                'La oferta ha sido eliminada.',
                                'success'
                            ).then(() => {
                                // Recargar la página
                                location.reload(); 
                            });
                        } else {
                            Swal.fire('Error', 'Hubo un problema al eliminar la oferta.', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Hubo un problema con la solicitud.', 'error');
                        console.error(error);
                    });
                }
            });
        });
    });


</script>


<script>
    // Mostrar modal para publicar oferta
    document.getElementById('ir-a-publicar-oferta').addEventListener('click', function() {
        document.getElementById('modal-oferta').style.display = 'flex'; // Mostrar el modal
    });

    // Cerrar modal al hacer clic en la 'X'
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('modal-oferta').style.display = 'none';
    });

    // Cerrar modal al hacer clic fuera del contenido del modal
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('modal-oferta');
        const modalContent = document.querySelector('.modal-content');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

<script>
    // Enviar formulario para publicar oferta
    document.getElementById('form-publicar-oferta').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener los datos del formulario
        const formData = new FormData(this);

        // Enviar los datos al servidor
        fetch('/WorkOnline/scriptControl/ofertasControl/addOferta.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())  // Asegurarse de que la respuesta es JSON
        .then(data => {
            if (data.success) {
                // Cerrar el modal antes de mostrar la alerta
                document.getElementById('modal-oferta').style.display = 'none';

                // Mostrar la alerta de éxito
                Swal.fire({
                    title: 'Oferta publicada correctamente',
                    icon: 'success',
                    timer: 5000,
                    showConfirmButton: false,
                    willClose: () => {
                        location.reload(); 
                    }
                });
            } else {
                // Mostrar error en caso de que algo falle
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => {
            Swal.fire('Error', 'Hubo un problema al publicar la oferta.', 'error');
            console.error(error);
        });
    });

</script>

<style>

    #publicar-oferta ul li {
        list-style: none;
        margin: 20px 0;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        gap: 15px; /* Espaciado entre las secciones */
        background-color:white;
        filter: brightness(0.90);
    }

    #publicar-oferta ul li h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: bold;
    }

    #publicar-oferta ul li p {
        margin: 5px 0;
        font-size: 1rem;
        color: #333;
    }

    .oferta-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .oferta-info p {
        margin: 0;
        font-size: 1rem;
    }

    .oferta-info span {
        font-weight: bold;
    }

    .oferta-acciones {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .eliminar-oferta-btn {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .eliminar-oferta-btn:hover {
        background-color: #d32f2f;
    }

    .fecha-cierre {
        display: flex;
        align-items: center;
    }

    .fecha-cierre span {
        margin-left: 10px;
        font-size: 0.9rem;
        color: #757575;
    }

    .btn-rojo {
        background-color: red;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
        display: inline-block;
        cursor: pointer;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro */
        z-index: 10; /* Asegurarse de que el modal esté encima de otros elementos */
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        width: 60%; /* Ajusta el tamaño del modal */
        max-width: 600px;
        max-height: 80vh; /* Esto asegura que el modal no exceda el 80% de la altura de la pantalla */
        overflow-y: auto; /* Añade barra de desplazamiento si el contenido es más grande que el espacio disponible */
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    }


    .eliminar-oferta-btn {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        display: inline-block;
        text-align: center;
    }

    .eliminar-oferta-btn:hover {
        background-color: #a00;
    }

    /* Asegúrate deque SweetAlert esté encima de todos los elementos */
    .swal2-container {
        z-index: 9999 !important;
    }

    #btn-publicar {
        background-color: #28a745; /* Verde */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        width: 30%; /* Para que ocupe todo el ancho disponible */
        font-size: 16px;
        margin-top: 25px;
        display:block;
        transform: translateX(220%); /* Mueve el botón horizontalmente hacia la izquierda */
    }

    #btn-publicar:hover {
        background-color: #218838; /* Verde con brillo reducido */
    }

    #form-publicar-oferta label {
        padding:20px;
    }
    
    #form-publicar-oferta input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    /* Estilo para textarea */
    #form-publicar-oferta textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        resize: vertical;
    }

    /* Estilo para input de tipo date */
    #form-publicar-oferta input[type="date"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: #f9f9f9;
    }

    /* Estilo para el select */
    #form-publicar-oferta select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: #f9f9f9;
        cursor: pointer;
    }

    /* Estilo para el hover del select */
    #form-publicar-oferta select:hover {
        border-color: #28a745; /* Cambia el borde cuando se pasa el mouse */
    }

    /* Estilo para input de tipo number */
    #form-publicar-oferta input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: #f9f9f9;
        text-align: right; /* Para que los números se alineen a la derecha */
    }

    /* Estilo para los botones de incremento y decremento del number */
    #form-publicar-oferta input[type="number"]:focus {
        border-color: #28a745;
    }

    /* Estilo adicional para un pequeño espacio entre las opciones */
    #form-publicar-oferta label {
        margin-bottom: 8px;
        font-weight: bold;
    }
    
</style>
