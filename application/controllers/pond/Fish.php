<?php
	
	defined('BASEPATH') OR exit("Can't access from direct script");

	class Fish extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			$this->load->model('ponds/Fish_Pond', 'fish_pond');
			$this->load->model('fish/Type_Fish', 'type_fish');
			$this->load->model('ponds/Pond', 'pond');
			$unities = get_unities();
            $this->data['unities'] 			= $unities;
            $this->data['header_product'] 	= "text-secondary";
            $this->data['header_ponds'] 	= "text-white";
            $this->data['he	ader_home'] 		= "text-secondary";
		}

		public function index(){
			$ponds = $this->fish_pond->get_fish_ponds();
			$this->data['ponds'] = $ponds;
			$this->data['page_title'] = 'Ponds Pages/ Fish Ponds';
			$this->data['body'] = 'ponds/fish/index';

			$this->load->view('template/index' , $this->data);
		}

		public function see( $id_ponds ){
			$ponds = $this->fish_pond->get_fish_pond( $id_ponds );
			$this->data['ponds'] = $ponds;
			$this->data['page_title'] = 'Pond Pages/ Fish Ponds';
			$this->data['body'] = 'ponds/fish/about';
			$this->load->view('template/index' , $this->data);
		}

		public function see_Insertion(){
			$type_fish = $this->type_fish->get_all_type();
			$ponds = $this->pond->get_all_ponds();
			$this->data['fishs'] = $type_fish;
			$this->data['ponds'] = $ponds;
			$this->data['page_title'] = 'Pond Pages/ Fish Ponds';
			$this->data['body'] = 'ponds/add_fish_pond';
			$this->load->view('template/index' , $this->data);
		}

		public function insert_fish_pond(){
			$id_type_fish = $this->input->post('id_type_fish');
			$id_pond = $this->input->post('id_pond');
			$fish_gender = $this->input->post('fish_gender');
			$quantity = $this->input->post('quantity');
			$date = $this->input->post("date");
			try {
				if ($fish_gender == null || $quantity <= 0) {
					throw new Exception('Please verify your entry, fish gender must not be empty and quantity must be superior to 0');
				}
			} catch (\Exception $e) {
				exit($e->getMessage());
			}
			$this->fish_pond->insert_fish_pond( $id_type_fish, $id_pond, $fish_gender, $quantity, $date );
			redirect(base_url('pond/Fish'));
		}

	}

?>