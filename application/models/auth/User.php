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
		 * just getting All profile
		 * 
		 * args : none
		 * 
		**/
		


        

	}

?>