<?php
class Packages_model extends Model {

   	function Packages_model(){
		parent :: Model();
   	}
	
	function all_packages_hotel($hotel_id){
		$this->db->where('HOTEL_id',$hotel_id);
		$query =  $this->db->get('_admin_packages');
		return $query->result_array();
	}
	
	function all_packages_categorie($categorie_id){
	 $this->db->select('p.* FROM _admin_packages p, _admin_categories_package cp
						WHERE cp.CATEGORIE_id ='.$categorie_id.'
						AND cp.PACKAGE_id = p.package_id');
	 	$query =  $this->db->get();
		return $query->result_array();
	}
	
	function select_lowest_price($pack_id){
		$this->db->select_min('price_per_person');
		$this->db->where('PACKAGE_id' , $pack_id);
		$query = $this->db->get('_admin_rooms_per_package');
		return $query->result_array();
	}
	
	function package_rooms($pack_id){		
	  $this->db->select('r.name_spanish, r.name_english, rp.*, h.name, h.hotel_id 
						 FROM _admin_rooms_per_package rp, _admin_rooms r, _admin_rooms_hotels rh, _admin_hotels h
						 WHERE rp.PACKAGE_id ='.$pack_id.'
						 AND rp.ROOMS_HOTELS_id = rh.rooms_hotels_id
						 AND rh.ROOMS_id = r.room_id
						 AND rh.HOTELS_id = h.hotel_id
						 ORDER BY h.name');
		$query =  $this->db->get();
		return $query->result_array();
	}
	
	function find($pack_id){
		$this->db->where('package_id',$pack_id);
		$query =  $this->db->get('_admin_packages');
		return $query->result_array();
	}
	
	function all_categories(){
		$query =  $this->db->get('_admin_categories');
		return $query->result_array();
	}
	
	function categorie_packages($categorie_id){
		$this->db->select('  p . *
							FROM _admin_packages p, _admin_categories_package cp
							WHERE p.package_id = cp.PACKAGE_id
							AND cp.CATEGORIE_id ='.$categorie_id);
		$query =  $this->db->get();
		return $query->result_array();
	}
	
	function categorie($categorie_id){
		$this->db->where('categorie_id',$categorie_id);
		$query =  $this->db->get('_admin_categories');
		return $query->result_array();
	}
	
	function add_package($package, $rooms, $categories){
		$cat_id = ''; $pack_id = '';

		$this->db->insert('_admin_packages', $package);
		
		$this->db->select_max('package_id');
			$query = $this->db->get('_admin_packages');
			
		foreach ($query->result_array() as $value)
			foreach ($value as $value)
				$pack_id = $value;
		
		
		foreach($categories as $cat){
			if($cat != ''){
				$cat_id = $cat;
				if(!(is_numeric($cat))) {
					$data_cat = array('categorie_id' => '', 'name_spanish' => $cat);
					$this->db->insert('_admin_categories', $data_cat);
				
					$this->db->select_max('categorie_id');
					$query = $this->db->get('_admin_categories');
					
					foreach ($query->result_array() as $value)
						foreach ($value as $value)
							$cat_id = $value;
				}
				$data_pack = array('CATEGORIE_id' => $cat_id, 'PACKAGE_id' => $pack_id);
				$this->db->insert('_admin_categories_package', $data_pack);
			}
		}
		
		for($i=1; $i<count($rooms);$i++){
			for($j=1; $j<count($rooms[$i]);$j++){
				$data_room = array('room_per_package_id' => '', 'PACKAGE_id' => $pack_id, 'ROOMS_HOTELS_id' => $rooms[$i]['room'.$j][0], 'price_per_person' => $rooms[$i]['room'.$j][1], 'additional_night' => $rooms[$i]['room'.$j][3], 'price_per_kid' => $rooms[$i]['room'.$j][2]);
				$this->db->insert('_admin_rooms_per_package', $data_room);
			}
		}
	}
	
	function package_hotel_rooms($package, $hotel){
		 $this->db->select('rp . *, r.name_spanish 
						   FROM _admin_rooms_per_package rp, _admin_rooms_hotels rh, _admin_rooms r
							WHERE rp.PACKAGE_id ='.$package.'
							AND rp.ROOMS_HOTELS_id = rh.rooms_hotels_id
							AND rh.ROOMS_id = r.room_id
							AND rh.HOTELS_id ='.$hotel);
		 $query =  $this->db->get();
		 return $query->result_array();
	}
	
	function find_room_package_name($room_package_id){
		 $this->db->select('r.name_spanish FROM _admin_rooms_per_package rp, _admin_rooms_hotels rh, _admin_rooms r
							WHERE rp.room_per_package_id ='.$room_package_id.' AND rp.ROOMS_HOTELS_id = rh.rooms_hotels_id AND rh.ROOMS_id = r.room_id');
		 $query =  $this->db->get();
		 return $query->result_array();
	}
}
?>