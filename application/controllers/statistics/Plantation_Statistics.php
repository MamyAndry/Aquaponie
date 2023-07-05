<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantation_statistics extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('statistics/Sale_Plantation_Statistics' , 'plantation_statistics');
        $this->data['header_product'] 	= "";
        $this->data['header_ponds'] 	= "";
        $this->data['header_home'] 		= "";
        $this->data['header_statistics'] = "active";
        $this->data['header_report'] = "";
        $this->data['header_sale'] = "";
	}

	// To get the quantity of fishes sold in the year
	public function index(){

		$this->data['year'] = $this->plantation_statistics->get_all_year();
		$this->data['sold'] = $this->plantation_statistics->get_plantation_sold();
		$this->data['details'] = $this->plantation_statistics->details_sale();
		$this->data['page_title'] = "Statistics of plant sold";
		$this->data['body'] = 'statistics/Plantation_sold';
		$this->load->view('template/index' , $this->data);

	}


}

?>