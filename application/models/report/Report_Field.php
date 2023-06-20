<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Layah
	 * @package report
	 * Use report_field from database
	 * 
	 * */

	class Report_Field extends CI_Model{
		
		public static $table = 'report_field';

        public $id_report_field;
        public $id_field_plantation;
        public $report_date_field;
        public $one_plant_weight;
        public $plant_per_squaremeter;
        public $surface_covered;

		/**
		 *	@author Layah
		 * 	
		 *  Insert Report Field :
		 * 		@args : 
		 * 			- id_field_plantation
		 * 			- report_date_field
		 * 			- one_plant_weight
		 * 			- plant_per_squaremeter
         *          - surface_covered
		 * 	Use:
         * 
		 * */

		public function insert_report_field($id_field_plantation, $report_date_field, $one_plant_weight, $plant_per_squaremeter, $surface_covered){
			if( $report_date_field <= 0 ) throw new Exception("Please, where is the datee ?");
			if( $one_plant_weight < 0 ) throw new Exception("Why you insert negative number for the fish ?");
			if( $plant_per_squaremeter < 0 ) throw new Exception("Man, pleasee !");
			if( $surface_covered < 0 ) throw new Exception("Man, pleasee! the covered surface");
 
			$data = array(
				'id_field_plantation' => $this->db->escape($id_field_plantation),
				'report_date_field' => $this->db->escape($report_date_field),
				'one_plant_weight' => $this->db->escape($one_plant_weight),
				'plant_per_squaremeter' => $this->db->escape($plant_per_squaremeter),
				'surface_covered' => $this->db->escape($surface_covered)
			);

			try{
				$this->db->insert(Report_Field::$table, $data);
			}catch( Exception $exception ){
				throw $exception;
			}
		}

	}


?>