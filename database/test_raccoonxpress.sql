-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2024 a las 04:54:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test_raccoonxpress`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL COMMENT 'Identificador de categoria',
  `title` varchar(64) NOT NULL COMMENT 'Titulo de la categoria',
  `description` varchar(160) NOT NULL COMMENT 'Descripción de la categoría',
  `creation_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de creación de la categoría',
  `created_by` int(11) NOT NULL COMMENT 'Usuario creador de la categoria',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Bandera de categoria activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL COMMENT 'Identificador de producto',
  `product_name` varchar(64) NOT NULL COMMENT 'Nombre del producto',
  `description` varchar(160) NOT NULL COMMENT 'Descripción del producto',
  `quotable` tinyint(1) NOT NULL COMMENT 'Bandera de producto cotizable',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'Precio del producto',
  `quantity` int(11) NOT NULL COMMENT 'Cantidad del producto',
  `active` tinyint(1) DEFAULT NULL COMMENT 'Bandera de producto activado',
  `approved_by` int(11) DEFAULT NULL COMMENT 'Identificador del usuario administrador quien aprovó el producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(11) NOT NULL COMMENT 'Identificador del producto',
  `category_id` int(11) NOT NULL COMMENT 'Identificador de la categoria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'Identificador de usuario',
  `email` varchar(64) NOT NULL COMMENT 'Correo electrónico del usuario',
  `username` varchar(32) NOT NULL COMMENT 'Nombre de usuario para la aplicación',
  `user_password` varchar(64) NOT NULL COMMENT 'Contraseña para el ingreso a la aplicación',
  `user_role` int(11) NOT NULL COMMENT 'Identificador del rol de usuario',
  `first_name` varchar(64) NOT NULL COMMENT 'Primer nombre real del usuario',
  `last_name` varchar(64) NOT NULL COMMENT 'Apellido real del usuario',
  `gender` int(11) NOT NULL COMMENT 'Género del usuario',
  `birth_date` date NOT NULL COMMENT 'Fecha de nacimiento del usuario',
  `visibility` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Visibilidad del perfil del usuario',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Bandera de usuario activo',
  `last_login_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'fecha del último ingreso al portal',
  `profile_image` blob DEFAULT NULL COMMENT 'Imagen del perfil del usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `fk_category_created_by_users` (`created_by`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_approved_by_users` (`approved_by`);

--
-- Indices de la tabla `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `fk_product_categories_category_id_categories` (`category_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de categoria';

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de producto';

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de usuario';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_category_created_by_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_approved_by_users` FOREIGN KEY (`approved_by`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `fk_product_categories_category_id_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `fk_product_categories_product_id_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
