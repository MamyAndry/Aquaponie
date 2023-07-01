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
				'id_field' => $id_field,
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

        public static function get_instance( $data ){
            $type = new Field_Plantation();
            $type->id_field_plantation   = $data['id_field_plantation'];
            $type->id_field              = $data['id_field'];
            $type->density               = $data['density'];
            $type->surface_covered       = $data['surface_covered'];
            $type->plant_weight          = $data['plant_weight'];
            $type->insertion_date        = $data['insertion_date'];
            $type->id_type_plantation    = $data['id_type_plantation'];
            $type->name_type_plantation  = $data['name_type_plantation'];
            $type->weight_max_baby       = $data['weight_max_baby'];
            $type->weight_max_semi_mature= $data['weight_max_semi_mature'];
            return $type;
        }

        public function get_field_plantation(){
            $query = $this->db->get('details_fields');
            $results = array();
            $result_array = $query->result_array();
            foreach( $result_array as $row ){
                $type = Field_Plantation::get_instance($row);
                $results[] = $type;
            }
            return $results;
        }

        public function get_details_field_by_id_type_plantation( $id_type ){
            if ( empty( $id_type ) ) throw new Exception("This type of plantation doesn't exist");
            $sql = "select * from %s where id_type_plantation like %s";
            $sql = sprintf( $sql, "details_fields", $this->db->escape('%'.$id_type.'%'));
            $sql = $this->db->query($sql);
            $results = $sql->result_array();
            $plantations = array();
            foreach( $results as $row ){
                $type = Field_Plantation::get_instance( $row );
                $plantations[] = $type;
            }
            return $plantations;
        }
	}
?>