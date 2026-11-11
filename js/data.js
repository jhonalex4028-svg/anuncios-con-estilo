/* =========================================================
   ANUNCIOS CON ESTILOS — Datos del sitio
   Sitio 100% estático: no hay servidor ni base de datos.
   Los datos viven aquí mismo (CATEGORIAS y EMPRESAS_SEED).
   Cuando esté lista la base de datos en el hosting, estos datos
   se pueden reemplazar por consultas a esa base de datos.
========================================================= */

const CATEGORIAS = [
  { slug: "comercio",           nombre: "Comercio",           icono: "bi-basket3",        color: "#A0522D" },
  { slug: "restaurantes",       nombre: "Restaurantes",       icono: "bi-cup-hot",        color: "#E8590C" },
  { slug: "turismo",            nombre: "Turismo",            icono: "bi-signpost-2",     color: "#0EA5A5" },
  { slug: "hoteles",            nombre: "Hoteles",            icono: "bi-door-open",      color: "#2563EB" },
  { slug: "agroindustrias",     nombre: "Agroindustrias",     icono: "bi-tree",           color: "#4C9A2A" },
  { slug: "servicios-publicos", nombre: "Servicios Públicos", icono: "bi-lightning-charge", color: "#B8860B" },
  { slug: "servicios",          nombre: "Servicios",          icono: "bi-truck",          color: "#D6336C" },
  { slug: "emprendimientos",    nombre: "Emprendimientos",    icono: "bi-lightbulb",      color: "#7048E8" },
];

const EMPRESAS_SEED = [
  {
    id: "rtt-transporte-logistica",
    nombre: "RTT Transporte y Logística S.A.S.",
    categoria: "servicios",
    subcategoria: "Transporte de pasajeros y de carga",
    descripcion: "RTT Transporte y Logística S.A.S. nació en Tame en 1992 para movilizar a la población del casco urbano y las veredas circunvecinas. Hoy presta servicio de taxi urbano e intermunicipal (con ruta fija a Saravena), buseta urbana, servicio especial de pasajeros, y transporte de carga líquida (incluye hidrocarburos, petróleo y lodos) y carga seca. Cuenta con certificaciones ISO 9001, ISO 14001, ISO 45001 e ISO 39001, y está vigilada por la Superintendencia de Transporte.",
    whatsapp: "573125717465",
    telefono: "3125717465",
    correo: "transporteylogisticasas@rtt.com.co",
    sitioWeb: "https://www.rtt.com.co",
    fundada: "29 de julio de 1992",
    direccion: "Tame, Arauca",
    lat: 6.4625, lng: -71.7335,
    redes: {
      facebook: "https://www.facebook.com/RTTTransporteyLogisticaSAS",
      instagram: "",
      whatsapp: "https://wa.me/573125717465"
    },
    logo: "imagenes/rtt/rtt-logo.jpg",
    imagenes: [
      "imagenes/rtt/rtt-sede.jpg",
      "imagenes/rtt/rtt-oficina.jpg",
      "imagenes/rtt/rtt-camion-carga.jpg",
      "imagenes/rtt/rtt-buseta.jpg",
      "imagenes/rtt/rtt-carrotanque.jpg"
    ],
    calificacion: 0, resenas: 0,
    servicios: [
      "Taxi urbano",
      "Taxi intermunicipal a Saravena",
      "Buseta urbana",
      "Servicio especial de pasajeros",
      "Transporte de carga líquida (hidrocarburos, petróleo, lodos)",
      "Transporte de carga seca",
      "Camionetas y transporte de pasaje"
    ],
    fuente: "www.rtt.com.co (sitio oficial)"
  },
  {
    id: "supermercado-el-llanero",
    nombre: "Supermercado El Llanero",
    categoria: "comercio",
    subcategoria: "Supermercado y víveres",
    descripcion: "Supermercado de barrio con productos frescos, abarrotes, aseo y licores. Atención de lunes a domingo y servicio de domicilio dentro del casco urbano.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Carrera 20 # 15-30, Tame, Arauca",
    lat: 6.4648, lng: -71.7312,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/ficticias/supermercado-el-llanero-logo.svg",
    imagenes: ["imagenes/ficticias/supermercado-el-llanero.svg"],
    calificacion: 0, resenas: 0,
    servicios: ["Frutas y verduras", "Carnes y lácteos", "Abarrotes", "Productos de aseo", "Domicilios"],
    ficticia: true
  },
  {
    id: "asadero-sabor-llanero",
    nombre: "Asadero Sabor Llanero",
    categoria: "restaurantes",
    subcategoria: "Comida típica llanera",
    descripcion: "Restaurante de comida típica llanera: carne a la llanera, mamona, hallacas y jugos naturales. Ambiente familiar con música en vivo los fines de semana.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Calle 14 # 18-22, Tame, Arauca",
    lat: 6.4612, lng: -71.7351,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/ficticias/asadero-sabor-llanero-logo.svg",
    imagenes: ["imagenes/ficticias/asadero-sabor-llanero.svg"],
    calificacion: 0, resenas: 0,
    servicios: ["Carne a la llanera", "Mamona", "Almuerzos ejecutivos", "Eventos y celebraciones", "Domicilios"],
    ficticia: true
  },
  {
    id: "aventuras-rio-tame",
    nombre: "Aventuras Río Tame Ecoturismo",
    categoria: "turismo",
    subcategoria: "Ecoturismo y paseos",
    descripcion: "Agencia local de ecoturismo que organiza paseos de río, caminatas ecológicas, avistamiento de aves y excursiones de un día por el piedemonte llanero.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Vía al río, Tame, Arauca",
    lat: 6.466, lng: -71.7365,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/ficticias/aventuras-rio-tame-logo.svg",
    imagenes: ["imagenes/ficticias/aventuras-rio-tame.svg"],
    calificacion: 0, resenas: 0,
    servicios: ["Paseos de río", "Caminatas ecológicas", "Avistamiento de aves", "Planes de un día", "Guías locales"],
    ficticia: true
  },
  {
    id: "hotel-casa-real-tame",
    nombre: "Hotel Casa Real Tame",
    categoria: "hoteles",
    subcategoria: "Hotel",
    descripcion: "Hotel céntrico con habitaciones con aire acondicionado, wifi, parqueadero y desayuno incluido. Ideal para viajeros de negocios y turistas.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Carrera 19 # 12-10, Tame, Arauca",
    lat: 6.463, lng: -71.7298,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/ficticias/hotel-casa-real-tame-logo.svg",
    imagenes: ["imagenes/ficticias/hotel-casa-real-tame.svg"],
    calificacion: 0, resenas: 0,
    servicios: ["Habitaciones con aire acondicionado", "Wifi", "Parqueadero", "Desayuno incluido", "Salón de eventos"],
    ficticia: true
  },
  {
    id: "agroindustrias-la-sabana",
    nombre: "Agroindustrias La Sabana",
    categoria: "agroindustrias",
    subcategoria: "Ganadería y lácteos",
    descripcion: "Empresa agroindustrial dedicada a la ganadería de doble propósito y la producción de queso, cuajada y leche pasteurizada de la región.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Vereda La Sabana, Tame, Arauca",
    lat: 6.459, lng: -71.733,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/ficticias/agroindustrias-la-sabana-logo.svg",
    imagenes: ["imagenes/ficticias/agroindustrias-la-sabana.svg"],
    calificacion: 0, resenas: 0,
    servicios: ["Queso llanero", "Cuajada", "Leche pasteurizada", "Venta de ganado", "Asesoría agropecuaria"],
    ficticia: true
  },
  {
    id: "servicios-publicos-tame-unidos",
    nombre: "Servicios Públicos Tame Unidos",
    categoria: "servicios-publicos",
    subcategoria: "Acueducto y aseo",
    descripcion: "Entidad prestadora de servicios públicos de acueducto, alcantarillado y aseo para el casco urbano. Atención de peticiones, quejas y reclamos en oficina.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Calle 16 # 17-05, Tame, Arauca",
    lat: 6.464, lng: -71.7345,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/ficticias/servicios-publicos-tame-unidos-logo.svg",
    imagenes: ["imagenes/ficticias/servicios-publicos-tame-unidos.svg"],
    calificacion: 0, resenas: 0,
    servicios: ["Acueducto", "Alcantarillado", "Recolección de basuras", "Atención de PQR", "Nuevas conexiones"],
    ficticia: true
  },
  {
    id: "soluciones-tecnicas-araucanas",
    nombre: "Soluciones Técnicas Araucanas",
    categoria: "servicios",
    subcategoria: "Mantenimiento y reparaciones",
    descripcion: "Servicios técnicos para el hogar y la empresa: electricidad, plomería, aires acondicionados, mantenimiento locativo y reparación de electrodomésticos.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Carrera 22 # 10-40, Tame, Arauca",
    lat: 6.4605, lng: -71.729,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/ficticias/soluciones-tecnicas-araucanas-logo.svg",
    imagenes: ["imagenes/ficticias/soluciones-tecnicas-araucanas.svg"],
    calificacion: 0, resenas: 0,
    servicios: ["Electricidad", "Plomería", "Aires acondicionados", "Reparación de electrodomésticos", "Mantenimiento locativo"],
    ficticia: true
  },
  {
    id: "dulce-nutria-reposteria",
    nombre: "Dulce Nutria Repostería",
    categoria: "emprendimientos",
    subcategoria: "Repostería artesanal",
    descripcion: "Emprendimiento familiar de repostería artesanal: tortas personalizadas, cupcakes, galletas decoradas y postres para cumpleaños y eventos.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Barrio Centro, Tame, Arauca",
    lat: 6.4672, lng: -71.733,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/ficticias/dulce-nutria-reposteria-logo.svg",
    imagenes: ["imagenes/ficticias/dulce-nutria-reposteria.svg"],
    calificacion: 0, resenas: 0,
    servicios: ["Tortas personalizadas", "Cupcakes", "Galletas decoradas", "Postres para eventos", "Pedidos por encargo"],
    ficticia: true
  },
  {
    id: "primrose",
    nombre: "Primrose",
    categoria: "comercio",
    subcategoria: "Accesorios para el cabello y belleza",
    descripcion: "Tienda de accesorios para el cabello y artículos de belleza en Tame: ganchos, pinzas, caimanes y scrunchies de muchos estilos y colores, mascarillas faciales y cosméticos, en un local lleno de color.",
    whatsapp: "",
    telefono: "",
    correo: "",
    direccion: "Tame, Arauca",
    lat: 6.4640, lng: -71.7328,
    redes: { facebook: "", instagram: "", tiktok: "https://www.tiktok.com/@primrosetame", whatsapp: "" },
    logo: "imagenes/primrose/primrose-logo.jpg",
    imagenes: [
      "imagenes/primrose/primrose-ganchos.jpg",
      "imagenes/primrose/primrose-tienda.jpg",
      "imagenes/primrose/primrose-flor.jpg",
      "imagenes/primrose/primrose-estrellas.jpg",
      "imagenes/primrose/primrose-mascarillas.jpg"
    ],
    calificacion: 0, resenas: 0,
    servicios: [
      "Ganchos, pinzas y caimanes para el cabello",
      "Scrunchies y accesorios infantiles",
      "Mascarillas faciales",
      "Cosméticos y artículos de belleza"
    ]
  },
  {
    id: "caribabare-esp",
    nombre: "Caribabare E.S.P.",
    categoria: "servicios-publicos",
    subcategoria: "Empresa de servicios públicos",
    descripcion: "Caribabare E.S.P. es la empresa de servicios públicos de Tame, Arauca. Opera la planta de tratamiento y atiende a los usuarios del municipio desde su sede en el centro.",
    whatsapp: "",
    telefono: "",
    correo: "",
    sitioWeb: "https://caribabare.gov.co/esp/",
    direccion: "Tame, Arauca",
    lat: 6.4650, lng: -71.7340,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/caribabare/caribabare-logo.jpg",
    imagenes: [
      "imagenes/caribabare/caribabare-sede.jpg",
      "imagenes/caribabare/caribabare-planta.jpg"
    ],
    calificacion: 0, resenas: 0,
    servicios: ["Acueducto", "Alcantarillado", "Aseo", "Atención al usuario"]
  },
  {
    id: "hotel-tame-real",
    nombre: "Hotel Tame Real",
    categoria: "hoteles",
    subcategoria: "Hotel",
    descripcion: "Hotel en Tame, Arauca, con habitaciones con aire acondicionado alrededor de un patio interior lleno de plantas. Recepción en el primer piso y ambiente tranquilo para descansar.",
    whatsapp: "",
    telefono: "",
    correo: "",
    sitioWeb: "https://www.booking.com/hotel/co/tame-real.es.html",
    direccion: "Tame, Arauca",
    lat: 6.4638, lng: -71.7336,
    redes: { facebook: "", instagram: "", whatsapp: "" },
    logo: "imagenes/tame-real/tame-real-logo.jpg",
    imagenes: [
      "imagenes/tame-real/tame-real-patio.jpg",
      "imagenes/tame-real/tame-real-recepcion.jpg",
      "imagenes/tame-real/tame-real-habitacion.jpg"
    ],
    calificacion: 0, resenas: 0,
    servicios: ["Habitaciones con aire acondicionado", "Recepción", "Patio interior con jardín"]
  },
];

/* ---- Capa de datos ----
   Con el hosting (PHP + MySQL) las empresas llegan de api/empresas.php
   (window.EMPRESAS_DB). Si se abre el sitio sin PHP (en el computador),
   se usan las empresas de ejemplo de EMPRESAS_SEED. */
function _lista() { return window.MODO_PHP ? (window.EMPRESAS_DB || []) : EMPRESAS_SEED; }
const DB = {
  all() { return _lista(); },
  byCategoria(slug) { return _lista().filter(e => e.categoria === slug); },
  getById(id) { return _lista().find(e => String(e.id) === String(id)); },
};
