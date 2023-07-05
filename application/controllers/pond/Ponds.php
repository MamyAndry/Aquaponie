<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Ponds extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('ponds/Pond' , 'ponds');
			$this->load->model('fish/Type_Fish' , 'fish');
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
			$this->data['body'] 		= 'ponds/index';
			$this->data['page_title'] 	= 'Ponds Page';
			$this->data['ponds'] 		= $ponds;

			$this->load->view( 'template/index' , $this->data );
		}

		public function see( $id_ponds = '' ){
			$ponds = $this->ponds->get_pond( $id_ponds );
			$this->data['ponds'] = $ponds;
			$this->data['body'] = 'ponds/details';
			$this->data['page_title'] = 'Ponds Pages/ Details';

			$this->load->view( 'template/index', $this->data );
		}

		public function insert(){
			$this->data['page_title'] = 'Ponds Pages/ Add new pond';
			$this->data['body'] = 'ponds/add_ponds';

			$this->load->view('template/index' , $this->data);
		}

		public function add_details(){

			$this->data['page_title'] = 'Ponds Pages/ Add details';
			$this->data['body'] = "ponds/add_details_pond";
			$capacity = $this->input->post('max_quantity');
			$fishes = $this->fish->get_all_type();
			$this->data['fishes'] = $fishes;

			$this->session->set_userdata('pond_insert_capacity' , $capacity);

			$this->load->view('template/index', $this->data);
		}


		public function save(){

			$fishes = $this->input->post('fish');
			$quantitys = $this->input->post('quantity');
			$pond = $this->session->userdata('pond_insert_capacity');
			$fs = array();
			try{
				if( is_array($fishes) && is_array($quantitys) ){
					foreach( $fishes as $fish ){
						$fs[] = $this->fish->get_Type($fish)[0]->id_type_fish;
					}
					$this->ponds->insert_pond( $pond, $quantitys, $fs );
				}else{
					$this->ponds->insert_only_pond( $pond );
				}
				$this->output->set_status_header('200');
				$this->data['message'] = "Added Successfully";
				echo json_encode($this->data);
			}catch( Exception $e ){
				$this->output->set_status_header('400');
				$this->data['message'] = $e->getMessage();
				echo json_encode($this->data);
			}
		}

	}

?>