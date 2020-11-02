-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2020 a las 21:51:14
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comunicaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `id_user` int(12) NOT NULL,
  `actividad` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(30) NOT NULL,
  `id_estado` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `id_user`, `actividad`, `fecha`, `hora`, `id_estado`) VALUES
(1, 1, 'Desarrollo sistema para registro de actividades funcionarios oficina de comunicaciones\r\nen la casa de la cultura', '2020-03-09', '08:00:00', 3),
(2, 49, 'Reunión con delegación de mineros de Quinchia', '2020-03-16', '07:30', 1),
(3, 54, 'Reunión Dirección de Comunicaciones. Comité.  dddd', '2020-03-09', '', 1),
(4, 54, 'Comité Gerencial Secretaría de Desarrollo Económico y Competitividad', '2020-03-09', '08:00:00', 3),
(5, 54, 'Almuerzo Rector Universidad Tecnológica de Pereira, acompañando a la Secretaria de Desarrollo Económico, para socializar proyectos y actividades que involucren a la Gobernación con la UTP y la Secretaría y proyectos futuros.', '2020-03-10', '', 3),
(6, 54, 'Acompañamiento reunión del Comité Regional de Competitividad de Risaralda; Registro visita del enlace del ministerio de Comercio, para definir hoja de ruta de Comisión Regional de Competitividad.', '2020-03-10', '', 3),
(7, 54, 'Reunión funcionarios Secretaría para elaboración de los proyectos Plan de Desarrollo, en componente empresarial. Lugar: Secretaría de Planeación', '2020-03-11', '', 1),
(8, 54, 'Asistencia reunión Gobernador con Alcaldes, para definir proyectos estratégicos, acompañamiento a Secretaria de Desarrollo Económico. Sala de juntas Despacho Gobernador.', '2020-03-11', '', 1),
(9, 54, 'Reunión Plan de Desarrollo componente Turismo, secretaría de Planeación departamental.', '2020-03-11', '', 3),
(10, 54, 'Encuentro Alcaldes y Gobernador con funcionarios Federación de Cafeteros, para reafirmar compromisos del Paisaje Cultural Cafetero. Se realizó boletín de prensa y bullets para la intervención del Sr. Gobernador. Lugar: Universidad Católica de Pereira.', '2020-03-12', '', 3),
(11, 54, 'Acompañamiento entrega interventoría proyecto \"Establecimiento de una ruta turística para el Centro-Occidente de Risaralda\". Lugar: secretaría de Desarrollo Económico.', '2020-03-12', '', 1),
(12, 54, 'Reunión asesora proyecto Centro de Biodiversidad, para definir piezas de comunicación y estrategia con colegios.', '2020-03-13', '', 3),
(13, 54, 'Mesa Técnica Comunicaciones, CPC, definición productos rutas turísticas para entrega. Lugar: oficina director de Comunicaciones 10: 00 am', '2020-03-13', '', 3),
(14, 54, 'Reunión de cierre Vitrina Anato, 2:30 p.m. Secretaría de Desarrollo Económico.', '2020-03-13', '', 3),
(15, 41, 'Cronograma de Entrevistas municipios para los 100 primeros días', '2020-03-16', '14:00', 1),
(16, 41, 'Pruebas de estudio para programa de TV', '2020-03-17', '14:00', 1),
(17, 41, 'Animación Campaña de impuesto vehicular', '2020-03-18', '09:00', 1),
(18, 41, 'Diseño de piezas animadas para Programa institucional SDT', '2020-03-16', '09:00', 3),
(19, 62, 'Audiencia Fondo de Financiamiento de la Infraestructura Educativa FFIE con Contraloría. ', '2020-03-17', '08:00', 1),
(20, 62, 'Reunión Gobernador de Risaralda con rectores de las universidades de la región ', '2020-03-18', '17:00', 1),
(21, 49, '8:30 a.m. Gobernador Víctor Manuel Tamayo y Primera Dama, Nathala Sierra se reúnen con Monseñor Rigoberto Corredor.\r\nLugar: Curia Episcopal.\r\n\r\n9:00 a.m. Gobernador Víctor Manuel Tamayo lidera Comité de Vigilancia Epidemiológica.\r\nLugar: Sala de Juntas, Despacho del Gobernador. (tema: Coronavirus)\r\n\r\n10:00 a.m.  Gobernador Víctor Manuel Tamayo preside Comité Departamental de Gestión del Riesgo.\r\nLugar: Sala de Juntas, Despacho del Gobernador. (tema: Coronavirus)\r\n\r\n\r\n2:00 p.m. Gobernador Víctor Manuel Tamayo lidera rueda de prensa. (tema: Coronavirus)\r\nLugar: Sala de Juntas, Despacho del Gobernador.\r\n\r\n5:00 p.m. Gobernador Víctor Manuel Tamayo preside Junta Directiva de la Carder.\r\nLugar: Carder', '2020-03-16', '', 1),
(22, 49, '9:30 a.m. Gobernador Víctor Manuel Tamayo participa en Junta Directiva de Telecafé.\r\nLugar: Sala de Juntas Despacho del Gobernador de Risaralda.', '2020-03-17', '', 1),
(23, 49, '8:15 a.m. Gobernador Victor Manuel Tamayo se reúne con delegados de la Asociación de Concejales de Risaralda.\r\nLugar: Sala de Juntas.\r\n\r\n9:30 a.m. Gobernador Víctor Manuel Tamayo lidera Consejo Seccional de Estupefacientes.\r\nLugar: Sala de Juntas.\r\n\r\n5:00 p.m. Gobernador Víctor Manuel Tamayo preside mesa de trabajo con rectores de universidades públicas y privadas.\r\nLugar: Sala de Juntas.', '2020-03-18', '', 1),
(24, 49, 'Gobernador entrega a la comunidad vía río San Francisco en Marsella.', '2020-03-19', '', 1),
(25, 62, 'Acompañamiento secretario de educación departamental en mesa del Gobernador con alcaldes (se realizó acompañamiento y apoyo en el cubrimiento).', '2020-03-11', '08:00', 3),
(26, 62, 'Secretario de educación departamental asiste al encuentro Ideas para Tejer Territorios (secretario de educación no asistió)', '2020-03-14', '09:00', 4),
(27, 62, 'Acompañamiento Secretario de Educación a entrevista en el programa En Serio con Fabio Castaño.  ', '2020-03-10', '07:30', 3),
(28, 62, 'Actualizar cifra de matriculados para banner de redes sociales oficiales de la Gobernación de Risaralda.', '2020-03-09', '08:00', 3),
(29, 62, 'Actualizar cifra de matriculados para mención en la emisora.', '2020-03-09', '09:00', 1),
(30, 62, 'Actualizar cifra de matriculados para mención en la emisora.', '2020-03-09', '', 3),
(31, 62, 'Se pide elaboración de diseño sobre el programa bandera, Risaralda Profesional.', '2020-03-09', '', 3),
(32, 62, 'Se pide elaboración de diseño para invitación a rectores de universidades de la región en la cual el gobernador presentará Risaralda Profesional, el 18 de marzo. ', '2020-03-09', '', 3),
(33, 62, 'Seguimiento a la operación de la línea de rectores, para denuncias sobre PAE y otro tipo de atención que requieran estudiantes.', '2020-03-09', '', 3),
(34, 50, 'Sesión de trabajo entorno al Plan Departamental de Extensión Agropecuaria con los secretarios de Agricultura de Caldas y Quindío\r\nLugar:  Gobernación del Quindío', '2020-03-17', '14:00', 1),
(35, 52, 'Grabación programa radial La Hora de la Mujer. ', '2020-03-17', '09:00:59', 1),
(36, 52, 'Boletín balance convocatoria a conformar el Consejo Consultivo Departamental de Mujeres ', '2020-03-16', '08:00', 1),
(37, 52, 'solicitud de diseño banner programa de radio La Hora de la Mujer', '2020-03-16', '10:00', 1),
(38, 52, 'Capacitación y actualización del portal web de la Secretaría ', '2020-03-16', '14:00', 1),
(39, 52, 'Mesa sectorial de grupos vulnerables y población especial ', '2020-03-20', '08:00', 1),
(40, 52, 'Solicitud logo para Consejo Departamental de Paz, Reconciliación y Convivencia. ', '2020-03-16', '11:00', 1),
(41, 54, 'Presentación proyecto PLEC gremios de transporte y logística. 8 a.m., sala de juntas Gobernación', '2020-03-13', '', 3),
(42, 49, ' Consejo Directivo Carder (Elección de Director).', '2020-03-16', '17:30', 1),
(43, 1, 'se realizo satisfactoriamente editado', '2020-03-17', '22:00', 1),
(44, 1, 'nueva actividad', '2020-03-19', '13:00', 2),
(45, 1, 'nueva actividad', '2020-03-31', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_actividades`
--

CREATE TABLE `comentarios_actividades` (
  `id` int(11) NOT NULL,
  `id_actividad` int(12) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios_actividades`
--

INSERT INTO `comentarios_actividades` (`id`, `id_actividad`, `comentario`, `fecha`) VALUES
(1, 4, 'Todos los lunes a partir de las 8 de la mañana la Secretaria convoca a comité Gerencial a las Directoras y a la asesora de Comunicaciones', '2020-03-12'),
(2, 25, 'Se realizó acompañamiento y apoyo en el cubrimiento.', '2020-03-13'),
(3, 26, 'secretario de educación no asistió.', '2020-03-13'),
(4, 27, 'Se realizó acompañamiento.', '2020-03-13'),
(5, 28, 'Se actualizó. ', '2020-03-13'),
(6, 30, 'Se realizó. ', '2020-03-13'),
(7, 31, 'Se solicitó. ', '2020-03-13'),
(8, 32, 'Se solicitó al equipo de diseño. ', '2020-03-13'),
(9, 33, 'En proceso.', '2020-03-13'),
(10, 18, 'sddsds', '2020-03-16'),
(11, 1, 'Actividad realizada correctamente', '2020-03-16'),
(12, 44, 'esta nueva actividad se aplazo', '2020-03-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicados`
--

CREATE TABLE `comunicados` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `id_dependencia` int(12) NOT NULL,
  `id_periodista` int(12) NOT NULL,
  `id_estado` int(12) NOT NULL DEFAULT 1,
  `fecha_texto` varchar(100) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `correo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `correo`) VALUES
(1, 'comunicaciones@risaralda.gov.co'),
(2, 'rector@ucp.edu.co'),
(3, 'oscar.aguirre.2007@hotmail.com'),
(4, 'paulapaula974@gmail.com'),
(5, 'fedecoter@yahoo.es'),
(6, 'guillobopla@hotmail.com'),
(7, 'marelensa@hotmail.com'),
(8, 'navi400@hotmail.com'),
(9, 'asomartv@yahoo.com'),
(10, 'redaccion@ciudadregion.com'),
(11, 'grie.laflorestaapia@risaralda.gov.co'),
(12, 'hugoorozcorios@hotmail.com'),
(13, 'gerencia@telecafe.tv'),
(14, 'andreav95@gmail.com'),
(15, 'econativa08@hotmail.com'),
(16, 'grie.mistral@risaralda.gov.co'),
(17, 'kettycantillo@hotmail.com'),
(18, 'hospital.mistrato@risaralda.gov.co'),
(19, 'lanabema@hotmail.com'),
(20, 'alexa-1505@hotmail.com'),
(21, 'damaris.quintero@risaralda.gov.co'),
(22, 'auris1427@yahoo.es'),
(23, 'claudia.restrepo@risaralda.gov.co'),
(24, 'magazinmoliendocafe@gmail.com'),
(25, 'comunitaria@eldiario.com.co'),
(26, 'clapalo1208@gmail.com'),
(27, 'claudia_parra1023@hotmail.com'),
(28, 'alexfio110@gmail.com'),
(29, 'marimalkun@hotmail.com'),
(30, 'grie.bernardo@risaralda.gov.co'),
(31, 'periodistasrisaralda@gmail.com'),
(32, 'batallonsanmateo@gmail.com'),
(33, 'williams119@hotmail.com'),
(34, 'fanny.velasquez@risaralda.gov.co'),
(35, 'elenaserna27@hotmail.com'),
(36, 'hanslamprea@gmail.com'),
(37, 'redaccion@vocerodelcafe.com.co'),
(38, 'alciber.salas@risaralda.gov.co'),
(39, 'jhonnn-282@hotmail.com'),
(40, 'johnjairoariashenao@yahoo.com'),
(41, 'gerardoandresnossa@hotmail.com'),
(42, 'luismi16_@hotmail.com'),
(43, 'secretaria@fenalcorisaralda.com'),
(44, 'dircom@utp.edu.co'),
(45, 'grie.santaelena@risaralda.gov.co'),
(46, 'alcira.mendez@risaralda.gov.co'),
(47, 'grie.tecnologico@risaralda.gov.co'),
(48, 'luz.zapata@risaralda.gov.co'),
(49, 'diego.naranjo@risaralda.gov.co'),
(50, 'bendito37@yahoo.es'),
(51, 'avt329@live.com'),
(52, 'ivanoguera11@yahoo.es'),
(53, 'hernandootalvaroc@gmail.com'),
(54, 'albalucialm@gmail.com'),
(55, 'anibalgustavo7@hotmail.com'),
(56, 'nathi8476@hotmail.com'),
(57, 'ustedesnoticia@hotmail.com'),
(58, 'iengranada_dosq@yahoo.com'),
(59, 'comutevelac_217@hotmail.com'),
(60, 'jimmysintantoscuentos@yahoo.com'),
(61, 'despachoejecutivo@hotmail.com'),
(62, 'jitp.1424@hotmail.com'),
(63, 'sandraorlas678@hotmail.com'),
(64, 'avelez@areandina.edu.co'),
(65, 'jfreddyc28@hotmail.com'),
(66, 'john.vasquez@risaralda.gov.co'),
(67, 'juanmanuellenislara@gmail.com'),
(68, 'concejo@balboa-risaralda.gov.co'),
(69, 'epm0609@hotmail.com'),
(70, 'alexander.garcia@risaralda.gov.co'),
(71, 's.arquitectos.rda@gmail.com'),
(72, 'grie.santo.domingo@risaralda.gov.co'),
(73, 'lujose22@hotmail.com'),
(74, 'puntocafenoticias@gmail.com'),
(75, 'julianchicalo@hotmail.com'),
(76, 'rcnpereira@gmail.com'),
(77, 'guapa.02@hotmail.com'),
(78, 'jhonatan.1007@hotmail.com'),
(79, 'grie.sausagua@risaralda.gov.co'),
(80, 'raulquijanopereira@yahoo.com'),
(81, 'luchoespectacular@yahoo.com'),
(82, 'region3.coman@policia.gov.co'),
(83, 'diana.ramirez@risaralda.gov.co'),
(84, 'pahr2@hotmail.com'),
(85, 'deris.coest@policia.gov.co'),
(86, 'hiupaber@hotmail.com'),
(87, 'idcubillos@quindio.gov.co'),
(88, 'teleprisma.av@hotmail.com'),
(89, 'jandreagiraldoc@gmail.com'),
(90, 'grie.labamba@risaralda.gov.co'),
(91, 'dimaroga70@hotmail.com'),
(92, 'cardonalucho@hotmail.com'),
(93, 'pavaji@utp.edu.co'),
(94, 'sucesosyopiniones@hotmail.com'),
(95, 'grie.lapalma@risaralda.gov.co'),
(96, 'azucarvirginia@yahoo.es'),
(97, 'info@air.org.co'),
(98, 'faysury90@hotmail.com'),
(99, 'gbgh44@gmail.com'),
(100, 'todelarpereira@hotmail.com'),
(101, 'quindiocnc@gmail.com'),
(102, 'facamo2007@yahoo.com'),
(103, 'grie.patio.bonito@risaralda.gov.co'),
(104, 'zebas123@hotmail.es'),
(105, 'periodicoejecafetero@hotmail.com'),
(106, 'jhonatangtaborda@gmail.com'),
(107, 'caspior2c@gmail.com'),
(108, 'oparra@rcnradio.com.co'),
(109, 'alcaldia@lavirginia-risaralda.gov.co'),
(110, 'motoramatv@hotmail.com'),
(111, 'gloriax72@hotmail.com'),
(112, 'Sandra.osorio@risaralda.gov.co'),
(113, 'johnj.posada@gmail.com'),
(114, 'macrismuri@hotmail.com'),
(115, 'alefdz2004@hotmail.com'),
(116, 'mario.418@hotmail.com'),
(117, 'gilbertogallegovelasquez@hotmail.com'),
(118, 'quimbayaviva@gmail.com'),
(119, 'periodis@utp.edu.co'),
(120, 'aflandorffer@gmail.com'),
(121, 'diomedes.toro@risaralda.gov.co'),
(122, 'kvalvarez@rcnradio.com.co'),
(123, 'jofer62@hotmail.com'),
(124, 'dduque@mintrabajo.gov.co'),
(125, 'bomberos@dosquebradas.gov.co'),
(126, 'radiog1041@hotmail.com'),
(127, 'mauricio.toro@risaralda.gov.co'),
(128, 'Hectorhoyos.apia@gmail.com'),
(129, 'mauricio.secresalud.risaralda@gmail.com'),
(130, 'deris.guged@policia.gov.co'),
(131, 'margarita.alzate@risaralda.gov.co'),
(132, 'psalazarsierra@gmail.com'),
(133, 'alexanderlugo73@gmail.com'),
(134, 'oscarto88@hotmail.com'),
(135, 'ltorres@camarapereira.org.co'),
(136, 'hanslamprea@yahoo.es'),
(137, 'elyz12@hotmail.com'),
(138, 'giemaes27@hotmail.es'),
(139, 'davincho910525@hotmail.com'),
(140, 'comunicacionesgaulamilitar@gmail.com'),
(141, 'dj.jh@hotmail.com'),
(142, 'primera@eldiario.com.co'),
(143, 'alvarocomunicaciones@yahoo.com'),
(144, 'Jhonsepulveda1@gmail.com'),
(145, 'mesayepes@gmail.com'),
(146, 'elvia.osorio53@hotmail.com'),
(147, 'paolandreadiazsanchez@gmail.com'),
(148, 'perlajacela@hotmail.com'),
(149, 'orozcoradiotv@gmail.com'),
(150, 'cielo.marin@risaralda.gov.co'),
(151, 'contactenos@belendeumbria-risaralda.gov.co'),
(152, 'jorgis1955@hotmail.com'),
(153, 'nalolo21@gmail.com'),
(154, 'drinales@hotmail.com'),
(155, 'periodismocruel@hotmail.com'),
(156, 'juanmairplane@yahoo.com'),
(157, 'presidente@acopicentrooccidente.org'),
(158, 'altoyclaroconalvaro@hotmail.com'),
(159, 'israel.londono@risaralda.gov.co'),
(160, 'jhonnysaa@hotmail.com'),
(161, 'betofranco12@hotmail.com'),
(162, 'grie.marsella@risaralda.gov.co'),
(163, 'mdiaz.prensa@gmail.com'),
(164, 'agrorisaralda@hotmail.com'),
(165, 'joframean@gmail.com'),
(166, 'elquerendonwe@gmail.com'),
(167, 'gduqueg1@hotmail.com'),
(168, 'jpablo348@gmail.com'),
(169, 'ederalan@hotmail.com'),
(170, 'ingrid.catano@risaralda.gov.co'),
(171, 'julioabayona_1@hotmail.com'),
(172, 'elpereirano2017@gmail.com'),
(173, 'grie.fco.jose@risaralda.gov.co'),
(174, 'presidencia@unilibre.edu.co'),
(175, 'gersonlopezgarcia@gmail.com'),
(176, 'jmarinm@comfamiliar.com'),
(177, 'mscarlos1964@gmail.com'),
(178, 'sabo16@hotmail.com'),
(179, 'jhonjairomunoz@gmail.com'),
(180, 'alcaldia@apia-risaralda.gov.co'),
(181, 'jacke0304@hotmail.com'),
(182, 'jnieto_87@hotmail.com'),
(183, 'grie.miracampos@risaralda.gov.co'),
(184, 'faeli1973@hotmail.com'),
(185, 'crist019@hotmail.com'),
(186, 'rector@utp.edu.co'),
(187, 'ettore79_4@hotmail.com'),
(188, 'creativo@pereiravirtual.com'),
(189, 'jramirez@camarapereira.org.co'),
(190, 'amelperiodico@gmail.com'),
(191, 'valentina.rojas@cafedecolombia.com.co'),
(192, 'maricelagarzon1@gmail.com'),
(193, 'edufranco2610@gmail.com'),
(194, 'prensabrigadadesminado@gmail.com'),
(195, 'almundodeturismodesde@gmail.com'),
(196, 'direccionejecafetero@anato.org'),
(197, 'lina.munera@risaralda.gov.co'),
(198, 'carito2862@hotmail.com'),
(199, 'grie.columbia@risaralda.gov.co'),
(200, 'diana.henao@esap.edu.co'),
(201, 'jfmcomunicaciones@gmail.com'),
(202, 'sipol.dequi@dipol.gov.co'),
(203, 'concejomunicipalapia@hotmail.es'),
(204, 'abotero@camarapereira.org.co'),
(205, 'criss_saldarriaga@icloud.com'),
(206, 'vane.gomez93@hotmail.com'),
(207, 'grie.lorencita@risaralda.gov.co'),
(208, 'robin210318@gmail.com'),
(209, 'ramosgamez@hotmail.com'),
(210, 'mauricio.roa@risaralda.gov.co'),
(211, 'diego_lombo@hotmail.com'),
(212, 'contabilidad@acopicentrooccidente.org'),
(213, 'prensaalcaldiapereira@gmail.com'),
(214, 'ferrae@gmail.com'),
(215, 'didiersernanoticias@gmail.com'),
(216, 'luisalbertofigueroa@yahoo.com.co'),
(217, 'natalia.gallo@ucp.edu.co'),
(218, 'beanasa@hotmail.com'),
(219, 'lalvarez@andi.com.co'),
(220, 'elmer4477@gmail.com'),
(221, 'danielmontabar@hotmail.com'),
(222, 'ruizromeroja@gmail.com'),
(223, 'alarcon961@yahoo.com'),
(224, 'd.marce-1091@hotmail.com'),
(225, 'juanitacafe@yahoo.com'),
(226, 'calidad@quindio.gov.co'),
(227, 'carlos.velez@risaralda.gov.co'),
(228, 'radiocesar@yahoo.com'),
(229, 'prensaplaneacion@gmail.com'),
(230, 'paulmec@hotmail.com'),
(231, 'ansermaculturalfm@gmail.com'),
(232, 'alexandra.espinosa@risaralda.gov.co'),
(233, 'donnergaitan5@hotmail.com'),
(234, 'lagodoc@hotmail.com'),
(235, 'jamesconcejal@gmail.com'),
(236, 'janibaldg@gmail.com'),
(237, 'paulina.giraldo@ucp.edu.co'),
(238, 'alejandro.usma@risaralda.gov.co'),
(239, 'marcediaz13@gmail.com'),
(240, 'mauroproductor@hotmail.com'),
(241, 'manizalesnews@gmail.com'),
(242, 'lisandromotta@gmail.com'),
(243, 'hugoa@utp.edu.co'),
(244, 'judicial.pereira2@qhubo.com'),
(245, 'pilarsalcedojimenez@yahoo.com'),
(246, 'agrosuarez10@gmail.com'),
(247, 'mentalfilandia@hotmail.com'),
(248, 'juano.velasquez@hotmail.com'),
(249, 'angelava89@hotmail.com'),
(250, 'pagina.alcaldia@gmail.com'),
(251, 'dianam.vera@ucc.edu.co'),
(252, 'santacho17@gmail.com'),
(253, 'notitodelar@hotmail.com'),
(254, 'grie.rosario@risaralda.gov.co'),
(255, 'erika23111@hotmail.com'),
(256, 'henrycelis56@hotmail.com'),
(257, 'alcaldiapueblorico@gmail.com'),
(258, 'leoss107@hotmail.com'),
(259, 'anscia@hotmail.com'),
(260, 'poohmade@hotmail.com'),
(261, 'duberney.gutierrez@ucp.edu.co'),
(262, 'indeportes@gmail.com'),
(263, 'marcotenovedades@hotmail.com'),
(264, 'achavez@sena.edu.co'),
(265, 'archivo@balboa-risaralda.gov.co'),
(266, 'hsantana2004@gmail.com'),
(267, 'adriana.vallejo@unilibre.edu.co'),
(268, 'contactenos@balboa-risaralda.gov.co'),
(269, 'forero91@hotmail.com'),
(270, 'jandy-20112011@hotmail.com'),
(271, 'jhoncatano@yahoo.com'),
(272, 'juandsdn@hotmail.com'),
(273, 'luiso1968@hotmail.com'),
(274, 'canalvealo@gmail.com'),
(275, 'jhoncito6@gmail.com'),
(276, 'fmorales100@gmail.com'),
(277, 'mayra_tapasco@hotmail.com'),
(278, 'jannlo@hotmail.com'),
(279, 'mahuco24@hotmail.com'),
(280, 'despiertapereira@gmail.com'),
(281, 'social@eldiario.com.co'),
(282, 'arleyvalencia@gmail.com'),
(283, 'diegoescobar650@gmail.com'),
(284, 'germandario14@gmail.com'),
(285, 'diegosalazar9@yahoo.com'),
(286, 'humberto.franco@risaralda.gov.co'),
(287, 'escop24@yahoo.es'),
(288, 'geesco10@hotmail.com'),
(289, 'hecandres1980@gmail.com'),
(290, 'canalregionalmundovisiontv@gmail.com'),
(291, 'sguzman@utp.edu.co'),
(292, 'willibator@hotmail.com'),
(293, 'caliche117@yahoo.com'),
(294, 'olguita324@gmail.com'),
(295, 'heribertolopez302@hotmail.com'),
(296, 'sandrab_25@hotmail.com'),
(297, 'bioled-32@hotmail.es'),
(298, 'marco_aristizabal@yahoo.com'),
(299, 'grie.marillac@risaralda.gov.co'),
(300, 'levinsonfm@gmail.com'),
(301, 'grie.alfonso.lopez@risaralda.gov.co'),
(302, 'lampreahans@hotmail.com'),
(303, 'isabel.uribaron@gmail.com'),
(304, 'murciaosvaldo@hotmail.com'),
(305, 'andres@octopusg.com'),
(306, 'anamariavillegas11@gmail.com'),
(307, 'hernan.osorio@risaralda.gov.co'),
(308, 'rafa.gtk@hotmail.com'),
(309, 'andresossa.prensa@gmail.com'),
(310, 'prensapoliciapereira@gmail.com'),
(311, 'pinarpub@geonoticias.net'),
(312, 'arpidioe@yahoo.es'),
(313, 'moralito62@hotmail.com'),
(314, 'warroyavegarcia@gmail.com'),
(315, 'info@vivacerritos.com'),
(316, 'oscar.valencia@risaralda.gov.co'),
(317, 'normagutierrez911@hotmail.com'),
(318, 'hechosdesemana@hotmail.com'),
(319, 'jennifer.bolivar@risaralda.gov.co'),
(320, 'grie.ciato@risaralda.gov.co'),
(321, 'jennythebest26@hotmail.com'),
(322, 'laliascosd@uqvirtual.edu.co'),
(323, 'grie.pio.xii@risaralda.gov.co'),
(324, 'prensa@mindefensa.gov.co'),
(325, 'local.pereira1@qhubo.com'),
(326, 'elimparcial6@gmail.com'),
(327, 'manuelloaiza92@gmail.com'),
(328, 'danieljt1978@hotmail.com'),
(329, 'bibiana.agudelo@risaralda.gov.co'),
(330, 'grie.socialdokabu@risaralda.gov.co'),
(331, 'radiolatina1041@hotmail.com'),
(332, 'diegoalfonsodelgadollano60@hotmail.com'),
(333, 'albaemma.grisales@risaralda.gov.co'),
(334, 'osoriopress@gmail.com'),
(335, 'andrea.romero@risaralda.gov.co'),
(336, 'cgarzon63@misena.edu.co'),
(337, 'floralba.londono@risaralda.gov.co'),
(338, 'geco2525@hotmail.com'),
(339, 'parabolica_quinchia@hotmail.com'),
(340, 'malejalinares29@gmail.com'),
(341, 'grie.san.andres@risaralda.gov.co'),
(342, 'fely848@hotmail.com'),
(343, 'dimaroga70@gmail.com'),
(344, 'jhonjairopat_79@hotmail.com'),
(345, 'shirleycarob@hotmail.com'),
(346, 'cavtgo@hotmail.com'),
(347, 'grie.inmaculada@risaralda.gov.co'),
(348, 'licarva@hotmail.com'),
(349, 'juanorregol09@gmail.com'),
(350, 'soto7771@hotmail.com'),
(351, 'jasanta.comunicaciones@hotmail.com'),
(352, 'paginalagreca@gmail.com'),
(353, 'amejia99@gmail.com'),
(354, 'yulianaperdomo@gmail.com'),
(355, 'grie.laflorida@risaralda.gov.co'),
(356, 'jaimegrajales@hotmail.com'),
(357, 'ladyalexa1215@hotmail.com'),
(358, 'edgarleandro73@hotmail.com'),
(359, 'rosmiracorro@yahoo.com.mx'),
(360, 'alcaldia@santuario-risaralda.gov.co'),
(361, 'amigosdelapoliticadelrisaralda@gmail.com'),
(362, 'jhon.jimenez@risaralda.gov.co'),
(363, 'evela@oro.com.co'),
(364, 'georgema0913@yahoo.es'),
(365, 'prensa@loteriadelrisaralda.com'),
(366, 'asoambiental@gmail.com'),
(367, 'adriana.gallon@ucp.edu.co'),
(368, 'grie.maria.auxiliadora@risaralda.gov.co'),
(369, 'idavid_arango@hotmail.com'),
(370, 'osorioprensa@hotmail.com'),
(371, 'alejandroarboledallanos@gmail.com'),
(372, 'edgarampm@hotmail.com'),
(373, 'mongom22@hotmail.com'),
(374, 'rdqradio@gmail.com'),
(375, 'brian98254@gmail.com'),
(376, 'camilo_valencia17@hotmail.com'),
(377, 'fbenitez@caracol.com.co'),
(378, 'editor.pereira@qhubo.com'),
(379, 'disaac@archivogeneral.gov.co'),
(380, 'opiniones@periodicoelfaro.co'),
(381, 'luisgarciaquiroga@gmail.com'),
(382, 'magudelot14@hotmail.com'),
(383, 'presidencia@air.org.co'),
(384, 'jcmarinpda@gmail.com'),
(385, 'hector.alzate@risaralda.gov.co'),
(386, 'grie.jordania@risaralda.gov.co'),
(387, 'vivoperiodismo@hotmail.com'),
(388, 'gusotovo@gmail.com'),
(389, 'dipol.sipol-meper@policia.gov.co'),
(390, 'gerencia.arauna@gmail.com'),
(391, 'danielperiodista05@gmail.com'),
(392, 'almazum2@hotmail.es'),
(393, 'dcarito1028@hotmail.com'),
(394, 'lareddemunoz@gmail.com'),
(395, 'alejacomunicadora@gmail.com'),
(396, 'anamilenamazuera@gmail.com'),
(397, 'feruma@eltiempo.com'),
(398, 'pipelaker12@hotmail.com'),
(399, 'everval49@gmail.com'),
(400, 'deporteyturismo@hotmail.com'),
(401, 'dgdianagomez43@gmail.com'),
(402, 'elexpresoelperiodico@gmail.com'),
(403, 'patyzorro@hotmail.com'),
(404, 'johama85@hotmail.com'),
(405, 'guaroguarin@msn.com'),
(406, 'cespedescomunicaciones@gmail.com'),
(407, 'egarcia99@misena.edu.co'),
(408, 'juan.Sierra@mindefensa.gov.co'),
(409, 'didiserna@hotmail.com'),
(410, 'angela.gallo@risaralda.gov.co'),
(411, 'dir.revistaagendalegislativa@gmail.com'),
(412, 'comercialeventos2013@gmail.com'),
(413, 'jaristi@etp.net.co'),
(414, 'flamprea@hotmail.com'),
(415, 'curaduria1dosquebradas@gmail.com'),
(416, 'lucasmancera@yahoo.es'),
(417, 'geanagmu@hotmail.com'),
(418, 'federico.cano@risaralda.gov.co'),
(419, 'alexccongar@hotmail.com'),
(420, 'grie.nucleoescolar@risaralda.gov.co'),
(421, 'dsrisaralda@medicinalegal.gov.co'),
(422, 'gabriel.calvo@risaralda.gov.co'),
(423, 'ang.mary@hotmail.es'),
(424, 'carder@carder.gov.co'),
(425, 'adrianfree80@hotmail.com'),
(426, 'orlandin7@gmail.com'),
(427, 'norma.jaramillo@risaralda.gov.co'),
(428, 'abelgomo@gmail.com'),
(429, 'jediputada@hotmail.com'),
(430, 'caravelcarde@hotmail.com'),
(431, 'fgaviria3@gmail.com'),
(432, 'guillopuntoypelota@gmail.com'),
(433, 'hospital.santuario@risaralda.gov.co'),
(434, 'caritoho10@yahoo.es'),
(435, 'prensaejercitoarmenia@gmail.com'),
(436, 'caro.729@hotmail.com'),
(437, 'jesus1988-cuestas@hotmail.com'),
(438, 'torreglosajr@hotmail.com'),
(439, 'jmlloflo@hotmail.com'),
(440, 'jpinito8@hotmail.com'),
(441, 'luisalbertofigueroa902@hotmail.com'),
(442, 'acipripr@hotmail.com'),
(443, 'grie.veracruz@risaralda.gov.co'),
(444, 'jarrisito2010@hotmail.com'),
(445, 'lapazjaimemejia@gmail.com'),
(446, 'geinit@hotmail.com'),
(447, 'hospital.apia@risaralda.gov.co'),
(448, 'fbaena@areandina.edu.co'),
(449, 'areapoliticaweb@gmail.com'),
(450, 'angelamariagiraldo2012@hotmail.com'),
(451, 'lilirotsen@hotmail.com'),
(452, 'linaquintero314@hotmail.com'),
(453, 'educamossa@yahoo.com'),
(454, 'wortizga@gmail.com'),
(455, 'duver1989@hotmail.com'),
(456, 'beuge79@hotmail.com'),
(457, 'gelogo81@hotmail.com'),
(458, 'mgarzonvalencia@gmail.com'),
(459, 'jorgepulgarinm@hotmail.com'),
(460, 'hectormundo177@hotmail.com'),
(461, 'julicomunica@hotmail.com'),
(462, 'inforey.rey@gmail.com'),
(463, 'johncabreragomez@gmail.com'),
(464, 'especial@eldiario.com.co'),
(465, 'periodicoactualidadregional@gmail.com'),
(466, 'everardoochoapareja@gmail.com'),
(467, 'magazinedelcafe2009@hotmail.com'),
(468, 'alcaldia@mistrato-risaralda.gov.co'),
(469, 'secretaria@smpereira.org'),
(470, 'njartunduaga@hotmail.com'),
(471, 'rudaru22@hotmail.com'),
(472, 'grie.tambores@risaralda.gov.co'),
(473, 'dianiz07@hotmail.com'),
(474, 'nelson_arbelaez@hotmail.com'),
(475, 'deris.coman@policia.gov.co'),
(476, 'paola.nieto@risaralda.gov.co'),
(477, 'jaime.eslava@risaralda.gov.co'),
(478, 'alcaldia@marsella-risaralda.gov.co'),
(479, 'arturo.delfin16@hotmail.com'),
(480, 'fraari@gmail.com'),
(481, 'durguez1@hotmail.com'),
(482, 'franciscoarias@periodistas.com'),
(483, 'desarrollosocial@lavirginia-risaralda.gov.co'),
(484, 'aristizabalnohora@yahoo.es'),
(485, 'oscarbayona2320@hotmail.com'),
(486, 'gloriaeldiario@gmail.com'),
(487, 'lufesanz@mail.com'),
(488, 'janloto@gmail.com'),
(489, 'jhoelmusic@gmail.com'),
(490, 'educultura@balboa-risaralda.gov.co'),
(491, 'gerenciahsjm@hotmail.com'),
(492, 'andresarco83@hotmail.com'),
(493, 'matgar@eltiempo.com'),
(494, 'hospital.pueblorico@risaralda.gov.co'),
(495, 'fabergomeza09@hotmail.com'),
(496, 'tatyaguilarpreston@gmail.com'),
(497, 'lilibarragalavis@hotmail.com'),
(498, 'clarapinto@presidencia.gov.co'),
(499, 'director@air.org.co'),
(500, 'magobur1@yahoo.com'),
(501, 'rameco@gmail.com'),
(502, 'carlos.gil@risaralda.gov.co'),
(503, 'asamblea@risaralda.gov.co'),
(504, 'cardila@caracol.com.co'),
(505, 'grie.taparcal@risaralda.gov.co'),
(506, 'hhenaoparra@gmail.com'),
(507, 'jorgemariooyg@gmail.com'),
(508, 'comuna2rjcs@hotmail.com'),
(509, 'diego.blandon@risaralda.gov.co'),
(510, 'grie.purembara@risaralda.gov.co'),
(511, 'ajimenez@ucm.edu.co'),
(512, 'maricelagarzon@gmail.com'),
(513, 'angelagordita_180@hotmail.com'),
(514, 'helmerg@hotmail.com'),
(515, 'lapatria@lapatria.com'),
(516, 'dpanesso@diegopanesso.com'),
(517, 'evila.gallego@risaralda.gov.co'),
(518, 'sandradekno@hotmail.com'),
(519, 'hospital.marsella@risaralda.gov.co'),
(520, 'avilae2003@yahoo.com'),
(521, 'jandreagiraldo@misena.edu.co'),
(522, 'cristian.zuluaga@caracol.com.co'),
(523, 'nidodecondores4@hotmail.com'),
(524, 'andibomo1966@gmail.com'),
(525, 'jkrodriguez@caracol.com.co'),
(526, 'diego4bl@gmail.com'),
(527, 'yaneth902@yahoo.es'),
(528, 'grie.pedro.uribe@risaralda.gov.co'),
(529, 'kndres@hotmail.com'),
(530, 'directora@despiertapereira.com'),
(531, 'juanmairplane@hotmail.com'),
(532, 'pabloebd7@gmail.com'),
(533, 'line-723@hotmail.com'),
(534, 'damejia@sena.edu.co'),
(535, 'luishelmercastroeusse@yahoo.com'),
(536, 'hocampopress@yahoo.com'),
(537, 'aprada@ucm.edu.co'),
(538, 'adisago@gmail.com'),
(539, 'ventaneandotv@gmail.com'),
(540, 'yennyalexandra@hotmail.com'),
(541, 'clarymoncada@gmail.com'),
(542, 'sebastiangrajales15@hotmail.com'),
(543, 'economica@eldiario.com.co'),
(544, 'norbeyd2giraldo@hotmail.com'),
(545, 'diego.abad@risaralda.gov.co'),
(546, 'grie.lamaria@risaralda.gov.co'),
(547, 'juliococ@hotmail.com'),
(548, 'nicherelator@yahoo.es'),
(549, 'juliferh@yahoo.es'),
(550, 'victoria.giraldo.sanchez@gmail.com'),
(551, 'jaloca2@hotmail.com'),
(552, 'gloria.arango@risaralda.gov.co'),
(553, 'epachono@gmail.com'),
(554, 'paula.velez@risaralda.gov.co'),
(555, 'carito-diaz0125@hotmail.com'),
(556, 'local@eldiario.com.co'),
(557, 'andres.delrio@risaralda.gov.co'),
(558, 'antoniocolomboardila@gmail.com'),
(559, 'fmarin828@hotmail.com'),
(560, 'gloriahenaom@hotmail.com'),
(561, 'ednayostin@hotmail.com'),
(562, 'albaluguaneme@yahoo.com'),
(563, 'umonzu@hotmail.com'),
(564, 'jotagol@hotmail.com'),
(565, 'leapues@gmail.com'),
(566, 'unoatelevision@yahoo.es'),
(567, 'isosma9@hotmail.com'),
(568, 'ancarcas1077@hotmail.com'),
(569, 'cgzuluaga@misena.edu.co'),
(570, 'hernanes1@hotmail.com'),
(571, 'nietomo@hotmail.com'),
(572, 'jamaya@gmail.com'),
(573, 'gerardobetancur@yahoo.com'),
(574, 'elizabeth.diosa@risaralda.gov.co'),
(575, 'asistenteejecafetero@anato.org'),
(576, 'lasartes@eldiario.com.co'),
(577, 'adiaz@comfamiliar.com'),
(578, 'jcdiaz1984@gmail.com'),
(579, 'sansal28@hotmail.com'),
(580, 'juan.valencia@risaralda.gov.co'),
(581, 'director@acodresrisaralda.com'),
(582, 'sigifredosalazar@hotmail.es'),
(583, 'agutie44@eafit.edu.co'),
(584, 'jaimemejiaperez2014@gmail.com'),
(585, 'florvida1@hotmail.com'),
(586, 'redaccion@elcolombiano.com.co'),
(587, 'aristi96@gmail.com'),
(588, 'nataliaramirez36@hotmail.com'),
(589, 'alcaldia@santarosadecabal-risaralda.gov.co'),
(590, 'hernang7tv@hotmail.com'),
(591, 'jocara8@hotmail.com'),
(592, 'arlesarce@hotmail.com'),
(593, 'contactenos@elopinadero.com.co'),
(594, 'munozdilvan24@gmail.com'),
(595, 'andresgarciacoach@gmail.com'),
(596, 'cardona_g88@hotmail.com'),
(597, 'diegoolimpica@hotmail.com'),
(598, 'angeloenrique1926@hotmail.com'),
(599, 'drocjuridica@medicinalegal.gov.co'),
(600, 'cafegomez007@gmail.com'),
(601, 'marchapu27@gmail.com'),
(602, 'moliendocafe@gmail.com'),
(603, 'prensapoliciaquindio@gmail.com'),
(604, 'luisca.rivera@hotmail.com'),
(605, 'absaltre@hotmail.com'),
(606, 'grie.occidente@risaralda.gov.co'),
(607, 'catiklopes@hotmail.com'),
(608, 'gerencia@actours.com.co'),
(609, 'cristianbuitrago1@hotmail.com'),
(610, 'gerencia@colreservas.com'),
(611, 'cejigajunior55@hotmail.com'),
(612, 'nancyocampo26@hotmail.com'),
(613, 'scomercial@eldiario.com.co'),
(614, 'benjamin.villa@risaralda.gov.co'),
(615, 'yofrapi2004@yahoo.es'),
(616, 'amvelezm@misena.edu.co'),
(617, 'abemarturis@yahoo.es'),
(618, 'alex.palacio.c@hotmail.com'),
(619, 'kike1049@hotmail.com'),
(620, 'alba.toro@risaralda.gov.co'),
(621, 'jhonjposada@gmail.com'),
(622, 'jaimeduquegarcia2010@hotmail.com'),
(623, 'jnorrego@funec.org'),
(624, 'contactenos@risaralda.gov.co'),
(625, 'javier.marulanda@risaralda.gov.co'),
(626, 'administrativa@lavirginia-risaralda.gov.co'),
(627, 'mariaarbelaez25@gmail.com'),
(628, 'grie.san.clemente@risaralda.gov.co'),
(629, 'archivo@marsella-risaralda.gov.co'),
(630, 'acontalcure@sena.edu.co'),
(631, 'belenstereo95.3fm@hotmail.com'),
(632, 'yamid@cmi.com.co'),
(633, 'produccionesmaspublicidad@yahoo.com'),
(634, 'grie.sagrada.familia@risaralda.gov.co'),
(635, 'linamarcelat@gmail.com'),
(636, 'director@smpereira.org'),
(637, 'cecotvapia@yahoo.com'),
(638, 'planvecomunicaciones@gmail.com'),
(639, 'fabiozapata570@hotmail.com'),
(640, 'revistaprimerpunto@hotmail.com'),
(641, 'jovadu200@yahoo.com'),
(642, 'hernando.jaramillograjales@gmail.com'),
(643, 'camurillo68@hotmail.com'),
(644, 'lindaktbustamante@hotmail.com'),
(645, 'comunicacionesaseopereira@gmail.com'),
(646, 'dsilva.derecho@unilibrepereira.edu.co'),
(647, 'gutobert@gmail.com'),
(648, 'redactorregionet@gmail.com'),
(649, 'comunicaciones@ucp.edu.co'),
(650, 'jcarangoduque@hotmail.com'),
(651, 'paolamorales@hotmail.com'),
(652, 'deris.derhu@policia.gov.co'),
(653, 'alcaldia@guatica-risaralda.gov.co'),
(654, 'federacion@fnd.org.co'),
(655, 'cafesva@hotmail.com'),
(656, 'direccionejecutiva@acopicentrooccidente.org'),
(657, 'grie.villaclaret@risaralda.gov.co'),
(658, 'medardo31@hotmail.com'),
(659, 'dianacolmundopereira@hotmail.com'),
(660, 'andrearodasquiceno@hotmail.com'),
(661, 'camachoalvaro@yahoo.es'),
(662, 'oballesteroscardona@gmail.com'),
(663, 'ocampo.ch@hotmail.com'),
(664, 'jcamis29@gmail.com'),
(665, 'daya_282303@hotmail.com'),
(666, 'belen.dls@risaralda.gov.co'),
(667, 'boletinesrisaralda@gmail.com'),
(668, 'info@acodresrisaralda.com'),
(669, 'angelicagaviria15@gmail.com'),
(670, 'oscarjames69@hotmail.com'),
(671, 'arios_gomez@hotmail.com'),
(672, 'fernandamahecha83@yahoo.es'),
(673, 'guiposca@hotmail.com'),
(674, 'jomaro-21@hotmail.com'),
(675, 'velez.jairo@yahoo.es'),
(676, 'somoscorazon2009@hotmail.com'),
(677, 'cristal1720@hotmail.com'),
(678, 'velez@utp.edu.co'),
(679, 'politica@eldiario.com.co'),
(680, 'periodista7310@gmail.com'),
(681, 'yfranco2013@gmail.com'),
(682, 'tapieromedinaesneda@gmail.com'),
(683, 'anypat@gmail.com'),
(684, 'oscardj1028@hotmail.com'),
(685, 'ruben.varelah@gmail.com'),
(686, 'grie.lapresentacion@risaralda.gov.co'),
(687, 'jo-hanita_06@hotmail.com'),
(688, 'gerencia@trujilloasociados.com'),
(689, 'faysury.marquez@risaralda.gov.co'),
(690, 'osjuar@hotmail.com'),
(691, 'guillermo.rodas@risaralda.gov.co'),
(692, 'patimarji@hotmail.com'),
(693, 'flor.libreros@risaralda.gov.co'),
(694, 'grie.dolores@risaralda.gov.co'),
(695, 'contratacion@lavirginia-risaralda.gov.co'),
(696, 'luiscramirez@eldiario.com.co'),
(697, 'gerenciatva@tvanoticias.com'),
(698, 'nathalia.varon@risaralda.gov.co'),
(699, 'jessica.quintero@hotmail.com'),
(700, 'diputadofernancaicedo@gmail.com'),
(701, 'mtaristi@hotmail.com'),
(702, 'codegar@codegar.com'),
(703, 'djchavelo@hotmail.es'),
(704, 'pachoibata@hotmail.com'),
(705, 'tarjetau@hotmail.com'),
(706, 'hamhenry2005@yahoo.es'),
(707, 'evgiraldo@gmail.com'),
(708, 'epachon@camarapereira.org.co'),
(709, 'periodicoelcomunal@hotmail.com'),
(710, 'marsella75@hotmail.com'),
(711, 'paola_barnett@yahoo.es'),
(712, 'diecheve2011@hotmail.com'),
(713, 'alexanderlema@hotmail.com'),
(714, 'cristina.hernandez@risaralda.gov.co'),
(715, 'madorys21@hotmail.com'),
(716, 'feliperuiz14@hotmail.com'),
(717, 'elisarios-1980@hotmail.com'),
(718, 'jhon_1960@hotmail.com'),
(719, 'jofoloco@gmail.com'),
(720, 'anluteje-21@hotmail.com'),
(721, 'gladys.rios@risaralda.gov.co'),
(722, 'lcrua@utp.edu.co'),
(723, 'freddyfernan@mixmail.com'),
(724, 'carlos495.franco@gmail.com'),
(725, 'karsaenz3@hotmail.com'),
(726, 'osmelrc@hotmail.com'),
(727, 'alcaldia@pueblorico-risaralda.gov.co'),
(728, 'ana.cardona@risaralda.gov.co'),
(729, 'hugo.ocampo@risaralda.gov.co'),
(730, 'planeacion@quindio.gov.co'),
(731, 'corpazvida@gmail.com'),
(732, 'johebeos@yahoo.es'),
(733, 'gustavo.ossag@gmail.com'),
(734, 'katalinabs@gmail.com'),
(735, 'gloria.lopez@risaralda.gov.co'),
(736, 'marisela.marin@risaralda.gov.co'),
(737, 'jorge.echeverri@cafedecolombia.com'),
(738, 'dagobertoruizmolano@hotmail.com'),
(739, 'carlosahs@hotmail.com'),
(740, 'info@visionartv.com'),
(741, 'amro254@gmail.com'),
(742, 'auxiliar-gobierno@hotmail.com'),
(743, 'hospital.lacelia@risaralda.gov.co'),
(744, 'dianacristina.hc86@gmail.com'),
(745, 'murielladino@hotmail.com'),
(746, 'administrativa@camacolrisaralda.org'),
(747, 'jorgepinzonkafruny@gmail.com'),
(748, 'alonsomolinacorrales@utp.edu.co'),
(749, 'franky.yarce@risaralda.gov.co'),
(750, 'rectoria@unilibrepereira.edu.co'),
(751, 'maoe20@hotmail.com'),
(752, 'juan.toro@risaralda.gov.co'),
(753, 'grie.eltambo@risaralda.gov.co'),
(754, 'diputadodiomedes@hotmail.com'),
(755, 'luisa29@utp.edu.co'),
(756, 'gabrielsonnycubillos@yahoo.com'),
(757, 'Josearivera11@hotmail.com'),
(758, 'grie.alto.cauca@risaralda.gov.co'),
(759, 'david.hurtado.jimenez@gmail.com'),
(760, 'hvsproducciones@hotmail.com'),
(761, 'abel.tambores@hotmail.com'),
(762, 'contactenos@lacelia-risaralda.gov.co'),
(763, 'yvquiceno@utp.edu.co'),
(764, 'comunicaciones@eaar.gov.co'),
(765, 'ricardocorazondeleon89@gmail.com'),
(766, 'carolinaperez18@hotmail.com'),
(767, 'prensa@deportivopereira.com.co'),
(768, 'hospital.dosquebradas@risaralda.gov.co'),
(769, 'juanitaluciam@gmail.com'),
(770, 'visionarproducciones@gmail.com'),
(771, 'carolina.alvarezcomunica@gmail.com'),
(772, 'lilibarragalavis@gmail.com'),
(773, 'lilianalopezsanchez@gmail.com'),
(774, 'secretariainterior@quindio.gov.co'),
(775, 'televentasshowj@hotmail.com'),
(776, 'alejo903@hotmail.com'),
(777, 'gerencialaregion@gmail.com'),
(778, 'lfjaramillo@frisby.com.co'),
(779, 'fernandomunozduque@gmail.com'),
(780, 'alexmo2206@hotmail.com'),
(781, 'gerencia@camacolrisaralda.org'),
(782, 'denedth@hotmail.com'),
(783, 'cpgarcia@dosquebradas.gov.co'),
(784, 'guzmanbferchoj@hotmail.com'),
(785, 'hospital.balboa@risaralda.gov.co'),
(786, 'grie.santo.tomas@risaralda.gov.co'),
(787, 'lilianarive27@hotmail.com'),
(788, 'hangomez2@gmail.com'),
(789, 'mauricio1.ojeda@risaralda.gov.co'),
(790, 'alexander.loaiza@risaralda.gov.co'),
(791, 'clarimoncada@gmail.com'),
(792, 'damera20@gmail.com'),
(793, 'mpao-18@hotmail.com'),
(794, 'leonardo.gomez@risaralda.gov.co'),
(795, 'deris.coest@hotmail.com'),
(796, 'catalina.orozco@risaralda.gov.co'),
(797, 'elquerendon502011@hotmail.com'),
(798, 'gustavo.gardeazabal@gmail.com'),
(799, 'personeriadosquebradas@gmail.com'),
(800, 'rodrigogomez2@hotmail.com'),
(801, 'grie.maria.reina@risaralda.gov.co'),
(802, 'maritobont@hotmail.com'),
(803, 'mateorinconrendon@hotmail.com'),
(804, 'osalpapo@yahoo.com'),
(805, 'esrabe66@gmail.com'),
(806, 'grie.estrada@risaralda.gov.co'),
(807, 'paulaardila88@gmail.com'),
(808, 'juanc@uniquindio.edu.co'),
(809, 'torreglosajr@yahoo.es'),
(810, 'grie.santuario@risaralda.gov.co'),
(811, 'ventaneando1962@hotmail.com'),
(812, 'grie.educativoirra@risaralda.gov.co'),
(813, 'consuelo.ramirez@risaralda.gov.co'),
(814, 'idace17@gmail.com'),
(815, 'gmarlalucia@yahoo.com.co'),
(816, 'florego_25@hotmail.com'),
(817, 'jorgelopeztv@hotmail.com'),
(818, 'francinyle.raigoza@risaralda.gov.co'),
(819, 'cesar.idarraga@risaralda.gov.co'),
(820, 'esteban.cuartas.concejo@gmail.com'),
(821, 'radiodq@hotmail.com'),
(822, 'lau.danihincapie@gmail.com'),
(823, 'jgalov65@hotmail.com'),
(824, 'carolina.jaramillo@risaralda.gov.co'),
(825, 'damera20@hotmail.com'),
(826, 'marcechavesperiodista@gmail.com'),
(827, 'gea.arias@hotmail.com'),
(828, 'grie.florida@risaralda.gov.co'),
(829, 'inter_sa_per@hotmail.com'),
(830, 'julian.munoz@risaralda.gov.co'),
(831, 'janethfernandez@yahoo.com'),
(832, 'nia1106@hotmail.com'),
(833, 'lavozdepereiraonline@gmail.com'),
(834, 'hugo.arango@risaralda.gov.co'),
(835, 'jorgeauf@gmail.com'),
(836, 'periodicoelfarosantarosa@gmail.com'),
(837, 'alcaldia@quinchia-risaralda.gov.co'),
(838, 'jorgeandreshoyoshenao@gmail.com'),
(839, 'vermellon2000@yahoo.com'),
(840, 'angel89_18@yahoo.es'),
(841, 'grie.san.pablo@risaralda.gov.co'),
(842, 'gaco@misena.edu.co'),
(843, 'herneyocampocardona@hotmail.com'),
(844, 'guiposcas@hotmail.com'),
(845, 'marsellaaldia@yahoo.es'),
(846, 'feralcal1@hotmail.com'),
(847, 'deportes@eldiario.com.co'),
(848, 'rubielatapazco@hotmail.com'),
(849, 'churtado@caracol.com.co'),
(850, 'kattieblue85@hotmail.com'),
(851, 'luzangelaplata@yahoo.com'),
(852, 'auditorio.gonzalovallejo@risaralda.gov.co'),
(853, 'johanvico@gmail.com'),
(854, 'archivocentral@quindio.gov.co'),
(855, 'alcaldia@balboa-risaralda.gov.co'),
(856, 'monimmm@hotmail.com'),
(857, 'dianalopez1228@gmail.com'),
(858, 'grie.guatica@risaralda.gov.co'),
(859, 'jharboleda@hotmail.com'),
(860, 'drococcidente@medicinalegal.gov.co'),
(861, 'pinedaw3@gmail.com'),
(862, 'paulazabe@hotmail.com'),
(863, 'maramichel6@gmail.com'),
(864, 'lain660@hotmail.com'),
(865, 'julianmlenis@gmail.com'),
(866, 'grie.mistrato@risaralda.gov.co'),
(867, 'obedmoreno@gmail.com'),
(868, 'lorenaherreraramirez@gmail.com'),
(869, 'nisohusa@hotmail.com'),
(870, 'judicial@eldiario.com.co'),
(871, 'sandracampomv@hotmail.com'),
(872, 'paz985@gmail.com'),
(873, 'grie.lafloresta@risaralda.gov.co'),
(874, 'edilson1273@hotmail.com'),
(875, 'bervar48@hotmail.com'),
(876, 'dayramirez92@hotmail.com'),
(877, 'despacho@lavirginia-risaralda.gov.co'),
(878, 'lonjarisaralda@gmail.com'),
(879, 'adrian-david-95@hotmail.com'),
(880, 'j2restrepo@yahoo.com'),
(881, 'octaviocardonagonzalez@gmail.com'),
(882, 'cultura@quindio.gov.co'),
(883, 'editor@risaraldahoy.com'),
(884, 'rodrico8@hotmail.com'),
(885, 'pacho.salas@gmail.com'),
(886, 'secretaria@asemtur.com.co'),
(887, 'victoriaecheverri@hotmail.com'),
(888, 'grie.lamarina@risaralda.gov.co'),
(889, 'marioarboledas@hotmail.com'),
(890, 'isabel.valencia@risaralda.gov.co'),
(891, 'periodistasacpt@yahoo.com'),
(892, 'lufejavi70@hotmail.com'),
(893, 'acapamtelemistrato@gmail.com'),
(894, 'contacto@archivogeneral.gov.co'),
(895, 'prensaconcejod@gmail.com'),
(896, 'antenanoticias1520@hotmail.com'),
(897, 'mildreht@yahoo.com'),
(898, 'andreshurtadogarcia@hotmail.com'),
(899, 'luisfdo0318@gmail.com'),
(900, 'myara@andi.com.co'),
(901, 'jpburitica91@gmail.com'),
(902, 'hospital.guatica@risaralda.gov.co'),
(903, 'periodicoecosdesantarosa@hotmail.com'),
(904, 'contraloria@risaralda.gov.co'),
(905, 'comunicaciones@pereiravirtual.com'),
(906, 'meper.coman@policia.gov.co'),
(907, 'dmcacante@misena.edu.co'),
(908, 'grie.lavirginia@risaralda.gov.co'),
(909, 'grie.senorarosariosantuario@risaralda.gov.co'),
(910, 'viejowilly91@gmail.com'),
(911, 'lilianalopezsanchez@hotmail.com'),
(912, 'jatleya@hotmail.com'),
(913, 'alcaldia@lacelia-risaralda.gov.co'),
(914, 'marago25@gmail.com'),
(915, 'jjsantofimio@dosquebradas.gov.co'),
(916, 'paz0212@hotmail.com'),
(917, 'gloriled.81@hotmail.com'),
(918, 'mosorior@comfamiliar.com'),
(919, 'berthacarvajal920@gmail.com'),
(920, 'maricela.pachonsierrra011@gmail.com'),
(921, 'felipemediosmasivos@hotmail.com'),
(922, 'luismigue0313@hotmail.com'),
(923, 'jotagrow@hotmail.com'),
(924, 'jhurtado_50@hotmail.com'),
(925, 'jgiraldo312@hotmail.com'),
(926, 'opaprensa@yahoo.es'),
(927, 'blancaleliaconcejal@gmail.com'),
(928, 'martharotp@gmail.com'),
(929, 'hoyosalianza@gmail.com'),
(930, 'jsanchezpe@une.net.co'),
(931, 'unda53@hotmail.com'),
(932, 'director@acueductodecerritos.com'),
(933, 'aramirezra5@gmail.com'),
(934, 'andibomo1996@gmail.com'),
(935, 'liliana.ibarra@risaralda.gov.co'),
(936, 'julieth100porciento@gmail.com'),
(937, 'enriquejmarrero17@gmail.com'),
(938, 'patriciahidalgohenao@hotmail.com'),
(939, 'comunicaciones@husj.gov.co'),
(940, 'carolina.hernandezlopez@risaralda.gov.co'),
(941, 'jvillanueva@rtvc.gov.co'),
(942, 'nancyguz15@gmail.com'),
(943, 'sebasgrajalesm@gmail.com'),
(944, 'darioduque13@hotmail.com'),
(945, 'eosoriolalinde@gmail.com'),
(946, 'haru7983@gmail.com'),
(947, 'olgaluciacastanovelez4@gmail.com'),
(948, 'carlos.hincapie@risaralda.gov.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

CREATE TABLE `dependencias` (
  `id` int(11) NOT NULL,
  `dependencia` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dependencias`
--

INSERT INTO `dependencias` (`id`, `dependencia`) VALUES
(1, 'Secretaria de Educación Departamental'),
(2, 'Secretaria de Gobierno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_actividades`
--

CREATE TABLE `estados_actividades` (
  `id` int(11) NOT NULL,
  `estado` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_actividades`
--

INSERT INTO `estados_actividades` (`id`, `estado`) VALUES
(1, 'Registrada'),
(2, 'Aplazada'),
(3, 'Realizada'),
(4, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_comunicados`
--

CREATE TABLE `estados_comunicados` (
  `id` int(11) NOT NULL,
  `estado_comunicado` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_comunicados`
--

INSERT INTO `estados_comunicados` (`id`, `estado_comunicado`) VALUES
(1, 'En Desarrollo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias_dependencias`
--

CREATE TABLE `secretarias_dependencias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `secretarias_dependencias`
--

INSERT INTO `secretarias_dependencias` (`id`, `nombre`) VALUES
(1, 'Administrativa'),
(2, 'Deportes, Recreación y Cultura'),
(3, 'Desarrollo Agropecuario'),
(4, 'Desarrollo Económico y Competitividad'),
(5, 'Desarrollo Social'),
(6, 'Educación'),
(7, 'Gobierno'),
(8, 'Hacienda'),
(9, 'Infraestructura'),
(10, 'Juridica'),
(11, 'Of. Asesora de Comunicaciones '),
(12, 'Planeación'),
(13, 'Protocolo Despacho'),
(14, 'Salud'),
(15, 'Tic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_disenos`
--

CREATE TABLE `solicitudes_disenos` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `start` date NOT NULL,
  `color` varchar(150) NOT NULL DEFAULT '#f6c23e',
  `textColor` varchar(120) NOT NULL DEFAULT '#FFFFFF',
  `estado` char(1) NOT NULL,
  `fecha_solitud` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitudes_disenos`
--

INSERT INTO `solicitudes_disenos` (`id`, `title`, `descripcion`, `start`, `color`, `textColor`, `estado`, `fecha_solitud`) VALUES
(1, 'Solicitud Diseño', 'Solicitud diseño para la secretaria de gobierno por parte del secretario', '2020-04-29', '#f6c23e', '#FFFFFF', '1', '0000-00-00'),
(2, 'Solicitud Diseño 2', 'esta es una solicitud de diseño realizada por una persona muy especial y muy querida', '2020-04-29', '#f6c23e', '#FFFFFF', '1', '0000-00-00'),
(3, 'Solicitud Diseño 3', 'esta es una solicitud de diseño realizada por una persona muy especial y muy querida', '2020-04-29', '#f6c23e', '#FFFFFF', '1', '0000-00-00'),
(4, 'solicitud 4', 'csssssssss', '2020-04-29', '#f6c23e', '#FFFFFF', '1', '0000-00-00'),
(5, 'Solicitud Diseño', 'Solicitud diseño para la secretaria de gobierno por parte del secretario', '2020-04-29', '#f6c23e', '#FFFFFF', '1', '0000-00-00'),
(6, 'Solicitud Diseño', 'Solicitud diseño para la secretaria de gobierno por parte del secretario', '2020-04-29', '#f6c23e', '#FFFFFF', '1', '0000-00-00'),
(7, 'Solicitud Diseño', 'Solicitud diseño para la secretaria de gobierno por parte del secretario', '2020-04-29', '#f6c23e', '#FFFFFF', '1', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_disenos`
--

CREATE TABLE `tipo_disenos` (
  `id` int(11) NOT NULL,
  `diseno` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_disenos`
--

INSERT INTO `tipo_disenos` (`id`, `diseno`) VALUES
(1, 'Campaña Publicitaria'),
(2, 'Post De Redes'),
(3, 'Historia En Redes'),
(4, 'Banner Web'),
(5, 'Cabezote TV'),
(6, 'Marca TV'),
(7, 'Cortinilla TV'),
(8, 'Folleto / Plegable'),
(9, 'Volante Para Impresión'),
(10, 'Plantilla Hoja Carta'),
(11, 'Fondo Pantalla (Wallpaper)'),
(12, 'Pendón Impreso'),
(13, 'Adhesivo Para Pared'),
(14, 'Plantilla Web'),
(15, 'PopUp Web'),
(16, 'Invitación Digital / Impresa'),
(17, 'Formato Protocolo Gobernador'),
(18, 'Afiche'),
(19, 'Valla'),
(20, 'Logo De Campaña / Proyecto'),
(21, 'Montaje Fotográfico'),
(22, 'Brandig Para Espacios'),
(23, 'Señalización / Señaletica'),
(24, 'Presentación Digital'),
(25, 'Diseño De Carteleras'),
(26, 'Infografía'),
(27, 'Merchardesing Tipo Gorra / Camiseta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `tipo_usuario` varchar(30) NOT NULL,
  `nombre` varchar(180) NOT NULL,
  `correo` varchar(170) NOT NULL,
  `celular` varchar(40) DEFAULT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'Activado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `tipo_usuario`, `nombre`, `correo`, `celular`, `estado`) VALUES
(1, '1088008382', '$2y$10$jmy3RVElIsXTWYO8PcwMFOGb5/ivGjPBgWwxM4mzDP7bP3cdgMLoC', 'Ingeniero', 'Carlos Eduardo Hincapie Hidalgo', 'ce.hincapie19editado@hotmail.com', '3207236603', 'Activado'),
(41, '4520254', '$2y$10$KvGYxgVfsYv3djRTq0Fele3ua9V5v.YNZMQiXN5bpengwYJG./qGG', 'Funcionario', 'Eder Quintero Escobar', 'ederesco@gmail.com', '3012901371', 'Activado'),
(42, '30232232', '$2y$10$n3CNQDG/fLEJZKo8gJVcvugScyw7PXK9Nm5wAY.PpIfETB4lPJLcK', 'Funcionario', 'Paula Andrea Zamora Berrío', 'paula.zamora@risaralda.gov.co', '3218115360', 'Activado'),
(43, '42117303', '$2y$10$2HxU7ofDlZRboHfxw5pAJufM52EyjGbEo9z/qCA7OUQ8Nb/dkxate', 'Funcionario', 'Juanita Lucía Mendoza Salazar', 'juanitaluciam@gmail.com', '3008217902', 'Activado'),
(44, '10090969', '$2y$10$RYoEVkO2vP4WLbuqgIWTM.CRulhE3zbSxkfMxN/Y8NMv9yUrhqar2', 'Funcionario', 'Hugo Ocampo Villegas', 'hugo.ocampo@risaralda.gov.co', '3206908060', 'Activado'),
(45, '45539365', '$2y$10$X6u2XDSSnOVRtHR9qaFQBu9BQi8kHr3tsR9peNBtuTi.atDzdN4TW', 'Funcionario', 'María Malkum Gómez', 'marimalkun@hotmail.com', '3333335', 'Activado'),
(46, '1089746071', '$2y$10$ocGsQCrxFFPyt9cZmMKGc.emteZrnNtNnbXQxWQHkWz43lUIe4Lum', 'Funcionario', 'Juan Guillermo Delgado Berrio', 'juan.delgado@risaralda.gov.co', '3053055333', 'Activado'),
(47, '1088316460', '$2y$10$FzUMlkBXvYrDiULt9pY4rOYaxsm2WR4RqQS8Zkn.W8MMz9SJ2A0i.', 'Funcionario', 'Maria Camila Raga Vásquez', 'mcrv1921@gmail.com', '3024062663', 'Activado'),
(48, '26989273', '$2y$10$CMLs0gg7hvBcYFZqyes9q.C06exI2LKi0PoA7cswiXNmabngPgEQi', 'Funcionario', 'Bruna Patricia Carrillo Mejia', 'abogadabruna@gmail.com', '3166206700', 'Activado'),
(49, '51964752', '$2y$10$2OljVSGHw0ppJxbgMFqbBOl3267cReN9F4XFmEp7Qf8uZo7cVi8uy', 'Funcionario', 'Liliana Ibarra Galaviz', 'liliana.ibarra@risaralda.gov.co', '3137154136', 'Activado'),
(50, '1088250835', '$2y$10$ldfXRrD8UFvjebQbRabf7u9oxBltPHUq2j9n05HJPX4eoEhnq0bje', 'Funcionario', 'Catalina Betancur Salinas', 'katalinabs@gmail.com', '3217920903', 'Activado'),
(51, '10130060', '$2y$10$YtWmo6cfNEptG4lE.7KoP.46S3tjXFiPumkPFCGwgOj4op6HslxHK', 'Jefe de Prensa', 'Andres Garcia', 'andres.garciamartinez@risaralda.gov.co', '3207739455', 'Activado'),
(52, '1088246075', '$2y$10$BKMdf3FhGgA6vNawD6XiSuKy7FiKp0F6W7gs8TCZ5sDJdtc7YAsMW', 'Funcionario', 'Luz Piedad', 'luz.zapata@risaralda.gov.co', '3153257373', 'Activado'),
(53, '42135690', '$2y$10$EolPqviT4hPBsfy7uN93ZO2T/4x.z5RZ1zfYbuG1t2P.LcgEc/gPO', 'Jefa de Redacción', 'Diana Maria Rodriguez', 'diana.rodriguez@risaralda.gov.co', '3015468646', 'Activado'),
(54, '63312957', '$2y$10$5F//KgD/DknX/Gnu9koKjeEDNciqg7pezJ5PsYqtJPYp9jgMz5iBK', 'Funcionario', 'Sonia Díaz Mantilla', 'soniadiazmantilla@gmail.com', '3115057162', 'Activado'),
(55, '1010138896', '$2y$10$GMVIejPBY8jtWaZKCNxJzeo6yJOe62UPQnJCf00iFiuR3K59kjAcy', 'Funcionario', 'Jhon Fredy Caicedo Villa', 'caicedo1704@gmail.com', '3106002088', 'Activado'),
(56, '80058200', '$2y$10$Bv8qlR9JQbAUDEP9id7yPOpFqwDXS8tsze8Jn1nNwFLVJCOb6m0km', 'Funcionario', 'Felipe Agudelo', 'felipemedios@gmail.com', '3152173110', 'Activado'),
(57, '24341125', '$2y$10$eox1srPaRD4NpRwIwK8u3.WYMzF7RoKhfJdMBUt3kS..DO5qU8XYq', 'Funcionario', 'Carolina Muñoz Tabares', 'caropublicidad2@gmail.com', '3116286003', 'Activado'),
(58, '1010177923', '$2y$10$3rI7hEguYoeo/.qF/BWSB.BH2K67yMnqD6MH7XLgOlbleRYyt05CW', 'Funcionario', 'Jenny Marcela Llanos Pineda', 'jennymaercelalp@gmail.com', '3204691696', 'Activado'),
(59, '16212923', '$2y$10$sUXZBcc5Xogltrpk2pE0vOWrfknOqlH44GrbjJsjTBmGF720KO4FS', 'Funcionario', 'Jonny Vásquez Duque', 'john.vasquez@risaralda.gov.co', '3176815566', 'Activado'),
(60, '1088277614', '$2y$10$wQTRuqTdpo0No3CWyBV22u75Q8Tnkr2tFUKRjDhh2Uew56w1IsMW6', 'Funcionario', 'Ingrid Johana Cataño Benjumeda', 'ingrid.catano@risaralda.gov.co', '3045436996', 'Activado'),
(61, '1088347541', '$2y$10$LrhOWmsACYNEW0jSouuJGu0ySkjiPa721C3JNePdEEUucW5e33XoG', 'Funcionario', 'Natalia Gallo', 'natalia.gallo@ucp.edu.co', '3103599746', 'Activado'),
(62, '4520750', '$2y$10$zsTgsa66XbuZYwLxP6zzzOMvbEVSiZS89VafshBMN5NEVeMt29emK', 'Funcionario', 'Julián Muñoz Lenis', 'julian.munoz@risaralda.gov.co', '3146295780', 'Activado'),
(63, '1088244102', '$2y$10$Q.Ta01L37dtL1gn191eIxuZd6ZXey6mfHruj08/h5KB8SgmIPTOya', 'Funcionario', 'Walter Arroyave García', 'walter.arroyave@risaralda.gov.co', '3014844596', 'Activado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios_actividades`
--
ALTER TABLE `comentarios_actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comunicados`
--
ALTER TABLE `comunicados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dependencias`
--
ALTER TABLE `dependencias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dependencia` (`dependencia`);

--
-- Indices de la tabla `estados_actividades`
--
ALTER TABLE `estados_actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_comunicados`
--
ALTER TABLE `estados_comunicados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estado_comunicado` (`estado_comunicado`);

--
-- Indices de la tabla `secretarias_dependencias`
--
ALTER TABLE `secretarias_dependencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes_disenos`
--
ALTER TABLE `solicitudes_disenos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_disenos`
--
ALTER TABLE `tipo_disenos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `comentarios_actividades`
--
ALTER TABLE `comentarios_actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `comunicados`
--
ALTER TABLE `comunicados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=949;

--
-- AUTO_INCREMENT de la tabla `dependencias`
--
ALTER TABLE `dependencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados_actividades`
--
ALTER TABLE `estados_actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estados_comunicados`
--
ALTER TABLE `estados_comunicados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `secretarias_dependencias`
--
ALTER TABLE `secretarias_dependencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `solicitudes_disenos`
--
ALTER TABLE `solicitudes_disenos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_disenos`
--
ALTER TABLE `tipo_disenos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
