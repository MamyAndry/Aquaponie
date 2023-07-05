<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish_statistics extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('statistics/Sale_Fish_Statistics' , 'fish_statistics');
		$this->load->model('fish/Type_Fish' , 'fish');
        $this->data['header_product'] 	= "";
        $this->data['header_ponds'] 	= "";
        $this->data['header_home'] 		= "";
        $this->data['header_statistics'] = "active";
        $this->data['header_report'] = "";
        $this->data['header_sale'] = "";
	}

	// To list all type of fishes
	public function index(){

		$this->data['year'] = $this->fish_statistics->get_all_year();
		$this->data['sold'] = $this->fish_statistics->get_fish_sold();
		$this->fish->obtain_statistics();;
		
		$monthly_identifier = array();
		$monthly_value = array();

		foreach ($this->fish->statistics as $stat) {
			$monthly_identifier[] = $stat->identifier;
			$monthly_value[] = $stat->quantity_sold;
		}
		$this->data['monthly_identifier'] = $monthly_identifier;
		$this->data['monthly_value'] = $monthly_value;


		$this->data['details'] = $this->fish_statistics->details_sale();
		$this->data['page_title'] = "Statistics of fish sold";
		$this->data['body'] = 'statistics/fish_sold';
		$this->load->view('template/index' , $this->data);

	}


}

?>