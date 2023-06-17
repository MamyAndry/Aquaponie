<?php
	
	/**
	 * @author     Manoary Sarobidy
	 * @todo       This class will handle the data from the table 'field' from  the database
	 */

	class Field extends CI_Model{

		public static $PREFIX = "FLD";
		public static $TABLE = "field";
		public static $LENGTH = 7;
		public static $SEQUENCE = "s_field";

		public $id_field;
		public $max_surface;

		/**
		 * @author     Manoary Sarobidy
		 * @param      double max_surface { the max area of the field }
		 * @throws     Exception (if the max_surface < 0)
		 * @todo       Insert a new field with the given surface in the data
		 * 
		 */

		public function insert_field( $max_surface ){
			if( $max_surface < 0 ){
				throw new Exception('The max surface of the field can\'t be a negative value');
			}
			$id = create_primary_key( Field::$PREFIX, Field::$SEQUENCE, FIELD::$LENGTH );
			$data = array(
				'id_field' => $id,
				'max_surface' => $max_surface
			);
			try{
				$this->db->insert(Field::$TABLE, $data);
			}catch( Exception $e ){
				throw $e;
			}

		}

		/**
		 * @author     Manoary Sarobidy
		 * @todo       fetch all field 
		 * 
		 */

		public function get_all_field(){
			$query = $this->db->get(Field::$TABLE);
			$rows = $query->result_array();
			$fields = [];
			foreach ($rows as $row) {
				$field = new Field();
				$field->id_field = $row['id_field'];
				$field->max_surface = $row['max_surface'];
				$fields[] = $field;
			}
			return $fields;
		}

	}


?>