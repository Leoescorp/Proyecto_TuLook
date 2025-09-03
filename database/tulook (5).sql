-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-08-2025 a las 20:25:16
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
-- Base de datos: `tulook`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `ID_Articulo` int(11) NOT NULL,
  `N_Articulo` varchar(45) NOT NULL,
  `Foto` varchar(300) NOT NULL,
  `ID_Categoria` int(11) NOT NULL,
  `ID_SubCategoria` int(11) DEFAULT NULL,
  `ID_Genero` int(11) NOT NULL,
  `IdPrecio` int(11) NOT NULL,
  `Activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`ID_Articulo`, `N_Articulo`, `Foto`, `ID_Categoria`, `ID_SubCategoria`, `ID_Genero`, `IdPrecio`, `Activo`) VALUES
(2, 'Jeans blanco', 'ImgProducto/Hombre/Jeans/Jeans_blanco.png', 1, 1, 1, 1, 1),
(3, 'Jeans oscuro', 'ImgProducto/Hombre/Jeans/Jeans_oscuro.png', 1, 1, 1, 2, 1),
(4, 'Jeans azul', 'ImgProducto/Hombre/Jeans/Jeans_azul.png', 1, 1, 1, 11, 1),
(5, 'Jeans clásicos oscuros', 'ImgProducto/Hombre/Jeans/Jeans_oscuros_clasicos.png', 1, 1, 1, 10, 1),
(7, 'Pantaloneta blanca', 'ImgProducto/Hombre/Pantaloneta/Pantaloneta_blanco.png', 1, 2, 1, 12, 1),
(8, 'Pantaloneta gris', 'ImgProducto/Hombre/Pantaloneta/Pantaloneta_gris.png', 1, 2, 1, 12, 1),
(9, 'Pantaloneta negra', 'ImgProducto/Hombre/Pantaloneta/Pantaloneta_negra.png', 1, 2, 1, 12, 1),
(10, 'Pantaloneta oscura', 'ImgProducto/Hombre/Pantaloneta/Pantaloneta_oscura.png', 1, 2, 1, 12, 1),
(11, 'Camiseta amarilla con logo', 'ImgProducto/Hombre/Camiseta/Camiseta_de_color_Amarilla_con_logo.png', 1, 3, 1, 11, 1),
(12, 'Camiseta amarilla', 'ImgProducto/Hombre/Camiseta/Camiseta_de_color_amarillo.png', 1, 3, 1, 12, 1),
(13, 'Camiseta negra y rojo', 'ImgProducto/Hombre/Camiseta/Camiseta_de_color_negra_y_rojo.png', 1, 3, 1, 3, 1),
(14, 'Camiseta azul deportiva', 'ImgProducto/Hombre/Camiseta/Camiseta_deportiva_de_color_azul.png', 1, 3, 1, 10, 1),
(15, 'Camiste de Colombia', 'ImgProducto/Hombre/Camiseta/Camiste_de_Colombia.png', 1, 3, 1, 9, 1),
(16, 'Camisa negra con flores', 'ImgProducto/Hombre/Camisa/Camisa_corta_de_color_negra_con_flores.png', 1, 4, 1, 11, 1),
(17, 'Camisa azul', 'ImgProducto/Hombre/Camisa/Camisa_de_color_azul.png', 1, 4, 1, 2, 1),
(18, 'Camisa blanca', 'ImgProducto/Hombre/Camisa/Camisa_de_color_blanca.png', 1, 4, 1, 11, 1),
(19, 'Camisa gris', 'ImgProducto/Hombre/Camisa/Camisa_de_color_gris.png', 1, 4, 1, 1, 1),
(20, 'Camisa negra  con blanco', 'ImgProducto/Hombre/Camisa/Camisa_de_color_negro_y_blanco.png', 1, 4, 1, 1, 1),
(21, 'sudadera amarilla, negra y gris', 'ImgProducto/Hombre/Sudadera/sudadera_amarilla_negra_y_gris.png', 1, 5, 1, 9, 1),
(22, 'sudadera avis', 'ImgProducto/Hombre/Sudadera/sudadera_avis.png', 1, 5, 1, 7, 1),
(23, 'sudadera de otoño', 'ImgProducto/Hombre/Sudadera/sudadera_de_otoño.png', 1, 5, 1, 6, 1),
(25, 'sudadera meska', 'ImgProducto/Hombre/Sudadera/sudadera_meska.png', 1, 5, 1, 2, 1),
(26, 'Bóxer azul', 'ImgProducto/Hombre/Boxer/Boxer_azul.png', 1, 6, 1, 13, 1),
(29, 'Bóxer blanco con calaveras', 'ImgProducto/Hombre/Boxer/Boxer_blanco_con_calaveras.png', 1, 6, 1, 13, 1),
(30, 'Bóxer blanco', 'ImgProducto/Hombre/Boxer/Boxer_blanco-png.png', 1, 6, 1, 2, 1),
(31, 'Jeans azul oscuro', 'ImgProducto/Mujer/Jeans/Jeans_azul_oscuro.png', 1, 1, 2, 7, 1),
(32, 'Jeans blanco', 'ImgProducto/Mujer/Jeans/Jeans_blanco.png', 1, 1, 2, 11, 1),
(33, 'Jeans clásico ', 'ImgProducto/Mujer/Jeans/Jeans_clasico.png', 1, 1, 2, 8, 1),
(34, 'Jeans negro', 'ImgProducto/Mujer/Jeans/Jeans_negro.png', 1, 1, 2, 2, 1),
(35, 'Jeans rosa', 'ImgProducto/Mujer/Jeans/Jeans_rosa.png', 1, 1, 2, 6, 1),
(36, 'Camiseta azul', 'ImgProducto/Mujer/Camiseta/Camiseta_azul.png', 1, 3, 2, 10, 1),
(37, 'Camiseta gris', 'ImgProducto/Mujer/Camiseta/Camiseta_gris.png', 1, 3, 2, 10, 1),
(38, 'Camiseta negra', 'ImgProducto/Mujer/Camiseta/Camiseta_negra.png', 1, 3, 2, 11, 1),
(39, 'Camiseta rosa', 'ImgProducto/Mujer/Camiseta/Camiseta_rosa.png', 1, 3, 2, 9, 1),
(40, 'Camiseta verde', 'ImgProducto/Mujer/Camiseta/Camiseta_verde.png', 1, 3, 2, 9, 1),
(41, 'Camisa de jeans', 'ImgProducto/Mujer/Camisa/Camisa_de_jeans.png', 1, 4, 2, 9, 1),
(42, 'Camisa de rayas azules', 'ImgProducto/Mujer/Camisa/Camisa_de_rayas_azul.png', 1, 4, 2, 2, 1),
(43, 'Camisa de rayas blanca y negra', 'ImgProducto/Mujer/Camisa/Camisa_de_rayas_blancas_y_negras.png', 1, 4, 2, 2, 1),
(44, 'Camisa de rayas morada', 'ImgProducto/Mujer/Camisa/Camisa_de_rayas_morada.png', 1, 4, 2, 11, 1),
(45, 'Camisa de rayas rosa', 'ImgProducto/Mujer/Camisa/Camisa_de_rayas_rosa.png', 1, 4, 2, 12, 1),
(46, 'Sudadera gris', 'ImgProducto/Mujer/Sudadera/Sudadera_gris.png', 1, 5, 2, 11, 1),
(47, 'Sudadera larga gris', 'ImgProducto/Mujer/Sudadera/Sudadera_larga_gris.png', 1, 5, 2, 9, 1),
(48, 'Sudadera larga negra', 'ImgProducto/Mujer/Sudadera/Sudadera_larga_negra.png', 1, 5, 2, 5, 1),
(49, 'Sudadera rosa', 'ImgProducto/Mujer/Sudadera/Sudadera_rosa.png', 1, 5, 2, 11, 1),
(50, 'Sudadera verde azul', 'ImgProducto/Mujer/Sudadera/Sudadera_verde_azul.png', 1, 5, 2, 7, 1),
(51, 'Lancería fusia', 'ImgProducto/Mujer/Lenceria/Lenceria_fusia.png', 1, 7, 2, 2, 1),
(52, 'Lancería morada', 'ImgProducto/Mujer/Lenceria/Lenceria_morada.png', 1, 7, 2, 2, 1),
(53, 'Lancería negra', 'ImgProducto/Mujer/Lenceria/Lenceria_negra.png', 1, 7, 2, 2, 1),
(54, 'Lencería roja con negro', 'ImgProducto/Mujer/Lenceria/Lenceria_roja_con_negro.png', 1, 7, 2, 2, 1),
(55, 'Lencería roja', 'ImgProducto/Mujer/Lenceria/Lenceria_roja.png', 1, 7, 2, 2, 1),
(56, 'Jeans azul', 'ImgProducto/Niños/Jeans/Jeans_azul.png', 1, 1, 3, 9, 1),
(57, 'Jeans clásico', 'ImgProducto/Niños/Jeans/Jeans_clasico.png', 1, 1, 3, 1, 1),
(58, 'Jeans con corazones', 'ImgProducto/Niños/Jeans/Jeans_con_corazones.png', 1, 1, 3, 2, 1),
(59, 'Jeans de disney', 'ImgProducto/Niños/Jeans/Jeans_disney.png', 1, 1, 3, 11, 1),
(60, 'Jeans semi blanco', 'ImgProducto/Niños/Jeans/Jeans_semi_blanco.png', 1, 1, 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoria` int(11) NOT NULL,
  `N_Categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_Categoria`, `N_Categoria`) VALUES
(1, 'Ropa'),
(2, 'Accesorios'),
(3, 'Calzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `ID_Color` int(11) NOT NULL,
  `N_Color` varchar(45) NOT NULL,
  `CodigoHex` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`ID_Color`, `N_Color`, `CodigoHex`) VALUES
(1, 'Blanco', '#FFFFFF'),
(2, 'Negro', '#000000'),
(3, 'Azul', '#0000FF'),
(4, 'Azul Oscuro', '#00008B'),
(5, 'Azul Claro', '#ADD8E6'),
(6, 'Rojo', '#FF0000'),
(7, 'Verde', '#008000'),
(8, 'Verde Claro', '#00ff00'),
(9, 'Verde OScuro', '#003d08'),
(10, 'Amarillo', '#FFFF00'),
(11, 'Rosa', '#FFC0CB'),
(12, 'Morado', '#800080');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `ID_Factura` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Fecha_Factura` datetime NOT NULL,
  `Monto_Total` decimal(10,2) NOT NULL,
  `Direccion_Envio` text DEFAULT NULL,
  `Estado` enum('Emitido','Anulado','Entregado','Confirmado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ID_Metodo_Pago` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Usuario_Confirmacion` int(11) DEFAULT NULL,
  `Fecha_Confirmacion` datetime DEFAULT NULL,
  `Usuario_Anulacion` int(11) DEFAULT NULL,
  `Fecha_Anulacion` datetime DEFAULT NULL,
  `Codigo_Acceso` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`ID_Factura`, `ID_Usuario`, `Fecha_Factura`, `Monto_Total`, `Direccion_Envio`, `Estado`, `ID_Metodo_Pago`, `cantidad`, `Usuario_Confirmacion`, `Fecha_Confirmacion`, `Usuario_Anulacion`, `Fecha_Anulacion`, `Codigo_Acceso`) VALUES
(1, 1, '2025-08-10 14:34:23', 150000.00, NULL, 'Emitido', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 1, '2025-08-24 00:51:03', 1000000.00, 'Compra online - 24/08/2025 00:51', 'Confirmado', 1, NULL, NULL, NULL, NULL, NULL, 'FWV4ZIHX'),
(109, 1, '2025-08-27 17:55:16', 1000000.00, 'Compra online - 27/08/2025 17:55', 'Confirmado', 1, NULL, NULL, NULL, NULL, NULL, 'SGEFKJEA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_producto`
--

CREATE TABLE `factura_producto` (
  `ID_FacturaProducto` int(11) NOT NULL,
  `ID_Factura` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura_producto`
--

INSERT INTO `factura_producto` (`ID_FacturaProducto`, `ID_Factura`, `ID_Producto`, `Cantidad`) VALUES
(91, 108, 1, 5),
(92, 109, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `ID_Genero` int(11) NOT NULL,
  `N_Genero` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`ID_Genero`, `N_Genero`) VALUES
(1, 'Hombre'),
(2, 'Mujer'),
(3, 'Niños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `ID_Metodo_Pago` int(11) NOT NULL,
  `T_Pago` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`ID_Metodo_Pago`, `T_Pago`) VALUES
(1, 'Tarjeta'),
(2, 'Efectivo'),
(3, 'PSE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `ID_Permiso` int(11) NOT NULL,
  `N_Permiso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`ID_Permiso`, `N_Permiso`) VALUES
(1, 'Desactivar Producto'),
(2, 'Agregar Producto'),
(3, 'Eliminar Producto'),
(4, 'Editar Precio'),
(5, 'Gestionar Roles'),
(6, 'Comprar Producto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `ID_precio` int(11) NOT NULL,
  `Valor` decimal(10,2) NOT NULL,
  `Activo` int(11) NOT NULL,
  `FechaAct` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`ID_precio`, `Valor`, `Activo`, `FechaAct`) VALUES
(1, 200000.00, 1, '2025-07-10 16:20:06'),
(2, 250000.00, 1, '2025-07-10 15:42:17'),
(3, 210000.00, 1, '2025-05-16 15:19:47'),
(4, 500000.00, 1, '2025-05-16 17:12:28'),
(5, 550000.00, 1, '2025-05-16 17:12:50'),
(6, 400000.00, 1, '2025-05-19 16:38:36'),
(7, 300000.00, 1, '2025-06-22 16:01:03'),
(8, 320000.00, 1, '2025-06-22 16:01:15'),
(9, 255000.00, 1, '2025-06-22 16:02:09'),
(10, 100000.00, 1, '2025-06-22 16:03:29'),
(11, 150000.00, 1, '2025-06-22 16:03:37'),
(12, 50000.00, 1, '2025-06-22 16:04:29'),
(13, 25000.00, 1, '2025-06-22 16:13:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_Producto` int(11) NOT NULL,
  `ID_Articulo` int(11) NOT NULL,
  `ID_Talla` int(11) NOT NULL,
  `ID_Color` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_Producto`, `ID_Articulo`, `ID_Talla`, `ID_Color`, `Cantidad`) VALUES
(1, 2, 11, 1, 20),
(2, 2, 4, 2, 10),
(3, 2, 5, 3, 10),
(4, 2, 6, 4, 10),
(5, 3, 4, 2, 66),
(6, 3, 5, 2, 66),
(7, 3, 6, 2, 66),
(8, 4, 4, 3, 40),
(9, 4, 5, 3, 40),
(10, 4, 6, 3, 40),
(11, 7, 3, 1, 20),
(12, 7, 4, 1, 20),
(13, 11, 4, 10, 14),
(14, 11, 5, 10, 14),
(15, 17, 4, 3, 12),
(16, 17, 5, 3, 12),
(17, 22, 4, 2, 14),
(18, 22, 5, 2, 14),
(19, 26, 4, 3, 0),
(20, 26, 5, 3, 0),
(21, 31, 13, 4, 23),
(22, 31, 14, 4, 23),
(23, 32, 13, 1, 24),
(24, 32, 14, 1, 24),
(25, 39, 13, 11, 19),
(26, 39, 14, 11, 19),
(27, 44, 13, 12, 19),
(28, 44, 14, 12, 19),
(29, 49, 13, 11, 19),
(30, 49, 14, 11, 19),
(31, 53, 13, 2, 0),
(32, 53, 14, 2, 0),
(33, 56, 26, 3, 10),
(34, 56, 27, 3, 10),
(35, 58, 26, 11, 0),
(36, 58, 27, 11, 0),
(37, 59, 26, 3, 10),
(38, 59, 27, 3, 10),
(39, 2, 11, 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID_Rol` int(11) NOT NULL,
  `Roles` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID_Rol`, `Roles`) VALUES
(1, 'Abministrador'),
(2, 'Editor'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `ID_Rol` int(11) NOT NULL,
  `ID_Permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`ID_Rol`, `ID_Permiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 4),
(2, 6),
(3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `ID_SubCategoria` int(11) NOT NULL,
  `SubCategoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`ID_SubCategoria`, `SubCategoria`) VALUES
(1, 'Jeans'),
(2, 'Pantaloneta'),
(3, 'Camiseta'),
(4, 'Camisa'),
(5, 'Sudadera'),
(6, 'Boxer'),
(7, 'Lenceria'),
(8, 'Gorras'),
(9, 'Sombreros'),
(10, 'Relojes'),
(11, 'Perfumes'),
(12, 'Gafas'),
(13, 'Morrales'),
(14, 'Billeteras'),
(15, 'Correas'),
(16, 'Llaveros'),
(17, 'Tenis'),
(18, 'Sandalias'),
(19, 'Botas'),
(20, 'chanclas'),
(21, 'crocs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

CREATE TABLE `talla` (
  `ID_Talla` int(11) NOT NULL,
  `N_Talla` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`ID_Talla`, `N_Talla`) VALUES
(1, 'Indefinido'),
(2, 'XS Única'),
(3, 'S Única'),
(4, 'M Única'),
(5, 'L Única'),
(6, 'XL Única'),
(7, 'XXL Única'),
(8, 'XXXL Única'),
(9, '28 Única'),
(10, '30 Única'),
(11, '32 Única'),
(12, '34 Única'),
(13, '36 Única'),
(14, '38 Única'),
(15, '40 Única'),
(21, '42 Única'),
(22, '44 Única'),
(23, '10 Única'),
(24, '12  Única'),
(25, '14 Única'),
(26, '8 años'),
(27, '10 años'),
(28, '12 años'),
(29, '14 años'),
(30, '16 Única'),
(37, '18 Única');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `ID_TD` int(11) NOT NULL,
  `Documento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`ID_TD`, `Documento`) VALUES
(1, 'Cédula de Ciudadanía'),
(2, 'Tarjeta de Identidad'),
(3, 'Cédula de Extranjería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre_Completo` varchar(50) NOT NULL,
  `ID_Rol` int(11) NOT NULL,
  `ID_TD` int(11) NOT NULL,
  `N_Documento` int(11) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Celular` varchar(50) NOT NULL,
  `Contrasena` varchar(255) NOT NULL DEFAULT '',
  `token_recuperacion` varchar(255) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre_Completo`, `ID_Rol`, `ID_TD`, `N_Documento`, `Correo`, `Celular`, `Contrasena`, `token_recuperacion`, `token_expira`) VALUES
(1, 'Luis Fernando', 1, 1, 1058697582, 'luis@gmail.com', '3134584687', 'facfc26fc0664e7f0bfc9d88a3756152398cfab5e3c0ee0fa8ea3817666bd193013aaa1d6809b9d821e1c16990d3cbfdec7ab179d401006a863e89a5c009ed32', 'c019a00b651c4118f1e5247a875ddb02f8ddb3d90db54f93475f923640c16af9', '2025-07-11 04:56:36'),
(27, 'Michael Jasón ', 2, 3, 1448154094, 'JasonM@gmailcom', '2147483647', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', NULL, NULL),
(28, 'miguel', 3, 1, 1056772976, 'miguel01ruiz09@gmail.com', '2147483647', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', NULL, NULL),
(29, 'Antonio Galan', 1, 1, 1050647885, 'Antonio@gmail.com', '2147483647', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', NULL, NULL),
(43, 'Juan Pablo', 3, 1, 1038108585, 'Juan@gmail.com', '2147483647', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', NULL, NULL),
(44, 'sebas', 3, 1, 1056772259, 'Sebas123@gmail.com', '2147483647', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', NULL, NULL),
(61, 'Juan Pablo Martinez Briñez', 3, 1, 1105462579, 'Kiusmila9@gmail.com', '2147483647', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'abda3915b561a42a0741d8875c395c189429ec3d70e8122e89d39c89a174a11a', '2025-06-25 22:21:00'),
(63, 'Zarcorpgama', 3, 3, 1052688469, 'Zarcorp@gmail.com', '2147483647', 'ba680272379d3fabb77c21f4229cb683eca4c4169951b417437ebe843d1e42777625c60eda32aa2498d1b3d7aec033293f3667d30caba6110de10b1ac2de2930', NULL, NULL),
(64, 'Antonio Galan', 3, 1, 2085642390, 'Antonito@gmailcom', '2147483647', '542a7a7b9ee47c302761cecec23e2cd46f6c80bd6581fc077fa6f4b43d406662db9256f9d58483558734ef71997f1e1f29181a1a655f42051e897fb0e1529911', NULL, NULL),
(65, 'isabel rodriguez', 3, 1, 1056768396, 'anaisabel@gmail.com', '2147483647', 'db225859fed27e986c4db6f5a26c93ee09056e11833797a58d322e5bbd6b4ff945565670affe2f80493e9c7bfc2f2972db2b97a9c7352ac96a7c9771b2526b0a', NULL, NULL),
(66, 'Dana Kasandra', 3, 1, 1045681584, 'daka@gmail.com', '2147483647', 'adec5fec0c428ca3e4ad18fb71f94cab1b94613c1b344b47ddf3b73199e5956e4de128ff6fbd80893e2f461c0abafa1077ad92ccd59df0b0997dd3de6b82ed3a', NULL, NULL),
(67, 'juan nasasasaa', 3, 2, 1232131231, 'ciervoj72@gmail.com', '2147483647', '542a7a7b9ee47c302761cecec23e2cd46f6c80bd6581fc077fa6f4b43d406662db9256f9d58483558734ef71997f1e1f29181a1a655f42051e897fb0e1529911', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`ID_Articulo`),
  ADD KEY `Fk_Genero_idx` (`ID_Genero`),
  ADD KEY `Fk_Precio_idx` (`IdPrecio`),
  ADD KEY `Fk_Categoria_idx` (`ID_Categoria`),
  ADD KEY `Fk_SubCategoria_idx` (`ID_SubCategoria`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`ID_Color`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID_Factura`),
  ADD UNIQUE KEY `CodigoAcceso` (`Codigo_Acceso`),
  ADD KEY `Fk_Metodo_Pago_idx` (`ID_Metodo_Pago`),
  ADD KEY `Fk_Usuario_idx` (`ID_Usuario`),
  ADD KEY `UsuarioConfirmacion` (`Usuario_Confirmacion`),
  ADD KEY `UsuarioAnulacion` (`Usuario_Anulacion`);

--
-- Indices de la tabla `factura_producto`
--
ALTER TABLE `factura_producto`
  ADD PRIMARY KEY (`ID_FacturaProducto`),
  ADD KEY `Fk_Producto_idx` (`ID_Producto`),
  ADD KEY `Fk_FP_Factura_idx` (`ID_Factura`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`ID_Genero`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`ID_Metodo_Pago`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`ID_Permiso`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`ID_precio`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `Fk_Producto_Ropa_idx` (`ID_Articulo`),
  ADD KEY `Fk_Producto_Talla_idx` (`ID_Talla`),
  ADD KEY `Fk_Producto_Color_idx` (`ID_Color`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`ID_Rol`,`ID_Permiso`),
  ADD KEY `IdPermiso` (`ID_Permiso`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`ID_SubCategoria`);

--
-- Indices de la tabla `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`ID_Talla`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`ID_TD`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `FK.TD_idx` (`ID_TD`),
  ADD KEY `Fk_Rol_idx` (`ID_Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `ID_Color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID_Factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `factura_producto`
--
ALTER TABLE `factura_producto`
  MODIFY `ID_FacturaProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `ID_Metodo_Pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `ID_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `ID_precio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ID_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `ID_SubCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `talla`
--
ALTER TABLE `talla`
  MODIFY `ID_Talla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `ID_TD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `Fk_Categoria` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria` (`ID_Categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Genero` FOREIGN KEY (`ID_Genero`) REFERENCES `genero` (`ID_Genero`),
  ADD CONSTRAINT `Fk_Precio` FOREIGN KEY (`IdPrecio`) REFERENCES `precio` (`ID_precio`),
  ADD CONSTRAINT `Fk_SubCategoria` FOREIGN KEY (`ID_SubCategoria`) REFERENCES `subcategoria` (`ID_SubCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `Fk_Metodo_Pago` FOREIGN KEY (`ID_Metodo_Pago`) REFERENCES `metodo_pago` (`ID_Metodo_Pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`Usuario_Confirmacion`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`Usuario_Anulacion`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `factura_producto`
--
ALTER TABLE `factura_producto`
  ADD CONSTRAINT `FK_PF_Producto` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_FP_Factura` FOREIGN KEY (`ID_Factura`) REFERENCES `factura` (`ID_Factura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `Fk_Producto_Articulo` FOREIGN KEY (`ID_Articulo`) REFERENCES `articulo` (`ID_Articulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Producto_Color` FOREIGN KEY (`ID_Color`) REFERENCES `color` (`ID_Color`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Producto_Talla` FOREIGN KEY (`ID_Talla`) REFERENCES `talla` (`ID_Talla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `rol` (`ID_Rol`),
  ADD CONSTRAINT `rol_permiso_ibfk_2` FOREIGN KEY (`ID_Permiso`) REFERENCES `permiso` (`ID_Permiso`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `Fk_Rol` FOREIGN KEY (`ID_Rol`) REFERENCES `rol` (`ID_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_TD` FOREIGN KEY (`ID_TD`) REFERENCES `tipo_documento` (`ID_TD`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
