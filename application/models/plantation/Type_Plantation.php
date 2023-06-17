<?php
	
	/**
	 * @author     Manoary - Sarobidy
	 * 
	 * @package models
	 * @subpackage plantation
	 * @copyright  Manoary Sarobidy - 2023
	 * @todo       This class will be use for mapping the table 'type_plantation' from the database and for managing every action about the table
	 * 
	 */
	
	class Type_Plantation extends CI_Model{

		/**
		 * @static PREFIX : For the table identification prefix
		 * @static LENGTH : Length of a identification id
		 * @static SEQUENCE : The sequence mapped for that table
		 * @static TABLE : The table mapping for that class
		 */

		public static $LENGTH = 7;
		public static $PREFIX = "TYPL";
		public static $SEQUENCE = "s_type_plantation";
		public static $TABLE = "type_plantation";

		public $id_type_plantation;
		public $name_type_plantation;

		/**
		 * @author     Manoary Sarobidy
		 * @param      <String> name_type_plantation { The name of the type of plantation }
		 * @todo       This function will insert a new type of plantation
		 * @throws     Exception ( if the name_type_plantation is null or empty )
		 */

		public function insert_type_plantation( $name_type_plantation ){
			if( empty($name_type_plantation) || $name_type_plantation == null ){
				throw new Exception("The name of that plantation can't be null or empty");
			}

			$id = create_primary_key( Type_Plantation::$PREFIX , Type_Plantation::$SEQUENCE, Type_Plantation::$LENGTH );
			$data = array(
				'id_type_plantation' => $id,
				'name_type_plantation' => $name_type_plantation
			);

			try{
				$this->db->insert( Type_Plantation::$TABLE, $data );
			}catch( Exception $e ){
				throw $e;
			}
		}

		/**
		 * 
		 * @author     Manoary Sarobidy
		 * @todo       This function will get all type of plantation from database
		 * 
		 */

		public function get_all_type(){
			$query = $this->db->get(Type_Plantation::$TABLE);
			$rows = $query->result_array();
			$results = array();
			foreach( $rows as $row ){
				$type = new Type_Plantation();
				$type->id_type_plantation = $row["id_type_plantation"];
				$type->name_type_plantation = $row["name_type_plantation"];
				$results[] = $type;
			}
			return $results;
		}

	}



?>