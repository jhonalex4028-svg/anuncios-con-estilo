# Anuncios con Estilos

**Plataforma web para dar a conocer los negocios y emprendimientos de Tame, Arauca.**

Reúne en un solo lugar la información de los establecimientos comerciales del municipio: qué ofrecen, dónde quedan y cómo contactarlos. Así la comunidad, los visitantes y los clientes de otras regiones pueden encontrarlos fácilmente por internet.

🔗 **Vista previa:** https://jhonalex4028-svg.github.io/anuncios-con-estilo/
*(En GitHub Pages se ven las empresas de ejemplo de `js/data.js`. El registro y el panel administrativo necesitan PHP y MySQL, por ejemplo en Hostinger.)*

---

## Funcionalidades

- **Inicio** con empresas destacadas y un mapa de Tame.
- **Categorías:** Comercio, Restaurantes, Turismo, Hoteles, Agroindustrias, Servicios Públicos, Servicios y Emprendimientos.
- **Buscador** de empresas.
- **Mapa general** con filtros (`mapa.html`). También hay mapas en el inicio, en cada categoría y en cada empresa.
- **Ficha de cada empresa** con descripción, servicios, fotos, ubicación, contacto y redes.
- **Registro de usuarios:** para ver el detalle completo de una empresa hay que registrarse.
- **Panel administrativo** para crear, editar y borrar empresas y ver los usuarios registrados.

## Tecnologías

| Parte | Herramientas |
| --- | --- |
| Páginas | HTML, CSS y JavaScript |
| Diseño | Bootstrap 5.3, Bootstrap Icons, Google Fonts |
| Mapas | Leaflet 1.9 (necesita internet para cargar el mapa) |
| Servidor | PHP 8 |
| Base de datos | MySQL (tablas `administradores`, `empresas` y `usuarios`) |

## Estructura del proyecto

```
├── index.html, buscar.html, categorias.html, categoria.html,
│   empresa.html, mapa.html, registro.html   → páginas públicas
├── css/            → estilos (style.css, fusion.css)
├── js/             → data.js (empresas de ejemplo), main.js (navbar, footer y tarjetas), fusion.js
├── imagenes/       → logo, fotos de Tame y fotos de las empresas
├── admin/          → panel administrativo (login, empresas, usuarios)
├── api/            → servicios PHP que consultan la base de datos
├── config/         → configuración y conexión a la base de datos
├── database/       → script de la base de datos y datos de ejemplo
└── uploads/        → fotos que se suben desde el panel
```

## Empresas incluidas

- **Empresas reales:** RTT Transporte y Logística S.A.S., Primrose, Caribabare E.S.P. y Hotel Tame Real.
- **Empresas ficticias de ejemplo (8):** están marcadas con `ficticia: true` en `js/data.js` y no tienen WhatsApp, teléfono ni correo. Para quitarlas, borra sus bloques en `js/data.js` y la carpeta `imagenes/ficticias/`.

Si el sitio se abre sin PHP (por ejemplo, directamente en el computador o en GitHub Pages), se muestran las empresas de `js/data.js` y no se pide registro.

## Cómo verlo en el computador

Descarga el repositorio y abre `index.html` en el navegador. No hace falta instalar nada.

## Cómo publicarlo completo en Hostinger

1. **hPanel → Bases de datos:** crear la base de datos y el usuario.
2. **phpMyAdmin:** importar `database/anuncios_con_estilos.sql`. Si quieres cargar empresas de ejemplo, importa también los archivos `database/datos_ejemplo_*.sql`.
3. **Editar `config/config.php`** con los datos de la base, la `CLAVE_INSTALACION` y la `CLAVE_COOKIES` (textos largos y secretos).
4. **Subir** todo el contenido del repositorio a `public_html`. La carpeta `uploads/empresas` debe tener permisos 755.
5. Abrir `tudominio.com/admin/crear_admin.php`, crear los administradores y **borrar ese archivo** del hosting.
6. Entrar en `tudominio.com/admin/login.php` y subir empresas desde **Nueva empresa** (5 fotos + icono por empresa).

> ⚠️ **Importante:** el repositorio es público. Las claves reales de `config/config.php` se ponen solo en el hosting, nunca en GitHub.

### Archivos del servidor

- `admin/crear_admin.php`: crea a los administradores (los creadores del proyecto).
- `admin/login.php` y `admin/logout.php`: acceso solo para administradores.
- `admin/empresas.php` y `admin/empresa_form.php`: lista, crear, editar y borrar empresas.
- `admin/usuarios.php`: ver los usuarios registrados.
- `api/empresas.php`: lista pública de empresas (nombre, categoría, descripción, dirección, ubicación, logo y foto 1). Alimenta las tarjetas, el buscador y el mapa.
- `api/empresa.php`: detalle completo de una empresa (contacto, redes, servicios y 5 fotos). **Solo responde a usuarios registrados.**
- `api/registrar.php` y `api/salir.php`: registro y cierre de sesión del usuario.
- `registro.html`: formulario de registro (nombres, apellidos, correo y teléfono). Los botones **Ver más**, "Ver detalles" y "Ver empresa" del mapa mandan aquí a quien no se ha registrado.

## Contacto

- **WhatsApp:** +57 322 872 8537 (botón del footer y botón flotante)
- **Correo:** anunciosconestilo@gmail.com
- **Facebook e Instagram:** "Anuncios con Estilo", con el logo. Los enlaces están en `js/main.js` (busca `class="footer-red"`); cambia `href="#"` por la dirección real de cada página.

---

Proyecto de la Institución Educativa Liceo Tame, Modalidad en Programación y Tecnologías Digitales.
