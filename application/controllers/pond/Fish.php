<?php
	
	defined('BASEPATH') OR exit("Can't access from direct script");

	class Fish extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			$this->load->model('ponds/Fish_Pond', 'fish_pond');
			$unities = get_unities();
            $this->data['unities'] 			= $unities;
            $this->data['header_product'] 	= "text-secondary";
            $this->data['header_ponds'] 	= "text-white";
            $this->data['header_home'] 		= "text-secondary";
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

	}

?>