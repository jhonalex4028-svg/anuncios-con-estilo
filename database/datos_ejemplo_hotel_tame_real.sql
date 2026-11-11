-- OPCIONAL: agrega el Hotel Tame Real (categoria hoteles). Importar DESPUES del archivo principal.
-- Las fotos ya vienen en la carpeta imagenes/tame-real del sitio.
-- Falta completar: telefono/whatsapp, direccion exacta y ubicacion (latitud/longitud) reales.
INSERT INTO empresas (nombre,descripcion_breve,servicios,pagina_web,foto1,foto2,foto3,foto_icono,direccion,latitud,longitud,categoria) VALUES (
'Hotel Tame Real',
'Hotel en Tame, Arauca, con habitaciones con aire acondicionado alrededor de un patio interior lleno de plantas. Recepcion en el primer piso y ambiente tranquilo para descansar.',
'Habitaciones con aire acondicionado
Recepcion
Patio interior con jardin',
'https://www.booking.com/hotel/co/tame-real.es.html',
'imagenes/tame-real/tame-real-patio.jpg',
'imagenes/tame-real/tame-real-recepcion.jpg',
'imagenes/tame-real/tame-real-habitacion.jpg',
'imagenes/tame-real/tame-real-logo.jpg',
'Tame, Arauca',
6.4638,
-71.7336,
'hoteles'
);
