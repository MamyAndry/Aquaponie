<?php
	
	class Pond_detail extends CI_Model{

		/**
		 * @static PREFIX : For the table identification prefix
		 * @static LENGTH : Length of a identification id
		 * @static SEQUENCE : The sequence mapped for that table
		 * @static TABLE : The table mapping for that class
		*/

		public static $LENGTH = 7;
		public static $PREFIX = "POND";
		public static $SEQUENCE = "s_pond";
		public static $TABLE = "pond";

		// Inona insray izao
		// Omena attribut izy
		
		public $id_pond_details;
		public $id_pond;
		public $id_type_fish;
		public $max_quantity;

		// Okey inona indray izao

		public function insert_pond( $id_pond, $id_type_fish, $max_quantity, $db ){
			
			if( empty($id_pond) || $id_pond == null ){
				throw new Exception("Can't assign in a non identified pond");
			}
			if( empty($id_type_fish) ){
				throw new Exception("Can't assign a non identified fish : Id is empty");
			}
			if( $max_quantity < 0 ){
				throw new Exception("The max quantity of a faish can't be negative");
			}

			$id = create_primary_key( Pond_Detail::$PREFIX, Pond_Detail::$SEQUENCE, Pond_Detail::$LENGTH );

			$data = array(
				'id_pond_details' 	=> $id,
				'id_pond' 			=> $id_pond,
				'id_type_fish' 		=> $id_type_fish,
				'max_quantity' 		=> $max_quantity
			);

			try{
				$db->insert( Pond_Detail::$TABLE, $data );
			}catch( Exception $e ){
				throw $e;
			}


		}

		public static function get_instance_from_data( $data ){
			$details = new self();
			$details->fill($data);
			return $details;
		}

		public static function get_instance_from_pond( $pond ){
			$detail = new self();
			$details = $detail->get_pond_details_from_pond( $pond );
			return $details;
		}

		public function get_pond_details_from_pond( $pond ){
			$query = "select * from %s where id_pond like '%s%s%s'";
			$query = sprintf( $query, Pond_Detail::$TABLE, '%', $this->db->escape($pond->id_pond), '%' );
			$query = $this->db->query($query);
			$rows = $query->result_array();
			$details = array();
			foreach( $rows as $row ){
				$detail = new Pond_Detail();
				$detail->id_pond_details = $row['id_pond_details'];
				$detail->id_pond = $row['id_pond'];
				$detail->id_type_fish = $row['id_type_fish'];
				$detail->max_quantity = $row['max_quantity'];
				$detail->pond = $pond;
				$details[] = $detail;
			}
			return $details;
		}

		private function fill( $data ){
			if( empty($data['id_pond']) || $data['id_pond'] == null ){
				throw new Exception("Can't assign in a non identified pond");
			}
			if( empty($data['id_type_fish']) ){
				throw new Exception("Can't assign a non identified fish : Id is empty");
			}
			if( $$data['max_quantity'] < 0 ){
				throw new Exception("The max quantity of a faish can't be negative");
			}
			$this->$id_pond = $data["id_pond"];
			$this->$id_type_fish = $data["id_type_fish"];
			$this->$max_quantity = $data["max_quantity"];
		}

	}


?>