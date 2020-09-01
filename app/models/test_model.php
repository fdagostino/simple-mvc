<?php 

class test_model extends Model {

	function __construct(){
		parent::__construct();
		 $this->table = 'test';
	}

	function get_all($object_pagination = false) {

		$query="SELECT * FROM $this->table ORDER by position ASC";

		if($object_pagination){
			return $object_pagination->paginar($query, $this->table);
		} else {
			return $this->db->get_results($query);
		}
		
	}

	function search($term, $object_pagination = false) {
		
		$term = $this->db->escape($term);
		$query = "SELECT * FROM $this->table WHERE title LIKE '%$term%' ORDER by position ASC";

		if($object_pagination){
			return $object_pagination->paginar($query, $this->table);
		} else {
			return $this->db->get_results($query);
		}

	}
	
}
