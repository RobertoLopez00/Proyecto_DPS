-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2024 a las 06:23:07
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
-- Base de datos: `bd_tienda_dps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_productos`
--

CREATE TABLE `carrito_productos` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_carrito` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `talla` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(0, 'computadoras'),
(1, 'Gaming'),
(2, 'Hardware'),
(3, 'Software'),
(4, 'Mobile'),
(5, 'Peripherals');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_estados`
--

CREATE TABLE `compra_estados` (
  `id` int(11) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra_estados`
--

INSERT INTO `compra_estados` (`id`, `estado`) VALUES
(1, 'Pedido'),
(2, 'Pagado y pedido'),
(3, 'Pagado y enviado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_talla` int(11) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `producto` text NOT NULL,
  `descripcion` text NOT NULL,
  `codigo` text NOT NULL,
  `existencias` int(11) NOT NULL,
  `modelo` text DEFAULT NULL,
  `marca` text DEFAULT NULL,
  `imagen` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `estado` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto`, `descripcion`, `codigo`, `existencias`, `modelo`, `marca`, `imagen`, `id_categoria`, `estado`, `precio`, `descuento`, `created_at`, `updated_at`) VALUES
(1, 'Control de PS5', 'Control inalambrico de PlayStation 5', '00002', 10, 'PS5 Dualsense', 'PS5', 'https://store.sony.com.sg/cdn/shop/files/DualSense_WirelessController_MetallicGray_1200x.png?v=1706234652', 1, 'Activo', 79.00, 10, '2024-10-05 04:34:32', NULL),
(2, 'AMD Ryzen 3 4100', 'Microprocesador AMD Ryzen 3 4100', '00003', 10, 'Ryzen 3 4100', 'AMD', 'https://mgrtechno.com.ar/wp-content/uploads/2024/03/Ryzen-3-4100-web.png', 2, 'Activo', 339.00, 40, '2024-10-05 04:34:32', NULL),
(3, 'Office365', 'Office365', '00004', 10, 'Office365', 'Microsoft', 'https://luna1.co/6e6990.png', 3, 'Activo', 250.00, 10, '2024-10-05 04:34:32', NULL),
(4, 'PlayStation 5', 'Consola de videojuegos PS5', '00005', 4, 'PS5', 'PlayStation', 'https://myxprs.com/cdn/shop/products/sony-playstation-5-slim-570862.png?v=1723625774', 1, 'Activo', 750.00, 0, '2024-10-07 03:05:35', NULL),
(5, 'Monitor QHD HP P32u', 'Monitor QHD HP P32u G5 USB-C', '00005', 13, 'Monitor QHD HP P32u G5 USB-C', 'HP', 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c08319042.png', 5, 'Activo', 210.00, 23, '2024-10-07 03:05:35', NULL),
(6, 'Amazon Echo', 'Bocina inteligente Amazon Echo de segunda generacion', '00031', 21, 'Amazon Echo (2nd Generation) Smart Speaker', 'Amazon', 'https://crdms.images.consumerreports.org/prod/products/cr/models/393652-smart-speakers-amazon-echo-2nd-generation-59795.png', 5, 'Activo', 46.00, 9, '2024-10-07 03:05:35', NULL),
(7, 'Mouse HP 100', 'Mouse con cable HP 100', '00012', 26, 'Mouse HP 100 ', 'HP', 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c06444257.png', 5, 'Activo', 16.00, 3, '2024-10-07 03:05:35', NULL),
(8, 'Computadora', 'Computadora', '00006', 5, 'Vivobook', 'HP', 'https://i5.walmartimages.com/seo/ASUS-VivoBook-17-3-FHD-Display-Ryzen-3250U-Processor-8GB-DDR4-RAM-256GB-PCIe-SSD-Windows-10-Home-Transparent-Silver-M712DA-WH34_215741a7-87fe-49db-baf2-53a382befbf8.8b6b33df87d792072d1d87c5c65aea62.png', 0, 'Activo', 70.00, 5, '2024-10-03 13:59:59', NULL),
(30, 'Samsung A54', 'Telefono Samsung Galaxy A54 5G 128GB', '00005', 10, 'Galaxy A54 5G 128GB', 'Samsung', 'https://shop.samsung.com/latin/cac/pub/media/catalog/product/cache/a69170b4a4f0666a52473c2224ba9220/s/m/sm-a546_galaxy-a54-5g-all-name_1_2.png', 4, 'Activo', 299.00, 20, '2024-10-05 04:34:32', NULL),
(31, 'Razer Huntsman Mini', 'Teclado Razer Huntsman Mini', '00001', 10, 'Huntsman Mini', 'Razer', 'https://assets.razerzone.com/eeimages/support/products/1689/1689-huntsmanmini.png', 5, 'Activo', 89.99, 10, '2024-10-05 04:34:32', NULL),
(32, 'Control de Nintendo Switch', 'Control inalambrico de Nintendo Switch', '00002', 10, 'Hori Pad', 'Hori', 'https://i5.walmartimages.com/seo/Hori-Nintendo-Switch-Sonic-the-Hedgehog-Edition-Wireless-HORI-PAD-Video-Game-Controller_f025f7dc-7e72-4414-8cb7-01be374648f8.f39ee5b86914992719c3f164ac456f9a.png', 1, 'Activo', 128.00, 0, '2024-10-05 04:34:32', NULL),
(33, 'Intel Core i5-10400', 'Procesador Intel Core i5-10400 12M Cache, up to 4.30 GHz', '00003', 10, 'Intel Core i5-10400 Processor 12M Cache, up to 4.30 GHz', 'Intel', 'https://www.godukkan.com/media/catalog/product/cache/8fb272ed754d6a3c792b4835b21610ed/i/n/intel-core-i5-10400-processor-12m-cache-up-to-430-ghz-tray-without-fan.png', 2, 'Activo', 259.00, 0, '2024-10-05 04:34:32', NULL),
(34, 'ESET NOD32', 'Antivirus ESET NOD32', '00004', 10, 'ESET NOD32 – Antivirus', 'ESET', 'https://orotec.com.sv/wp-content/uploads/2022/03/ena_800x800_3.png', 3, 'Activo', 70.00, 10, '2024-10-05 04:34:32', NULL),
(35, 'ThinkPad X280', 'Laptop ThinkPad X280 | Ultraportátil de Negocios de 12.5”', '00006', 5, 'ThinkPad X280', 'Lenovo', 'https://p1-ofp.static.pub/medias/bWFzdGVyfHJvb3R8MjkwNzQ5fGltYWdlL3BuZ3xoMDIvaDhkLzE0MzMyOTc5MzE0NzE4LnBuZ3xlM2VjMWI5ZjNlN2VjMDhkY2ZjNjdlMDJiZTE0MGZkZjRmNGRiZTEwMjJiY2MxZTY4NTM5YmNlMDEwNGE4NjJm/lenovo-laptop-thinkpad-x280-hero.png', 0, 'Activo', 560.00, 5, '2024-10-03 13:59:59', NULL),
(36, 'Honor X8b 256GB', 'Telefono Honor X8b 256GB ', '00005', 10, 'Honor X8b 256GB ', 'Honor', 'https://sstoresv.com/wp-content/uploads/2024/01/Front-_HQ_PNG_20231017.png', 4, 'Activo', 199.00, 20, '2024-10-05 04:34:32', NULL),
(37, 'Dragonborn K630', 'Teclado mecánico 60%, Dragonborn K630', '00001', 10, 'Dragonborn K630', 'Redragon', 'https://redragon.es/content/uploads/2021/07/DRAGONBORN.png', 5, 'Activo', 49.99, 10, '2024-10-05 04:34:32', NULL),
(38, 'Control de Xbox', 'Control inalambrico de Xbox', '00002', 14, 'Xbox controller', 'Xbox', 'https://blog.desdelinux.net/wp-content/uploads/2020/01/xbox-one-controller.png', 1, 'Activo', 79.00, 0, '2024-10-05 04:34:32', NULL),
(39, 'AMD Ryzen 7 5800X', 'Procesador AMD Ryzen 7 5800X 8-Core', '00003', 10, 'Ryzen 7 5800X', 'AMD', 'https://i5.walmartimages.com/seo/AMD-Ryzen-7-5800X-8-core-16-thread-Desktop-Processor_6991aa07-fda4-4d5c-a327-14f173b49695.0a72219f57b56aacf58bea6a04355e93.png', 2, 'Activo', 359.00, 40, '2024-10-05 04:34:32', NULL),
(41, 'ASUS E510', 'Laptop ASUS E510', '00006', 5, 'E510', 'ASUS', 'https://www.asus.com/media/global/gallery/t9knrwr16cmvzc8i_setting_xxx_0_90_end_2000.png', 0, 'Activo', 670.00, 5, '2024-10-03 13:59:59', NULL),
(42, 'iPhone 12', 'Smartphone iPhone 12 64 Morado Desbloqueado', '00005', 10, 'iPhone 12', 'Apple', 'https://i5.walmartimages.com/asr/0c32366a-f919-436c-9b3e-7e23685b83a0.15ea190262784ac6058dfa233281ce43.png', 4, 'Activo', 699.00, 20, '2024-10-05 04:34:32', NULL),
(43, 'Razer DeathAdder', 'Ratón para diestros de agarre en palma y en pinza - La gama Razer DeathAdder', '00001', 10, '', 'Razer', 'https://store.sony.com.sg/cdn/shop/files/DualSense_WirelessController_MetallicGray_1200x.png?v=1706234652', 5, 'Activo', 109.99, 10, '2024-10-05 04:34:32', NULL),
(44, 'Xbox Serie S', 'Consola de videojuegos Xbox Serie S', '00002', 10, 'Xbox Serie S', 'Xbox', 'https://cms-assets.xboxservices.com/assets/98/7b/987b8ad4-0f9e-4f65-bef7-f93ee9d1a689.png?n=389964_Hero-Gallery-0_A4_857x676.png', 1, 'Activo', 376.00, 10, '2024-10-05 04:34:32', NULL),
(45, 'CPU', 'CPU', '00003', 10, 'Ryzen', 'AMD', 'https://store.sony.com.sg/cdn/shop/files/DualSense_WirelessController_MetallicGray_1200x.png?v=1706234652', 2, 'Activo', 339.00, 40, '2024-10-05 04:34:32', NULL),
(47, 'Computadora', 'Computadora', '00006', 5, 'Vivobook', 'HP', 'https://i5.walmartimages.com/seo/ASUS-VivoBook-17-3-FHD-Display-Ryzen-3250U-Processor-8GB-DDR4-RAM-256GB-PCIe-SSD-Windows-10-Home-Transparent-Silver-M712DA-WH34_215741a7-87fe-49db-baf2-53a382befbf8.8b6b33df87d792072d1d87c5c65aea62.png', 0, 'Activo', 70.00, 5, '2024-10-03 13:59:59', NULL),
(48, 'Samsung', 'Samsung', '00005', 10, 'Samsung', 'Samsung', 'https://store.sony.com.sg/cdn/shop/files/DualSense_WirelessController_MetallicGray_1200x.png?v=1706234652', 4, 'Activo', 399.00, 20, '2024-10-05 04:34:32', NULL),
(49, 'Teclado', 'Teclado', '00001', 10, 'Teclado', 'Razer', 'https://store.sony.com.sg/cdn/shop/files/DualSense_WirelessController_MetallicGray_1200x.png?v=1706234652', 5, 'Activo', 109.99, 10, '2024-10-05 04:34:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagenes`
--

CREATE TABLE `producto_imagenes` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `imagen1` text NOT NULL,
  `imagen2` text NOT NULL,
  `imagen3` text NOT NULL,
  `imagen4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` text NOT NULL,
  `apellidos` text NOT NULL,
  `dui` text NOT NULL,
  `email` text NOT NULL,
  `telefono` int(8) NOT NULL,
  `password` text NOT NULL,
  `id_rol` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `estado` text NOT NULL,
  `usuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `dui`, `email`, `telefono`, `password`, `id_rol`, `direccion`, `estado`, `usuario`) VALUES
(1, 'admin', 'admin', '12345678-9', 'admin@gmail.com', 12345678, '$2y$10$NPhG.eqySK6lSIbn7FLQEuEcZkNQSWSnQsyXilEtJ9SjDF3cpWCpW', 1, 'Soyapango', 'Activo', ''),
(2, 'Spike', 'Spiegel', '12345678-2', 'spike@gmail.com', 44442222, '$2y$10$vAfCNrdoyeQxaDnYg0dDJ.BSJdCB7pOSOvvC4hZbWiRe6hNpbPnqS', 2, 'Soyapango', 'Activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_metodo_pago` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `direccion` text NOT NULL,
  `id_estado` int(11) NOT NULL,
  `comprobante` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_metodo_pago`, `id_cliente`, `monto`, `fecha`, `direccion`, `id_estado`, `comprobante`) VALUES
(31, 2, 1, 40.00, '2024-07-16 07:55:09', 'San Salvador', 3, NULL),
(32, 1, 1, 40.00, '2024-07-16 07:55:59', 'San Salvador', 2, NULL),
(33, 1, 1, 40.00, '2024-07-16 08:21:59', 'San Salvador', 2, NULL),
(34, 2, 1, 40.00, '2024-07-16 08:23:00', 'San Salvador', 1, NULL),
(35, 2, 1, 40.00, '2024-07-22 22:07:14', 'San Salvador', 1, NULL),
(36, 2, 1, 40.00, '2024-07-22 22:46:23', 'San Salvador', 1, NULL),
(50, 3, 1, 20.00, '2024-08-06 03:01:48', 'San Salvador', 1, NULL),
(51, 3, 1, 0.00, '2024-08-06 03:01:56', 'San Salvador', 1, NULL),
(52, 3, 1, 0.00, '2024-08-06 03:02:00', 'San Salvador', 1, NULL),
(53, 3, 1, 0.00, '2024-08-06 03:02:04', 'San Salvador', 1, NULL),
(56, 2, 1, 20.00, '2024-08-07 08:36:48', 'San Salvador', 1, NULL),
(57, 2, 1, 20.00, '2024-08-07 08:37:17', 'San Salvador', 1, NULL),
(58, 2, 1, 20.00, '2024-08-07 08:37:40', 'San Salvador', 1, NULL),
(60, 2, 1, 17.60, '2024-08-08 07:54:30', 'San Salvador', 1, NULL),
(61, 2, 1, 17.60, '2024-08-08 07:54:36', 'San Salvador', 1, NULL),
(62, 2, 1, 17.60, '2024-08-08 07:55:36', 'San Salvador', 1, NULL),
(63, 2, 1, 17.60, '2024-08-08 07:55:36', 'San Salvador', 1, NULL),
(64, 2, 1, 17.60, '2024-08-08 07:57:31', 'San Salvador', 1, NULL),
(65, 3, 1, 14.70, '2024-08-29 02:12:03', 'San Salvador', 1, NULL),
(66, 2, 1, 18.00, '2024-08-29 02:19:12', 'San Salvador', 1, NULL),
(67, 2, 1, 162.00, '2024-09-02 07:10:43', 'San Salvador', 1, '1725244282_sdasdasd.pdf'),
(68, 3, 1, 70.00, '2024-09-02 12:44:21', 'San Salvador', 1, NULL),
(69, 3, 1, 140.00, '2024-09-02 12:49:44', 'San Salvador', 1, NULL),
(70, 3, 1, 140.00, '2024-09-02 12:54:53', 'San Salvador', 1, NULL),
(71, 3, 1, 44.10, '2024-09-02 13:05:40', 'San Salvador', 1, NULL),
(72, 3, 1, 29.40, '2024-09-02 13:06:46', 'San Salvador', 1, NULL),
(73, 3, 1, 20.00, '2024-09-02 13:08:37', 'San Salvador', 1, NULL),
(74, 3, 1, 20.00, '2024-09-02 13:09:03', 'San Salvador', 1, NULL),
(75, 3, 1, 20.00, '2024-09-02 13:09:22', 'San Salvador', 1, NULL),
(76, 3, 1, 20.00, '2024-09-02 13:09:51', 'San Salvador', 1, NULL),
(77, 3, 1, 52.80, '2024-09-02 13:10:21', 'San Salvador', 1, NULL),
(78, 3, 1, 18.00, '2024-09-02 14:14:16', 'San Salvador', 1, NULL),
(79, 3, 1, 18.00, '2024-09-02 14:17:57', 'San Salvador', 1, NULL),
(80, 2, 1, 20.00, '2024-09-02 14:19:48', 'San Salvador', 1, NULL),
(81, 2, 1, 16.40, '2024-09-02 14:19:57', 'San Salvador', 1, NULL),
(82, 3, 1, 16.40, '2024-09-02 14:21:48', 'San Salvador', 1, NULL),
(83, 3, 1, 0.00, '2024-09-02 14:22:21', 'San Salvador', 1, NULL),
(84, 2, 1, 0.00, '2024-09-02 14:25:32', 'San Salvador', 1, NULL),
(85, 3, 1, 17.60, '2024-09-02 14:25:39', 'San Salvador', 1, NULL),
(86, 2, 1, 0.00, '2024-09-02 14:25:48', 'San Salvador', 1, NULL),
(87, 3, 1, 17.60, '2024-09-02 14:26:43', 'San Salvador', 1, NULL),
(88, 3, 1, 16.40, '2024-09-02 14:30:33', 'San Salvador', 1, NULL),
(89, 3, 1, 19.40, '2024-09-02 14:33:07', 'San Salvador', 1, NULL),
(90, 3, 1, 19.40, '2024-09-02 14:36:55', 'San Salvador', 1, NULL),
(91, 3, 1, 20.00, '2024-09-02 14:43:02', 'San Salvador', 1, NULL),
(92, 3, 1, 19.40, '2024-09-02 14:46:52', 'San Salvador', 1, '1725377928_sdasdasd.pdf'),
(93, 2, 1, 0.00, '2024-09-03 21:45:46', 'San Salvador', 1, NULL),
(94, 2, 1, 0.00, '2024-09-03 21:45:49', 'San Salvador', 1, NULL),
(95, 2, 1, 0.00, '2024-09-03 21:46:47', 'San Salvador', 1, NULL),
(96, 2, 1, 0.00, '2024-09-03 21:46:53', 'San Salvador', 1, NULL),
(97, 2, 1, 0.00, '2024-09-03 21:47:37', 'San Salvador', 1, NULL),
(98, 2, 1, 0.00, '2024-09-03 21:47:48', 'San Salvador', 1, NULL),
(99, 2, 1, 0.00, '2024-09-03 21:47:56', 'San Salvador', 1, NULL),
(100, 2, 1, 0.00, '2024-09-03 21:48:47', 'San Salvador', 1, NULL),
(101, 2, 1, 0.00, '2024-09-03 21:49:50', 'San Salvador', 1, NULL),
(102, 2, 1, 0.00, '2024-09-03 21:50:15', 'San Salvador', 1, NULL),
(103, 2, 1, 0.00, '2024-09-03 21:50:23', 'San Salvador', 1, NULL),
(104, 2, 1, 18.00, '2024-09-03 21:50:48', 'San Salvador', 1, NULL),
(105, 2, 1, 18.00, '2024-09-03 21:52:18', 'San Salvador', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_cliente_c` (`id_cliente`);

--
-- Indices de la tabla `carrito_productos`
--
ALTER TABLE `carrito_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_producto_c` (`id_producto`),
  ADD KEY `fk_id_carrito_c` (`id_carrito`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra_estados`
--
ALTER TABLE `compra_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto_d` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_categoria` (`id_categoria`);

--
-- Indices de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_producto_i` (`id_producto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_cliente_v` (`id_cliente`),
  ADD KEY `fk_id_metodo_pago` (`id_metodo_pago`),
  ADD KEY `fk_id_compra_estado` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `carrito_productos`
--
ALTER TABLE `carrito_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compra_estados`
--
ALTER TABLE `compra_estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `fk_id_cliente_c` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `carrito_productos`
--
ALTER TABLE `carrito_productos`
  ADD CONSTRAINT `fk_id_carrito_c` FOREIGN KEY (`id_carrito`) REFERENCES `carritos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_producto_c` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `id_producto_d` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD CONSTRAINT `fk_id_producto_i` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_id_cliente_v` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_compra_estado` FOREIGN KEY (`id_estado`) REFERENCES `compra_estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
