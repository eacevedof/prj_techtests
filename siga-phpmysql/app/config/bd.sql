-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2019 a las 08:18:32
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_productos`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_01`
--
CREATE TABLE `productos_01` (
    `id` INT(6) UNSIGNED NOT NULL,
    `nombre` VARCHAR(160) DEFAULT NULL,
    `descripcion` VARCHAR(258) DEFAULT NULL,
    `imagen` LONGBLOB
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

CREATE TABLE `categorias` (
    `id` INT(6) UNSIGNED NOT NULL,
    `nombre` VARCHAR(160) DEFAULT NULL,
    `descripcion` VARCHAR(258) DEFAULT NULL
) ENGINE=MYISAM DEFAULT CHARSET=utf8;
--
-- Índices para tablas volcadas
--
ALTER TABLE `categorias` ADD PRIMARY KEY (`id`);
--
-- Indices de la tabla `productos_01`
--
ALTER TABLE `productos_01` ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT de las tablas volcadas
--
ALTER TABLE productos_01 ADD COLUMN categoria_id INT(6) AFTER imagen;
ALTER TABLE `categorias` MODIFY `id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos_01`
--
ALTER TABLE `productos_01` MODIFY `id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
