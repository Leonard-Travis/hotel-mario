-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2010 at 04:16 PM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `_admin_airlines`
--

INSERT INTO `_admin_airlines` (`airline_id`, `name`, `code`) VALUES
(1, 'American Airline', 'AA'),
(2, 'Rutaca', 'Rt');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18277058 ;

--
-- Dumping data for table `_admin_customers`
--

INSERT INTO `_admin_customers` (`customer_ci_id`, `name`, `lastname`, `phone`, `email`, `address`, `sex`, `birth_date`) VALUES
(13, 'Anita', 'Munera', 412, 'ana@hotmail.com', 'maracay', 'f', '2010-02-27'),
(99, 'jose', 'marques', 999999, 'lololo', 'la guaira', 'f', '2010-02-18'),
(8989, 'lolo', 'mianda', 90909, 'plopopo', 'ссссс', 'm', '2010-02-18'),
(18277057, 'marco', 'marcon', 999999, 'oooooo', 'kokoko', 'f', '2010-02-18'),
(18277056, 'Mario', 'Munera', 111, '1111', '1111', 'm', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_employees`
--

DROP TABLE IF EXISTS `_admin_employees`;
CREATE TABLE IF NOT EXISTS `_admin_employees` (
  `employees_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`employees_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `AIRLINES_airline_id` int(10) unsigned NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `class` enum('first class','turist','economic') NOT NULL,
  `price` float NOT NULL,
  `origin` varchar(45) NOT NULL,
  `distination` varchar(45) NOT NULL,
  `time` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`flight_id`),
  KEY `FLIGHTS_FKIndex1` (`AIRLINES_airline_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `FLIGHTS_COUNTRY_flight_country_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`flight_city_id`),
  KEY `FLIGHTS_CITY_FKIndex1` (`FLIGHTS_COUNTRY_flight_country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_flights_country`
--


-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_per_quote`
--

DROP TABLE IF EXISTS `_admin_flights_per_quote`;
CREATE TABLE IF NOT EXISTS `_admin_flights_per_quote` (
  `QUOTATIONS_FLIGHTS_quote_flight_id` int(10) unsigned NOT NULL,
  `FLIGHTS_flight_id` int(10) unsigned NOT NULL,
  `number_of_people` int(10) unsigned NOT NULL,
  PRIMARY KEY (`QUOTATIONS_FLIGHTS_quote_flight_id`,`FLIGHTS_flight_id`),
  KEY `QUOTATIONS_FLIGHTS_has_FLIGHTS_FKIndex1` (`QUOTATIONS_FLIGHTS_quote_flight_id`),
  KEY `QUOTATIONS_FLIGHTS_has_FLIGHTS_FKIndex2` (`FLIGHTS_flight_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `_admin_hotels`
--

INSERT INTO `_admin_hotels` (`hotel_id`, `percent_commission`, `collect_type`, `name`, `location`) VALUES
(1, '10', NULL, 'Hilton', 'Margarita'),
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
  `HOTELS_hotel_id` int(10) unsigned NOT NULL,
  `PLANS_plan_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`HOTELS_hotel_id`,`PLANS_plan_id`),
  KEY `HOTELS_has_PLANS_FKIndex1` (`HOTELS_hotel_id`),
  KEY `HOTELS_has_PLANS_FKIndex2` (`PLANS_plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_hotels_plans`
--

INSERT INTO `_admin_hotels_plans` (`HOTELS_hotel_id`, `PLANS_plan_id`) VALUES
(1, 4),
(1, 6),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_hotels_season`
--

DROP TABLE IF EXISTS `_admin_hotels_season`;
CREATE TABLE IF NOT EXISTS `_admin_hotels_season` (
  `HOTELS_hotel_id` int(11) NOT NULL,
  `SEASON_season_id` int(11) NOT NULL,
  PRIMARY KEY (`HOTELS_hotel_id`,`SEASON_season_id`),
  KEY `fk_HOTELS_has_SEASON_HOTELS` (`HOTELS_hotel_id`),
  KEY `fk_HOTELS_has_SEASON_SEASON` (`SEASON_season_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_hotels_season`
--


-- --------------------------------------------------------

--
-- Table structure for table `_admin_plans`
--

DROP TABLE IF EXISTS `_admin_plans`;
CREATE TABLE IF NOT EXISTS `_admin_plans` (
  `plan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `_admin_plans`
--

INSERT INTO `_admin_plans` (`plan_id`, `name`, `description`) VALUES
(1, 'Weekends', 'fines de semana economicos'),
(2, 'Only room', 'Only room'),
(9, 'Room with dinner', 'Room with dinner'),
(4, 'All included', 'All included'),
(5, 'Full day', 'Full day'),
(6, 'Room dinner and breakfast', 'Room dinner and breakfast'),
(7, 'Full pension', 'Full pension');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_price`
--

DROP TABLE IF EXISTS `_admin_price`;
CREATE TABLE IF NOT EXISTS `_admin_price` (
  `price_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SEASON_season_id` int(10) unsigned NOT NULL,
  `ROOMS_HOTELS_rooms_hotels_id` int(10) unsigned NOT NULL,
  `price_per_night` float NOT NULL,
  PRIMARY KEY (`price_id`),
  KEY `PRICE_FKIndex1` (`ROOMS_HOTELS_rooms_hotels_id`),
  KEY `PRICE_FKIndex2` (`SEASON_season_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `_admin_price`
--

INSERT INTO `_admin_price` (`price_id`, `SEASON_season_id`, `ROOMS_HOTELS_rooms_hotels_id`, `price_per_night`) VALUES
(1, 1, 20, 150),
(2, 2, 19, 100),
(3, 2, 7, 120),
(4, 2, 4, 120),
(5, 3, 4, 100),
(6, 4, 4, 100);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations`
--

DROP TABLE IF EXISTS `_admin_quotations`;
CREATE TABLE IF NOT EXISTS `_admin_quotations` (
  `quote_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CUSTOMERS_customer_ci_id` int(10) unsigned NOT NULL,
  `EMPLOYEES_employees_id` int(10) unsigned NOT NULL,
  `QUOTATIONS_HOTELS_quote_hotel_id` int(10) unsigned DEFAULT NULL,
  `QUOTATIONS_FLIGHTS_quote_flight_id` int(10) unsigned DEFAULT NULL,
  `QUOTATIONS_GENERIC_quotes_generic_id` int(10) unsigned DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  PRIMARY KEY (`quote_id`),
  KEY `QUOTATIONS_FKIndex1` (`EMPLOYEES_employees_id`),
  KEY `QUOTATIONS_FKIndex2` (`QUOTATIONS_GENERIC_quotes_generic_id`),
  KEY `QUOTATIONS_FKIndex3` (`QUOTATIONS_FLIGHTS_quote_flight_id`),
  KEY `QUOTATIONS_FKIndex4` (`CUSTOMERS_customer_ci_id`),
  KEY `QUOTATIONS_FKIndex5` (`QUOTATIONS_HOTELS_quote_hotel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `total` int(10) unsigned NOT NULL,
  `reservation_status` varchar(45) NOT NULL,
  `collect_status` varchar(45) NOT NULL,
  `payment_status` varchar(45) NOT NULL,
  `billing_status` varchar(45) NOT NULL,
  PRIMARY KEY (`quote_hotel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_quotations_hotels`
--


-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms`
--

DROP TABLE IF EXISTS `_admin_rooms`;
CREATE TABLE IF NOT EXISTS `_admin_rooms` (
  `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `capacity` int(10) unsigned NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `_admin_rooms`
--

INSERT INTO `_admin_rooms` (`room_id`, `name`, `special`, `capacity`, `description`) VALUES
(1, 'Individual', 0, 1, 'cama sola'),
(4, 'Doble', 0, 2, 'Dos camas'),
(5, 'Senior', 1, 0, 'senior'),
(6, 'Suite', 0, 4, 'es una suite'),
(9, 'Matrimonial', 0, 2, 'Cama Matrimonial'),
(7, 'escolar', 1, 0, 'solo para colegiales'),
(11, 'Triple', 0, 3, '3 Camas Individuales');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_hotels`
--

DROP TABLE IF EXISTS `_admin_rooms_hotels`;
CREATE TABLE IF NOT EXISTS `_admin_rooms_hotels` (
  `rooms_hotels_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ROOMS_room_id` int(10) unsigned NOT NULL,
  `HOTELS_hotel_id` int(10) unsigned NOT NULL,
  `commissionable` tinyint(1) NOT NULL,
  PRIMARY KEY (`rooms_hotels_id`),
  KEY `ROOMS_HOTELS_FKIndex3` (`HOTELS_hotel_id`),
  KEY `ROOMS_HOTELS_FKIndex4` (`ROOMS_room_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `_admin_rooms_hotels`
--

INSERT INTO `_admin_rooms_hotels` (`rooms_hotels_id`, `ROOMS_room_id`, `HOTELS_hotel_id`, `commissionable`) VALUES
(20, 9, 1, 1),
(19, 1, 1, 1),
(22, 7, 1, 1),
(7, 4, 2, 1),
(8, 4, 6, 1),
(2, 1, 1, 1),
(11, 6, 5, 1),
(12, 6, 2, 1),
(13, 5, 7, 1),
(14, 5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_per_quote`
--

DROP TABLE IF EXISTS `_admin_rooms_per_quote`;
CREATE TABLE IF NOT EXISTS `_admin_rooms_per_quote` (
  `ROOMS_HOTELS_id_rooms_hotels` int(10) unsigned NOT NULL,
  `QUOTATIONS_HOTELS_quote_hotel_id` int(10) unsigned NOT NULL,
  `quantity_of_rooms` int(10) unsigned NOT NULL,
  `number_of_guests` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ROOMS_HOTELS_id_rooms_hotels`,`QUOTATIONS_HOTELS_quote_hotel_id`),
  KEY `ROOMS_HOTELS_has_QUOTATIONS_HOTELS_FKIndex1` (`ROOMS_HOTELS_id_rooms_hotels`),
  KEY `ROOMS_HOTELS_has_QUOTATIONS_HOTELS_FKIndex2` (`QUOTATIONS_HOTELS_quote_hotel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_rooms_per_quote`
--

INSERT INTO `_admin_rooms_per_quote` (`ROOMS_HOTELS_id_rooms_hotels`, `QUOTATIONS_HOTELS_quote_hotel_id`, `quantity_of_rooms`, `number_of_guests`) VALUES
(2, 1, 2, 4),
(19, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_season`
--

DROP TABLE IF EXISTS `_admin_season`;
CREATE TABLE IF NOT EXISTS `_admin_season` (
  `season_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `has_weekdays` tinyint(1) NOT NULL,
  PRIMARY KEY (`season_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `_admin_season`
--

INSERT INTO `_admin_season` (`season_id`, `date_start`, `date_end`, `has_weekdays`) VALUES
(1, '2010-01-01', '2010-01-31', 0),
(2, '2010-02-01', '2010-03-15', 1),
(3, '2010-03-16', '2010-04-01', 0),
(4, '2010-04-05', '2010-04-30', 1),
(5, '2010-05-01', '2010-06-01', 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `_admin_travelers`
--


-- --------------------------------------------------------

--
-- Table structure for table `_admin_travelers_per_flight`
--

DROP TABLE IF EXISTS `_admin_travelers_per_flight`;
CREATE TABLE IF NOT EXISTS `_admin_travelers_per_flight` (
  `TRAVELERS_traveler_ci_id` int(10) unsigned NOT NULL,
  `FLIGHTS_flight_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`TRAVELERS_traveler_ci_id`,`FLIGHTS_flight_id`),
  KEY `TRAVELERS_has_FLIGHTS_FKIndex1` (`TRAVELERS_traveler_ci_id`),
  KEY `TRAVELERS_has_FLIGHTS_FKIndex2` (`FLIGHTS_flight_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_travelers_per_flight`
--


-- --------------------------------------------------------

--
-- Table structure for table `_admin_weekdays`
--

DROP TABLE IF EXISTS `_admin_weekdays`;
CREATE TABLE IF NOT EXISTS `_admin_weekdays` (
  `weekdays_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SEASON_season_id` int(10) unsigned NOT NULL,
  `monday_price` int(10) unsigned DEFAULT NULL,
  `tuesday_price` int(10) unsigned DEFAULT NULL,
  `wednesday_price` int(10) unsigned DEFAULT NULL,
  `thursday_price` int(10) unsigned DEFAULT NULL,
  `friday_price` int(10) unsigned DEFAULT NULL,
  `saturday_price` int(10) unsigned DEFAULT NULL,
  `sunday_price` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`weekdays_id`),
  KEY `WEEKDAYS_FKIndex1` (`SEASON_season_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `_admin_weekdays`
--

INSERT INTO `_admin_weekdays` (`weekdays_id`, `SEASON_season_id`, `monday_price`, `tuesday_price`, `wednesday_price`, `thursday_price`, `friday_price`, `saturday_price`, `sunday_price`) VALUES
(1, 2, 100, 100, 100, 100, 100, 150, 150),
(2, 4, 100, 100, 100, 100, 200, 200, 250),
(3, 5, 100, 100, 100, 100, 100, 200, 300);
