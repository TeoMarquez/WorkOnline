<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - WorkOnline</title>
    <link rel="stylesheet" href="/WorkOnline/css/Inicio_Sesion.css">
    <script>
       function toggleEmployerFields() {
            const userType = document.getElementById('user-type').value;
            const employerFields = document.getElementById('employer-fields');
            const cuitField = document.getElementById('cuit');
            const businessIdField = document.getElementById('business-id');

            if (userType === 'empleador') {
                employerFields.style.display = 'block';
                cuitField.setAttribute('required', 'required');
                businessIdField.setAttribute('required', 'required');
            } else {
                employerFields.style.display = 'none';
                cuitField.removeAttribute('required');
                businessIdField.removeAttribute('required');
            }
        }

        function addBranch() {
            const branchesContainer = document.getElementById('branches-container');
            const branchDiv = document.createElement('div');
            branchDiv.className = 'branch';

            branchDiv.innerHTML = `
                <label for="branch-country">País:</label>
                <select name="branch-country[]" required>
                    <option value="">Seleccionar País</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Mexico">Mexico</option>
                    <option value="España">España</option>
                    <option value="Chile">Chile</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Peru">Peru</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Chile">Chile</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Brasil">Brasil</option>
                </select>

                <label for="branch-city">Ciudad:</label>
                <input type="text" name="branch-city[]" required placeholder="Ciudad">

                <button type="button" onclick="this.parentElement.remove()" id="btn-eliminarSede">Eliminar</button>
            `;

            branchesContainer.appendChild(branchDiv);
        }

     
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

    <main>
    <?php include '../fragmento/header.php'; ?>

        <section id="register" class="register">
            <div class="container">
                <h2>Registrarse</h2>
                <form action="/WorkOnline/scriptControl/sessionControl/registerAccount.php" method="POST">
                    <label for="name">Nombre Completo:</label>
                    <input type="text" id="name" name="name" required placeholder="Ingresá tu Nombre y Apellido">

                    <label for="email-register">Correo Electrónico:</label>
                    <input type="email" id="email-register" name="email" required placeholder="Ingresá tu Gmail">

                    <label for="password-register">Contraseña:</label>
                    <input type="password" id="password-register" name="password" required placeholder="********">

                    <label for="user-type">Tipo de Usuario:</label>
                    <select id="user-type" name="user-type" onchange="toggleEmployerFields()">
                        <option value="buscador">Buscador de Empleo</option>
                        <option value="empleador">Empleador</option>
                    </select>

                    <label for="country">País:</label>
                    <select id="country" name="country" required>
                        <option value="">Seleccionar País</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Mexico">Mexico</option>
                        <option value="España">España</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Peru">Peru</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Chile">Chile</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Brasil">Brasil</option>
                    </select>

                    <label for="Telefono">Teléfono:</label>
                    <input type="tel" id="Telefono" name="Telefono" required placeholder="Número">

                    <!-- Campos adicionales para empleadores -->
                    <div id="employer-fields" style="display: none;">
                        <h3>Información para Empleadores</h3>

                        <label for="cuit">CUIT:</label>
                        <input type="text" id="cuit" name="cuit" placeholder="CUIT">

                        <label for="business-id">Identificador de Empresa:</label>
                        <input type="text" id="business-id" name="business-id" placeholder="ID de Empresa">

                        <h4>Sedes</h4>
                        <div id="branches-container"></div>
                        <button type="button" onclick="addBranch()" id="btn-addSede">Añadir Sede</button>
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="btn-cancel" onclick="window.location.href='/'">Cancelar</button>
                        <button type="submit" class="btn-primary">Registrarse</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <?php include '../fragmento/footer.php'; ?>
</body>
</html>
