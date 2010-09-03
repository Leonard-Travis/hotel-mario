-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2010 at 02:25 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_airlines`
--


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
  `employees_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`employees_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_employees`
--


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
  `price` float NOT NULL,
  `origin` int(10) unsigned NOT NULL,
  `destination` int(10) unsigned NOT NULL,
  `time` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`flight_id`),
  KEY `fk__ADMIN_FLIGHTS_has_ADMIN_AIRLINES` (`AIRLINES_id`),
  KEY `origin_flight_city` (`origin`),
  KEY `destination_flight_city` (`destination`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_flights`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_flights_city`
--


-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_country`
--

DROP TABLE IF EXISTS `_admin_flights_country`;
CREATE TABLE IF NOT EXISTS `_admin_flights_country` (
  `flight_country_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`flight_country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_flights_country`
--


-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_per_quote`
--

DROP TABLE IF EXISTS `_admin_flights_per_quote`;
CREATE TABLE IF NOT EXISTS `_admin_flights_per_quote` (
  `QUOTATIONS_FLIGHTS_id` int(10) unsigned NOT NULL,
  `FLIGHTS_id` int(10) unsigned NOT NULL,
  `number_of_people` int(10) unsigned NOT NULL,
  PRIMARY KEY (`QUOTATIONS_FLIGHTS_id`,`FLIGHTS_id`),
  KEY `fk_QUOTATIONS_FLIGHTS_has_FLIGHTS_QUOTATIONS_FLIGHTS` (`QUOTATIONS_FLIGHTS_id`),
  KEY `fk__ADMIN_QUOTATIONS_FLIGHTS_has_ADMIN_FLIGHTS_ADMIN_FLIGHTS` (`FLIGHTS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_flights_per_quote`
--


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
  PRIMARY KEY (`quote_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_EMPLOYEES` (`EMPLOYEES_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_GENERIC` (`QUOTATIONS_GENERIC_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_FLIGHTS` (`QUOTATIONS_FLIGHTS_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_CUSTOMERS` (`CUSTOMERS_ci_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_HOTELS` (`QUOTATIONS_HOTELS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_quotations`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_quotations_flights`
--


-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_generic`
--

DROP TABLE IF EXISTS `_admin_quotations_generic`;
CREATE TABLE IF NOT EXISTS `_admin_quotations_generic` (
  `quotes_generic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `total_price` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `unit_price` float NOT NULL,
  PRIMARY KEY (`quotes_generic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_quotations_generic`
--


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
  `reservation_status` varchar(45) NOT NULL,
  `collect_status` varchar(45) NOT NULL,
  `payment_status` varchar(45) NOT NULL,
  `billing_status` varchar(45) NOT NULL,
  PRIMARY KEY (`quote_hotel_id`),
  KEY `FK_qq_hh` (`PLAN_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `_admin_quotations_hotels`
--

INSERT INTO `_admin_quotations_hotels` (`quote_hotel_id`, `date_check_in`, `date_check_out`, `PLAN_id`, `total`, `reservation_status`, `collect_status`, `payment_status`, `billing_status`) VALUES
(2, '2010-04-23', '2010-04-22', 1, 11, 'AF', 'af', 'F', 'f'),
(3, '2010-01-01', '2010-02-01', 1, 6000, 'x', 'x', 'x', 'x');

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
(9, 'Matrimonial', 'Wedding room ', 0, 'inactive'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `_admin_rooms_hotels`
--

INSERT INTO `_admin_rooms_hotels` (`rooms_hotels_id`, `ROOMS_id`, `HOTELS_id`, `commissionable`, `description`, `capacity`, `status`) VALUES
(29, 1, 1, 1, 'Cama individual', 1, 'active'),
(33, 9, 2, 1, 'Habitacion con cama matrimonial y sala de estar', 2, 'inactive'),
(40, 4, 1, 1, 'Dos camas con A/A', 2, 'active'),
(41, 9, 1, 1, 'Cama Matrimonial', 2, 'inactive'),
(42, 6, 1, 1, 'habitacion amplia', 4, 'inactive');

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
(29, 3, 2, 6000, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />');

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
  `traveler_ci_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `passport` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `type` enum('senior','kid','adult') DEFAULT NULL,
  PRIMARY KEY (`traveler_ci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_travelers`
--


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
  ADD CONSTRAINT `FK_flights_flight_per_quote` FOREIGN KEY (`FLIGHTS_id`) REFERENCES `_admin_flights` (`flight_id`),
  ADD CONSTRAINT `FK_quotations_flight_per_quote` FOREIGN KEY (`QUOTATIONS_FLIGHTS_id`) REFERENCES `_admin_flights_per_quote` (`QUOTATIONS_FLIGHTS_id`);

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
-- Constraints for table `_admin_rooms_per_quote`
--
ALTER TABLE `_admin_rooms_per_quote`
  ADD CONSTRAINT `FK_quotations_hotels_per_quote` FOREIGN KEY (`QUOTATIONS_HOTELS_id`) REFERENCES `_admin_quotations_hotels` (`quote_hotel_id`),
  ADD CONSTRAINT `FK_rooms_hotels_per_quote` FOREIGN KEY (`ROOMS_HOTELS_id`) REFERENCES `_admin_rooms_hotels` (`rooms_hotels_id`);

--
-- Constraints for table `_admin_seasons_per_hotel`
--
ALTER TABLE `_admin_seasons_per_hotel`
  ADD CONSTRAINT `season_in_seasons_per_hotel` FOREIGN KEY (`SEASON_id`) REFERENCES `_admin_season` (`season_id`),
  ADD CONSTRAINT `hotel_in_seasons_per_hotel` FOREIGN KEY (`HOTEL_id`) REFERENCES `_admin_hotels` (`hotel_id`);

--
-- Constraints for table `_admin_travelers_per_flight`
--
ALTER TABLE `_admin_travelers_per_flight`
  ADD CONSTRAINT `FK_travelers_per_flight_flihts` FOREIGN KEY (`FLIGHTS_id`) REFERENCES `_admin_flights` (`flight_id`),
  ADD CONSTRAINT `FK_travelers_travelers_per_flight` FOREIGN KEY (`TRAVELERS_ci_id`) REFERENCES `_admin_travelers` (`traveler_ci_id`);
