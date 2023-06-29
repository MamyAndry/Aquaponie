<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Layah
	 * @package fish
	 * Use type_fish from database
	 * 
	 * */

	class Sale_Fish extends CI_Model{
		
		public static $PREFIX = "SAF";
		public static $SEQUENCE = "s_sale_fish";
		public static $LENGTH = 7;
		public static $table = 'sale_fish';

		public $id_sale_fish;
		public $id_fish_pond;
		public $quantity_sold;
		public $sale_date;

		public function format_date($date)
		{
			return date("Y-m-d", strtotime($date));
		}

		/**
		 *	@author Layah
		 * 	
		 *  Insert Sale Fish :
		 * 		@args : 
		 * 			- id_fish_pond : The pond where the fish is
		 * 			- quantity_saled : The quantity of fish who were saled
		 * 			- saling_date : The date when the fish were saled
		 * 	Use:
		 * 		Insert sale fish in the database with an Id beginning with "SAF"
		**/

		public function insert_sale_fish( $id_fish_pond, $quantity_saled, $saling_date ){
			if( $quantity_saled <= 0 ) throw new Exception("Why you insert if the quantity is negative or null ?");
			if( $saling_date <= 0 ) throw new Exception("Please, insert a date!");
 
			$id = create_primary_key(Sale_Fish::$PREFIX , Sale_Fish::$SEQUENCE, Sale_Fish::$LENGTH);
			$data = array(
				'id_sale_fish' => ($id),
				'id_fish_pond' => ($id_fish_pond),
				'quantity_sold' => ($quantity_saled),
				'sale_date' => ($this->format_date($saling_date))
			);

			try{
				$this->db->insert(Sale_Fish::$table, $data);
			}catch( Exception $exception ){
				throw $exception;
			}
		}

		/**
		 * 
		 * @author     Layah
		 * 
		 * Get All Saled Fish
		 * 
		 * args : none
		 * 
		 * use : Get all fish who were already sold
		 * 
		 * 
		 */

		public function get_all_saled_fish(){
			$query = $this->db->get('sale_fish');
            echo $this->db->last_query($query);
			$results = array();
			$result_array = $query->result_array();
			foreach( $result_array as $row ){
				$saleFish = new Sale_Fish();
				$saleFish->id_sale_fish = $row["id_sale_fish"];
				$saleFish->id_fish_pond = $row["id_fish_pond"];
				$saleFish->quantity_sold = $row["quantity_sold"];
				$saleFish->sale_date = $row["sale_date"];
				$results[] = $saleFish;
			}
			return $results;
		}

		// public function get_fish_by_category($category)
		// {

		// }

		public function check_sale_quantity($id_fish_pond, $quantity_to_sell)
		{
			$query = " SELECT CASE WHEN ".$quantity_to_sell." > quantity THEN 'false' ELSE 'true' END AS result FROM fish_pond WHERE id_fish_pond = ".$id_fish_pond;
			$query = $this->db->query($query);
			$row = $query->row();
			return $row->result;
		}

	}

?>