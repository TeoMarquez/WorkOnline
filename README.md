# WorkOnline - Plataforma de Búsqueda de Empleo  

WorkOnline es una plataforma web que facilita la búsqueda y publicación de ofertas de empleo. Los empleadores pueden registrar sus empresas y publicar ofertas, mientras que los candidatos pueden buscar empleos, filtrar resultados y postularse.  

## 🚀 Características  

- 🔍 **Búsqueda Avanzada**: Filtra ofertas por rol, ubicación, tipo de empleo, salario mínimo y fecha de publicación.  
- 🏢 **Gestión de Empresas**: Registro de empresas y publicación de ofertas de trabajo.  
- 📄 **Perfiles de Usuario**: Candidatos pueden subir su currículum y gestionar postulaciones.  
- 📢 **Publicación de Ofertas**: Empleadores pueden gestionar sus vacantes y recibir postulaciones.  
- 🛠️ **Desarrollado con PHP y MySQL**: Utiliza PDO para una conexión segura a la base de datos.  

## 📌 Instalación  

Sigue estos pasos para instalar y ejecutar el proyecto en tu entorno local:  

1. **Clona el repositorio**  
   ```bash
   git clone https://github.com/tu-usuario/workonline.git
   cd workonline
# WorkOnline  

## 2️⃣ Configura la base de datos  
1. Crea una base de datos en MySQL llamada **workOnline**.  
2. Importa el archivo `database.sql` en tu base de datos.  

## 3️⃣ Configura las credenciales de la base de datos  
Abre el archivo `db.php` y edita las variables con tus credenciales:  

```php  
$host = 'localhost';  
$db = 'workOnline';  
$user = 'root';  
$pass = '12345678';     
$charset = 'utf8mb4';  

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";  

$pdo = new PDO($dsn, $user, $pass, [  
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  
    PDO::ATTR_EMULATE_PREPARES => false,  
]);  
```
## 4️⃣ Inicia el servidor  

### Si usas XAMPP  
Coloca los archivos en la carpeta `htdocs` y accede a:  

http://localhost/WorkOnline

### Si usas PHP nativo  
Ejecuta el siguiente comando en la terminal:  

```bash  
php -S localhost:8000
```

Luego, abre en el navegador:
```bash  
http://localhost:8000  
```

## 📂 Estructura del Proyecto  
```bash  
WorkOnline/  
│── assets/              # Archivos estáticos (CSS, JS, imágenes)  
│── database.sql         # Script de la base de datos  
│── scriptControl/db/    # Conexión a la base de datos  
│── templates/           # Plantillas y vistas  
│   ├── busqueda/        # Página de búsqueda de empleo  
│   ├── fragmento/       # Header y footer  
│── index.php            # Página principal  
│── novedades.php        # Redirección si no hay búsqueda activa  

