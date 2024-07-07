-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2021 a las 20:34:33
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kardex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

CREATE TABLE `administracion` (
  `Id_Admin` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `ValorTotal` int(20) NOT NULL,
  `Tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `Id_Articulo` int(11) NOT NULL,
  `Codigo` varchar(100) NOT NULL,
  `Id_Categoria` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Marca` varchar(100) NOT NULL,
  `PrecioCosto` int(50) NOT NULL,
  `PrecioVenta` int(50) NOT NULL,
  `StockIdeal` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`Id_Articulo`, `Codigo`, `Id_Categoria`, `Nombre`, `Cantidad`, `Marca`, `PrecioCosto`, `PrecioVenta`, `StockIdeal`, `Estado`) VALUES
(1, '0128839', 1, 'Leche 1000ml', 0, 'Alpina', 2500, 3500, 20, 0),
(2, '283893', 5, 'Frijoles 200gr', 8, 'DoñaCasa', 2000, 2500, 10, 0),
(3, '1092992', 3, 'gaseosa  200ml', 6, 'Colombiana', 1000, 1500, 20, 1),
(4, '8237847', 2, 'Poker 150ml', 0, 'Poker', 1500, 2000, 20, 1),
(5, '2932202', 1, 'Leche achocolatada', 0, 'Alpin', 2000, 2600, 20, 1),
(6, '9934433', 5, 'Lentejas 250gr', 6, 'Buen grano', 1500, 2000, 20, 1),
(7, '77567544', 3, 'Gaseosa 150ml  manzana', 15, 'Postobon', 1200, 1500, 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `IdCategoria` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`IdCategoria`, `Nombre`, `Descripcion`) VALUES
(1, 'Leches Liquidas', 'El grupo de los lácteos incluye alimentos como la leche y sus derivados procesados'),
(2, 'Cervezas', 'Las bebidas alcohólicas son aquellas bebidas que contienen etanol en su composición'),
(3, 'Bebidas Gaseosas', 'gaseosa, refresco, fresco o soda'),
(4, 'Cigarrillos', 'es uno de los formatos más populares para el consumo de tabaco'),
(5, 'Granos', 'Un grano es una semilla pequeña, dura y seca, con o sin cáscara o capa de fruta adherida, cosechada para consumo humano o animal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrada`
--

CREATE TABLE `detalle_entrada` (
  `Id_Articulo` int(11) NOT NULL,
  `Id_Entrada` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precioxunidad` int(20) NOT NULL,
  `Total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_entrada`
--

INSERT INTO `detalle_entrada` (`Id_Articulo`, `Id_Entrada`, `Cantidad`, `Precioxunidad`, `Total`) VALUES
(1, 2, 10, 2500, 25000),
(5, 2, 15, 2000, 30000),
(2, 3, 20, 2000, 40000),
(6, 3, 14, 1500, 21000),
(3, 4, 10, 1000, 10000),
(7, 4, 30, 1200, 36000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `Id_Salida` int(11) NOT NULL,
  `Id_Articulo` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `PrecioXunidad` int(20) NOT NULL,
  `Total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`Id_Salida`, `Id_Articulo`, `Cantidad`, `PrecioXunidad`, `Total`) VALUES
(2, 2, 10, 2500, 25000),
(2, 6, 4, 2000, 8000),
(3, 2, 2, 2500, 5000),
(3, 3, 4, 1500, 6000),
(3, 7, 12, 1500, 18000),
(3, 6, 4, 2000, 8000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `Id_Empresa` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `NIT` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`Id_Empresa`, `Nombre`, `NIT`) VALUES
(1, 'Tienda Local', '1232-32113');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `Id_Entrada` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Id_Proveedor` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `ValorTotal` int(40) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 1,
  `Procesado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`Id_Entrada`, `Nombre`, `Id_Proveedor`, `Fecha`, `ValorTotal`, `Estado`, `Procesado`) VALUES
(2, 'Entrada Lacteos', 1, '2021-05-07', 55000, 0, 0),
(3, 'Entrada_Granos', 4, '2021-05-13', 61000, 1, 0),
(4, 'Entradad_Gaseosas', 5, '2021-05-12', 46000, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `Id_Proveedor` int(11) NOT NULL,
  `RazonSocial` varchar(200) NOT NULL,
  `PersonaContacto` int(30) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Telefono` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`Id_Proveedor`, `RazonSocial`, `PersonaContacto`, `Direccion`, `Telefono`) VALUES
(1, 'Alpina S.A', 3390978, 'calle 6 a#72jsc', 30021032),
(2, 'Bavaria', 120302, 'Avenida Boyaca', 2147483647),
(3, 'fritolay', 19282, 'calle5', 2147483647),
(4, 'InsualimentosS.A', 1929493, 'Calle6#72', 3029322),
(5, 'Postobon', 23234555, 'N-A', 13445236);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `Id_Salida` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Fecha` date NOT NULL,
  `PrecioTotal` int(50) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 1,
  `Procesado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`Id_Salida`, `Nombre`, `Fecha`, `PrecioTotal`, `Estado`, `Procesado`) VALUES
(2, 'SalidaGranos', '2021-05-14', 33000, 1, 0),
(3, 'VentaNatural', '2021-05-14', 37000, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_registro`
--

CREATE TABLE `tipo_registro` (
  `Id_Tipo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_registro`
--

INSERT INTO `tipo_registro` (`Id_Tipo`, `Nombre`) VALUES
(1, 'Ingreso'),
(2, 'Egreso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Cedula` int(20) NOT NULL,
  `Nombre_Usuario` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Cedula`, `Nombre_Usuario`, `Nombre`, `Apellido`, `Correo`, `Contraseña`, `Estado`) VALUES
(1, 1030695578, 'Santi', 'Santiago', 'Guzman', 'santiago_guzmanprada@hotmail.com', '123', 1),
(2, 10158272, 'jacus', 'Jacob ', 'Arevalo', 'jarevaloji@uninpahu.edu.co', '1234', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`Id_Admin`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`Id_Articulo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`Id_Empresa`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`Id_Entrada`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`Id_Proveedor`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`Id_Salida`);

--
-- Indices de la tabla `tipo_registro`
--
ALTER TABLE `tipo_registro`
  ADD PRIMARY KEY (`Id_Tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administracion`
--
ALTER TABLE `administracion`
  MODIFY `Id_Admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `Id_Articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `Id_Empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `Id_Entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `Id_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `Id_Salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
