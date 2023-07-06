<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * @author Yoann
 * 
 * Displaying statistic by Fish(es)
 * 
 */
class Statistics extends CI_Controller {

    public function __construct(){
		parent::__construct();
        $this->load->model('ponds/Pond' , 'ponds');
        $this->load->model('fish/Type_Fish' , 'fish');
        $this->load->model('statistics/Sale_Fish_Statistics' , 'fish_statistics');

        $unities = get_unities();
        $this->data['unities'] 			= $unities;
        $this->data['header_product'] 	= "";
        $this->data['header_ponds'] 	= "active";
        $this->data['header_home'] 		= "";
        $this->data['header_statistics'] = "";
        $this->data['header_report'] = "";
        $this->data['header_sale'] = "";
	}

    public function index(){
        $ponds = $this->ponds->get_all_ponds();
			$this->data['body'] 		= 'statistics/stat_by_fish';
			$this->data['page_title'] 	= 'Ponds Page';
			$this->data['ponds'] 		= $ponds;

            $id = $_GET['id_fish'];

			//Stat(s)
			$this->data['year'] = $this->fish_statistics->get_all_year();
			$this->data['sold'] = $this->fish_statistics->get_fish_sold();
			$this->data['fishes'] = $this->fish->get_all_type();
			$this->fish->retrieve_statistics($id);
			
			$monthly_identifier = array();
			$monthly_value = array();
	
			foreach ($this->fish->statistics as $stat) {
				$monthly_identifier[] = $stat->identifier;
				$monthly_value[] = $stat->quantity_sold;
			}
			$this->data['monthly_identifier'] = $monthly_identifier;
			$this->data['monthly_value'] = $monthly_value;

			$this_year_stat = $this->fish_statistics->get_this_year_by_month_by_id($id);
			$this->data['month'] = array();
			$this->data['quantity_sold'] = array();
			foreach ($this_year_stat as $st) {
				$this->data['month'][] = $st['name'];
				$this->data['quantity_sold'][] = $st['coalesce'];
			}


			$this->load->view( 'template/index' , $this->data );
    }
}