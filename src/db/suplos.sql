-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2023 a las 17:46:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `suplos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `id_segments` int(11) NOT NULL,
  `id_family` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `activities`
--

INSERT INTO `activities` (`id`, `id_segments`, `id_family`) VALUES
(2, 10, 1011),
(3, 10, 1011),
(4, 10, 1011),
(5, 10, 1011),
(1, 80, 1010);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `currency_type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `currency`
--

INSERT INTO `currency` (`id`, `currency_type`) VALUES
(1, 'COP'),
(2, 'USD'),
(3, 'EUR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_offers`
--

CREATE TABLE `event_offers` (
  `id` int(11) NOT NULL,
  `id_creator` int(11) NOT NULL,
  `id_event_offers_schedule` int(11) DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `id_currency` int(11) NOT NULL,
  `object` varchar(12) NOT NULL,
  `budget` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `event_offers`
--

INSERT INTO `event_offers` (`id`, `id_creator`, `id_event_offers_schedule`, `id_status`, `id_activity`, `description`, `id_currency`, `object`, `budget`) VALUES
(1, 1, NULL, 1, 1, 'Hola, esto es una prueba', 1, 'ABC123', '250.000'),
(2, 1, 13, 1, 3, 'Prueba Api', 1, 'ABC1234', '3500'),
(4, 1, 15, 1, 5, 'Prueba Api', 1, 'ABC123XDD', '3500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_offers_docs`
--

CREATE TABLE `event_offers_docs` (
  `id` int(11) NOT NULL,
  `route_doc` varchar(240) NOT NULL,
  `id_event_offers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_offers_schedule`
--

CREATE TABLE `event_offers_schedule` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `full_start_date` datetime NOT NULL,
  `full_end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `event_offers_schedule`
--

INSERT INTO `event_offers_schedule` (`id`, `start_date`, `start_time`, `end_date`, `end_time`, `full_start_date`, `full_end_date`) VALUES
(1, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(2, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(3, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(4, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(5, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(6, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(7, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(8, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(9, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(10, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(11, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(12, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(13, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(14, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00'),
(15, '2023-09-30', '13:30:00', '2023-10-30', '13:30:00', '2023-09-30 13:30:00', '2023-10-30 13:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `family`
--

CREATE TABLE `family` (
  `id` int(11) NOT NULL,
  `description_family` varchar(120) NOT NULL,
  `id_segment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `family`
--

INSERT INTO `family` (`id`, `description_family`, `id_segment`) VALUES
(1010, 'Animales vivos', 10),
(1011, 'Productos para animales domésticos', 10),
(1012, 'Comida de animales', 10),
(1013, 'Recipientes y hábitat para animales', 10),
(1014, 'Productos de talabartería y arreo', 10),
(1015, 'Semillas, bulbos, plántulas y esquejes', 10),
(1016, 'Productos de floricultura y silvicultura', 10),
(1017, 'Fertilizantes y nutrientes para plantas y herbicidas', 10),
(1019, 'Productos para el control de plagas ', 10),
(1020, 'Rosales vivos', 10),
(1021, 'Plantas vivas  de especies o variedades de flores altas', 10),
(1022, 'Plantas vivas  de especies o variedades de flores bajas', 10),
(1023, 'Crisantemos vivos', 10),
(1024, 'Claveles vivos', 10),
(1025, 'Orquídeas vivas', 10),
(1030, 'Rosas frescas cortadas', 10),
(1031, 'Bouquets cortados frescos  de especies o variedades de flores altas', 10),
(1032, 'Bouquets cortados frescos  de especies o variedades de flores bajas', 10),
(1033, 'Crisantemos cortados frescos', 10),
(1034, 'Bouquets florales cortados frescos', 10),
(1035, 'Claveles cortados frescos', 10),
(1036, 'Orquídeas cortadas frescas', 10),
(1040, 'Rosas cortadas secas', 10),
(1041, 'Bouquets cortados secos  de especies o variedades de flores altas', 10),
(1042, 'Bouquets cortados secos  de especies o variedades de flores bajas', 10),
(1043, 'Crisantemos cortados secos', 10),
(1044, 'Claveles cortados secos', 10),
(1045, 'Orquídeas cortadas secas', 10),
(1050, 'Follaje cortado fresco', 10),
(1110, 'Minerales, minerales metálicos y metales', 11),
(1111, 'Tierra y piedra', 11),
(1112, 'Productos no comestibles de planta y silvicultura', 11),
(1113, 'Productos animales no comestibles', 11),
(1114, 'Chatarra y materiales de desecho', 11),
(1115, 'Fibra, hilos e hilados', 11),
(1116, 'Tejidos y materiales de cuero', 11),
(1117, 'Aleaciones', 11),
(1118, 'Óxido metálico', 11),
(1119, 'Desechos metálicos y chatarra', 11),
(1213, 'Materiales explosivos', 12),
(1214, 'Elementos y gases', 12),
(1216, 'Aditivos', 12),
(1217, 'Colorantes', 12),
(1218, 'Ceras y aceites', 12),
(1219, 'Solventes', 12),
(1235, 'Compuestos y mezclas', 12),
(1310, 'Caucho y elastómeros', 13),
(1311, 'Resinas y colofonias y otros materiales derivados de resina', 13),
(1410, 'Materiales de papel', 14),
(1411, 'Productos de papel', 14),
(1412, 'Papel para uso industrial', 14),
(1510, 'Combustibles', 15),
(1511, 'Combustibles gaseosos y aditivos', 15),
(1512, 'Lubricantes, aceites, grasas y anticorrosivos', 15),
(1513, 'Combustible para reactores nucleares', 15),
(2010, 'Maquinaria y equipo de minería y explotación de canteras', 20),
(2011, 'Equipo de perforación y explotación de pozos', 20),
(2012, 'Equipo para perforación y exploración de petróleo y gas', 20),
(2013, 'Materiales para  perforación y operaciones de petróleo y gas', 20),
(2014, 'Equipo de producción y operación de petróleo y gas', 20),
(2110, 'Maquinaria y equipo para agricultura, silvicultura y paisajismo', 21),
(2111, 'Equipo de pesca y acuicultura', 21),
(2210, 'Maquinaria y equipo pesado de construcción', 22),
(2310, 'Maquinaria para el procesamiento de materias primas', 23),
(2311, 'Maquinaria para el procesamiento de petróleo', 23),
(2312, 'Maquinaria y accesorios de textiles y tejidos', 23),
(2313, 'Maquinaria y equipos lapidarios', 23),
(2314, 'Maquinaria de reparación y accesorios para marroquinería', 23),
(2315, 'Maquinaria, equipo y suministros de procesos industriales', 23),
(2316, 'Máquinas, equipo y suministros para fundición', 23),
(2318, 'Equipo industrial para alimentos y bebidas', 23),
(2319, 'Mezcladores y sus partes y accesorios', 23),
(2320, 'Equipamiento para transferencia de masa', 23),
(2321, 'Maquinaria de fabricación electrónica, equipo y accesorios', 23),
(2322, 'Equipo y maquinaria de procesamiento de pollos', 23),
(2323, 'Equipo y maquinaria de procesamiento de madera y aserrado', 23),
(2324, 'Maquinaria y accesorios para cortar metales', 23),
(2325, 'Maquinaria y accesorios para el formado de metales', 23),
(2326, 'Maquinaria y accesorios para hacer prototipos rápidos', 23),
(2327, 'Maquinaria y accesorios y suministros para soldadura de todas las clases', 23),
(2328, 'Maquinaria para el tratamiento de metal', 23),
(2329, 'Herramientas de maquinado industrial', 23),
(2330, 'Maquinaria y equipo para cable', 23),
(2410, 'Maquinaria y equipo para manejo de materiales', 24),
(2411, 'Recipientes y almacenamiento', 24),
(2412, 'Materiales de empaque', 24),
(2413, 'Refrigeración industrial', 24),
(2414, 'Suministros de embalaje', 24),
(2510, 'Vehículos de motor', 25),
(2511, 'Transporte marítimo', 25),
(2512, 'Maquinaria y equipo para ferrocarril y tranvías', 25),
(2513, 'Aeronaves', 25),
(2515, 'Naves espaciales', 25),
(2516, 'Bicicletas no motorizadas', 25),
(2517, 'Componentes y sistemas de transporte', 25),
(2518, 'Carrocerías y remolques', 25),
(2519, 'Equipo para servicios de transporte', 25),
(2520, 'Sistemas  y componentes y equipos aeroespaciales', 25),
(2610, 'Fuentes de energía', 26),
(2611, 'Baterías y generadores y transmisión de energía cinética', 26),
(2612, 'Alambres, cables y arneses', 26),
(2613, 'Generación de energía', 26),
(2614, 'Maquinaria y equipo para energía atómica o nuclear', 26),
(2711, 'Herramientas de mano', 27),
(2712, 'Maquinaria y equipo hidráulico', 27),
(2713, 'Maquinaria y equipo neumático', 27),
(2714, 'Herramientas especializadas automotrices', 27),
(3010, 'Componentes estructurales y formas básicas', 30),
(3011, 'Hormigón, cemento y yeso', 30),
(3012, 'Carreteras y paisaje', 30),
(3013, 'Productos de construcción estructurales', 30),
(3014, 'Aislamiento', 30),
(3015, 'Materiales para acabado de exteriores', 30),
(3016, 'Materiales de acabado de interiores', 30),
(3017, 'Puertas y ventanas y vidrio', 30),
(3018, 'Instalaciones de plomería', 30),
(3019, 'Equipo de apoyo para Construcción y Mantenimiento', 30),
(3024, 'Componentes de construcción de estructura portátil', 30),
(3025, 'Estructuras y materiales de minería subterránea', 30),
(3026, 'Materiales estructurales', 30),
(3110, 'Piezas de fundición y ensambles de piezas de fundición', 31),
(3111, 'Extrusiones', 31),
(3112, 'Piezas fundidas maquinadas', 31),
(3113, 'Forjaduras', 31),
(3114, 'Molduras', 31),
(3115, 'Cuerda, cadena, cable, alambre y correa', 31),
(3116, 'Ferretería', 31),
(3117, 'Rodamientos, cojinetes ruedas y engranajes', 31),
(3118, 'Empaques, glándulas, fundas y cubiertas', 31),
(3119, 'Materiales de afilado pulido y alisado', 31),
(3120, 'Adhesivos y selladores', 31),
(3121, 'Pinturas y bases y acabados', 31),
(3122, 'Extractos de teñir y de curtir', 31),
(3123, 'Materia prima en placas o barras labradas', 31),
(3124, 'Óptica industrial', 31),
(3125, 'Sistemas de control neumático, hidráulico o eléctrico', 31),
(3126, 'Cubiertas, cajas y envolturas', 31),
(3127, 'Piezas hechas a máquina', 31),
(3128, 'Componentes de placa y estampados', 31),
(3129, 'Extrusiones maquinadas', 31),
(3130, 'Forjas labradas', 31),
(3131, 'Ensambles de tubería fabricada', 31),
(3132, 'Ensambles fabricados de material en barras', 31),
(3133, 'Ensambles estructurales fabricados', 31),
(3134, 'Ensambles de lámina fabricado', 31),
(3135, 'Ensambles de tubería fabricada', 31),
(3136, 'Ensambles de placa fabricados', 31),
(3137, 'Refractarios', 31),
(3138, 'Imanes y materiales magnéticos', 31),
(3139, 'Maquinados', 31),
(3140, 'Empaques', 31),
(3141, 'Sellos', 31),
(3142, 'Partes sinterizadas', 31),
(3210, 'Circuitos impresos, circuitos integrados y micro ensamblajes', 32),
(3211, 'Dispositivo semiconductor discreto', 32),
(3212, 'Componentes pasivos discretos', 32),
(3213, 'Piezas de componentes y hardware electrónicos y accesorios', 32),
(3214, 'Dispositivos de tubo electrónico y accesorios', 32),
(3215, 'Dispositivos y componentes y accesorios de control de automatización', 32),
(3910, 'Lámparas y bombillas y componentes para lámparas', 39),
(3911, 'Iluminación, artefactos y accesorios', 39),
(3912, 'Equipos, suministros y componentes eléctricos', 39),
(3913, 'Dispositivos y accesorios y suministros de manejo de cable eléctrico', 39),
(4010, 'Calefacción, ventilación y circulación del aire', 40),
(4014, 'Distribución de fluidos y gas', 40),
(4015, 'Bombas y compresores industriales', 40),
(4016, 'Filtrado y purificación industrial', 40),
(4017, 'Instalaciones de tubos y entubamientos', 40),
(4018, 'Instalaciones de tubos y tuberías', 40),
(4110, 'Equipo de laboratorio y científico', 41),
(4111, 'Instrumentos de medida, observación y ensayo', 41),
(4112, 'Suministros y accesorios de laboratorio', 41),
(4212, 'Equipos y suministros veterinarios', 42),
(4213, 'Telas y vestidos médicos', 42),
(4214, 'Suministros, productos de tratamiento y cuidado del enfermo', 42),
(4215, 'Equipos y suministros dentales', 42),
(4216, 'Equipo de diálisis y suministros', 42),
(4217, 'Productos para los servicios médicos de urgencias y campo', 42),
(4218, 'Productos de examen y control del paciente', 42),
(4219, 'Productos de centro médico', 42),
(4220, 'Productos de hacer imágenes diagnósticas médicas y de medicina nuclear', 42),
(4221, 'Ayuda para personas con desafíos físicos para vivir independiente', 42),
(4222, 'Productos para administración intravenosa y arterial', 42),
(4223, 'Nutrición clínica', 42),
(4224, 'Productos medicinales de deportes y ortopédicos y prótesis', 42),
(4225, 'Productos de rehabilitación y terapia ocupacional y física', 42),
(4226, 'Equipo y suministros post mortem y funerarios', 42),
(4227, 'Productos de resucitación, anestesia y respiratorio', 42),
(4228, 'Productos para la esterilización médica', 42),
(4229, 'Productos quirúrgicos', 42),
(4230, 'Suministros para formación y estudios de medicina', 42),
(4231, 'Productos para el cuidado de heridas', 42),
(4232, 'Implantes ortopédicos quirúrgicos', 42),
(4319, 'Dispositivos de comunicaciones y accesorios', 43),
(4320, 'Componentes para tecnología de la información, difusión o telecomunicaciones', 43),
(4321, 'Equipo informático y accesorios', 43),
(4322, 'Equipos o plataformas y accesorios de redes multimedia o de voz y datos', 43),
(4323, 'Software', 43),
(4410, 'Maquinaria, suministros y accesorios de oficina', 44),
(4411, 'Accesorios de oficina y escritorio', 44),
(4412, 'Suministros de oficina', 44),
(4510, 'Equipo de imprenta y publicación', 45),
(4511, 'Equipos de audio y video para presentación y composición', 45),
(4512, 'Equipo de vídeo, filmación o fotografía', 45),
(4513, 'Medios fotográficos y de grabación', 45),
(4514, 'Suministros fotográficos para cine', 45),
(4610, 'Armas ligeras y munición', 46),
(4611, 'Armas de guerra convencionales', 46),
(4612, 'Misiles', 46),
(4613, 'Cohetes y subsistemas', 46),
(4614, 'Lanzadores', 46),
(4615, 'Protección del Orden Público', 46),
(4616, 'Seguridad y control público', 46),
(4617, 'Seguridad, vigilancia y detección', 46),
(4618, 'Seguridad y protección personal', 46),
(4619, 'Protección contra incendios', 46),
(4620, 'Equipo de entrenamiento de seguridad física e industrial, defensa y orden público', 46),
(4710, 'Tratamiento, suministros y eliminación de agua y aguas residuales', 47),
(4711, 'Equipo industrial de lavandería y lavado en seco', 47),
(4712, 'Equipo de aseo', 47),
(4713, 'Suministros de aseo y limpieza', 47),
(4810, 'Equipos de servicios de alimentación para instituciones', 48),
(4811, 'Máquinas expendedoras', 48),
(4812, 'Equipo de Juego o de Apostar', 48),
(4813, 'Equipo y materiales funerarios', 48),
(4910, 'Coleccionables y condecoraciones', 49),
(4912, 'Equipos y accesorios para acampada y exteriores', 49),
(4913, 'Equipos de pesca y caza', 49),
(4914, 'Equipos para deportes acuáticos', 49),
(4915, 'Equipos para deportes de invierno', 49),
(4916, 'Equipos deportivos para campos y canchas', 49),
(4917, 'Equipos de gimnasia y boxeo', 49),
(4918, 'Juegos, equipo de tiro y mesa', 49),
(4920, 'Equipo para entrenamiento físico', 49),
(4921, 'Otros deportes', 49),
(4922, 'Equipo  y accesorios para deportes', 49),
(4924, 'Equipo de recreo, parques infantiles y equipo y suministros de natación y de spa', 49),
(5010, 'Frutos secos', 50),
(5011, 'Productos de carne y aves de corral', 50),
(5012, 'Pescados y mariscos', 50),
(5013, 'Productos lácteos y huevos', 50),
(5015, 'Aceites y grasas comestibles', 50),
(5016, 'Chocolates, azúcares, edulcorantes y productos de confitería', 50),
(5017, 'Condimentos y conservantes', 50),
(5018, 'Productos de panadería', 50),
(5019, 'Alimentos preparados y conservados', 50),
(5020, 'Bebidas', 50),
(5021, 'Tabaco y productos de fumar y substitutos', 50),
(5022, 'Productos de cereales y legumbres', 50),
(5030, 'Fruta fresca', 50),
(5031, 'Fruta orgánica fresca', 50),
(5032, 'Fruta seca', 50),
(5033, 'Fruta orgánica seca', 50),
(5034, 'Fruta congelada', 50),
(5035, 'Fruta orgánica congelada', 50),
(5036, 'Fruta en lata o en frasco', 50),
(5037, 'Fruta orgánica en lata o en frasco', 50),
(5038, 'Puré de frutas', 50),
(5040, 'Vegetales frescos', 50),
(5041, 'Vegetales orgánicos frescos', 50),
(5042, 'Vegetales secos', 50),
(5043, 'Vegetales orgánicos secos', 50),
(5044, 'Vegetales congelados', 50),
(5045, 'Vegetales orgánicos congelados', 50),
(5046, 'Vegetales en lata o en frasco', 50),
(5047, 'Vegetales orgánicos en lata o en frasco', 50),
(5110, 'Medicamentos antiinfecciosos', 51),
(5111, 'Agentes antitumorales', 51),
(5112, 'Medicamentos cardiovasculares', 51),
(5113, 'Medicamentos hematólogos', 51),
(5114, 'Medicamentos para el sistema nervioso central', 51),
(5115, 'Medicamentos para el sistema nervioso autónomo', 51),
(5116, 'Medicamentos que afectan al sistema respiratorio', 51),
(5117, 'Medicamentos que afectan al sistema gastrointestinal', 51),
(5118, 'Hormonas y antagonistas hormonales', 51),
(5119, 'Agentes que afectan el agua y los electrolitos', 51),
(5120, 'Medicamentos inmunomoduladores', 51),
(5121, 'Categorías de medicamentos varios', 51),
(5124, 'Fármacos que afectan a los oídos, los ojos, la nariz y la piel', 51),
(5125, 'Suplementos alimenticios veterinarios', 51),
(5210, 'Revestimientos de suelos', 52),
(5212, 'Ropa de cama, mantelerías, paños de cocina y toallas', 52),
(5213, 'Tratamientos de ventanas', 52),
(5214, 'Aparatos electrodomésticos', 52),
(5215, 'Utensilios de cocina domésticos', 52),
(5216, 'Electrónica de consumo', 52),
(5217, 'Tratamientos de pared doméstica', 52),
(5310, 'Ropa', 53),
(5311, 'Calzado', 53),
(5312, 'Maletas, bolsos de mano, mochilas y estuches', 53),
(5313, 'Artículos de tocador y cuidado personal', 53),
(5314, 'Fuentes y accesorios de costura', 53),
(5410, 'Joyería', 54),
(5411, 'Relojes', 54),
(5412, 'Gemas', 54),
(5510, 'Medios impresos', 55),
(5511, 'Material electrónico de referencia', 55),
(5512, 'Etiquetado y accesorios', 55),
(5610, 'Muebles de alojamiento', 56),
(5611, 'Muebles comerciales e industriales', 56),
(5612, 'Mobiliario institucional, escolar y educativo y accesorios', 56),
(5613, 'Muebles y accesorios para merchandising', 56),
(5614, 'Adornos para el hogar', 56),
(6010, 'Materiales didácticos profesionales y de desarrollo y accesorios y suministros', 60),
(6011, 'Decoraciones y suministros del aula', 60),
(6012, 'Equipo, accesorios y suministros de arte y manualidades', 60),
(6013, 'Instrumentos musicales, piezas y accesorios', 60),
(6014, 'Juguetes y juegos', 60),
(7010, 'Pesquerías y acuicultura', 70),
(7011, 'Horticultura', 70),
(7012, 'Servicios de animales vivos', 70),
(7013, 'Preparación, gestión y protección del terreno y del suelo', 70),
(7014, 'Producción, gestión y protección de cultivos', 70),
(7015, 'Silvicultura', 70),
(7016, 'Fauna y flora silvestres', 70),
(7017, 'Desarrollo y vigilancia de recursos hidráulicos', 70),
(7110, 'Servicios de minería', 71),
(7111, 'Servicios de perforación y prospección petrolífera y de gas', 71),
(7112, 'Servicios de construcción y perforación de pozos', 71),
(7113, 'Servicios de aumento de la extracción y producción de gas y petróleo', 71),
(7114, 'Servicios de restauración y recuperación de gas y petróleo', 71),
(7115, 'Servicios de procesamiento y gestión de datos de petróleo y gas', 71),
(7116, 'Servicios de gerencia de proyectos en pozos de petróleo y gas', 71),
(7210, 'Servicios de mantenimiento y reparaciones de construcciones e instalaciones', 72),
(7211, 'Servicios de construcción de edificaciones residenciales', 72),
(7212, 'Servicios de construcción de edificaciones no residenciales', 72),
(7214, 'Servicios de construcción pesada', 72),
(7215, 'Servicios de mantenimiento y construcción de comercio especializado', 72),
(7310, 'Industrias de plásticos y productos químicos', 73),
(7311, 'Industrias de la madera y el papel', 73),
(7312, 'Industrias del metal y de minerales', 73),
(7313, 'Industrias de alimentos y bebidas', 73),
(7314, 'Industrias de fibras, textiles y de tejidos', 73),
(7315, 'Servicios de apoyo a la fabricación', 73),
(7316, 'Fabricación de maquinaria y equipo de transporte', 73),
(7317, 'Fabricación de productos eléctricos e instrumentos de precisión', 73),
(7318, 'Servicios de maquinado y procesado', 73),
(7610, 'Servicios de descontaminación', 76),
(7611, 'Servicios de aseo y limpieza', 76),
(7612, 'Eliminación y tratamiento de desechos', 76),
(7613, 'Limpieza de residuos tóxicos y peligrosos', 76),
(7710, 'Gestión medioambiental', 77),
(7711, 'Protección medioambiental', 77),
(7712, 'Seguimiento, control y rehabilitación de la contaminación', 77),
(7713, 'Servicios de seguimiento, control o rehabilitación de contaminantes', 77),
(7810, 'Transporte de correo y carga', 78),
(7811, 'Transporte de pasajeros', 78),
(7812, 'Manejo y embalaje de material', 78),
(7813, 'Almacenaje', 78),
(7814, 'Servicios de transporte', 78),
(7818, 'Servicios de mantenimiento o reparaciones de transportes', 78),
(8010, 'Servicios de asesoría de gestión', 80),
(8011, 'Servicios de recursos humanos', 80),
(8012, 'Servicios legales', 80),
(8013, 'Servicios inmobiliarios', 80),
(8014, 'Comercialización y distribución', 80),
(8015, 'Política comercial y servicios', 80),
(8016, 'Servicios de administración de empresas', 80),
(8110, 'Servicios profesionales de ingeniería', 81),
(8111, 'Servicios informáticos', 81),
(8112, 'Economía', 81),
(8113, 'Estadística', 81),
(8114, 'Tecnologías de fabricación', 81),
(8115, 'Servicios de pedología', 81),
(8116, 'Entrega de servicios de tecnología de información', 81),
(8210, 'Publicidad', 82),
(8211, 'Escritura y traducciones', 82),
(8212, 'Servicios de reproducción', 82),
(8213, 'Servicios fotográficos', 82),
(8214, 'Diseño gráfico', 82),
(8215, 'Artistas e intérpretes profesionales', 82),
(8310, 'Servicios públicos', 83),
(8311, 'Servicios de medios de telecomunicaciones', 83),
(8312, 'Servicios de información', 83),
(8410, 'Finanzas de desarrollo', 84),
(8411, 'Servicios de contabilidad y auditorias', 84),
(8412, 'Banca e inversiones', 84),
(8413, 'Servicios de seguros y pensiones', 84),
(8414, 'Agencias de crédito', 84),
(8510, 'Servicios integrales de salud', 85),
(8511, 'Prevención y control de enfermedades', 85),
(8512, 'Práctica médica', 85),
(8513, 'Ciencia médica, investigación y experimentación', 85),
(8514, 'Medicina alternativa y holística', 85),
(8515, 'Servicios alimenticios y de nutrición', 85),
(8516, 'Servicios de mantenimiento, renovación y reparación de equipo médico quirúrgico', 85),
(8517, 'Servicios de muerte y soporte al fallecimiento', 85),
(8610, 'Formación profesional', 86),
(8611, 'Sistemas educativos alternativos', 86),
(8612, 'Instituciones educativas', 86),
(8613, 'Servicios educativos especializados', 86),
(8614, 'Instalaciones educativas', 86),
(9010, 'Restaurantes y catering (servicios de comidas y bebidas)', 90),
(9011, 'Instalaciones hoteleras, alojamientos y centros de encuentros', 90),
(9012, 'Facilitación de viajes', 90),
(9013, 'Artes interpretativas', 90),
(9014, 'Deportes comerciales', 90),
(9015, 'Servicios de entretenimiento', 90),
(9110, 'Aspecto personal', 91),
(9111, 'Asistencia doméstica y personal', 91),
(9210, 'Orden público y seguridad', 92),
(9211, 'Servicios militares o defensa nacional', 92),
(9212, 'Seguridad y protección personal', 92),
(9310, 'Sistemas e instituciones políticas', 93),
(9311, 'Condiciones sociopolíticas', 93),
(9312, 'Relaciones internacionales', 93),
(9313, 'Ayuda y asistencia humanitaria', 93),
(9314, 'Servicios comunitarios y sociales', 93),
(9315, 'Servicios de administración y financiación pública', 93),
(9316, 'Tributación', 93),
(9317, 'Política y regulación comercial', 93),
(9410, 'Organizaciones laborales', 94),
(9411, 'Organizaciones religiosas', 94),
(9412, 'Clubes', 94),
(9413, 'Organizaciones, asociaciones y movimientos cívicos', 94),
(9510, 'Parcelas de tierra', 95),
(9511, 'Vías', 95),
(9512, 'Estructuras y edificios permanentes', 95),
(9513, 'Estructuras y edificios móviles', 95),
(9514, 'Estructuras y edificios prefabricados', 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segments`
--

CREATE TABLE `segments` (
  `id` int(11) NOT NULL,
  `description_segment` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `segments`
--

INSERT INTO `segments` (`id`, `description_segment`) VALUES
(10, 'Material Vivo Vegetal y Animal, Accesorios y Suministros'),
(11, 'Material Mineral, Textil y  Vegetal y Animal No Comestible'),
(12, 'Material Químico incluyendo Bioquímicos y Materiales de Gas'),
(13, 'Materiales de Resina, Colofonia, Caucho, Espuma, Película y Elastómericos'),
(14, 'Materiales y Productos de Papel'),
(15, 'Materiales Combustibles, Aditivos para Combustibles, Lubricantes y Anticorrosivos'),
(20, 'Maquinaria y Accesorios de Minería y Perforación de Pozos'),
(21, 'Maquinaria y Accesorios para Agricultura, Pesca, Silvicultura y Fauna'),
(22, 'Maquinaria y Accesorios para Construcción y Edificación'),
(23, 'Maquinaria y Accesorios para Manufactura y Procesamiento Industrial'),
(24, 'Maquinaria, Accesorios y Suministros para Manejo, Acondicionamiento y Almacenamiento de Materiales'),
(25, 'Vehículos Comerciales, Militares y Particulares, Accesorios y Componentes'),
(26, 'Maquinaria y Accesorios para Generación y Distribución de Energía'),
(27, 'Herramientas y Maquinaria General'),
(30, 'Componentes y Suministros para Estructuras, Edificación, Construcción y Obras Civiles'),
(31, 'Componentes y Suministros de Manufactura'),
(32, 'Componentes y Suministros Electrónicos'),
(39, 'Componentes, Accesorios y Suministros de Sistemas Eléctricos e Iluminación'),
(40, 'Componentes y Equipos para Distribución y Sistemas de Acondicionamiento'),
(41, 'Equipos y Suministros de Laboratorio, de Medición, de Observación y de Pruebas'),
(42, 'Equipo Médico, Accesorios y Suministros'),
(43, 'Difusión de Tecnologías de Información y Telecomunicaciones'),
(44, 'Equipos de Oficina, Accesorios y Suministros'),
(45, 'Equipos y Suministros para Impresión, Fotografia y Audiovisuales'),
(46, 'Equipos y Suministros de Defensa, Orden Publico, Proteccion, Vigilancia y Seguridad'),
(47, 'Equipos de Limpieza y Suministros'),
(48, 'Maquinaria, Equipo y Suministros para la Industria de Servicios'),
(49, 'Equipos, Suministros y Accesorios para Deportes y Recreación'),
(50, 'Alimentos, Bebidas y Tabaco '),
(51, 'Medicamentos y Productos Farmacéuticos'),
(52, 'Artículos Domésticos, Suministros y Productos Electrónicos de Consumo '),
(53, 'Ropa, Maletas y Productos de Aseo Personal'),
(54, 'Productos para Relojería, Joyería y Piedras Preciosas'),
(55, 'Publicaciones Impresas, Publicaciones Electrónicas y Accesorios'),
(56, 'Muebles, Mobiliario y Decoración'),
(60, 'Instrumentos Musicales, Juegos, Juguetes, Artes, Artesanías y Equipo educativo, Materiales, Accesorios y Suministros'),
(70, 'Servicios de Contratacion Agrícola, Pesquera, Forestal y de Fauna'),
(71, 'Servicios de Minería, Petróleo y Gas'),
(72, 'Servicios de Edificación, Construcción de Instalaciones y Mantenimiento'),
(73, 'Servicios de Producción Industrial y Manufactura'),
(76, 'Servicios de Limpieza, Descontaminación y Tratamiento de Residuos'),
(77, 'Servicios Medioambientales'),
(78, 'Servicios de Transporte, Almacenaje y Correo'),
(80, 'Servicios de Gestión, Servicios Profesionales de Empresa y Servicios Administrativos'),
(81, 'Servicios Basados en Ingeniería, Investigación y Tecnología'),
(82, 'Servicios Editoriales, de Diseño, de Artes Graficas y Bellas Artes'),
(83, 'Servicios Públicos y Servicios Relacionados con el Sector Público'),
(84, 'Servicios Financieros y de Seguros'),
(85, 'Servicios de Salud'),
(86, 'Servicios Educativos y de Formación'),
(90, 'Servicios de Viajes, Alimentación, Alojamiento y Entretenimiento'),
(91, 'Servicios Personales y Domésticos'),
(92, 'Servicios de Defensa Nacional, Orden Publico, Seguridad y Vigilancia'),
(93, 'Servicios Políticos y de Asuntos Cívicos'),
(94, 'Organizaciones y Clubes'),
(95, 'Terrenos, Edificios, Estructuras y Vías');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'ACTIVO'),
(2, 'PUBLICADO'),
(3, 'EVALUACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(120) NOT NULL,
  `fullname` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `fullname`) VALUES
(1, 'admin', '$2y$12$Iw2mfRssTSoXffnNPBIH0uH9HwrHd5l/GvgQkkdIxG.000Z/dED86', 'admin administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_segments` (`id_segments`,`id_family`),
  ADD KEY `id_family` (`id_family`);

--
-- Indices de la tabla `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `event_offers`
--
ALTER TABLE `event_offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `object` (`object`),
  ADD KEY `id_creator` (`id_creator`,`id_event_offers_schedule`,`id_status`),
  ADD KEY `id_event_offers_schedule` (`id_event_offers_schedule`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_activity` (`id_activity`),
  ADD KEY `id_currency` (`id_currency`);

--
-- Indices de la tabla `event_offers_docs`
--
ALTER TABLE `event_offers_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `event_offers_schedule`
--
ALTER TABLE `event_offers_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_segment` (`id_segment`);

--
-- Indices de la tabla `segments`
--
ALTER TABLE `segments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `event_offers`
--
ALTER TABLE `event_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `event_offers_schedule`
--
ALTER TABLE `event_offers_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9515;

--
-- AUTO_INCREMENT de la tabla `segments`
--
ALTER TABLE `segments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`id_segments`) REFERENCES `segments` (`id`),
  ADD CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`id_family`) REFERENCES `family` (`id`);

--
-- Filtros para la tabla `event_offers`
--
ALTER TABLE `event_offers`
  ADD CONSTRAINT `event_offers_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `event_offers_ibfk_2` FOREIGN KEY (`id_event_offers_schedule`) REFERENCES `event_offers_schedule` (`id`),
  ADD CONSTRAINT `event_offers_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `event_offers_ibfk_4` FOREIGN KEY (`id_currency`) REFERENCES `currency` (`id`),
  ADD CONSTRAINT `event_offers_ibfk_5` FOREIGN KEY (`id_activity`) REFERENCES `activities` (`id`);

--
-- Filtros para la tabla `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `family_ibfk_1` FOREIGN KEY (`id_segment`) REFERENCES `segments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
