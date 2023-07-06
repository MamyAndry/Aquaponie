<?php
	defined('BASEPATH') or exit("No direct script entrance allowed");
	require('application/models/ponds/Pond.php');
	class Fish_pond extends CI_Model{
		/**
		 * @static PREFIX : For the table identification prefix
		 * @static LENGTH : Length of a identification id
		 * @static SEQUENCE : The sequence mapped for that table
		 * @static TABLE : The table mapping for that class
		*/

		public static $LENGTH = 7;
		public static $PREFIX = "FIP";
		public static $SEQUENCE = "s_fish_pond";
		public static $TABLE = "fish_pond";

		public $id_pond;
		public $capacity;

		public function format_date($date)
		{
			return date("Y-m-d", strtotime($date));
		}

		// Inona daholo ny informations azo lalaovina ato

		public function insert_fish_pond( $id_type_fish, $id_pond, $gender, $quantity, $when ){
			if( empty($id_type_fish) ){
				throw new Exception("The type of fish can't be empty");
			}
			if( empty($id_pond) ){
				throw new Exception("The pond can't be empty");
			}
			if( $quantity < 0 ){
				throw new Exception("The fish importation can't be a negative value ");
			}
			if( empty($when) ){
				throw new Exception("The date of insertion can't be empty");
			}

			$date = $this->format_date($when);
			$id = create_primary_key(Fish_pond::$PREFIX, Fish_pond::$SEQUENCE, Fish_pond::$LENGTH);
			$data = array(
				'id_fish_pond' => $id,
				'id_type_fish' => $id_type_fish,
				'id_pond' => $id_pond,
				'fish_gender' => $gender,
				'quantity' => $quantity,
				'insertion_date' => $date
			);

			try{
				$this->db->insert( Fish_pond::$TABLE, $data );
			}catch(Exception $e){
				throw $e;
			}
		}

		public function get_fish_ponds(){
			
			$sql = "select * from %s";
			$sql = sprintf( $sql, 'v_fishs_ponds' );
			$sql = $this->db->query( $sql );
			$sql_results = $sql->result_array();
			$results = array();

			foreach( $sql_results as $rows ){
				$pond = Pond::__get_instance($rows);
				$fish_pond = Fish_pond::__get_instance($rows);
				$fish_pond->pond = $pond;
				$results[] = $fish_pond;
			}

			return $results;
		}

		public function get_fish_pond( $id ){
			
			$sql = "select * from %s where id_fish_pond like %s";
			$sql = sprintf( $sql, 'v_fishs_ponds', $this->db->escape('%'.$id.'%') );
			$sql = $this->db->query( $sql );
			$sql_results = $sql->result_array();
			$results = array();

			foreach( $sql_results as $rows ){
				$pond = Pond::__get_instance($rows);
				$fish_pond = Fish_pond::__get_instance($rows);
				$fish_pond->pond = $pond;
				$results[] = $fish_pond;
			}


			return $results;
		}

        public function get_fish_pond_by_pond( $id ){

            $sql = "select * from fish_pond where id_pond like %s";
            $sql = sprintf( $sql, $this->db->escape('%'.$id.'%') );
            $sql = $this->db->query( $sql );
            $sql_results = $sql->result_array();
            $results = array();

            foreach( $sql_results as $rows ){
                $fish_pond = Fish_pond::__get_instance($rows);
                $results[] = $fish_pond;
            }


            return $results;
        }

		public static function __get_instance( $data ){
			$fish_ponds = new Fish_pond();

			$fish_ponds->id_fish_pond 	= $data['id_fish_pond'];
			$fish_ponds->id_type_fish 	= $data['id_type_fish'];
			$fish_ponds->id_pond 		= $data['id_pond'];
			$fish_ponds->fish_gender 	= $data['fish_gender'];
			$fish_ponds->quantity 		= $data['quantity'];
			$fish_ponds->insertion_date = $data['insertion_date'];

			return $fish_ponds;
		}

	}

?>