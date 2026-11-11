/* =========================================================
   FUSIÓN — Efectos visuales (adaptados de "proyecto_fusion")
   Archivo ADICIONAL: no modifica js/main.js ni js/data.js
========================================================= */
(function () {
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  document.documentElement.classList.add('fx-js');

  /* ---- Fondo de página con desenfoque dinámico al hacer scroll ---- */
  function fondo() {
    if (document.querySelector('.fx-page-bg')) return;
    const d = document.createElement('div');
    d.className = 'fx-page-bg';
    d.innerHTML = '<img src="imagenes/fotos/porton-bienvenida-tame.jpg" alt="" aria-hidden="true">';
    document.body.insertBefore(d, document.body.firstChild);
    const g1 = document.createElement('div'); g1.className = 'fx-glow';
    const g2 = document.createElement('div'); g2.className = 'fx-glow-2';
    document.body.insertBefore(g2, document.body.firstChild);
    document.body.insertBefore(g1, document.body.firstChild);
    const img = d.querySelector('img');
    window.addEventListener('scroll', () => {
      const blur = Math.min(8, window.scrollY * 0.005);
      img.style.filter = `blur(${blur}px) contrast(1.2)`;
    }, { passive: true });
  }

  /* ---- Navbar: sombra/desenfoque al hacer scroll ---- */
  function onScroll() {
    const nav = document.querySelector('.navbar-aces');
    if (nav) nav.classList.toggle('fx-scrolled', window.scrollY > 40);
  }
  window.addEventListener('scroll', onScroll, { passive: true });

  /* ---- Revelado al hacer scroll (con escalonado) ---- */
  const io = 'IntersectionObserver' in window ? new IntersectionObserver((entries, obs) => {
    let n = 0;
    entries.forEach(en => {
      if (!en.isIntersecting) return;
      const el = en.target;
      setTimeout(() => el.classList.add('fx-in'), (n++) * 90);
      obs.unobserve(el);
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }) : null;

  function observar(el) {
    if (!el || el.dataset.fxSeen) return;
    el.dataset.fxSeen = '1';
    el.classList.add('fx-reveal');
    if (io) io.observe(el); else el.classList.add('fx-in');
  }

  function revelarTodo() {
    document.querySelectorAll(
      '.section-eyebrow, .cat-pill, .empresa-card, .empresa-row, .fx-stats, .fx-promo, .map-container, .lugar-card, .banner-llano, .titulo-bloque'
    ).forEach(observar);
  }

  /* ---- Luciérnagas en el hero (solo página de inicio) ---- */
  function luciernagas() {
    const hero = document.querySelector('.hero-slider');
    if (!hero || reduce || hero.querySelector('.fx-fireflies')) return;
    const box = document.createElement('div');
    box.className = 'fx-fireflies';
    for (let i = 0; i < 16; i++) {
      const f = document.createElement('div');
      f.className = 'fx-firefly';
      f.style.left = Math.random() * 100 + '%';
      f.style.top = (30 + Math.random() * 70) + '%';
      f.style.animationDelay = (Math.random() * 6) + 's';
      f.style.animationDuration = (6 + Math.random() * 4) + 's';
      box.appendChild(f);
    }
    hero.appendChild(box);
  }

  /* ---- Contadores animados ---- */
  function contar(el) {
    const meta = +el.dataset.target || 0;
    if (reduce || !meta) { el.textContent = meta; return; }
    let cur = 0;
    const paso = Math.max(1, Math.ceil(meta / 40));
    const t = setInterval(() => {
      cur += paso;
      if (cur >= meta) { cur = meta; clearInterval(t); }
      el.textContent = cur;
    }, 30);
  }
  function estadisticas() {
    const nums = document.querySelectorAll('.fx-stat-number');
    if (!nums.length) return;
    // Cifras reales tomadas de los datos del sitio
    try {
      const todas = (typeof DB !== 'undefined' && DB.all) ? DB.all() : [];
      const set = (id, v) => { const e = document.getElementById(id); if (e) e.dataset.target = v; };
      set('fxStatEmpresas', todas.length);
      set('fxStatCategorias', (typeof CATEGORIAS !== 'undefined') ? CATEGORIAS.length : 0);
      set('fxStatResenas', todas.reduce((a, e) => a + (+e.resenas || 0), 0));
    } catch (_) { /* si falla, quedan los valores por defecto del HTML */ }
    const fila = document.querySelector('.fx-stats');
    if (!fila || !io) { nums.forEach(contar); return; }
    const so = new IntersectionObserver((en, o) => {
      if (en[0].isIntersecting) { nums.forEach(contar); o.disconnect(); }
    }, { threshold: 0.4 });
    so.observe(fila);
  }

  /* ---- Inclinación 3D + brillo en tarjetas (delegación: sirve para tarjetas dinámicas) ---- */
  if (window.matchMedia('(hover: hover)').matches && !reduce) {
    document.addEventListener('mousemove', e => {
      const card = e.target.closest && e.target.closest('.empresa-card');
      if (!card) return;
      const r = card.getBoundingClientRect();
      const x = e.clientX - r.left, y = e.clientY - r.top;
      card.classList.add('fx-tilt');
      card.style.setProperty('--mx', x + 'px');
      card.style.setProperty('--my', y + 'px');
      const rx = ((y - r.height / 2) / (r.height / 2)) * -5;
      const ry = ((x - r.width / 2) / (r.width / 2)) * 5;
      card.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-4px)`;
    });
    document.addEventListener('mouseout', e => {
      const card = e.target.closest && e.target.closest('.empresa-card');
      if (card && !card.contains(e.relatedTarget)) card.style.transform = '';
    });
  }

  /* ---- Carrusel de recomendados ---- */
  function recomendados() {
    const wrap = document.querySelector('.reco-wrap');
    if (!wrap || wrap.dataset.ok) return;
    const tr = wrap.querySelector('.reco-track');
    if (!tr || !tr.children.length) return;
    wrap.dataset.ok = '1';
    const paso = () => Math.max(260, tr.clientWidth * 0.8);
    wrap.querySelector('.prev').addEventListener('click', () => tr.scrollBy({ left: -paso(), behavior: 'smooth' }));
    wrap.querySelector('.next').addEventListener('click', () => tr.scrollBy({ left: paso(), behavior: 'smooth' }));
    if (reduce) return;
    let pausa = false;
    wrap.addEventListener('mouseenter', () => pausa = true);
    wrap.addEventListener('mouseleave', () => pausa = false);
    wrap.addEventListener('touchstart', () => pausa = true, { passive: true });
    setInterval(() => {
      if (pausa) return;
      const fin = tr.scrollLeft + tr.clientWidth >= tr.scrollWidth - 8;
      tr.scrollTo({ left: fin ? 0 : tr.scrollLeft + 280, behavior: 'smooth' });
    }, 4500);
  }

  /* ---- Arranque: las tarjetas se pintan después, así que se vigila el DOM ---- */
  function iniciar() {
    fondo();
    onScroll();
    luciernagas();
    estadisticas();
    revelarTodo();
    recomendados();
    let pend = false;
    new MutationObserver(() => {
      if (pend) return; pend = true;
      requestAnimationFrame(() => { pend = false; onScroll(); revelarTodo(); recomendados(); });
    }).observe(document.body, { childList: true, subtree: true });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', iniciar);
  else iniciar();
})();
