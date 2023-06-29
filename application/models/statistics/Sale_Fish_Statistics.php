<?php
	
	class Sale_Fish_Statistics extends CI_Model{
        
        /**
		 * @author     Mamisoa
		 * @todo       get all the year in sale_date
		 * 
		 */
        function get_all_year(){
            
            $result = array();
            $query = "SELECT DISTINCT EXTRACT('year' from sale_date) FROM sale_fish";
            $result_array = $this->db->query($query);
            foreach( $result_array as $row){
                $result[] = $row['date_part'];
            }
            return $result
        }

        /**
		 * @author     Mamisoa
		 * @todo       get the quantity of fish sold in a year
		 * 
		 */
        function get_quantity_sold_in_year($year){
            
            $query = "SELECT SUM(quantity_sold) FROM sale_fish WHERE EXTRACT('year' from sale_date) = %s";
            $query = sprintf($query , $year);
            echo $query;
            $result = $this->db->query($query);
            return $result['sum'];

        }

        /**
		 * @author     Mamisoa
		 * @todo       get all the year in sale_date
		 * 
		 */
        function get_sold_fish(){
            
            $result = array();
            $years = get_all_year();
            foreach( $years as $year){
                $quantity = get_quantity_sold_in_year($year);
                $result[] = array(
                    "year"  => $year,
                    "quantity" =>  $quantity
                );
            }
        }

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
                $type->maturity_period  = $row["maturity_period"];
                $type->maturity_size 	= $row["maturity_size"];
                $results[] = $type;
            }
        }

	}

?>