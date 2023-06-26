<?php
	
	class Pond extends CI_Model{
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

		public $id_pond;
		public $capacity;

		/**
		 * @author     Manoary Sarobidy
		 * @param      Array ids_type_fish { the ids of the fish to be in the details of the pond }
		 * @param      Array max_quantitys { the maximum size of all each quantty fish }
		 * @throws     Exception ( if the length of ids and quanitys is not equal )
		 * @todo       insert a new pond with it's details transactionnally
		 * 
		 */

		public function insert_pond( $ids_type_fish, $capacity ,$max_quantitys ){
			if( count($ids_type_fish) != count($max_quantitys) ){
				throw new Exception( "Verify that the number of fish you selected and the quantity are the same" );
			}
			if( $capacity <= 0 ){
				throw new Exception("A pond capacity can't be negative or null");
			}

			$length = count($ids_type_fish);

			$id = create_primary_key(Pond::$PREFIX, Pond::$SEQUENCE, Pond::$LENGTH);
			$details = array();

			for( $i = 0 ; $i < $length ; $i++ ){
				$data = array(
					'id_pond' => $id,
					'id_type_fish' => $ids_type_fish[$i],
					'max_quantity' => $max_quantitys[$i]
				);
				$detail = Pond_Detail::get_instance_from_data($data);
				$details[] = $detail;
			}

			$data = array(
				'id_pond' 	=> $id,
				'capacity' 	=> $capacity
			);

			try{
				$this->db->trans_start();
				$this->db->insert( Pond::$TABLE, $data );
				for( $i = 0 ; $i < $length ; $i++ ){
					$detail = new Pond();
					$detail->insert_pond( $id, $ids_type_fish[$i], $max_quantitys[$i], $this->db );
				}
				$this->db->trans_complete();
			}catch( Exception $e ){
				$this->db->trans_rollback();
				throw $e;
			}
		}

		public function get_all_ponds(){
			
			$query = $this->db->get(Pond::$TABLE);
			$rows = $query->result_array();
			$ponds = array();

			foreach( $rows as $row ){
				$pond = new Pond();
				$pond->id_pond = $row['id_pond'];
				$pond->load_pond_details();
				$ponds[] = $pond;
			}

			return $ponds;
		}

		public function load_pond_details(  ){
			$details = Pond::get_instance_from_pond( $this );
			$this->details = $details;

		}


	}

?>