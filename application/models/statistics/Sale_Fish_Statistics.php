<?php
	
	class Sale_Fish_Statistics extends CI_Model{
        
        /**
		 * @author     Mamisoa
		 * @todo       get all the year in sale_date
		 * 
		 */
        function get_all_year(){
            
            $result = array();
            $query = "SELECT DISTINCT EXTRACT('year' from sale_date) as year FROM sale_fish order by year";
            // echo $query;
            $result_array = $this->db->query($query);
            $result_array = $result_array->result_array();
            foreach( $result_array as $row){
                $result[] = $row['year'];
            }
            return $result;
        }

        /**
		 * @author     Mamisoa
		 * @todo       get the quantity of fish sold in a year
		 * 
		 */
        function get_quantity_sold_in_year($year){
            
            $query = "SELECT SUM(quantity_sold) FROM sale_fish WHERE EXTRACT('year' from sale_date) = %s";
            $query = sprintf($query , $year);
            // echo $query;
            $result = $this->db->query($query);
            $result = $result->result_array();
            return $result[0]['sum'];
        }

        /**
		 * @author     Mamisoa
		 * @todo       get all the year in sale_date
		 * 
		 */
        function get_fish_sold(){
            
            $result = array();
            $years = $this->get_all_year();
            foreach( $years as $year){
                $result[] = $this->get_quantity_sold_in_year($year);
            }
            return $result;
        }
            

        /**
		 * @author     Mamisoa
		 * @todo       get the details of all fish sale
		 * 
		 */
        function details_sale(){
         
            $result = array();
            $query = "SELECT * FROM details_fish_sold";
            // echo $query;
            $result_array = $this->db->query($query);
            $result_array = $result_array->result_array();
            foreach( $result_array as $row){
                $result[] = array(
                    'pond'=> $row['id_pond'],
                    'name_type_fish'=> $row['name_type_fish'],
                    'quantity_sold'=> $row['quantity_sold'],
                    'sale_date'=> $row['sale_date']
                );
            }
            // var_dump($result);
            return $result;   
        }
	}

?>