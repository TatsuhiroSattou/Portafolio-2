<?php
// AppSec: bloquea el acceso directo a esta vista sin pasar por el controlador.
defined('APP_INICIADA') || die('Acceso directo no permitido.');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Solicitar servicio — VACT Security</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/estilos.css" />
</head>
<body>

  <div class="pagina">
    <a href="../index.php" class="volver">← Volver al inicio</a>

    <div class="tarjeta">
      <div class="tarjeta-header">
        <div class="icono-circulo">🛡️</div>
        <h1>Solicita tu servicio de ciberseguridad</h1>
        <p class="tarjeta-subtitulo">Bug Bounty · Red Team · Blue Team · Auditorías</p>
      </div>

      <?php if (!empty($mensaje)): ?>
        <div class="mensaje mensaje-<?= htmlspecialchars($tipoMensaje ?? 'info') ?>">
          <?= htmlspecialchars($mensaje) ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($servicioElegido) && empty($mensaje)): ?>
        <div class="resumen-seleccion">
          🛒 Estás solicitando: <strong><?= htmlspecialchars($servicioElegido) ?></strong>
        </div>
      <?php endif; ?>

      <form id="form-solicitud" action="SolicitudController.php" method="POST" novalidate>
        <input type="hidden" name="accion" value="guardar" />

        <div class="campo">
          <label for="nombre"><span class="campo-icono campo-icono-teal">👤</span> Nombre completo</label>
          <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" />
          <span class="error" id="error-nombre"></span>
        </div>

        <div class="campo">
          <label for="correo"><span class="campo-icono campo-icono-azul">✉️</span> Correo electrónico</label>
          <input type="email" id="correo" name="correo" placeholder="tucorreo@empresa.com" />
          <span class="error" id="error-correo"></span>
        </div>

        <div class="campo">
          <label for="empresa"><span class="campo-icono campo-icono-morado">🏢</span> Empresa (opcional)</label>
          <input type="text" id="empresa" name="empresa" placeholder="Nombre de tu empresa" />
        </div>

        <div class="campo">
          <label for="servicio"><span class="campo-icono campo-icono-rojo">🎯</span> Servicio que necesitas</label>
          <select id="servicio" name="servicio">
            <option value="">Selecciona un servicio</option>
            <?php
              $opcionesServicio = [
                  'Bug Bounty' => 'Bug Bounty — Programa de recompensas',
                  'Red Team' => 'Red Team — Simulación de ataque real',
                  'Blue Team' => 'Blue Team — Defensa y monitoreo',
                  'Auditoría de Seguridad' => 'Auditoría de Seguridad / Pentesting',
                  'Respuesta a Incidentes' => 'Respuesta a Incidentes',
                  'Capacitación' => 'Capacitación en Ciberseguridad',
              ];
              foreach ($opcionesServicio as $valor => $etiqueta):
                $seleccionado = (($servicioElegido ?? '') === $valor) ? ' selected' : '';
            ?>
              <option value="<?= htmlspecialchars($valor) ?>"<?= $seleccionado ?>><?= htmlspecialchars($etiqueta) ?></option>
            <?php endforeach; ?>
          </select>
          <span class="error" id="error-servicio"></span>
        </div>

        <div class="campo">
          <label for="alcance"><span class="campo-icono campo-icono-amarillo">📝</span> Cuéntanos el alcance</label>
          <textarea id="alcance" name="alcance" rows="4" placeholder="¿Qué sistemas, apps o infraestructura quieres evaluar o proteger? Danos el mayor detalle posible."></textarea>
          <span class="error" id="error-alcance"></span>
        </div>

        <div class="campo">
          <label for="presupuesto"><span class="campo-icono campo-icono-teal">💵</span> Presupuesto estimado (opcional)</label>
          <input type="text" id="presupuesto" name="presupuesto" placeholder="Ej: 1500" inputmode="decimal" />
          <span class="error" id="error-presupuesto"></span>
        </div>

        <div class="campo">
          <label for="urgencia"><span class="campo-icono campo-icono-rojo">⏱️</span> Urgencia</label>
          <select id="urgencia" name="urgencia">
            <option value="">Selecciona la urgencia</option>
            <option value="Baja">Baja — sin apuro, planificando</option>
            <option value="Media">Media — próximas semanas</option>
            <option value="Alta">Alta — cuanto antes</option>
            <option value="Crítica">Crítica — incidente en curso</option>
          </select>
          <span class="error" id="error-urgencia"></span>
        </div>

        <button type="submit">🚀 Enviar solicitud</button>
      </form>

      <a href="SolicitudController.php?accion=listar" class="enlace-secundario">Ver solicitudes recibidas →</a>
    </div>
  </div>

  <script src="../js/script.js"></script>
</body>
</html>
