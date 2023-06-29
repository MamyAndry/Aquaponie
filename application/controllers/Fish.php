<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('fish/Type_Fish' , 'fish');
	}

	// To list all type of fishes
	public function index(){

		$fishes = $this->fish->get_all_type();
		
		$data['fishes'] = $fishes;
		$data['page_title'] = "Fishes Pages";
		$data['body'] = 'fish/index';

		$this->load->view('template/index' , $data);

	}

	public function insert(){
		$data['page_title'] = "Fishes Pages / Insert Fishes";
		$data['body'] = 'fish/insert_fish';
		$this->load->view('template/index' , $data);
	}

	// For seeing details for one type of fish
	public function see( $fish = '' ){
		try{
			$fishes = $this->fish->get_Fish( $fish );
			$data['fishes'] = $fishes;
			$data['page_title'] = " Fish page ";
			$data['body'] = 'fish/abouts';
			$this->load->view('template/index' , $data);
		}catch(Exception $e){
			echo $e->getMessage();
		}

	}

	public function save(){
		try{
			$config = array(

				array(
					'field' => 'type',
					'label' => 'Type of fish',
					'rules' => 'required',
					'errors' => array(
						'required' => '<p class="text-danger"> You must provide a %s </p>'
					)
				),

			);

			// Avy eo mametaka an'izany form_validation izany ka

			$this->form_validation->set_rules( $config );

			$type 		= $this->input->post('type');
			$m_period 	= $this->input->post('m_period');
			$m_length 	= $this->input->post('m_length');
			$m_size 	= $this->input->post('m_size');
			$w_max_baby = $this->input->post('w_max_baby');
			$w_max_avg 	= $this->input->post('w_max_avg');
			$s_max_baby = $this->input->post('s_max_baby');
			$s_max_avg 	= $this->input->post('s_max_avg');

			$this->fish->insert_type_fish( $type, $m_period, $m_length, $m_size, $w_max_baby, $w_max_avg, $s_max_baby, $s_max_avg );
		}catch( Exception $e ){
			echo $e->getMessage();
		}
	}

}

?>