<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('fish/Type_Fish' , 'fish');
        $this->data['header_product'] = "text-white";
        $this->data['header_ponds'] = "text-secondary";
        $this->data['header_home'] = "text-secondary";
	}

	// To list all type of fishes
	public function index(){

		$fishes = $this->fish->get_all_type();
		
		$this->data['fishes'] = $fishes;
        $unities = get_unities();
        $this->data['unities'] = $unities;
		$this->data['page_title'] = "Fishes Pages";
		$this->data['body'] = 'fish/index';


		$this->load->view('template/index' , $this->data);

	}

	public function insert(){
		$this->data['page_title'] = "Fishes Pages / Insert Fishes";
		$this->data['body'] = 'fish/insert_fish';
		$this->load->view('template/index' , $this->data);
	}

	// For seeing details for one type of fish
	public function see( $fish = '' ){
		try{
			$fishes = $this->fish->get_Fish( $fish );
			$this->data['fishes'] = $fishes;
            $unities = get_unities();
            $this->data['unities'] = $unities;
			$this->data['page_title'] = " Fish page ";
			$this->data['body'] = 'fish/abouts';
			$this->load->view('template/index' , $this->data);
		}catch(Exception $e){
			echo $e->getMessage();
		}

	}

	public function save(){
		$config = array(

			array(
				'field' => 'type',
				'label' => 'type of fish',
				'rules' => 'required',
				'errors' => array(
					'required' => '<span class="text-danger"> You must provide a %s </span>'
				)
			),
            array(
                'field' => 'm_length',
                'label' => 'maturity length',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),
            array(
                'field' => 'm_period',
                'label' => 'maturity period',
                'rules' => 'required|numeric|min_length[1]|max_length[2]',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),
            array(
                'field' => 'm_size',
                'label' => 'size at maturity',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),
            array(
                'field' => 'w_max_baby',
                'label' => 'max weight when baby',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),
            array(
                'field' => 'w_max_avg',
                'label' => 'max average weight',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),
            array(
                'field' => 's_max_baby',
                'label' => 'max size when baby',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),
            array(
                'field' => 's_max_avg',
                'label' => 'max average size',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),

		);

		// Avy eo mametaka an'izany form_validation izany ka
        $this->form_validation->set_rules( $config );
        if (!$this->form_validation->run()){
            $this->insert();
            return;
        }
        $type 		= $this->input->post('type');
        $m_period 	= $this->input->post('m_period');
        $m_length 	= $this->input->post('m_length');
        $m_size 	= $this->input->post('m_size');
        $w_max_baby = $this->input->post('w_max_baby');
        $w_max_avg 	= $this->input->post('w_max_avg');
        $s_max_baby = $this->input->post('s_max_baby');
        $s_max_avg 	= $this->input->post('s_max_avg');



        $this->fish->insert_type_fish( $type, $m_period, $m_length, $m_size, $w_max_baby, $w_max_avg, $s_max_baby, $s_max_avg );
	    redirect(base_url('fish'));
    }

}

?>