<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Yoann
	 * @package fish
	 * Use type_fish from database
	 * 
	 * */

	class Profile extends CI_Model{
		
		public static $PREFIX = "PRO";
		public static $SEQUENCE = "s_profile";
		public static $LENGTH = 7;
		public static $table = 'profile';

		public $id_profile;
		public $name;

		/**
		 *	@author Yoann
		 * 	
		 * just getting All profile
		 * 
		 * args : none
		 * 
		**/
        public function get_all_profile(){
			$query = $this->db->get('profile');
            echo $this->db->last_query($query);
			$results = array();
			$result_array = $query->result_array();
			foreach( $result_array as $row ){
				$profile = new Profile();
				$profile->id_profile = $row["id_profile"];
				$profile->name = $row["name"];
				$results[] = $profile;
			}
			return $results;
		}

	}

?>