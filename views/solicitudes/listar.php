<?php
// AppSec: bloquea el acceso directo a esta vista sin pasar por el controlador.
defined('APP_INICIADA') || die('Acceso directo no permitido.');

// Mapeo seguro de urgencia -> clase CSS (evita tildes/caracteres raros en el atributo class)
$clasesUrgencia = [
    'Baja'     => 'baja',
    'Media'    => 'media',
    'Alta'     => 'alta',
    'Crítica'  => 'critica',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Solicitudes recibidas — VACT Security</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/estilos.css" />
</head>
<body>

  <div class="pagina">
    <a href="../index.php" class="volver">← Volver al inicio</a>

    <div class="tarjeta tarjeta-ancha">
      <div class="tarjeta-header tarjeta-header--tabla">
        <h1>🛡️ Solicitudes de servicio recibidas</h1>
        <a href="SolicitudController.php?accion=formulario" class="boton-nuevo">+ Nueva solicitud</a>
      </div>

      <form action="SolicitudController.php" method="GET" class="form-buscar">
        <input type="hidden" name="accion" value="listar" />
        <input
          type="text"
          name="buscar"
          placeholder="Buscar por nombre, empresa o servicio..."
          value="<?= htmlspecialchars($terminoBusqueda ?? '') ?>"
        />
        <button type="submit">Buscar</button>
      </form>

      <div class="tabla-wrap">
        <table class="tabla-productos">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Empresa</th>
              <th>Servicio</th>
              <th>Urgencia</th>
              <th>Presupuesto</th>
              <th>Estado</th>
              <th>Fecha</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($solicitudes)): ?>
              <tr>
                <td colspan="10" class="fila-vacia">No hay solicitudes registradas todavía.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                  <td><?= (int)$solicitud['id'] ?></td>
                  <td><?= htmlspecialchars($solicitud['nombre']) ?></td>
                  <td><?= htmlspecialchars($solicitud['correo']) ?></td>
                  <td><?= htmlspecialchars($solicitud['empresa'] ?? '—') ?></td>
                  <td>
                    <span class="etiqueta-servicio"><?= htmlspecialchars($solicitud['servicio']) ?></span>
                  </td>
                  <td>
                    <span class="etiqueta-urgencia etiqueta-urgencia--<?= $clasesUrgencia[$solicitud['urgencia']] ?? 'default' ?>">
                      <?= htmlspecialchars($solicitud['urgencia']) ?>
                    </span>
                  </td>
                  <td><?= $solicitud['presupuesto'] !== null ? '$' . number_format((float)$solicitud['presupuesto'], 2) : '—' ?></td>
                  <td><?= htmlspecialchars($solicitud['estado']) ?></td>
                  <td><?= htmlspecialchars(substr($solicitud['creado_en'], 0, 10)) ?></td>
                  <td>
                    <a
                      href="SolicitudController.php?accion=eliminar&id=<?= (int)$solicitud['id'] ?>"
                      class="boton-eliminar"
                      onclick="return confirm('¿Eliminar esta solicitud?');"
                    >🗑️</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
