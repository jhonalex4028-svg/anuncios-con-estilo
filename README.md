# Anuncios con Estilos — sitio estático

HTML + CSS + JS puro. Se puede abrir `index.html` en el navegador o subir toda la carpeta al hosting.

## Estructura

- `imagenes/` — logo (`logo.png`), fotos de Tame (`fotos/`), fotos de RTT (`rtt/`) e imágenes de ejemplo
  de las empresas ficticias (`ficticias/`).
- `mapa.html` — mapa general con filtros. También hay mapas en el inicio, en cada categoría y en cada empresa
  (usan Leaflet y necesitan internet para cargar el mapa).
- `js/data.js` — categorías y empresas: RTT (real) y 8 empresas ficticias de ejemplo (marcadas con
  `ficticia: true`). Cada empresa tiene `lat` y `lng` para ubicarla en el mapa.
- `js/main.js` — navbar, footer (contacto) y tarjetas de empresa.
- `css/style.css` — estilos.

## Contacto en el footer

- WhatsApp: +57 322 872 8537 (botón del footer y botón flotante)
- Correo: anunciosconestilo@gmail.com

## Empresas ficticias

Son de ejemplo y no tienen WhatsApp, teléfono ni correo. Para quitarlas, borra sus bloques en
`js/data.js` (los que tienen `ficticia: true`) y la carpeta `imagenes/ficticias/`.

---

## Novedades: base de datos y panel administrativo (PHP + MySQL)

- `database/anuncios_con_estilos.sql` — tablas `administradores`, `empresas` y `usuarios` (importar en phpMyAdmin).
- `config/config.php` — datos de la base de datos de Hostinger y clave de instalación (**editar**).
- `admin/` — panel administrativo:
  - `crear_admin.php` — crea a los creadores del proyecto (**borrar del hosting al terminar**).
  - `login.php` / `logout.php` — acceso solo para administradores.
  - `empresas.php` y `empresa_form.php` — lista, crear, editar y borrar empresas (5 fotos + icono).
  - `usuarios.php` — ver usuarios registrados.
- `uploads/empresas/` — aquí se guardan las fotos subidas (permisos 755).

### Registro de usuarios y páginas públicas (ya conectadas a la base de datos)
- `registro.html` — formulario (nombres, apellidos, correo, teléfono). El botón **Ver más** (y "Ver detalles" / "Ver empresa" del mapa) manda aquí a quien no se ha registrado.
- `api/empresas.php` — lista pública (nombre, categoría, descripción, dirección, ubicación, logo y foto 1). Alimenta tarjetas, buscador y mapa.
- `api/empresa.php` — detalle completo (contacto, redes, servicios, 5 fotos). **Solo responde a usuarios registrados.**
- `api/registrar.php` / `api/salir.php` — registro y cierre de sesión del usuario.
- Si el sitio se abre sin PHP (en el computador), se muestran las empresas de ejemplo de `js/data.js` y no se pide registro.

### Pasos en Hostinger
1. hPanel > Bases de datos: crear base de datos y usuario.
2. phpMyAdmin: importar `database/anuncios_con_estilos.sql`. (Opcional: `database/datos_ejemplo_rtt.sql` carga la empresa RTT.)
3. Editar `config/config.php`: datos de la base, `CLAVE_INSTALACION` y `CLAVE_COOKIES` (textos largos y secretos).
4. Subir todo el contenido de esta carpeta a `public_html` (la carpeta `uploads/empresas` debe tener permisos 755).
5. Abrir `tudominio.com/admin/crear_admin.php`, crear los administradores y **borrar ese archivo**.
6. Ingresar en `tudominio.com/admin/login.php` y subir empresas desde "Nueva empresa".
