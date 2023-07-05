<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Layah
	 * @package report
	 * Use report_pond from database
	 * 
	 * */

	class Report_Field extends CI_Model{
		
		public static $table = 'report_field';
        public static $PREFIX = "RPF";
		public static $SEQUENCE = "s_report_field";
		public static $LENGTH = 7;

        public $id_report_field;
        public $id_field_plantation;
        public $report_date_field;
        public $plant_weight;
        public $density;
		public $surface_covered;

		/**
		 *	@author Layah
		 * 	
		 *  Insert Report field :
		 * 		@args : 
		 * 			- id_field_plantation : The field where the fish is
		 * 			- date_report_field
		 * 			- plant_weight
		 * 			- density
		 * 			- surface_covered
		 * 	Use:
		 * 		Insert report field in the database with an Id beginning with "SAF"
		**/

		public function format_date($date)
		{
			return date("Y-m-d", strtotime($date));
		}

        // id_report_field | id_field_plantation | report_date_field | plant_weight | density | surface_covered
		public function insert_report_field($id_field_plantation, $report_date_field, $plant_weight, $density, $surface_covered){
			if( $report_date_field <= 0 ) throw new Exception("Please, where is the datee ?");
			if( $density < 0 ) throw new Exception("Why you insert negative density for the field ?");
			if( $surface_covered < 0 ) throw new Exception("Man, pleasee! The covered surface");
 
			$id = create_primary_key(Report_Field::$PREFIX , Report_Field::$SEQUENCE, Report_Field::$LENGTH);
			$data = array(
                'id_report_field' => ($id),
				'id_field_plantation' => ($id_field_plantation),
				'report_date_field' => $this->format_date($report_date_field),
				'plant_weight' => ($plant_weight),
				'density' => ($density),
				'surface_covered' =>($surface_covered)
			);

			try{
				$this->db->insert(Report_Field::$table, $data);
			}catch( Exception $exception ){
				throw $exception;
			}
		}

	}
?>