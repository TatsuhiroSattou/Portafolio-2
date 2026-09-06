<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VACT Security — Tienda de Servicios</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/estilos.css" />
</head>
<body>

  <header class="site-header">
    <div class="term-bar">
      <span class="dot dot-r"></span>
      <span class="dot dot-y"></span>
      <span class="dot dot-g"></span>
      <span class="term-path">vact@security-shop:~$</span>
    </div>

    <div class="header-inner">
      <div class="brand">
        <span class="brand-name">VACT Security</span>
        <span class="brand-role">Bug Bounty · Red Team · Blue Team · Auditorías</span>
      </div>

      <nav class="main-nav" aria-label="Navegación principal">
        <ul>
          <li><a href="#catalogo">cd /catalogo</a></li>
          <li><a href="controllers/SolicitudController.php?accion=listar">cd /solicitudes</a></li>
          <li><a href="https://github.com/TatsuhiroSattou" target="_blank" rel="noopener noreferrer">cd /portafolio</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>

    <!-- ===== HERO ===== -->
    <section class="hero">
      <div class="hero-terminal">
        <p class="line"><span class="prompt">$</span> catalogo --listar-servicios</p>
        <h1 class="typed-name">Servicios de Ciberseguridad Ofensiva &amp; Defensiva</h1>
        <p class="line output">Elige un servicio del catálogo y solicita tu cotización.
          Reportes reales reconocidos por <span class="highlight">Lenovo</span>,
          <span class="highlight">NASA</span> y <span class="highlight">Harvard</span>.</p>
        <p class="line"><span class="prompt">$</span> <span class="cursor">_</span></p>
      </div>
    </section>

    <!-- ===== CATÁLOGO / TIENDA ===== -->
    <section id="catalogo" class="tienda">
      <h2><span class="tag">01</span> Catálogo de servicios</h2>
      <p class="tienda-intro">
        Cada servicio se cotiza según el alcance de tu proyecto. Elige uno para
        continuar con tu solicitud — es como agregarlo al carrito, pero en vez de
        un envío, te contactamos para coordinar el trabajo.
      </p>

      <div class="tienda-grid">

        <article class="producto-card">
          <div class="producto-icono">🐞</div>
          <span class="producto-etiqueta producto-etiqueta--critico">Más solicitado</span>
          <h3>Bug Bounty</h3>
          <p class="producto-desc">
            Programa de recompensas para encontrar vulnerabilidades reales en tus
            aplicaciones antes que un atacante lo haga.
          </p>
          <div class="producto-precio">Desde <strong>$500</strong></div>
          <a href="controllers/SolicitudController.php?accion=formulario&amp;servicio=Bug+Bounty" class="producto-boton">
            🛒 Solicitar cotización
          </a>
        </article>

        <article class="producto-card">
          <div class="producto-icono">🗡️</div>
          <span class="producto-etiqueta producto-etiqueta--alto">Avanzado</span>
          <h3>Red Team</h3>
          <p class="producto-desc">
            Simulación de ataques dirigidos y realistas para poner a prueba tus
            defensas técnicas, humanas y de proceso.
          </p>
          <div class="producto-precio">Desde <strong>$2,500</strong></div>
          <a href="controllers/SolicitudController.php?accion=formulario&amp;servicio=Red+Team" class="producto-boton">
            🛒 Solicitar cotización
          </a>
        </article>

        <article class="producto-card">
          <div class="producto-icono">🛡️</div>
          <span class="producto-etiqueta producto-etiqueta--medio">Continuo</span>
          <h3>Blue Team</h3>
          <p class="producto-desc">
            Monitoreo, detección y respuesta ante incidentes — fortalecemos tu
            capacidad de defender la infraestructura en tiempo real.
          </p>
          <div class="producto-precio">Desde <strong>$800</strong>/mes</div>
          <a href="controllers/SolicitudController.php?accion=formulario&amp;servicio=Blue+Team" class="producto-boton">
            🛒 Solicitar cotización
          </a>
        </article>

        <article class="producto-card">
          <div class="producto-icono">🔍</div>
          <span class="producto-etiqueta producto-etiqueta--medio">Puntual</span>
          <h3>Auditoría de Seguridad</h3>
          <p class="producto-desc">
            Evaluaciones a fondo de seguridad en aplicaciones web, redes e
            infraestructura, con reportes claros y accionables.
          </p>
          <div class="producto-precio">Desde <strong>$600</strong></div>
          <a href="controllers/SolicitudController.php?accion=formulario&amp;servicio=Auditoría+de+Seguridad" class="producto-boton">
            🛒 Solicitar cotización
          </a>
        </article>

        <article class="producto-card">
          <div class="producto-icono">🚨</div>
          <span class="producto-etiqueta producto-etiqueta--critico">Urgente</span>
          <h3>Respuesta a Incidentes</h3>
          <p class="producto-desc">
            ¿Ya tienes un incidente de seguridad activo? Actuamos rápido para
            contener, investigar y recuperar tus sistemas.
          </p>
          <div class="producto-precio">Cotización inmediata</div>
          <a href="controllers/SolicitudController.php?accion=formulario&amp;servicio=Respuesta+a+Incidentes" class="producto-boton">
            🛒 Solicitar cotización
          </a>
        </article>

        <article class="producto-card">
          <div class="producto-icono">🎓</div>
          <span class="producto-etiqueta producto-etiqueta--bajo">Formación</span>
          <h3>Capacitación</h3>
          <p class="producto-desc">
            Talleres y capacitaciones en ciberseguridad para tu equipo técnico o
            no técnico, adaptados a su nivel.
          </p>
          <div class="producto-precio">Desde <strong>$300</strong></div>
          <a href="controllers/SolicitudController.php?accion=formulario&amp;servicio=Capacitación" class="producto-boton">
            🛒 Solicitar cotización
          </a>
        </article>

      </div>
    </section>

  </main>

  <footer class="site-footer">
    <p>VACT Security © 2026</p>
    <a href="controllers/SolicitudController.php?accion=listar">Panel de solicitudes</a>
    <a href="https://github.com/TatsuhiroSattou" target="_blank" rel="noopener noreferrer">github.com/TatsuhiroSattou</a>
  </footer>

</body>
</html>
