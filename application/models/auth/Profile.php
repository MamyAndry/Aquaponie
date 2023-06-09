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

        /**
         * 
         * @author Yoann
         * 
         * Simple function to get the profile object from an id
         * 
         * Args : id of the profile
         * 
         */
        public function get_profile($id){
            $sql = "select * from profile where id_profile LIKE %s";
            $sql = sprintf( $sql, $this->db->escape('%'.$id.'%'));
            $query = $this->db->query($sql);
            $row = $query->row();
            if($row != NULL){
                $profile = new Profile();
                $profile->id_profile = $row["id_profile"];
				$profile->name = $row["name"];
				return $profile;
            }else return NULL;
        }

	}

?>