-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-08-2018 a las 21:13:41
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `editorial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci, NOT NULL
  `fecha` date NOT NULL,
  `isbn` int(15) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `nombre`, `autor`, `descripcion`, `fecha`, `isbn`) VALUES
(1, 'De amor y de sombra', 'Isabel Allende', 'En un ambiente de incertidumbre y miedo, en un país de arrestos arbitrarios, desapariciones súbitas, y ejecuciones sumarias, la segunda novela de Isabel Allende narra la apasionada relación de dos personas dispuestas a arriesgar todo por el bien de la justicia y de la verdad.', '2017-10-30', 471668882),
(2, 'El amor en los tiempos del cólera', 'Gabriel García Márquez', 'Florentino Ariza se enamora de Fermina Daza y la corteja desde su adolescencia, pero las diferencias sociales y de carácter los separan. Fermina contrae matrimonio con el doctor Juvenal Urbino, mientras que Florentino espera el momento indicado para estar con su amor que ha estado esperando durante cincuenta y un años, nueve meses y cuatro días.', '2018-08-15', 213123123),
(3, 'Crónica de una muerte anunciada', 'Gabriel García Márquez', 'En un pequeño y aislado pueblo en la costa del Caribe, se casan Bayardo San Román, un hombre rico y recién llegado, y Ángela Vicario. Al celebrar su boda, los recién casados se van a su nueva casa, y allí Bayardo descubre que su esposa no es virgen. Inmediatamente, Bayardo devuelve a Ángela Vicario a la casa de sus padres donde es golpeada por su madre. Ángela culpará a Santiago Nasar, un vecino del pueblo.', '2018-04-10', 32442343),
(4, 'Los árboles mueren de pie', 'Alejandro Casona', 'El señor Balboa tenía un nieto desalmado al que, un día, tuvo que echar de casa (cosa que ocultó a su esposa). Desde entonces “Balboa” hacía llegar cartas apócrifas haciéndose pasar por su nieto para que su esposa no se deprimiera. El nieto real decide volver a su hogar (en busca de dinero) pero el barco en el que venía se pierde. Balboa contrata a un imitador. Su nieto falso (Mauricio) en conjunto con una linda muchacha (Isabel), para que finja ser el nieto perdido y «su feliz esposa» ante la abuela; les cuenta y logra que acepten lo que dijo Balboa.', '2017-10-11', 1232134);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
