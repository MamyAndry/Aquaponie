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
        public static $PREFIX = "RPP";
		public static $SEQUENCE = "s_report_pond";
		public static $LENGTH = 7;

        public $id_report_pond;
        public $id_fish_pond;
        public $report_date_pond;
        public $alive_fish_number;
        public $dead_fish_number;
		public $category;

		/**
		 *	@author Layah
		 * 	
		 *  Insert Report Pond :
		 * 		@args : 
		 * 			- id_fish_pond : The pond where the fish is
		 * 			- date_report_pond
		 * 			- alive_report_pond
		 * 			- dead_fish_number
		 * 			- category
		 * 	Use:
		 * 		Insert sale fish in the database with an Id beginning with "SAF"
		**/

		public function format_date($date)
		{
			return date("Y-m-d", strtotime($date));
		}

		public function return_category($data, $id_fish_pond){
			$query = "SELECT
				CASE
					WHEN  ".$data[0]." < weight_max_little and ".$data[1]." < size_max_little THEN 1
					WHEN  ".$data[0]." BETWEEN weight_max_little and weight_max_average and ".$data[1]." BETWEEN size_max_little and size_max_average THEN 11
					WHEN  ".$data[0]." > weight_max_average and ".$data[1]." > size_max_average THEN 21
				END AS RESULT
				FROM fish_pond as f join type_fish as t on f.id_type_fish = t.id_type_fish where id_fish_pond = '".$id_fish_pond."'";
				echo $query;

			$query = $this->db->query($query);
			$row = $query->row();
			return $row->result;
		}

		public function insert_report_pond($data, $id_fish_pond, $date_report_pond, $alive_fish_number, $dead_fish_number){
			if( $date_report_pond <= 0 ) throw new Exception("Please, where is the datee ?");
			if( $alive_fish_number < 0 ) throw new Exception("Why you insert negative number for the fish ?");
			if( $dead_fish_number < 0 ) throw new Exception("Man, pleasee !");
 
			$id = create_primary_key(Report_Pond::$PREFIX , Report_Pond::$SEQUENCE, Report_Pond::$LENGTH);
			$data = array(
				'id_report_pond' => ($id),
				'id_fish_pond' => $this->get_last_id_fish_pond($id_fish_pond),
				'report_date_pond' => $this->format_date($date_report_pond),
				'alive_fish_number' => ($alive_fish_number),
				'dead_fish_number' => ($dead_fish_number),
				'category' =>($this->return_category($data, $id_fish_pond))
			);

			try{
				$this->db->insert(Report_Pond::$table, $data);
			}catch( Exception $exception ){
				throw $exception;
			}
		}
		public function get_last_id_fish_pond($id_pond)
		{
			$query = " select f_get_recent_fish_pond( '%s' )";
			$query = sprintf($query , $id_pond);
			echo $query;
			$query = $this->db->query($query);
			$row = $query->result_array();
			return $row[0]["f_get_recent_fish_pond"];
		}


	}
?>