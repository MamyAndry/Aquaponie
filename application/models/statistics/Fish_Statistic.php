<?php

class Fish_Statistic extends CI_Model{
    public $id_type_fish = '';
    public $identifier = '';
    public $quantity_sold = 0;

    /**
     *	@author Yoann
        * 	
        * Getting all statistic by month and by fish
        * 
        * args : none
        * 
    **/
    public function get_all_by_month(){
        $query = $this->db->get('v_fish_month_statistic');
        $rows = $query->result_array();
        $result = array();
        foreach ($rows as $row) {
            $statistic = new Fish_Statistic();
            $statistic->id_type_fish = $row['id_type_fish'];
            $statistic->identifier = $row['identifier'];
            $statistic->quantity_sold = $row['quantity_sold'];
            $result[] = $statistic;
        }
        return $result;
    }

        /**
     *	@author Yoann
        * 	
        * Getting all statistic by month and by fish type
        * 
        * args : id_type_fish
        * 
    **/
    public function get_fish_by_month($id_type){
        $query = $this->db->get_where('v_fish_month_statistic', 
                array('id_type_fish'=>$id_type));
        $rows = $query->result_array();
        $result = array();
        foreach ($rows as $row) {
            $statistic = new Fish_Statistic();
            $statistic->id_type_fish = $row['id_type_fish'];
            $statistic->identifier = $row['identifier'];
            $statistic->quantity_sold = $row['quantity_sold'];
            $result[] = $statistic;
        }
        return $result;
    }

    public static function get_by_year(){

    }
}