<?php
/**
 * models/Solicitud.php
 *
 * Modelo: responsable ÚNICAMENTE de hablar con MySQL. No conoce nada
 * de HTML ni de $_POST/$_GET — esa responsabilidad es del Controlador.
 *
 * AppSec: todas las consultas usan sentencias preparadas (prepare +
 * bind_param) en vez de concatenar strings, para evitar SQL Injection
 * (OWASP A03:2021 - Injection).
 */

class Solicitud
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * Inserta una nueva solicitud de servicio.
     */
    public function crear(array $datos): bool
    {
        $sql = "INSERT INTO solicitudes (nombre, correo, empresa, servicio, alcance, presupuesto, urgencia)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param(
            'sssssds',
            $datos['nombre'],
            $datos['correo'],
            $datos['empresa'],
            $datos['servicio'],
            $datos['alcance'],
            $datos['presupuesto'],
            $datos['urgencia']
        );

        return $stmt->execute();
    }

    /**
     * Devuelve todas las solicitudes, de la más reciente a la más antigua.
     */
    public function listarTodas(): array
    {
        $resultado = $this->conexion->query("SELECT * FROM solicitudes ORDER BY id DESC");

        if (!$resultado) {
            return [];
        }

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Busca solicitudes por nombre, empresa o tipo de servicio
     * (funcionalidad opcional del deber).
     */
    public function buscar(string $termino): array
    {
        $sql = "SELECT * FROM solicitudes
                WHERE nombre LIKE CONCAT('%', ?, '%')
                   OR empresa LIKE CONCAT('%', ?, '%')
                   OR servicio LIKE CONCAT('%', ?, '%')
                ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            return [];
        }

        $stmt->bind_param('sss', $termino, $termino, $termino);
        $stmt->execute();

        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Actualiza el estado de una solicitud (Pendiente / Contactado /
     * En proceso / Cerrado) — funcionalidad opcional del deber.
     */
    public function actualizarEstado(int $id, string $estado): bool
    {
        $stmt = $this->conexion->prepare("UPDATE solicitudes SET estado = ? WHERE id = ?");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('si', $estado, $id);
        return $stmt->execute();
    }

    /**
     * Elimina una solicitud por su id (funcionalidad opcional del deber).
     */
    public function eliminar(int $id): bool
    {
        $stmt = $this->conexion->prepare("DELETE FROM solicitudes WHERE id = ?");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
