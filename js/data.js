/* =========================================================
   ANUNCIOS CON ESTILOS — Datos del sitio
   Sitio 100% estático: no hay servidor ni base de datos.
   Los datos viven aquí mismo (CATEGORIAS y EMPRESAS_SEED).
   Cuando esté lista la base de datos en el hosting, estos datos
   se pueden reemplazar por consultas a esa base de datos.
========================================================= */

const CATEGORIAS = [
  { slug: "comercio",           nombre: "Comercio",           icono: "bi-basket3",        color: "#7B2FB5" },
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
];

/* ---- Capa de datos ----
   Por ahora lee las empresas de EMPRESAS_SEED. Cuando conectes tu
   base de datos en el hosting, solo hay que cambiar estas funciones. */
const DB = {
  all() { return EMPRESAS_SEED; },
  byCategoria(slug) { return EMPRESAS_SEED.filter(e => e.categoria === slug); },
  getById(id) { return EMPRESAS_SEED.find(e => e.id === id); },
};
