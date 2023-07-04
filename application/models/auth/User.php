<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Yoann
	 * @package fish
	 * Use type_fish from database
	 * 
	 * */

	class User extends CI_Model{
		
		public static $PREFIX = "AUR";
		public static $SEQUENCE = "s_aqua_user";
		public static $LENGTH = 7;
		public static $table = 'aqua_user';

		public $id_user;
		public $id_profile;
		public $name;
		public $identifier;
		public $password;

		/**
		 *	@author Yoann
		 * 	
		 * simple log in function
		 * 
		 * args : identifier and password
		 * 
		**/
		public function check_sign_in($ident, $passwd){
			$sql = "select * from aqua_user where identifier LIKE %s and password LIKE %s";
            $sql = sprintf( $sql, $this->db->escape('%'.$ident.'%'), $this->db->escape('%'.$passwd.'%'));
            $query = $this->db->query($sql);
			if($query->num_rows() > 0){
				$user = new User();
				$sign = $query->row();
				$user->id_user = $sign['id_user'];
				$user->id_profile = $sign['id_profile'];
				$user->name = $sign['name'];
				$user->identifier = $sign['identifier'];
				$user->password = $sign['password'];
				return $user;
			}
			else return false;
		}

		/**
		 * @author Yoann
		 * 
		 * Simple function to see if the following class user is connected
		 * precisely if it is in the http-session
		 * 
		 * args : none
		 * 
		 */
		public function is_connected(){
			if(isset($_SESSION['user'])){
				$user = $_SESSION['user'];
				if(	$user->id_user == $this->id_user && 
					$user->id_profile == $this->id_profile){
					return true;
				}
			} return false;
		}
        

	}

?>