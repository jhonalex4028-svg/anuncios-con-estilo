-- =========================================================
-- ANUNCIOS CON ESTILOS - Base de datos
-- Importar en phpMyAdmin (Hostinger): seleccionar la base de datos
-- creada en hPanel > Importar > elegir este archivo > Continuar.
-- NOTA: en Hostinger la base de datos ya se crea desde hPanel
-- (Bases de datos > Administración), por eso aqui NO se usa CREATE DATABASE.
-- =========================================================

SET NAMES utf8mb4;
SET time_zone = '-05:00';

-- ---------------------------------------------------------
-- 1) ADMINISTRADORES (solo los creadores del proyecto)
--    Se usa para entrar al apartado administrativo y subir empresas.
--    La contrasena se guarda cifrada (hash), nunca en texto plano.
--    No hay registro publico: los administradores se crean con
--    admin/crear_admin.php (se hace una sola vez y luego se borra).
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS administradores (
  id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  usuario     VARCHAR(50)  NOT NULL,
  contrasena  VARCHAR(255) NOT NULL,
  creado_en   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_admin_usuario (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 2) EMPRESAS (las sube el administrador desde el panel)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS empresas (
  id                INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre            VARCHAR(150) NOT NULL,
  descripcion_breve VARCHAR(500) NOT NULL,
  fecha_creacion    DATE         NULL COMMENT 'Fecha en que se fundo la empresa',
  servicios         TEXT         NULL COMMENT 'Un servicio por linea',
  instagram         VARCHAR(255) NULL,
  facebook          VARCHAR(255) NULL,
  tiktok            VARCHAR(255) NULL,
  whatsapp          VARCHAR(30)  NULL COMMENT 'Con indicativo, ej: 573228728537',
  correo            VARCHAR(150) NULL,
  pagina_web        VARCHAR(255) NULL,
  foto1             VARCHAR(255) NULL,
  foto2             VARCHAR(255) NULL,
  foto3             VARCHAR(255) NULL,
  foto4             VARCHAR(255) NULL,
  foto5             VARCHAR(255) NULL,
  foto_icono        VARCHAR(255) NULL COMMENT 'Logo de la empresa',
  direccion         VARCHAR(255) NOT NULL,
  latitud           DECIMAL(10,7) NULL COMMENT 'Para ubicarla en el mapa',
  longitud          DECIMAL(10,7) NULL,
  categoria         ENUM('comercio','restaurantes','turismo','hoteles',
                         'agroindustrias','servicios-publicos','servicios',
                         'emprendimientos') NOT NULL,
  creado_en         TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_empresas_categoria (categoria),
  KEY idx_empresas_nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------
-- 3) USUARIOS (publico general)
--    Se registran al pulsar "Ver mas" para poder ver la
--    informacion completa de las empresas.
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombres    VARCHAR(100) NOT NULL,
  apellidos  VARCHAR(100) NOT NULL,
  correo     VARCHAR(150) NOT NULL,
  telefono   VARCHAR(20)  NOT NULL,
  creado_en  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_usuario_correo (correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
