<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2010-12-19 22:53:25 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`hoteles.com.ve`.`_admin_rooms_hotels`, CONSTRAINT `FK_hotel_room` FOREIGN KEY (`HOTELS_id`) REFERENCES `_admin_hotels` (`hotel_id`))
ERROR - 2010-12-19 23:11:27 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`hoteles.com.ve`.`_admin_hotels_plans`, CONSTRAINT `FK_hotel_hotel` FOREIGN KEY (`HOTELS_id`) REFERENCES `_admin_hotels` (`hotel_id`))
