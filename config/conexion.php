<?php
/**
 * config/conexion.php
 *
 * Archivo independiente de conexión a MySQL (requisito #4 del deber).
 * Usuario root sin clave, como se indica en la consigna.
 *
 * AppSec: usamos mysqli con sentencias preparadas en el Modelo
 * (nunca concatenamos datos del usuario directo en el SQL), lo que
 * mitiga OWASP A03:2021 - Injection (SQL Injection).
 */

$host = 'localhost';
$usuario = 'root';
$clave = '';
$baseDeDatos = 'integradora';

$conexion = new mysqli($host, $usuario, $clave, $baseDeDatos);

if ($conexion->connect_error) {
    die('Error de conexión a la base de datos: ' . $conexion->connect_error);
}

$conexion->set_charset('utf8mb4');
