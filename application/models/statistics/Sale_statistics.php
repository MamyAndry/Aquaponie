<?php
	
	class Sale_Fish_Statistics extends CI_Model{



        /**
		 * @author     Mamisoa
		 * @todo       get the gap type of a list of values
		 * 
		 */
        function get_Fish_sold(){
        
            $query = $this->db->get('sale_fish');
            $results = array();
            $result_array = $query->result_array();
            foreach( $result_array as $row ){
                $type = new Type_fish();
                $type->id_type_fish 	= $row["id_type_fish"];
                $type->name_type_fish 	= $row["name_type_fish"];
                $type->maturity_period = $row["maturity_period"];
                $type->maturity_size 	= $row["maturity_size"];
                $results[] = $type;
            }
        }

	}

?>