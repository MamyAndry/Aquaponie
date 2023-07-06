<?php
	
	/**
	 * @author     Manoary Sarobidy
	 * @todo       This class will handle the data from the table 'field' from  the database
	 */

	class Fields extends CI_Model{

		public static $PREFIX = "FLD";
		public static $TABLE = "field";
		public static $LENGTH = 7;
		public static $SEQUENCE = "s_field";

		public $id_field;

		/**
		 * @author     Manoary Sarobidy
		 * @param      double max_surface { the max area of the field }
		 * @throws     Exception (if the max_surface < 0)
		 * @todo       Insert a new field with the given surface in the data
		 * 
		 */

		public function insert_field( ){
			$id = create_primary_key( Fields::$PREFIX, Fields::$SEQUENCE, Fields::$LENGTH );
			$data = array(
				'id_field' => $id
			);
			try{
				$this->db->insert(Fields::$TABLE, $data);
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
			$query = $this->db->get(Fields::$TABLE);
			$rows = $query->result_array();
			$fields = [];
			foreach ($rows as $row) {
				$field = new Fields();
				$field->id_field = $row['id_field'];
				$fields[] = $field;
			}
			return $fields;
		}

        public function get_field( $id_field ){
            $sql = "select * from %s where id_field like %s";
            $sql = sprintf( $sql, Fields::$TABLE, $this->db->escape('%'.$id_field.'%') );
            $sql = $this->db->query($sql);
            $sql_results = $sql->result_array();
            $fields = array();
            foreach( $sql_results as $row ){
                $field = new Fields();
                $field->id_field = $id_field;
                $field->load_field_details();
                $fields[] = $field;
            }
            return $fields;
        }

        public static function __get_instance( $data ){
            $field = new Fields();
            $field->id_field = $data['id_field'];
            $field->load_pond_details();
            return $field;
        }

        public function load_field_details(){
            $details = Field_Plantation::get_instance_from_field( $this );
            $this->details = $details;

        }

	}


?>