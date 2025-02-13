-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS registro_usuarios;
USE registro_usuarios;

-- Tabla para usuarios que buscan empleo
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    pais VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS curriculums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo_cv VARCHAR(255) NOT NULL,
    descripcion TEXT DEFAULT NULL,
    experiencia_laboral JSON DEFAULT NULL,
    educacion JSON DEFAULT NULL,
    habilidades JSON DEFAULT NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);


-- Crear tabla para almacenar las postulaciones de los usuarios a ofertas
CREATE TABLE IF NOT EXISTS postulaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    empresa_id INT NOT NULL,
    estado ENUM('pendiente', 'aceptada', 'rechazada') DEFAULT 'pendiente',
    fecha_postulacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    oferta_empleo_id INT NOT NULL,  
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    FOREIGN KEY (oferta_empleo_id) REFERENCES ofertas_empleo(id) ON DELETE CASCADE
);

-- Tabla para empleadores
CREATE TABLE IF NOT EXISTS empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    pais VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    cuit VARCHAR(20) NOT NULL UNIQUE,
    identificador_empresa VARCHAR(100) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla para las sedes de las empresas
CREATE TABLE IF NOT EXISTS sedes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    pais VARCHAR(100) NOT NULL,
    ciudad VARCHAR(100) NOT NULL,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- Crear tabla para almacenar los currículums de los usuarios

-- Crear tabla para registrar el historial de trabajos de los usuarios
CREATE TABLE IF NOT EXISTS historial_trabajos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    puesto VARCHAR(255) NOT NULL,
    empresa VARCHAR(255) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Crear tabla para las ofertas de empleo publicadas por las empresas
CREATE TABLE IF NOT EXISTS ofertas_empleo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    titulo_oferta VARCHAR(255) NOT NULL,
    descripcion_oferta TEXT NOT NULL,
    rol VARCHAR(255) NOT NULL,
    sueldo DECIMAL(10, 2) NOT NULL,
    carga_horaria VARCHAR(50) NOT NULL,
    tipo VARCHAR(50) NOT NULL,  -- Híbrido, presencial, virtual
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_cierre TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);
