-- =========================================================
-- Base de datos: integradora
-- Proyecto: VACT Security — Solicitudes de Servicios de Ciberseguridad
-- (Bug Bounty, Red Team, Blue Team, Auditorías)
-- =========================================================

CREATE DATABASE IF NOT EXISTS integradora
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE integradora;

CREATE TABLE IF NOT EXISTS solicitudes (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  nombre      VARCHAR(100)   NOT NULL,
  correo      VARCHAR(150)   NOT NULL,
  empresa     VARCHAR(120)   NULL,
  servicio    VARCHAR(60)    NOT NULL,
  alcance     TEXT           NOT NULL,
  presupuesto DECIMAL(10,2)  NULL,
  urgencia    VARCHAR(20)    NOT NULL,
  estado      VARCHAR(20)    NOT NULL DEFAULT 'Pendiente',
  creado_en   TIMESTAMP      DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Datos de ejemplo (opcional, se puede borrar)
INSERT INTO solicitudes (nombre, correo, empresa, servicio, alcance, presupuesto, urgencia, estado) VALUES
  ('Ana Torres', 'ana.torres@ejemplo.com', 'Ferretería del Pacífico', 'Bug Bounty',
   'Necesitamos un programa de bug bounty privado para nuestra plataforma de e-commerce.',
   1500.00, 'Media', 'Pendiente'),
  ('Carlos Vega', 'carlos.vega@ejemplo.com', 'FinTech Andina', 'Red Team',
   'Simulación de ataque dirigido contra nuestra infraestructura interna antes de una auditoría regulatoria.',
   5000.00, 'Alta', 'Contactado');
