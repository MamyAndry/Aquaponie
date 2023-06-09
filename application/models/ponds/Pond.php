<?php
	require('Pond_Detail.php');
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

		public function insert_pond( $capacity ,$max_quantitys, $ids_type_fish ){
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
					$detail = new Pond_detail();
					$detail->insert_pond( $id, $ids_type_fish[$i], $max_quantitys[$i], $this->db );
				}
				$this->db->trans_complete();
			}catch( Exception $e ){
				$this->db->trans_rollback();
				throw $e;
			}
		}

		public function insert_only_pond( $capacity ){
			if( $capacity < 0 ){
				throw new Exception("Capacity can't be a negative value");
			}
			$id = create_primary_key(Pond::$PREFIX, Pond::$SEQUENCE, Pond::$LENGTH);
			
			$data = array(
				'id_pond' => $id,
				'capacity' => $capacity
			);

			try{
				$this->db->insert(Pond::$TABLE, $data);
			}catch( Exeption $e ){
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
				$pond->capacity = $row['capacity'];
				// $pond->load_pond_details();
				$ponds[] = $pond;
			}

			return $ponds;
		}

		public function get_pond( $id_pond ){
			$sql = "select * from %s where id_pond like %s";
			$sql = sprintf( $sql, Pond::$TABLE, $this->db->escape('%'.$id_pond.'%') );
			$sql = $this->db->query($sql);
			$sql_results = $sql->result_array();
			$ponds = array();
			foreach( $sql_results as $row ){
				$pond = new Pond();
				$pond->id_pond = $id_pond;
				$pond->capacity = $row['capacity'];
				$pond->load_pond_details();
				$ponds[] = $pond;
			}
			return $ponds;
		}

		public static function __get_instance( $data ){
			$pond = new Pond();
			$pond->id_pond = $data['id_pond'];
			$pond->capacity = $data['capacity'];
			$pond->load_pond_details();
			return $pond;
		}

		public function load_pond_details(){
			$details = Pond_detail::get_instance_from_pond( $this );
			$this->details = $details;

		}

		public function get_last_id_fish_pond($id_pond)
		{
			$query = " select f_get_recent_fish_pond( '%s' )";
			$query = sprintf($query , $id_pond);
			$query = $this->db->query($query);
			$row = $query->result_array();
			return $row[0]["f_get_recent_fish_pond"];
		}

		public function get_count_fish($id_pond){
			$id_fish_pond = $this->get_last_id_fish_pond($id_pond);
			$query = " select  f_get_actual_fish_pond_number( '%s' )";
			$query = sprintf($query , $id_fish_pond);
			$query = $this->db->query($query);
			$row = $query->result_array();
			return $row[0]["f_get_actual_fish_pond_number"];
		}

		public function get_details_transaction($id_pond){
			$query = " select id_pond , name_type_fish , quantity , insertion_date from details_pond_fish_pond_v2 where id_pond like '%s' ";
			$query = sprintf($query , $id_pond);
			$query = $this->db->query($query);
			$result = $query->result_array();
			$data = [];	
			foreach( $result as $row){
				$data1 = array(
					'id_pond' => $row['id_pond'],
					'name_type_fish' => $row['name_type_fish'],
					'quantity' => $row['quantity'],
					'insertion_date' => $row['insertion_date']
				);
				$data[] = $data1;
			}
			return $data;

		}
	}

?>