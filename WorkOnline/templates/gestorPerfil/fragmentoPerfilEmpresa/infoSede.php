<section id="sedes-empresa">
    <h2>Sedes de la Empresa</h2>
    <ul>
        <?php if (!empty($sedes)): ?>
            <?php foreach ($sedes as $sede): ?>
                <li style="display: flex; justify-content: space-between; align-items: center;">
                    <?php echo htmlspecialchars($sede['ciudad'] . ', ' . $sede['pais']); ?>
                    <button class="btn eliminar-sede-btn" data-id="<?php echo $sede['id']; ?>">✖</button>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No hay sedes registradas</li>
        <?php endif; ?>
    </ul>
    <button id="añadir-sede-btn" class="btn">Añadir Sede</button>
</section>

<!-- Modal para añadir sede -->
<div id="modal-sede" class="modal" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 1000;">
    <div class="modal-content">
        <span class="close" style="cursor: pointer; position: absolute; top: 10px; right: 10px; font-size: 20px;">&times;</span>
        <h2>Añadir Nueva Sede</h2>
        <form>
            <input type="hidden" name="empresa_id" value="<?php echo $empresa['id']; ?>">
            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" required>
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required>
            <button type="submit" class="btn">Guardar</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Mostrar modal para añadir sede
    document.getElementById('añadir-sede-btn').addEventListener('click', function() {
        document.getElementById('modal-sede').style.display = 'flex'; // Cambiar a 'flex' para centrar el contenido
    });

    // Cerrar modal al hacer clic en la 'X'
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('modal-sede').style.display = 'none';
    });

    // Cerrar modal al hacer clic fuera del contenido del modal
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('modal-sede');
        const modalContent = document.querySelector('.modal-content');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

   // Eliminar sede con confirmación de SweetAlert
    document.querySelectorAll('.eliminar-sede-btn').forEach(button => {
        button.addEventListener('click', function() {
            const sedeId = this.getAttribute('data-id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará la sede definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/WorkOnline/scriptControl/sedesControl/deleteSede.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'id': sedeId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Eliminado', 'La sede ha sido eliminada.', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Hubo un problema al eliminar la sede.', 'error');
                        console.error(error);
                    });
                }
            });
        });
    });

</script>

<script>
document.querySelector('#modal-sede form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    // Obtener los datos del formulario
    const formData = new FormData(this);

    // Mostrar los datos del formulario en consola para asegurarnos de que están bien capturados
    console.log("Datos del formulario:", formData);

    // Enviar los datos al servidor
    fetch('/WorkOnline/scriptControl/sedesControl/addSede.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Asegurarse de que la respuesta es JSON
    .then(data => {
        console.log("Respuesta del servidor:", data); // Verificar la respuesta del servidor
        if (data.success) {
            // Mostrar la alerta de éxito
            Swal.fire({
                title: 'Sede añadida correctamente',
                icon: 'success',
                timer: 5000, // Mostrar durante 5 segundos
                showConfirmButton: false,
                willClose: () => {
                    // Lógica para actualizar la vista sin recargar la página
                    const nuevaSede = document.createElement('li');
                    nuevaSede.style.display = 'flex';
                    nuevaSede.style.justifyContent = 'space-between';
                    nuevaSede.style.alignItems = 'center';
                    nuevaSede.innerHTML = `${data.pais}, ${data.ciudad} <button class="btn eliminar-sede-btn" data-id="${data.id}">✖</button>`;
                    document.querySelector('#sedes-empresa ul').appendChild(nuevaSede);

                    // Cerrar el modal
                    document.getElementById('modal-sede').style.display = 'none';
                }
            });
        } else {
            // Mostrar error en caso de que algo falle
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Hubo un problema al añadir la sede.', 'error');
        console.error("Error en el fetch:", error);
    });
});

</script>

<style>
    #modal-sede {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none; /* Asegura que el modal esté oculto por defecto */
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    #modal-sede label {
        padding:20px;
    }

    #modal-sede input {
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 5px;
        border: 5px solid #ccc; /* Borde suave */
        width: 100%; /* Para que los inputs ocupen todo el ancho disponible */
        margin-bottom: 15px; /* Espaciado entre los inputs */
    }

    .modal-content {
        padding: 20px;
        border-radius: 8px;
        position: relative;
        width: 400px;
        max-width: 90%;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Estilo para la lista de sedes */
    #sedes-empresa ul li {
        list-style: circle;
        margin: 10px 0;
        padding: 10px;
        background: #f9f9f9;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Botón de eliminar sede */
    .eliminar-sede-btn {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .eliminar-sede-btn:hover {
        background-color: #a00;
    }

    #modal-sede button[type="submit"] {
        background-color: #28a745; /* Verde */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        width: 30%; /* Para que ocupe todo el ancho disponible */
        font-size: 16px;
        margin-top: 10px;
        display: flex;
        justify-content: flex-end; /* Alineado a la derecha */
    }

    #modal-sede button[type="submit"]:hover {
        background-color: #218838; /* Verde con brillo reducido */
    }
</style>
