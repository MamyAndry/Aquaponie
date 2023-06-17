<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Sarobidy - Manoary
	 * @package fish
	 * Use type_fish from database
	 * 
	 * */

	class Type_fish extends CI_Model{
		
		public static $PREFIX = "TYF";
		public static $SEQUENCE = "s_type_fish";
		public static $LENGTH = 7;
		public static $table = 'type_fish';

		public $id_type_fish;
		public $name_type_fish;
		public $maturity_period;
		public $maturity_size;

		/**
		 *	@author Sarobidy - Manoary
		 * 	
		 *  Insert Type Fish :
		 * 		@args : 
		 * 			- name_type_fish : the type of the fish
		 * 			- maturity_period : When this type of fish will be mature
		 * 			- maturity_size : The size of this type of fish when the maturity period is reached
		 * 	Use:
		 * 		Insert a type of fish in the database with an Id beginning with "TYF"
		 * */

		public function insert_type_fish( $name_type_fish, $maturity_period, $maturity_size ){
			if( empty($name_type_fish) || $name_type_fish == null ) throw new Exception("The fish type can't be empty or null");
			if( $maturity_period <= 0 ) throw new Exception("The maturity period of the fish can't be a negative value nor 0");
			if( $maturity_size <= 0 ) throw new Exception("The maturity size of that type can't be a negative or a zero value");
 
			$id = create_primary_key(Type_Fish::$PREFIX , Type_Fish::$SEQUENCE, Type_Fish::$LENGTH);
			$data = array(
				'id_type_fish' => $this->db->escape($id),
				'name_type_fish' => $this->db->escape($name_type_fish),
				'maturity_period' => $this->db->escape($maturity_period),
				'maturity_size' => $this->db->escape($maturity_size)
			);
			// $query = "insert into type_fish ( id_type_fish, name_type_fish, maturity_period, maturity_size ) \ 
			// values ( %s , %s , %d, %d )";

			// $query = sprintf( $query , $this->db->escape( $id ), 
			// 							$this->db->escape( $name_type_fish ), 
			// 							$maturity_period, $maturity_size );
			try{
				$this->db->insert(Type_fish::$table, $data);
				// $this->db->exec( $query );
			}catch( Exception $e ){
				throw $e;
			}
		}

		/**
		 * 
		 * @author     Sarobidy - Manoary
		 * 
		 * Get All Type
		 * 
		 * args : none
		 * 
		 * use : Get all kind of fish from database
		 * 
		 * 
		 */

		public function get_all_type(){
			$query = $this->db->get('type_fish');
			$results = array();
			$result_array = $query->result_array();
			for( $result_array as $row ){
				$type = new Type_fish();
				$type->$id_type_fish 	= $row["id_type_fish"];
				$type->$name_type_fish 	= $row["name_type_fish"];
				$type->$maturity_period = $row["maturity_period"];
				$type->$maturity_size 	= $row["maturity_size"];
				$results[] = $type;
			}
			return $results;
		}

	}


.?>