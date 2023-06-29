<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('statistics/Type_Fish' , 'fish');
	}

	// To list all type of fishes
	public function index(){

		$fishes = $this->fish->get_all_type();
		
		$data['fishes'] = $fishes;
		$data['page_title'] = "Fishes Pages";
		$data['body'] = 'fish/index';

		$this->load->view('template/index' , $data);

	}


}

?>