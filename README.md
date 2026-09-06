# Actividad Integradora 3 — VACT Security (PHP + MySQL + MVC)

## Descripción
Aplicación web para gestionar solicitudes de servicios de ciberseguridad
(**Bug Bounty, Red Team, Blue Team, Auditorías / Pentesting, Respuesta a
Incidentes y Capacitación**), desarrollada con HTML, CSS, JavaScript, PHP
y MySQL, siguiendo el patrón **MVC (Modelo - Vista - Controlador)**.

Un cliente potencial llena el formulario en la landing page, la solicitud
queda guardada en la base de datos, y desde el panel de "Solicitudes
recibidas" se puede consultar, buscar y gestionar cada una.

Flujo de la aplicación: **Vista → Controlador → Modelo → Base de datos**

## Estructura del proyecto
```
actividad-integradora-3/
├── index.php                          (landing de servicios)
├── config/
│   └── conexion.php
├── controllers/
│   └── SolicitudController.php
├── models/
│   └── Solicitud.php
├── views/
│   └── solicitudes/
│       ├── crear.php                  (formulario de solicitud)
│       └── listar.php                 (panel de solicitudes)
├── css/
│   └── estilos.css
├── js/
│   └── script.js
└── sql/
    └── integradora.sql
```

## Base de datos
- **Nombre:** `integradora`
- **Tabla principal:** `solicitudes` (id, nombre, correo, empresa,
  servicio, alcance, presupuesto, urgencia, estado, creado_en)
- El script `sql/integradora.sql` crea la base de datos, la tabla y dos
  solicitudes de ejemplo.

## Instalación (XAMPP / WAMP / Laragon)
1. Copia la carpeta `actividad-integradora-3` dentro de tu carpeta de
   servidor local (por ejemplo `htdocs` en XAMPP, o `www` en WAMP/Laragon).
2. Abre phpMyAdmin e importa el archivo `sql/integradora.sql` — esto crea
   la base `integradora` y la tabla `solicitudes` automáticamente.
3. Verifica que `config/conexion.php` tenga los datos correctos:
   usuario `root`, sin clave, base `integradora`.
4. Abre `http://localhost/actividad-integradora-3/` en el navegador.

## Funcionalidades
- **Landing de servicios:** presenta Bug Bounty, Red Team, Blue Team y
  Auditorías, con botón para solicitar servicio.
- **Formulario de solicitud:** nombre, correo, empresa (opcional),
  servicio, alcance del proyecto, presupuesto estimado (opcional) y
  urgencia.
- **Validaciones con JavaScript** (`js/script.js`): campos vacíos, campo
  numérico (presupuesto), longitud mínima (nombre, alcance), valores
  incorrectos (presupuesto negativo), y **formato de correo electrónico**.
- **Panel de solicitudes recibidas:** tabla con todas las solicitudes,
  con búsqueda por nombre, empresa o servicio, y opción de eliminar.

## Organización MVC
- **Modelo** (`models/Solicitud.php`): única capa que habla con MySQL
  (INSERT, SELECT, DELETE, UPDATE) mediante sentencias preparadas.
- **Vista** (`views/solicitudes/`): solo HTML + PHP para mostrar datos,
  sin lógica de negocio ni SQL.
- **Controlador** (`controllers/SolicitudController.php`): recibe la
  acción (`formulario`, `guardar`, `listar`, `eliminar`), valida en el
  servidor y decide qué vista mostrar con qué datos.

## AppSec — buenas prácticas aplicadas
- **SQL Injection (OWASP A03:2021):** todas las consultas usan sentencias
  preparadas (`prepare` + `bind_param`), nunca concatenación de strings.
- **XSS (OWASP A03:2021):** todo dato mostrado en las vistas pasa por
  `htmlspecialchars()` antes de imprimirse.
- **Validación doble:** JavaScript valida en el navegador (UX), pero el
  controlador **repite siempre** la validación en el servidor —
  incluyendo el correo con `filter_var(..., FILTER_VALIDATE_EMAIL)` — ya
  que nunca se debe confiar solo en el JavaScript del cliente (OWASP
  A04:2021).
- **Control de acceso a archivos (OWASP A01:2021):** las vistas rechazan
  ser abiertas directamente por URL; solo responden si la petición pasó
  por el controlador (`defined('APP_INICIADA')`).

## Autor
Victor Andre Chiquito Toro
