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
		public $weight_max_little;
		public $weight_max_average;
		public $size_max_little;
		public $size_max_average;

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

		// public function insert_type_fish( $name_type_fish, $maturity_period, $maturity_size ){
		// 	if( empty($name_type_fish) || $name_type_fish == null ) throw new Exception("The fish type can't be empty or null");
		// 	if( $maturity_period <= 0 ) throw new Exception("The maturity period of the fish can't be a negative value nor 0");
		// 	if( $maturity_size <= 0 ) throw new Exception("The maturity size of that type can't be a negative or a zero value");
 
		// 	$id = create_primary_key(Type_Fish::$PREFIX , Type_Fish::$SEQUENCE, Type_Fish::$LENGTH);
		// 	$data = array(
		// 		'id_type_fish' => $this->db->escape($id),
		// 		'name_type_fish' => $this->db->escape($name_type_fish),
		// 		'maturity_period' => $this->db->escape($maturity_period),
		// 		'maturity_size' => $this->db->escape($maturity_size)
		// 	);
		// 	try{
		// 		$this->db->insert(Type_fish::$table, $data);
		// 		// $this->db->exec( $query );
		// 	}catch( Exception $e ){
		// 		throw $e;
		// 	}
		// }

		public function insert_type_fish( 
			$name_type_fish, $maturity_period, $maturity_size, $weight_max_little, $weight_max_average, $size_max_little, $size_max_average  
		){
			if( empty($name_type_fish) || $name_type_fish == null ) throw new Exception("The fish type can't be empty or null");
			if( $maturity_period <= 0 ) throw new Exception("The maturity period of the fish can't be a negative value nor 0");
			if( $maturity_size <= 0 ) throw new Exception("The maturity size of that type can't be a negative or a zero value");
			if( $weight_max_little <= 0 ) throw new Exception("The weight max little value can't be a negative value nor null value");
			if( $weight_max_average <= 0 ) throw new Exception("The weight max average value can't be a negative value nor null value");
			if( $size_max_little <= 0 ) throw new Exception("The size max little value can't be a negative value nor null value");
			if( $size_max_average <= 0 ) throw new Exception("The size max average value can't be a negative value nor null value");
 
			$id = create_primary_key(Type_Fish::$PREFIX , Type_Fish::$SEQUENCE, Type_Fish::$LENGTH);
			$data = array(
				'id_type_fish'	 		=> $id,
				'name_type_fish' 		=> $name_type_fish,
				'maturity_period'		=> $maturity_period,
				'maturity_size' 		=> $maturity_size,

				'weight_max_little'		=> $weight_max_little,
				'weight_max_average' 	=> $weight_max_average,
				'size_max_little' 		=> $size_max_little,
				'size_max_average' 		=> $size_max_average
			);
			try{
				$this->db->insert(Type_fish::$table, $data);
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
			foreach( $result_array as $row ){
				$type = Type_fish::get_instance($row);
				$results[] = $type;
			}
			return $results;
		}

		public static function get_instance( $data ){
			$type = new Type_fish();
			$type->id_type_fish 	= $data["id_type_fish"];
			$type->name_type_fish 	= $data["name_type_fish"];
			$type->maturity_period = $data["maturity_period"];
			$type->maturity_size 	= $data["maturity_size"];
			return $type;
		}

		public function get_Type_By_Id( $idType ){
			if( empty($idType) ){
				throw new Exception("This type of Fish doesn't exist");
			}
			$sql = "select * from %s where id_type_fish like %s";
			$sql = sprintf( $sql, Type_Fish::$table, $this->db->escape('%'.$idType.'%'));
			$sql = $this->db->query($sql);
			$results = $sql->result_array();
			$fishes = array();
			foreach( $results as $row ){
				$type = Type_fish::get_instance($row);
				$fishes[] = $type;
			}
			return $fishes;
		}

		public function get_Type( $type ){
			if( empty($type) ){
				throw new Exception("This type of Fish doesn't exist");
			}
			$sql = "select * from %s where name_type_fish like %s";
			$sql = sprintf( $sql, Type_Fish::$table, $this->db->escape('%'.$type.'%') );
			$sql = $this->db->query($sql);
			$results = $sql->result_array();
			$fishes = [];
			foreach( $results as $row ){
				$type = Type_fish::get_instance($row);
				$fishes[] = $type;
			}
			return $fishes;
		}

		public function get_Fish( $id_or_name ){
			$byId = $this->get_Type_By_Id( $id_or_name );
			$byName = $this->get_Type( $id_or_name );
			if( count($byId) == 0  && count($byName) == 0){
				throw new Exception("This type of fish doesn't exist in your data. May be you have forgotten to add it");
			}
			return ( count($byId) == 0 && count($byName) > 0 ) ? $byName : $byId;
		}


	}


?>