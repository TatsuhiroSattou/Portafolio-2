/**
 * js/script.js
 * Validaciones del formulario de solicitud de servicios de ciberseguridad.
 *
 * Requisitos cubiertos:
 *   - Campos vacíos (nombre, correo, servicio, alcance, urgencia)
 *   - Campo numérico (presupuesto, si se ingresa)
 *   - Longitud de datos (nombre mínimo 3, alcance mínimo 20 caracteres)
 *   - Valores incorrectos (presupuesto negativo)
 *   - Correo electrónico (formato válido)
 *
 * AppSec: esta validación es solo de UX. El servidor (controllers/
 * SolicitudController.php) SIEMPRE repite estas validaciones antes de
 * tocar la base de datos, porque JavaScript puede desactivarse o la
 * petición puede enviarse directamente sin pasar por el navegador.
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {
  var formulario = document.getElementById('form-solicitud');
  if (!formulario) return;

  formulario.addEventListener('submit', function (evento) {
    limpiarErrores();

    var nombre = document.getElementById('nombre').value.trim();
    var correo = document.getElementById('correo').value.trim();
    var servicio = document.getElementById('servicio').value;
    var alcance = document.getElementById('alcance').value.trim();
    var presupuesto = document.getElementById('presupuesto').value.trim();
    var urgencia = document.getElementById('urgencia').value;

    var formularioValido = true;

    // Campo vacío + longitud mínima
    if (nombre === '') {
      mostrarError('nombre', 'Tu nombre es obligatorio.');
      formularioValido = false;
    } else if (nombre.length < 3) {
      mostrarError('nombre', 'El nombre debe tener al menos 3 caracteres.');
      formularioValido = false;
    }

    // Campo vacío + formato de correo electrónico
    var patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (correo === '') {
      mostrarError('correo', 'El correo electrónico es obligatorio.');
      formularioValido = false;
    } else if (!patronCorreo.test(correo)) {
      mostrarError('correo', 'Ingresa un correo electrónico válido.');
      formularioValido = false;
    }

    // Campo vacío (select)
    if (servicio === '') {
      mostrarError('servicio', 'Selecciona el servicio que necesitas.');
      formularioValido = false;
    }

    // Campo vacío + longitud mínima
    if (alcance === '') {
      mostrarError('alcance', 'Cuéntanos brevemente qué necesitas.');
      formularioValido = false;
    } else if (alcance.length < 20) {
      mostrarError('alcance', 'Danos un poco más de detalle (mínimo 20 caracteres).');
      formularioValido = false;
    }

    // Campo numérico opcional: si se llena, debe ser válido y no negativo
    if (presupuesto !== '' && (isNaN(presupuesto) || Number(presupuesto) < 0)) {
      mostrarError('presupuesto', 'El presupuesto debe ser un número válido.');
      formularioValido = false;
    }

    // Campo vacío (select)
    if (urgencia === '') {
      mostrarError('urgencia', 'Selecciona el nivel de urgencia.');
      formularioValido = false;
    }

    if (!formularioValido) {
      evento.preventDefault();
    }
  });

  function mostrarError(idCampo, mensaje) {
    var contenedorError = document.getElementById('error-' + idCampo);
    if (contenedorError) {
      contenedorError.textContent = mensaje;
    }
  }

  function limpiarErrores() {
    document.querySelectorAll('.error').forEach(function (elemento) {
      elemento.textContent = '';
    });
  }
});
