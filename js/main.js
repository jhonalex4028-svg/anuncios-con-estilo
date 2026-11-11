/* =========================================================
   ANUNCIOS CON ESTILOS — utilidades compartidas del sitio
========================================================= */

/* Si el usuario no esta registrado, "Ver más" lo manda a registrarse */
function urlEmpresa(id) {
  const destino = "empresa.html?id=" + encodeURIComponent(id);
  if (window.MODO_PHP && !window.USUARIO_ACTUAL) return "registro.html?next=" + encodeURIComponent(destino);
  return destino;
}

function catInfo(slug) {
  return CATEGORIAS.find(c => c.slug === slug) || { nombre: slug, color: "#F5A623", icono: "bi-shop" };
}

function renderNavbar(activePage = "") {
  const links = [
    { href: "index.html", label: "Inicio", key: "inicio" },
    { href: "buscar.html", label: "Empresas", key: "empresas" },
    { href: "categorias.html", label: "Categorías", key: "categorias" },
    { href: "mapa.html", label: "Mapa", key: "mapa" },
  ];
  const html = `
  <div class="topbar-llano">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-1">
      <span><i class="bi bi-geo-alt-fill me-1"></i>Tame, Arauca <span class="sep oculto-movil">✦</span><span class="oculto-movil">Cuna de la Libertad</span></span>
      <span><a href="mailto:anunciosconestilo@gmail.com" class="oculto-movil"><i class="bi bi-envelope me-1"></i>anunciosconestilo@gmail.com</a><span class="sep oculto-movil">✦</span><a href="https://wa.me/573228728537" target="_blank"><i class="bi bi-whatsapp me-1"></i>322 872 8537</a></span>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-aces sticky-top py-2">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
        <img src="imagenes/logo.png" alt="Anuncios con Estilos">
        <span class="brand-text"><strong>Anuncios</strong><span>con Estilos</span></span>
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <i class="bi bi-list fs-1 text-primary-brand"></i>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto gap-lg-2">
          ${links.map(l => `<li class="nav-item"><a class="nav-link ${activePage===l.key?'active fw-semibold':''}" href="${l.href}">${l.label}</a></li>`).join("")}
        </ul>
        <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
          <button class="icon-search-btn" onclick="window.location.href='buscar.html'"><i class="bi bi-search"></i></button>
          ${window.MODO_PHP ? (window.USUARIO_ACTUAL
            ? `<span class="small text-muted d-none d-lg-inline"><i class="bi bi-person-circle me-1"></i>${String(window.USUARIO_ACTUAL.nombres).replace(/[<>&"]/g,"")}</span><a class="btn btn-sm btn-outline-secondary" href="api/salir.php">Salir</a>`
            : `<a class="btn btn-sm btn-hero" href="registro.html">Registrarse</a>`) : ''}
        </div>
      </div>
    </div>
  </nav>`;
  document.getElementById("navbar-slot").innerHTML = html;
}

function renderFooter() {
  const html = `
  <footer class="footer-aces pt-5 pb-0 mt-5">
    <div class="container pb-4">
      <div class="row g-4">
        <div class="col-lg-4">
          <a href="index.html" class="d-flex align-items-center gap-2 mb-3 text-decoration-none">
            <img src="imagenes/logo.png" alt="logo" style="height:44px;width:44px;object-fit:contain">
            <span class="fw-bold text-white fs-5">Anuncios con Estilos</span>
          </a>
          <p>Tu región, tus empresas, tu estilo de vida. Conectamos el talento y los negocios locales con las personas que los buscan.</p>
        </div>
        <div class="col-lg-2 col-6">
          <h6>Enlaces rápidos</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="index.html">Inicio</a></li>
            <li class="mb-2"><a href="buscar.html">Empresas</a></li>
            <li class="mb-2"><a href="categorias.html">Categorías</a></li>
            <li class="mb-2"><a href="mapa.html">Mapa</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-6">
          <h6>Categorías</h6>
          <ul class="list-unstyled">
            ${CATEGORIAS.slice(0,6).map(c=>`<li class="mb-2"><a href="categoria.html?cat=${c.slug}">${c.nombre}</a></li>`).join("")}
          </ul>
        </div>
        <div class="col-lg-4">
          <h6>Contáctanos</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Tame, Arauca, Colombia</li>
            <li class="mb-2"><i class="bi bi-whatsapp me-2"></i>+57 322 872 8537</li>
            <li class="mb-2"><i class="bi bi-envelope me-2"></i><a href="mailto:anunciosconestilo@gmail.com">anunciosconestilo@gmail.com</a></li>
          </ul>
          <a href="https://wa.me/573228728537" target="_blank" class="btn btn-sm btn-hero mt-1"><i class="bi bi-whatsapp me-1"></i>Escríbenos por WhatsApp</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom text-center py-3">© 2026 Anuncios con Estilos. Todos los derechos reservados.</div>
  </footer>
  <a href="https://wa.me/573228728537" class="whatsapp-fab" target="_blank" title="Escríbenos por WhatsApp"><i class="bi bi-whatsapp"></i></a>
  `;
  document.getElementById("footer-slot").innerHTML = html;
}

function starsHtml(rating) {
  const full = Math.round(rating);
  let s = "";
  for (let i = 1; i <= 5; i++) s += `<i class="bi ${i<=full?'bi-star-fill':'bi-star'}"></i>`;
  return s;
}

function ratingBlockHtml(e, extraClass) {
  if (!e.resenas) return `<span class="text-muted small ${extraClass||''}">Aún sin calificaciones</span>`;
  return `<span class="${extraClass||''}">${starsHtml(e.calificacion)} <span class="text-muted fw-normal">(${e.resenas})</span></span>`;
}

function empresaCardHtml(e) {
  const cat = catInfo(e.categoria);
  const img = (e.imagenes && e.imagenes[0]) || "https://via.placeholder.com/400x240?text=" + encodeURIComponent(e.nombre);
  return `
  <div class="empresa-card">
    <div class="img-wrap">
      <img src="${img}" alt="${e.nombre}" loading="lazy">
    </div>
    <div class="card-body">
      <span class="cat-tag">${cat.nombre}</span>
      <h5>${e.nombre}</h5>
      <p class="desc">${(e.descripcion||"").substring(0,80)}${(e.descripcion||"").length>80?'...':''}</p>
      <div class="d-flex justify-content-between align-items-center mb-2">
        ${ratingBlockHtml(e, "rating")}
      </div>
      <div class="loc mb-3"><i class="bi bi-geo-alt me-1"></i>${e.direccion}</div>
      <a href="${urlEmpresa(e.id)}" class="btn btn-ver-mas">Ver más</a>
    </div>
  </div>`;
}

function empresaRowHtml(e) {
  const img = (e.imagenes && e.imagenes[0]) || "https://via.placeholder.com/120?text=" + encodeURIComponent(e.nombre);
  return `
  <div class="empresa-row">
    <img src="${img}" alt="${e.nombre}">
    <div class="info">
      <h6>${e.nombre}</h6>
      <p class="mb-1">${(e.descripcion||"").substring(0,90)}...</p>
      <div class="d-flex align-items-center gap-3 flex-wrap">
        <span class="loc"><i class="bi bi-geo-alt me-1"></i>${e.direccion}</span>
        ${ratingBlockHtml(e, "rating")}
        <span class="social-mini">
          ${e.redes?.facebook ? `<a href="${e.redes.facebook}" target="_blank"><i class="bi bi-facebook"></i></a>`:''}
          ${e.redes?.instagram ? `<a href="${e.redes.instagram}" target="_blank"><i class="bi bi-instagram"></i></a>`:''}
          ${e.redes?.whatsapp ? `<a href="${e.redes.whatsapp}" target="_blank"><i class="bi bi-whatsapp"></i></a>`:''}
        </span>
      </div>
    </div>
    <a href="${urlEmpresa(e.id)}" class="btn-detalle">Ver detalles</a>
  </div>`;
}

function initHeaderFooter(active) {
  renderNavbar(active);
  renderFooter();
}

function qs(name) {
  return new URLSearchParams(window.location.search).get(name);
}

/* ---- Mapa (Leaflet) con respaldo automático de proveedores ----
   Si un proveedor de mapas bloquea las teselas ("Access blocked",
   "Referer is required", etc.), se pasa solo al siguiente proveedor. */
const PROVEEDORES_MAPA = [
  { // 1) Esri: gratis, sin clave y sin exigir referer (funciona también abriendo el archivo en el PC)
    url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
    opts: { maxZoom: 19, attribution: 'Tiles &copy; Esri &mdash; Source: Esri, HERE, Garmin, OpenStreetMap contributors' }
  },
  { // 2) OpenStreetMap (funciona cuando el sitio está publicado con https)
    url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
    opts: { maxZoom: 19, referrerPolicy: 'strict-origin-when-cross-origin',
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>' }
  },
  { // 3) Esri Topográfico (último respaldo)
    url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}',
    opts: { maxZoom: 19, attribution: 'Tiles &copy; Esri' }
  }
];

function crearCapaMapa() {
  let idx = 0, errores = 0, cargadas = 0;
  const p = PROVEEDORES_MAPA[0];
  const capa = L.tileLayer(p.url, Object.assign({}, p.opts));
  capa.on('tileload', () => { cargadas++; });
  capa.on('tileerror', () => {
    errores++;
    // Si fallan varias teselas y casi ninguna carga, cambiamos de proveedor
    if (errores >= 4 && cargadas < 2 && idx < PROVEEDORES_MAPA.length - 1) {
      idx++; errores = 0; cargadas = 0;
      const n = PROVEEDORES_MAPA[idx];
      capa.options.attribution = n.opts.attribution;
      capa.options.subdomains = n.opts.subdomains || 'abc';
      capa.options.maxZoom = n.opts.maxZoom;
      capa.options.referrerPolicy = n.opts.referrerPolicy || false;
      capa.setUrl(n.url);
      if (capa._map && capa._map.attributionControl) {
        capa._map.attributionControl._attributions = {};
        capa._map.attributionControl.addAttribution(n.opts.attribution);
      }
    }
  });
  return capa;
}

function iconoMarcador(c, tam = 30) {
  return L.divIcon({
    html: `<div style="background:${c.color};width:${tam}px;height:${tam}px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);display:flex;align-items:center;justify-content:center;border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.3)"><i class="bi ${c.icono}" style="transform:rotate(45deg);color:#fff;font-size:${Math.round(tam*0.45)}px"></i></div>`,
    className: '', iconSize: [tam, tam], iconAnchor: [tam/2, tam]
  });
}

function popupEmpresa(e) {
  const c = catInfo(e.categoria);
  return `<div class="cat-tag-mini">${c.nombre}</div><h6>${e.nombre}</h6><p class="small mb-1">${e.direccion}</p><a href="${urlEmpresa(e.id)}" class="btn btn-sm btn-hero">Ver empresa</a>`;
}
