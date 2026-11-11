-- OPCIONAL: agrega Caribabare E.S.P. (categoria servicios-publicos). Importar DESPUES del archivo principal.
-- Las fotos ya vienen en la carpeta imagenes/caribabare del sitio.
-- Falta completar: telefono/whatsapp, correo, direccion exacta y ubicacion (latitud/longitud) reales.
INSERT INTO empresas (nombre,descripcion_breve,servicios,pagina_web,foto1,foto2,foto_icono,direccion,latitud,longitud,categoria) VALUES (
'Caribabare E.S.P.',
'Caribabare E.S.P. es la empresa de servicios publicos de Tame, Arauca. Opera la planta de tratamiento y atiende a los usuarios del municipio desde su sede en el centro.',
'Acueducto
Alcantarillado
Aseo
Atencion al usuario',
'https://caribabare.gov.co/esp/',
'imagenes/caribabare/caribabare-sede.jpg',
'imagenes/caribabare/caribabare-planta.jpg',
'imagenes/caribabare/caribabare-logo.jpg',
'Tame, Arauca',
6.4650,
-71.7340,
'servicios-publicos'
);
