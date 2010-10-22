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
	
	function package_rooms($pack_id){		
		$this->db->select(' r.name_spanish, r.name_english, rp.price_per_person     FROM _admin_rooms_per_package rp, _admin_rooms r, _admin_rooms_hotels rh							WHERE rp.PACKAGE_id ='.$pack_id.' AND rp.ROOMS_HOTELS_id = rh.rooms_hotels_id AND rh.ROOMS_id = r.room_id');
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
		$this->db->select('  p . * , h.name AS hotel_name
							FROM _admin_packages p, _admin_categories_package cp, _admin_hotels h
							WHERE p.package_id = cp.PACKAGE_id
							AND cp.CATEGORIE_id ='.$categorie_id.'
							AND p.HOTEL_id = h.hotel_id');
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
		
		foreach($rooms as $room){
			if($room[0] != ''){
				$data_room = array('PACKAGE_id' => $pack_id, 'ROOMS_HOTELS_id' => $room[0], 'price_per_person' => $room[1]);
				$this->db->insert('_admin_rooms_per_package', $data_room);
			}
		}
		
	}
}
?>