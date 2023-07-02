<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish_statistics extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('statistics/Sale_Fish_Statistics' , 'fish_statistics');
        $this->data['header_product'] = "text-white";
        $this->data['header_ponds'] = "text-secondary";
        $this->data['header_home'] = "text-secondary";
	}

	// To list all type of fishes
	public function index(){

		$this->data['year'] = $this->fish_statistics->get_all_year();
		$this->data['sold'] = $this->fish_statistics->get_fish_sold();
		$this->data['page_title'] = "Statistics of fish sold";
		$this->data['body'] = 'statistics/fish_sold';
		// var_dump($year);
		// print_r($this->data);
		// var_dump($sold);
		$this->load->view('template/index' , $this->data);

	}


}

?>