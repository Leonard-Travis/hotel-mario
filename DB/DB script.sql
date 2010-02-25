-- Base de datos: `hoteles.com.ve`
--
CREATE DATABASE `hoteles.com.ve` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hoteles.com.ve`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_airlines`
--

DROP TABLE IF EXISTS `_admin_airlines`;
CREATE TABLE IF NOT EXISTS `_admin_airlines` (
  `airline_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL,
  PRIMARY KEY (`airline_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_airlines`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_customers`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_customers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_employees`
--

DROP TABLE IF EXISTS `_admin_employees`;
CREATE TABLE IF NOT EXISTS `_admin_employees` (
  `employees_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`employees_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_employees`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_flights`
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
-- Volcar la base de datos para la tabla `_admin_flights`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_flights_city`
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
-- Volcar la base de datos para la tabla `_admin_flights_city`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_flights_country`
--

DROP TABLE IF EXISTS `_admin_flights_country`;
CREATE TABLE IF NOT EXISTS `_admin_flights_country` (
  `flight_country_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`flight_country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_flights_country`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_flights_per_quote`
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
-- Volcar la base de datos para la tabla `_admin_flights_per_quote`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_hotels`
--

DROP TABLE IF EXISTS `_admin_hotels`;
CREATE TABLE IF NOT EXISTS `_admin_hotels` (
  `hotel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `percent_commission` varchar(45) NOT NULL,
  `collect_type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_hotels`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_hotels_has_plans`
--

DROP TABLE IF EXISTS `_admin_hotels_has_plans`;
CREATE TABLE IF NOT EXISTS `_admin_hotels_has_plans` (
  `HOTELS_hotel_id` int(10) unsigned NOT NULL,
  `PLANS_plan_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`HOTELS_hotel_id`,`PLANS_plan_id`),
  KEY `HOTELS_has_PLANS_FKIndex1` (`HOTELS_hotel_id`),
  KEY `HOTELS_has_PLANS_FKIndex2` (`PLANS_plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `_admin_hotels_has_plans`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_plans`
--

DROP TABLE IF EXISTS `_admin_plans`;
CREATE TABLE IF NOT EXISTS `_admin_plans` (
  `plan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_plans`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_price`
--

DROP TABLE IF EXISTS `_admin_price`;
CREATE TABLE IF NOT EXISTS `_admin_price` (
  `price_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SEASON_season_id` int(10) unsigned NOT NULL,
  `ROOMS_HOTELS_id_rooms_hotels_plans` int(10) unsigned NOT NULL,
  `price_per_night` float NOT NULL,
  PRIMARY KEY (`price_id`),
  KEY `PRICE_FKIndex1` (`ROOMS_HOTELS_id_rooms_hotels_plans`),
  KEY `PRICE_FKIndex2` (`SEASON_season_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_price`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_quotations`
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
-- Volcar la base de datos para la tabla `_admin_quotations`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_quotations_flights`
--

DROP TABLE IF EXISTS `_admin_quotations_flights`;
CREATE TABLE IF NOT EXISTS `_admin_quotations_flights` (
  `quote_flight_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`quote_flight_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_quotations_flights`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_quotations_generic`
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
-- Volcar la base de datos para la tabla `_admin_quotations_generic`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_quotations_hotels`
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
-- Volcar la base de datos para la tabla `_admin_quotations_hotels`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_rooms`
--

DROP TABLE IF EXISTS `_admin_rooms`;
CREATE TABLE IF NOT EXISTS `_admin_rooms` (
  `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `capacity` int(10) unsigned NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_rooms`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_rooms_hotels`
--

DROP TABLE IF EXISTS `_admin_rooms_hotels`;
CREATE TABLE IF NOT EXISTS `_admin_rooms_hotels` (
  `id_rooms_hotels_plans` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ROOMS_room_id` int(10) unsigned NOT NULL,
  `HOTELS_hotel_id` int(10) unsigned NOT NULL,
  `commissionable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_rooms_hotels_plans`),
  KEY `ROOMS_HOTELS_FKIndex3` (`HOTELS_hotel_id`),
  KEY `ROOMS_HOTELS_FKIndex4` (`ROOMS_room_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_rooms_hotels`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_rooms_per_quote`
--

DROP TABLE IF EXISTS `_admin_rooms_per_quote`;
CREATE TABLE IF NOT EXISTS `_admin_rooms_per_quote` (
  `ROOMS_HOTELS_id_rooms_hotels_plans` int(10) unsigned NOT NULL,
  `QUOTATIONS_HOTELS_quote_hotel_id` int(10) unsigned NOT NULL,
  `quantity_of_rooms` int(10) unsigned NOT NULL,
  `number_of_guests` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ROOMS_HOTELS_id_rooms_hotels_plans`,`QUOTATIONS_HOTELS_quote_hotel_id`),
  KEY `ROOMS_HOTELS_has_QUOTATIONS_HOTELS_FKIndex1` (`ROOMS_HOTELS_id_rooms_hotels_plans`),
  KEY `ROOMS_HOTELS_has_QUOTATIONS_HOTELS_FKIndex2` (`QUOTATIONS_HOTELS_quote_hotel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `_admin_rooms_per_quote`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_season`
--

DROP TABLE IF EXISTS `_admin_season`;
CREATE TABLE IF NOT EXISTS `_admin_season` (
  `season_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `HOTELS_hotel_id` int(10) unsigned NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `has_weekdays` tinyint(1) NOT NULL,
  PRIMARY KEY (`season_id`),
  KEY `SEASON_FKIndex1` (`HOTELS_hotel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_season`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_travelers`
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
-- Volcar la base de datos para la tabla `_admin_travelers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_travelers_per_flight`
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
-- Volcar la base de datos para la tabla `_admin_travelers_per_flight`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_admin_weekdays`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `_admin_weekdays`
--


