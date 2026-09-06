<?php
/**
 * controllers/SolicitudController.php
 *
 * Controlador: recibe las acciones del usuario (formulario, guardar,
 * listar, eliminar), valida en el servidor y coordina la comunicación
 * entre la Vista y el Modelo. No contiene SQL directo — eso vive en
 * models/Solicitud.php.
 *
 * Flujo del deber: Vista → Controlador → Modelo → Base de datos
 *
 * AppSec: la validación de JavaScript (js/script.js) es solo de UX.
 * Aquí repetimos SIEMPRE la validación en el servidor, porque
 * cualquier persona puede desactivar JavaScript o enviar la petición
 * directamente sin pasar por el formulario (OWASP A04:2021 - Insecure
 * Design / falta de validación server-side).
 */

// AppSec — OWASP A01:2021 (Broken Access Control): esta constante marca
// que la petición pasó por el controlador. Las vistas la exigen al
// principio para rechazar quien intente abrirlas directamente por URL.
define('APP_INICIADA', true);

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../models/Solicitud.php';

$solicitudModel = new Solicitud($conexion);

$accion = $_POST['accion'] ?? $_GET['accion'] ?? 'formulario';

switch ($accion) {

    case 'guardar':
        $nombre      = trim($_POST['nombre'] ?? '');
        $correo      = trim($_POST['correo'] ?? '');
        $empresa     = trim($_POST['empresa'] ?? '');
        $servicio    = trim($_POST['servicio'] ?? '');
        $alcance     = trim($_POST['alcance'] ?? '');
        $presupuesto = trim($_POST['presupuesto'] ?? '');
        $urgencia    = trim($_POST['urgencia'] ?? '');

        $errores = [];

        if ($nombre === '' || mb_strlen($nombre) < 3) {
            $errores[] = 'El nombre debe tener al menos 3 caracteres.';
        }

        if ($correo === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'Ingresa un correo electrónico válido.';
        }

        if ($servicio === '') {
            $errores[] = 'Selecciona el servicio que necesitas.';
        }

        if ($alcance === '' || mb_strlen($alcance) < 20) {
            $errores[] = 'Cuéntanos el alcance del proyecto (mínimo 20 caracteres).';
        }

        if ($presupuesto !== '' && (!is_numeric($presupuesto) || (float)$presupuesto < 0)) {
            $errores[] = 'El presupuesto debe ser un número válido (o dejarlo vacío).';
        }

        if ($urgencia === '') {
            $errores[] = 'Selecciona el nivel de urgencia.';
        }

        if (empty($errores)) {
            $guardadoOk = $solicitudModel->crear([
                'nombre'      => $nombre,
                'correo'      => $correo,
                'empresa'     => $empresa !== '' ? $empresa : null,
                'servicio'    => $servicio,
                'alcance'     => $alcance,
                'presupuesto' => $presupuesto !== '' ? (float)$presupuesto : null,
                'urgencia'    => $urgencia,
            ]);

            $mensaje     = $guardadoOk
                ? '¡Solicitud enviada! Te contactaremos pronto para coordinar el servicio.'
                : 'Ocurrió un error al enviar tu solicitud. Intenta de nuevo.';
            $tipoMensaje = $guardadoOk ? 'exito' : 'error';
        } else {
            $mensaje     = implode(' ', $errores);
            $tipoMensaje = 'error';
        }

        $servicioElegido = $servicio;
        require __DIR__ . '/../views/solicitudes/crear.php';
        break;

    case 'listar':
        $terminoBusqueda = trim($_GET['buscar'] ?? '');

        $solicitudes = $terminoBusqueda !== ''
            ? $solicitudModel->buscar($terminoBusqueda)
            : $solicitudModel->listarTodas();

        require __DIR__ . '/../views/solicitudes/listar.php';
        break;

    case 'eliminar':
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $solicitudModel->eliminar($id);
        }
        header('Location: SolicitudController.php?accion=listar');
        exit;

    case 'formulario':
    default:
        $mensaje          = null;
        $tipoMensaje      = null;
        $servicioElegido  = trim($_GET['servicio'] ?? '');
        require __DIR__ . '/../views/solicitudes/crear.php';
        break;
}
