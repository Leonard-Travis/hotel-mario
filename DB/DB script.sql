-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2010 at 02:05 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `hoteles.com.ve`
--

-- --------------------------------------------------------

--
-- Table structure for table `_admin_airlines`
--

DROP TABLE IF EXISTS `_admin_airlines`;
CREATE TABLE IF NOT EXISTS `_admin_airlines` (
  `airline_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL,
  PRIMARY KEY (`airline_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_admin_airlines`
--

INSERT INTO `_admin_airlines` (`airline_id`, `name`, `code`) VALUES
(1, 'American Airline', 'A.A.'),
(2, 'Santa Barbara', 'S.B.');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_categories`
--

DROP TABLE IF EXISTS `_admin_categories`;
CREATE TABLE IF NOT EXISTS `_admin_categories` (
  `categorie_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_spanish` varchar(50) NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `_admin_categories`
--

INSERT INTO `_admin_categories` (`categorie_id`, `name_spanish`) VALUES
(1, 'Margarita'),
(2, 'Playita'),
(3, 'Colonia Tovar'),
(4, 'Navideño');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_categories_package`
--

DROP TABLE IF EXISTS `_admin_categories_package`;
CREATE TABLE IF NOT EXISTS `_admin_categories_package` (
  `CATEGORIE_id` int(10) unsigned NOT NULL,
  `PACKAGE_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_categories_package`
--

INSERT INTO `_admin_categories_package` (`CATEGORIE_id`, `PACKAGE_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(4, 3),
(1, 4),
(2, 4),
(1, 5),
(2, 5),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_customers`
--

DROP TABLE IF EXISTS `_admin_customers`;
CREATE TABLE IF NOT EXISTS `_admin_customers` (
  `customer_ci_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phone` int(10) unsigned NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `sex` enum('m','f') NOT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`customer_ci_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18277057 ;

--
-- Dumping data for table `_admin_customers`
--

INSERT INTO `_admin_customers` (`customer_ci_id`, `name`, `lastname`, `phone`, `email`, `address`, `sex`, `birth_date`) VALUES
(22, 'Ana', 'arargar', 111, 'ggggg', 'gg', 'm', '2010-02-27'),
(555, 'tt', 'tt', 0, 'themonkey_89@hotmail.com', 'tt', 'm', '2010-06-26'),
(1987, 'oo', 'oo', 0, 'o@l.com', 'oo', 'm', '2010-06-27'),
(123456, 'lol', 'olol', 0, 'olo@l.com', 'lolo', 'm', '2010-06-27'),
(18277056, 'Mario', 'Munera', 111, 'mario@gmail.com', '1', 'm', '1989-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_employees`
--

DROP TABLE IF EXISTS `_admin_employees`;
CREATE TABLE IF NOT EXISTS `_admin_employees` (
  `employees_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `type` enum('manager','seller') NOT NULL,
  `password` int(6) NOT NULL,
  PRIMARY KEY (`employees_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_employees`
--

INSERT INTO `_admin_employees` (`employees_id`, `name`, `lastname`, `type`, `password`) VALUES
(1, 'todo', 'elmundo', 'seller', 7896),
(1234, 'Mario', 'Munera', 'seller', 9876),
(5678, 'juan', 'varon', 'manager', 0);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights`
--

DROP TABLE IF EXISTS `_admin_flights`;
CREATE TABLE IF NOT EXISTS `_admin_flights` (
  `flight_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AIRLINES_id` int(10) unsigned NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `class` enum('first class','turist','economic') NOT NULL,
  `price_per_adult` float NOT NULL,
  `price_per_kid` float NOT NULL,
  `origin` int(10) unsigned NOT NULL,
  `destination` int(10) unsigned NOT NULL,
  `time` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `type` enum('national','international') NOT NULL,
  PRIMARY KEY (`flight_id`),
  KEY `fk__ADMIN_FLIGHTS_has_ADMIN_AIRLINES` (`AIRLINES_id`),
  KEY `origin_flight_city` (`origin`),
  KEY `destination_flight_city` (`destination`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `_admin_flights`
--

INSERT INTO `_admin_flights` (`flight_id`, `AIRLINES_id`, `number`, `class`, `price_per_adult`, `price_per_kid`, `origin`, `destination`, `time`, `date`, `type`) VALUES
(80, 1, 123, 'first class', 1.1, 1, 1, 2, 'hh:mm', '0000-00-00', 'national'),
(81, 1, 123, 'first class', 1.1, 1, 2, 1, 'hh:mm', '0000-00-00', 'national'),
(82, 2, 987, 'economic', 1.9, 0, 1, 4, 'hh:mm', '0000-00-00', 'international'),
(83, 2, 987, 'economic', 1.9, 0, 4, 1, 'hh:mm', '0000-00-00', 'international'),
(84, 1, 656, 'economic', 1.2, 0, 1, 3, 'hh:mm', '0000-00-00', 'international'),
(85, 1, 656, 'economic', 1.2, 0, 3, 1, 'hh:mm', '0000-00-00', 'international'),
(86, 2, 657, 'turist', 2.1, 1.1, 1, 2, 'hh:mm', '0000-00-00', 'national'),
(87, 1, 654, 'first class', 1.9, 0, 1, 4, 'hh:mm', '0000-00-00', 'international'),
(88, 1, 654, 'first class', 1.9, 0, 4, 1, 'hh:mm', '0000-00-00', 'international'),
(89, 1, 11, 'first class', 1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national'),
(90, 1, 11, 'first class', 1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national'),
(91, 1, 6767, 'first class', 1.1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national'),
(92, 1, 908, 'first class', 1.1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national'),
(93, 1, 908, 'first class', 1.1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national'),
(94, 1, 6959, 'turist', 1.1, 0, 1, 3, 'hh:mm', '0000-00-00', 'international'),
(95, 1, 6959, 'turist', 1.1, 0, 3, 1, 'hh:mm', '0000-00-00', 'international'),
(96, 1, 7867, 'first class', 1.2, 0, 1, 4, 'hh:mm', '0000-00-00', 'international'),
(97, 1, 5678, 'first class', 1.2, 0, 4, 3, 'hh:mm', '0000-00-00', 'international'),
(98, 1, 5678, 'first class', 1.2, 0, 3, 4, 'hh:mm', '0000-00-00', 'international'),
(99, 1, 8998, 'first class', 1.1, 0, 4, 1, 'hh:mm', '0000-00-00', 'international'),
(100, 1, 1234, 'first class', 156, 0, 1, 2, 'hh:mm', '0000-00-00', 'national'),
(101, 1, 1234, 'first class', 156, 0, 2, 1, 'hh:mm', '0000-00-00', 'national');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_city`
--

DROP TABLE IF EXISTS `_admin_flights_city`;
CREATE TABLE IF NOT EXISTS `_admin_flights_city` (
  `flight_city_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FLIGHTS_COUNTRY_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`flight_city_id`),
  KEY `FLIGHTS_CITY_FKIndex1` (`FLIGHTS_COUNTRY_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `_admin_flights_city`
--

INSERT INTO `_admin_flights_city` (`flight_city_id`, `FLIGHTS_COUNTRY_id`, `name`) VALUES
(1, 1, 'CCS'),
(2, 1, 'MAR'),
(3, 2, 'BOG'),
(4, 2, 'MDE');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_country`
--

DROP TABLE IF EXISTS `_admin_flights_country`;
CREATE TABLE IF NOT EXISTS `_admin_flights_country` (
  `flight_country_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`flight_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_admin_flights_country`
--

INSERT INTO `_admin_flights_country` (`flight_country_id`, `name`) VALUES
(1, 'venezuela'),
(2, 'colombia');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_per_quote`
--

DROP TABLE IF EXISTS `_admin_flights_per_quote`;
CREATE TABLE IF NOT EXISTS `_admin_flights_per_quote` (
  `QUOTATIONS_FLIGHTS_id` int(10) unsigned NOT NULL,
  `FLIGHTS_id` int(10) unsigned NOT NULL,
  KEY `FK_quotations_in_FPQ` (`QUOTATIONS_FLIGHTS_id`),
  KEY `FK_flights_in_FPQ` (`FLIGHTS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_flights_per_quote`
--

INSERT INTO `_admin_flights_per_quote` (`QUOTATIONS_FLIGHTS_id`, `FLIGHTS_id`) VALUES
(22, 80),
(22, 81),
(22, 82),
(22, 83),
(23, 84),
(23, 85),
(23, 86),
(23, 87),
(23, 88),
(24, 92),
(24, 93),
(25, 94),
(25, 95),
(25, 96),
(25, 97),
(25, 98),
(25, 99),
(26, 100),
(26, 101);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_generic`
--

DROP TABLE IF EXISTS `_admin_generic`;
CREATE TABLE IF NOT EXISTS `_admin_generic` (
  `generic_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  PRIMARY KEY (`generic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `_admin_generic`
--

INSERT INTO `_admin_generic` (`generic_id`, `description`, `quantity`, `unit_price`) VALUES
(1, 'cama adicional', 1, 125.65),
(2, 'toallas', 4, 35.657),
(3, 'masaje', 1, 750),
(4, 'mamisa', 2, 122);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_generic_per_quote`
--

DROP TABLE IF EXISTS `_admin_generic_per_quote`;
CREATE TABLE IF NOT EXISTS `_admin_generic_per_quote` (
  `QUOTES_GENERIC_id` int(11) NOT NULL,
  `GENERIC_id` int(11) NOT NULL,
  KEY `FK_generic_id` (`GENERIC_id`),
  KEY `FK_generic_quotation_id` (`QUOTES_GENERIC_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_generic_per_quote`
--

INSERT INTO `_admin_generic_per_quote` (`QUOTES_GENERIC_id`, `GENERIC_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_hotels`
--

DROP TABLE IF EXISTS `_admin_hotels`;
CREATE TABLE IF NOT EXISTS `_admin_hotels` (
  `hotel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `percent_commission` varchar(45) NOT NULL,
  `collect_type` tinyint(1) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(45) NOT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `_admin_hotels`
--

INSERT INTO `_admin_hotels` (`hotel_id`, `percent_commission`, `collect_type`, `name`, `location`) VALUES
(1, '10', NULL, 'Hilton', 'Caracas'),
(2, '', NULL, 'Marriot', 'Caracas'),
(5, '', NULL, 'Laguna Mar', 'Maragarita'),
(6, '', NULL, 'El Gran Balcon', 'Merida'),
(7, '', NULL, 'Hotel Dunes', 'Maracaibo');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_hotels_plans`
--

DROP TABLE IF EXISTS `_admin_hotels_plans`;
CREATE TABLE IF NOT EXISTS `_admin_hotels_plans` (
  `HOTELS_id` int(10) unsigned NOT NULL,
  `PLANS_id` int(10) unsigned NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`HOTELS_id`,`PLANS_id`),
  KEY `fk__ADMIN_HOTELS_has_ADMIN_PLANS_ADMIN_HOTELS` (`HOTELS_id`),
  KEY `fk__ADMIN_HOTELS_has_ADMIN_PLANS_ADMIN_PLANS` (`PLANS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_hotels_plans`
--

INSERT INTO `_admin_hotels_plans` (`HOTELS_id`, `PLANS_id`, `description`, `status`) VALUES
(1, 1, 'Fines de semana economicos', 'active'),
(1, 2, 'un cuarto', 'active'),
(1, 4, 'Todo incluido ', 'active'),
(1, 5, 'todo el dia', 'inactive'),
(1, 6, '', 'inactive'),
(1, 7, '', 'inactive'),
(1, 9, '', 'inactive'),
(2, 1, 'Los fines de semana te despertamos con mazucamba', 'active'),
(2, 5, 'Un recorrido por todas las mas bellas playas de margarita!', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_packages`
--

DROP TABLE IF EXISTS `_admin_packages`;
CREATE TABLE IF NOT EXISTS `_admin_packages` (
  `package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `HOTEL_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `description` varchar(450) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `_admin_packages`
--

INSERT INTO `_admin_packages` (`package_id`, `HOTEL_id`, `name`, `date_start`, `date_end`, `description`) VALUES
(1, 1, 'Paquete Dunas Margarita', '2010-11-15', '2010-11-20', 'Incluye:\n-Alojamiento\n-Bebidad Nacionales\n-Sillas y toldos enla playa\n-Buffets abierto 24 horas'),
(2, 1, 'Paquete Navideño', '2010-12-15', '2010-12-21', 'paquete navideño con cena navideña'),
(3, 1, 'Paquete Navidad', '2010-12-15', '2010-12-25', 'Paquete navideño con todoo'),
(4, 1, 'PAQUETE ESPECIAL NAVIDAD: Plan Todo Incluido Isla de Margarita ', '2010-12-15', '2010-12-20', 'Incluye:\n\nBoleto aéreo Caracas/ Porlamar/ Caracas\nTraslado Aeropuerto/ Hotel/ Aeropuerto\n05 Noches de alojamiento en el Hotel selecionado\nDesayunos\nAlmuerzos\nCenas\nSnacks\nBebidas alcohólicas y no alcohólicas nacionales ilimitadas\nDisfrute de las instalaciones\nNOTA: Incluye Cena y Fiesta de Navidad'),
(5, 2, 'Paquete Especial Navidad: Hesperia Playa El Agua', '2010-12-22', '2010-12-27', 'Incluye:\nBoleto aéreo Caracas/ Porlamar/ Caracas\nTraslado Aeropuerto/ Hotel/ Aeropuerto\n05 Noches de alojamiento \nDesayunos\nAlmuerzos\nCenas\nBebidas alcohólicas y no alcohólicas nacionales ilimitadas\nSnakcs\nCena Especial de Navidad\nDisfrute de todas las instalaciones');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_plans`
--

DROP TABLE IF EXISTS `_admin_plans`;
CREATE TABLE IF NOT EXISTS `_admin_plans` (
  `plan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_english` varchar(45) NOT NULL,
  `status` varchar(10) NOT NULL,
  `name_spanish` varchar(50) NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `_admin_plans`
--

INSERT INTO `_admin_plans` (`plan_id`, `name_english`, `status`, `name_spanish`) VALUES
(1, 'Weekends', 'active', 'Fines de Semana'),
(2, 'Only room', 'active', 'Solo la Hab.'),
(4, 'All included', 'active', 'Todo Incluido'),
(5, 'Full day', 'inactive', 'Dia completo'),
(6, 'Room dinner and breakfast', 'active', 'Hab. c/ cena y desayuno'),
(7, 'Full pension', 'inactive', 'Pension Completa'),
(9, 'All drinks inlcluded', 'inactive', 'Todas las bebidad incluidas'),
(10, 'lolo', 'inactive', 'olol');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_price`
--

DROP TABLE IF EXISTS `_admin_price`;
CREATE TABLE IF NOT EXISTS `_admin_price` (
  `price_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SEASON_id` int(10) unsigned NOT NULL,
  `ROOMS_HOTELS_id` int(10) unsigned NOT NULL,
  `price_per_night` float NOT NULL,
  `PLAN_id` int(11) unsigned NOT NULL,
  `has_weekdays` int(2) NOT NULL,
  `monday_price` float NOT NULL,
  `tuesday_price` float NOT NULL,
  `wednesday_price` float NOT NULL,
  `thursday_price` float NOT NULL,
  `friday_price` float NOT NULL,
  `saturday_price` float NOT NULL,
  `sunday_price` float NOT NULL,
  PRIMARY KEY (`price_id`),
  KEY `fk__ADMIN_PRICE_has_ADMIN_SEASON` (`SEASON_id`),
  KEY `FK_price_rooms_hotels` (`ROOMS_HOTELS_id`),
  KEY `FK_price_plan` (`PLAN_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `_admin_price`
--

INSERT INTO `_admin_price` (`price_id`, `SEASON_id`, `ROOMS_HOTELS_id`, `price_per_night`, `PLAN_id`, `has_weekdays`, `monday_price`, `tuesday_price`, `wednesday_price`, `thursday_price`, `friday_price`, `saturday_price`, `sunday_price`) VALUES
(1, 1, 29, 100, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 33, 120, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 2, 29, 100, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 2, 33, 120, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 6, 29, 100, 1, 1, 100, 100, 100, 10, 100, 100, 100),
(9, 6, 40, 190, 1, 1, 190, 190, 190, 190, 190, 200, 200);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_price_record`
--

DROP TABLE IF EXISTS `_admin_price_record`;
CREATE TABLE IF NOT EXISTS `_admin_price_record` (
  `price_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `season_id` int(10) unsigned NOT NULL,
  `rooms_hotels_id` int(10) unsigned NOT NULL,
  `price_per_night` float NOT NULL,
  `plan_id` int(11) unsigned NOT NULL,
  `elimination_date` date NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_admin_price_record`
--

INSERT INTO `_admin_price_record` (`price_id`, `season_id`, `rooms_hotels_id`, `price_per_night`, `plan_id`, `elimination_date`) VALUES
(1, 1, 34, 200, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations`
--

DROP TABLE IF EXISTS `_admin_quotations`;
CREATE TABLE IF NOT EXISTS `_admin_quotations` (
  `quote_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CUSTOMERS_ci_id` int(10) unsigned NOT NULL,
  `EMPLOYEES_id` int(10) unsigned NOT NULL,
  `QUOTATIONS_HOTELS_id` int(10) unsigned DEFAULT NULL,
  `QUOTATIONS_FLIGHTS_id` int(10) unsigned DEFAULT NULL,
  `QUOTATIONS_GENERIC_id` int(10) unsigned DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`quote_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_EMPLOYEES` (`EMPLOYEES_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_GENERIC` (`QUOTATIONS_GENERIC_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_FLIGHTS` (`QUOTATIONS_FLIGHTS_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_CUSTOMERS` (`CUSTOMERS_ci_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_HOTELS` (`QUOTATIONS_HOTELS_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_admin_quotations`
--

INSERT INTO `_admin_quotations` (`quote_id`, `CUSTOMERS_ci_id`, `EMPLOYEES_id`, `QUOTATIONS_HOTELS_id`, `QUOTATIONS_FLIGHTS_id`, `QUOTATIONS_GENERIC_id`, `quote_date`, `total`) VALUES
(2, 18277056, 1, 4, 26, 2, '2010-10-23', 30418);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_flights`
--

DROP TABLE IF EXISTS `_admin_quotations_flights`;
CREATE TABLE IF NOT EXISTS `_admin_quotations_flights` (
  `quote_flight_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`quote_flight_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `_admin_quotations_flights`
--

INSERT INTO `_admin_quotations_flights` (`quote_flight_id`, `status`, `total`) VALUES
(22, 'x', 8),
(23, 'x', 9.4),
(24, 'x', 2.2),
(25, 'x', 11.6),
(26, 'x', 624);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_generic`
--

DROP TABLE IF EXISTS `_admin_quotations_generic`;
CREATE TABLE IF NOT EXISTS `_admin_quotations_generic` (
  `quotes_generic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `total` float unsigned NOT NULL,
  PRIMARY KEY (`quotes_generic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_admin_quotations_generic`
--

INSERT INTO `_admin_quotations_generic` (`quotes_generic_id`, `total`) VALUES
(1, 1018.28),
(2, 244);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_hotels`
--

DROP TABLE IF EXISTS `_admin_quotations_hotels`;
CREATE TABLE IF NOT EXISTS `_admin_quotations_hotels` (
  `quote_hotel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_check_in` date NOT NULL,
  `date_check_out` date NOT NULL,
  `PLAN_id` int(10) unsigned NOT NULL,
  `total` float unsigned NOT NULL,
  `persons` int(3) NOT NULL,
  `reservation_status` varchar(45) NOT NULL,
  `collect_status` varchar(45) NOT NULL,
  `payment_status` varchar(45) NOT NULL,
  `billing_status` varchar(45) NOT NULL,
  PRIMARY KEY (`quote_hotel_id`),
  KEY `FK_qq_hh` (`PLAN_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `_admin_quotations_hotels`
--

INSERT INTO `_admin_quotations_hotels` (`quote_hotel_id`, `date_check_in`, `date_check_out`, `PLAN_id`, `total`, `persons`, `reservation_status`, `collect_status`, `payment_status`, `billing_status`) VALUES
(2, '2010-04-23', '2010-04-22', 1, 11, 0, 'AF', 'af', 'F', 'f'),
(3, '2010-01-01', '2010-02-01', 1, 6000, 0, 'x', 'x', 'x', 'x'),
(4, '2010-01-01', '2010-12-03', 1, 29550, 2, 'x', 'x', 'x', 'x');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_package`
--

DROP TABLE IF EXISTS `_admin_quotations_package`;
CREATE TABLE IF NOT EXISTS `_admin_quotations_package` (
  `quote_package_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `total` float NOT NULL,
  PRIMARY KEY (`quote_package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_admin_quotations_package`
--

INSERT INTO `_admin_quotations_package` (`quote_package_id`, `total`) VALUES
(1, 2333),
(2, 4555);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms`
--

DROP TABLE IF EXISTS `_admin_rooms`;
CREATE TABLE IF NOT EXISTS `_admin_rooms` (
  `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_spanish` varchar(45) NOT NULL,
  `name_english` varchar(45) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `_admin_rooms`
--

INSERT INTO `_admin_rooms` (`room_id`, `name_spanish`, `name_english`, `special`, `status`) VALUES
(1, 'Individual', 'Single', 0, 'active'),
(4, 'Doble', 'Double', 0, 'active'),
(6, 'Suite', 'Suite', 0, 'active'),
(7, 'Menores', 'Under-age', 1, 'active'),
(9, 'Matrimonial', 'Wedding room ', 0, 'active'),
(14, 'Triple', 'Triple', 0, 'active'),
(15, 'cuadruple', 'Quad', 0, 'inactive'),
(16, 'Mayores', 'Senior', 1, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_hotels`
--

DROP TABLE IF EXISTS `_admin_rooms_hotels`;
CREATE TABLE IF NOT EXISTS `_admin_rooms_hotels` (
  `rooms_hotels_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ROOMS_id` int(10) unsigned NOT NULL,
  `HOTELS_id` int(10) unsigned NOT NULL,
  `commissionable` tinyint(1) NOT NULL,
  `description` varchar(100) NOT NULL,
  `capacity` int(2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`rooms_hotels_id`),
  KEY `fk__ADMIN_ROOMS_HOTELS_ADMIN_HOTELS` (`HOTELS_id`),
  KEY `fk__ADMIN_ROOMS_HOTELS_ADMIN_ROOMS` (`ROOMS_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `_admin_rooms_hotels`
--

INSERT INTO `_admin_rooms_hotels` (`rooms_hotels_id`, `ROOMS_id`, `HOTELS_id`, `commissionable`, `description`, `capacity`, `status`) VALUES
(29, 1, 1, 1, 'Cama individual', 1, 'active'),
(33, 9, 2, 1, 'Cama matrimonial para recien casados', 2, 'active'),
(40, 4, 1, 1, 'Dos camas con A/A', 2, 'active'),
(41, 9, 1, 1, 'Cama matrimonial con AA', 2, 'active'),
(42, 6, 1, 1, 'habitacion amplia', 4, 'inactive'),
(43, 1, 2, 1, 'Cama individual', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_per_package`
--

DROP TABLE IF EXISTS `_admin_rooms_per_package`;
CREATE TABLE IF NOT EXISTS `_admin_rooms_per_package` (
  `room_per_package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PACKAGE_id` int(10) unsigned NOT NULL,
  `ROOMS_HOTELS_id` int(10) unsigned NOT NULL,
  `price_per_person` float NOT NULL,
  PRIMARY KEY (`room_per_package_id`),
  KEY `FK_room_per_package_package` (`PACKAGE_id`),
  KEY `FK_room_per_package_rooms` (`ROOMS_HOTELS_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `_admin_rooms_per_package`
--

INSERT INTO `_admin_rooms_per_package` (`room_per_package_id`, `PACKAGE_id`, `ROOMS_HOTELS_id`, `price_per_person`) VALUES
(1, 1, 29, 1200),
(2, 1, 40, 900),
(3, 2, 29, 3000),
(4, 2, 40, 2500),
(5, 3, 40, 4000),
(6, 3, 29, 3500),
(7, 4, 29, 3200),
(8, 4, 40, 2800),
(9, 5, 43, 4863),
(10, 5, 33, 4700);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_per_package_quote`
--

DROP TABLE IF EXISTS `_admin_rooms_per_package_quote`;
CREATE TABLE IF NOT EXISTS `_admin_rooms_per_package_quote` (
  `QUOTE_PACKAGE_id` int(3) unsigned NOT NULL,
  `ROOM_PER_PACKAGE_id` int(10) unsigned NOT NULL,
  `number_of_rooms` int(2) NOT NULL,
  KEY `FK_rooms_per_package_quote` (`QUOTE_PACKAGE_id`),
  KEY `FK_rooms_per_package_rooms` (`ROOM_PER_PACKAGE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_rooms_per_package_quote`
--

INSERT INTO `_admin_rooms_per_package_quote` (`QUOTE_PACKAGE_id`, `ROOM_PER_PACKAGE_id`, `number_of_rooms`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_per_quote`
--

DROP TABLE IF EXISTS `_admin_rooms_per_quote`;
CREATE TABLE IF NOT EXISTS `_admin_rooms_per_quote` (
  `ROOMS_HOTELS_id` int(10) unsigned NOT NULL,
  `QUOTATIONS_HOTELS_id` int(10) unsigned NOT NULL,
  `quantity_of_rooms` int(10) unsigned NOT NULL,
  `subtotal` float NOT NULL,
  `unit_price` varchar(250) NOT NULL,
  PRIMARY KEY (`ROOMS_HOTELS_id`,`QUOTATIONS_HOTELS_id`),
  KEY `FK_quotations_hotels_per_quote` (`QUOTATIONS_HOTELS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_rooms_per_quote`
--

INSERT INTO `_admin_rooms_per_quote` (`ROOMS_HOTELS_id`, `QUOTATIONS_HOTELS_id`, `quantity_of_rooms`, `subtotal`, `unit_price`) VALUES
(29, 2, 22, 0, ''),
(29, 3, 2, 6000, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />'),
(29, 4, 1, 11240, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />100BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 4, 1, 18310, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_season`
--

DROP TABLE IF EXISTS `_admin_season`;
CREATE TABLE IF NOT EXISTS `_admin_season` (
  `season_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`season_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `_admin_season`
--

INSERT INTO `_admin_season` (`season_id`, `date_start`, `date_end`) VALUES
(1, '2010-01-01', '2010-01-31'),
(2, '2010-02-01', '2010-02-15'),
(3, '2010-02-16', '2010-03-31'),
(4, '2010-04-05', '2010-04-30'),
(5, '2010-05-01', '2010-06-01'),
(6, '2010-06-01', '2010-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_seasons_per_hotel`
--

DROP TABLE IF EXISTS `_admin_seasons_per_hotel`;
CREATE TABLE IF NOT EXISTS `_admin_seasons_per_hotel` (
  `SEASON_id` int(10) unsigned NOT NULL,
  `HOTEL_id` int(10) unsigned NOT NULL,
  `season_name` varchar(50) NOT NULL,
  KEY `hotel_in_seasons_per_hotel` (`HOTEL_id`),
  KEY `season_in_seasons_per_hotel` (`SEASON_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_seasons_per_hotel`
--

INSERT INTO `_admin_seasons_per_hotel` (`SEASON_id`, `HOTEL_id`, `season_name`) VALUES
(6, 1, 'okok'),
(6, 1, 'okok'),
(6, 1, 'okok'),
(6, 1, 'okok');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_travelers`
--

DROP TABLE IF EXISTS `_admin_travelers`;
CREATE TABLE IF NOT EXISTS `_admin_travelers` (
  `traveler_ci_id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `passport` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `type` enum('senior','kid','adult') DEFAULT NULL,
  PRIMARY KEY (`traveler_ci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_travelers`
--

INSERT INTO `_admin_travelers` (`traveler_ci_id`, `name`, `lastname`, `passport`, `email`, `type`) VALUES
(0, 'Mercedes', 'Amaya', 'hih', 'ih', 'adult'),
(1, 'pedro', 'munera', '1', '1', 'adult'),
(2, 'peito', 'munera', '2', '2', 'kid'),
(177, 'Alex', 'Brito', '7', '7', 'adult'),
(178, 'Ana', 'Moreno', '7', '7', 'kid'),
(1888, 'Mario ', 'Moreno', '8', '8', 'adult'),
(1998, 'koko', 'ko', '1998', '1998', 'adult'),
(18898, 'Mario', 'Munera', '188981', '18898', 'adult'),
(18998, 'Mario ', 'Munera', '1899889', '8998', 'adult'),
(19909, 'Mercedes ', 'Amaya', '19909', '19909', 'adult'),
(188998, 'Mario', 'Munera', '188998', '18998', 'adult'),
(189878, 'Mario', 'Munera', '1899889', '1899889', 'adult');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_travelers_per_flight`
--

DROP TABLE IF EXISTS `_admin_travelers_per_flight`;
CREATE TABLE IF NOT EXISTS `_admin_travelers_per_flight` (
  `TRAVELERS_ci_id` int(10) unsigned NOT NULL,
  `FLIGHTS_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`TRAVELERS_ci_id`,`FLIGHTS_id`),
  KEY `fk__ADMIN_TRAVELERS_has_ADMIN_FLIGHTS_ADMIN_TRAVELERS` (`TRAVELERS_ci_id`),
  KEY `fk__ADMIN_TRAVELERS_has_ADMIN_FLIGHTS_ADMIN_FLIGHTS` (`FLIGHTS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_travelers_per_flight`
--

INSERT INTO `_admin_travelers_per_flight` (`TRAVELERS_ci_id`, `FLIGHTS_id`) VALUES
(0, 99),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 100),
(1, 101),
(2, 80),
(2, 81),
(2, 100),
(2, 101),
(177, 87),
(177, 88),
(178, 86),
(1888, 84),
(1888, 85),
(1888, 86),
(1998, 92),
(1998, 93),
(18898, 99),
(18998, 96),
(19909, 96),
(19909, 97),
(19909, 98),
(188998, 97),
(188998, 98),
(189878, 94),
(189878, 95);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `_admin_flights`
--
ALTER TABLE `_admin_flights`
  ADD CONSTRAINT `destination_flight_city` FOREIGN KEY (`destination`) REFERENCES `_admin_flights_city` (`flight_city_id`),
  ADD CONSTRAINT `FK_flights_airline` FOREIGN KEY (`AIRLINES_id`) REFERENCES `_admin_airlines` (`airline_id`),
  ADD CONSTRAINT `origin_flight_city` FOREIGN KEY (`origin`) REFERENCES `_admin_flights_city` (`flight_city_id`);

--
-- Constraints for table `_admin_flights_city`
--
ALTER TABLE `_admin_flights_city`
  ADD CONSTRAINT `country_city_flight` FOREIGN KEY (`FLIGHTS_COUNTRY_id`) REFERENCES `_admin_flights_country` (`flight_country_id`),
  ADD CONSTRAINT `FK_flights_city_country` FOREIGN KEY (`FLIGHTS_COUNTRY_id`) REFERENCES `_admin_flights_country` (`flight_country_id`);

--
-- Constraints for table `_admin_flights_per_quote`
--
ALTER TABLE `_admin_flights_per_quote`
  ADD CONSTRAINT `FK_flights_in_FPQ` FOREIGN KEY (`FLIGHTS_id`) REFERENCES `_admin_flights` (`flight_id`),
  ADD CONSTRAINT `FK_quotations_in_FPQ` FOREIGN KEY (`QUOTATIONS_FLIGHTS_id`) REFERENCES `_admin_quotations_flights` (`quote_flight_id`);

--
-- Constraints for table `_admin_hotels_plans`
--
ALTER TABLE `_admin_hotels_plans`
  ADD CONSTRAINT `FK_hotel_hotel` FOREIGN KEY (`HOTELS_id`) REFERENCES `_admin_hotels` (`hotel_id`),
  ADD CONSTRAINT `FK_hotel_plan` FOREIGN KEY (`PLANS_id`) REFERENCES `_admin_plans` (`plan_id`);

--
-- Constraints for table `_admin_price`
--
ALTER TABLE `_admin_price`
  ADD CONSTRAINT `FK_price_plan` FOREIGN KEY (`PLAN_id`) REFERENCES `_admin_plans` (`plan_id`),
  ADD CONSTRAINT `fk_price_rooms_hotels` FOREIGN KEY (`ROOMS_HOTELS_id`) REFERENCES `_admin_rooms_hotels` (`rooms_hotels_id`),
  ADD CONSTRAINT `fk_price_season` FOREIGN KEY (`SEASON_id`) REFERENCES `_admin_season` (`season_id`);

--
-- Constraints for table `_admin_quotations`
--
ALTER TABLE `_admin_quotations`
  ADD CONSTRAINT `FK_quotations_customer` FOREIGN KEY (`CUSTOMERS_ci_id`) REFERENCES `_admin_customers` (`customer_ci_id`),
  ADD CONSTRAINT `FK_quotations_employees` FOREIGN KEY (`EMPLOYEES_id`) REFERENCES `_admin_employees` (`employees_id`),
  ADD CONSTRAINT `FK_quotations_flights` FOREIGN KEY (`QUOTATIONS_FLIGHTS_id`) REFERENCES `_admin_quotations_flights` (`quote_flight_id`),
  ADD CONSTRAINT `FK_quotations_generic` FOREIGN KEY (`QUOTATIONS_GENERIC_id`) REFERENCES `_admin_quotations_generic` (`quotes_generic_id`);

--
-- Constraints for table `_admin_quotations_hotels`
--
ALTER TABLE `_admin_quotations_hotels`
  ADD CONSTRAINT `FK_qq_hh` FOREIGN KEY (`PLAN_id`) REFERENCES `_admin_plans` (`plan_id`);

--
-- Constraints for table `_admin_rooms_hotels`
--
ALTER TABLE `_admin_rooms_hotels`
  ADD CONSTRAINT `FK_hotel_room` FOREIGN KEY (`HOTELS_id`) REFERENCES `_admin_hotels` (`hotel_id`),
  ADD CONSTRAINT `FK_rooms_rooms` FOREIGN KEY (`ROOMS_id`) REFERENCES `_admin_rooms` (`room_id`);

--
-- Constraints for table `_admin_rooms_per_package`
--
ALTER TABLE `_admin_rooms_per_package`
  ADD CONSTRAINT `FK_room_per_package_rooms` FOREIGN KEY (`ROOMS_HOTELS_id`) REFERENCES `_admin_rooms_hotels` (`rooms_hotels_id`),
  ADD CONSTRAINT `FK_room_per_package_package` FOREIGN KEY (`PACKAGE_id`) REFERENCES `_admin_packages` (`package_id`);

--
-- Constraints for table `_admin_rooms_per_package_quote`
--
ALTER TABLE `_admin_rooms_per_package_quote`
  ADD CONSTRAINT `FK_rooms_per_package_rooms` FOREIGN KEY (`ROOM_PER_PACKAGE_id`) REFERENCES `_admin_rooms_per_package` (`room_per_package_id`),
  ADD CONSTRAINT `FK_rooms_per_package_quote` FOREIGN KEY (`QUOTE_PACKAGE_id`) REFERENCES `_admin_quotations_package` (`quote_package_id`);

--
-- Constraints for table `_admin_rooms_per_quote`
--
ALTER TABLE `_admin_rooms_per_quote`
  ADD CONSTRAINT `FK_quotations_hotels_per_quote` FOREIGN KEY (`QUOTATIONS_HOTELS_id`) REFERENCES `_admin_quotations_hotels` (`quote_hotel_id`),
  ADD CONSTRAINT `FK_rooms_hotels_per_quote` FOREIGN KEY (`ROOMS_HOTELS_id`) REFERENCES `_admin_rooms_hotels` (`rooms_hotels_id`);

--
-- Constraints for table `_admin_seasons_per_hotel`
--
ALTER TABLE `_admin_seasons_per_hotel`
  ADD CONSTRAINT `hotel_in_seasons_per_hotel` FOREIGN KEY (`HOTEL_id`) REFERENCES `_admin_hotels` (`hotel_id`),
  ADD CONSTRAINT `season_in_seasons_per_hotel` FOREIGN KEY (`SEASON_id`) REFERENCES `_admin_season` (`season_id`);

--
-- Constraints for table `_admin_travelers_per_flight`
--
ALTER TABLE `_admin_travelers_per_flight`
  ADD CONSTRAINT `FK_travelers_per_flight_flihts` FOREIGN KEY (`FLIGHTS_id`) REFERENCES `_admin_flights` (`flight_id`),
  ADD CONSTRAINT `FK_travelers_travelers_per_flight` FOREIGN KEY (`TRAVELERS_ci_id`) REFERENCES `_admin_travelers` (`traveler_ci_id`);
