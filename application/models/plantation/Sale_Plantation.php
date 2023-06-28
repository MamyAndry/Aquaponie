<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Layah
	 * @package fish
	 * Use type_fish from database
	 * 
	 * */

	class Sale_Plantation extends CI_Model{
		
		public static $PREFIX = "SAP";
		public static $SEQUENCE = "s_sale_plantation";
		public static $LENGTH = 7;
		public static $table = 'sale_plantation';

		public $id_field_plantation;
		public $quantity_sold;
		public $sale_date;

		public function format_date($date)
		{
			return date("Y-m-d", strtotime($date));
		}

		public function insert_sale_plantation( $id_field_plantation, $quantity_saled, $saling_date ){
			if( $quantity_saled <= 0 ) throw new Exception("Why you insert if the quantity is negative or null ?");
			if( $saling_date <= 0 ) throw new Exception("Please, insert a date!");
 
			$id = create_primary_key(Sale_Plantation::$PREFIX , Sale_Plantation::$SEQUENCE, Sale_Plantation::$LENGTH);
			$data = array(
				'id_field_plantation' => ($id_field_plantation),
				'quantity_sold' => ($quantity_saled),
				'sale_date' => ($this->format_date($saling_date))
			);

			try{
				$this->db->insert(Sale_Plantation::$table, $data);
			}catch( Exception $exception ){
				throw $exception;
			}
		}

	}

?>