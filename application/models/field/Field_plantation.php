<?php
	
	/**
	 * @author     Manoary Sarobidy
	 * @todo       This class will handle the data from the table 'field' from  the database
	 */

	class Field_Plantation extends CI_Model{

		public static $PREFIX = "FLP";
		public static $TABLE = "field_plantation";
		public static $LENGTH = 7;
		public static $SEQUENCE = "s_field_plantation";

		public $id_field_plantation;
        public $id_field;
        public $id_type_plantation;
        public $density;
        public $surface_covered;
        public $plant_weight;
        public $insertion_date;

        public function format_date($date)
		{
			return date("Y-m-d", strtotime($date));
		}


		public function insert_field_plantation( $id_field, $id_plantation, $density, $surface_covered, $plant_weight, $insertion_date ){
			if( $density < 0 ){
				throw new Exception('The density can\'t be a negative value');
			}
			$id = create_primary_key( Field_Plantation::$PREFIX, Field_Plantation::$SEQUENCE, Field_Plantation::$LENGTH );
			$data = array(
				'id_field' => $id,
				'id_type_plantation' => $id_plantation,
                'density' => $density,
                'surface_covered' => $surface_covered,
                'plant_weight' => $plant_weight,
                'insertion_date' => $this->format_date($insertion_date)
			);
			try{
				$this->db->insert(Field_Plantation::$TABLE, $data);
			}catch( Exception $e ){
				throw $e;
			}

		}

	}
?>