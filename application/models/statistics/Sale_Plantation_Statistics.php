<?php
	
	class Sale_Plantation_Statistics extends CI_Model{
        
        /**
		 * @author     Mamisoa
		 * @todo       get all the year in sale_date
		 * 
		 */
        function get_all_year(){
            
            $result = array();
            $query = "SELECT DISTINCT EXTRACT('year' from sale_date) as year FROM sale_plantation";
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
		 * @todo       get the quantity of plantation sold in a year given
		 * 
		 */
        function get_quantity_sold_in_year($year){
            
            $query = "SELECT SUM(quantity_sold) FROM sale_plantation WHERE EXTRACT('year' from sale_date) = %s";
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
        function get_plantation_sold(){
            
            $result = array();
            $years = $this->get_all_year();
            foreach( $years as $year){
                $result[] = $this->get_quantity_sold_in_year($year);
            }
            return $result;
        }

        /**
		 * @author     Mamisoa
		 * @todo       get the details of all plantation sale
		 * 
		 */
        function details_sale(){
         
            $result = array();
            $query = "SELECT * FROM details_plantation_sold";
            // echo $query;
            $result_array = $this->db->query($query);
            $result_array = $result_array->result_array();
            foreach( $result_array as $row){
                $result[] = array(
                    'field'=> $row['id_field_plantation'],
                    'name_type_plantation'=> $row['name_type_plantation'],
                    'quantity_sold'=> $row['quantity_sold'],
                    'sale_date'=> $row['sale_date']
                );
            }
            // var_dump($result);
            return $result;   
        }
	}

?>