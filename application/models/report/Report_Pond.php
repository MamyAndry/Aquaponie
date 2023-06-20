<?php
	
	/**
	 * This class models will handle all about fish type data from database or not
	 * @author Layah
	 * @package report
	 * Use report_pond from database
	 * 
	 * */

	class Report_Pond extends CI_Model{
		
		public static $table = 'report_pond';

        public $id_report_pond;
        public $id_fish_pond;
        public $report_date_pond;
        public $alive_fish_number;
        public $dead_fish_number;

		/**
		 *	@author Layah
		 * 	
		 *  Insert Report Pond :
		 * 		@args : 
		 * 			- id_fish_pond : The pond where the fish is
		 * 			- date_report_pond
		 * 			- alive_report_pond
		 * 			- dead_fish_number
		 * 	Use:
		 * 		Insert sale fish in the database with an Id beginning with "SAF"
		 * */

		public function insert_report_pond($id_fish_pond, $date_report_pond, $alive_fish_number, $dead_fish_number ){
			if( $date_report_pond <= 0 ) throw new Exception("Please, where is the datee ?");
			if( $alive_fish_number < 0 ) throw new Exception("Why you insert negative number for the fish ?");
			if( $dead_fish_number < 0 ) throw new Exception("Man, pleasee !");
 
			$data = array(
				'id_fish_pond' => $this->db->escape($id_fish_pond),
				'report_date_pond' => $this->db->escape($date_report_pond),
				'alive_fish_number' => $this->db->escape($alive_fish_number),
				'dead_fish_number' => $this->db->escape($dead_fish_number)
			);

			try{
				$this->db->insert(Report_Pond::$table, $data);
			}catch( Exception $exception ){
				throw $exception;
			}
		}

	}


?>