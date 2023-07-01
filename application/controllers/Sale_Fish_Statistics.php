<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('statistics/Type_Fish' , 'fish');
        $this->data['header_product'] = "text-white";
        $this->data['header_ponds'] = "text-secondary";
        $this->data['header_home'] = "text-secondary";
	}

	// To list all type of fishes
	public function index(){

		$fishes = $this->fish->get_all_type();
		
		$this->data['fishes'] = $fishes;
		$this->data['page_title'] = "Fishes Pages";
		$this->data['body'] = 'fish/index';

		$this->load->view('template/index' , $this->data);

	}


}

?>