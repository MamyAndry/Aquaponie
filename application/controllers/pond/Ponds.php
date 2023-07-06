<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Ponds extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('ponds/Pond' , 'ponds');
			$this->load->model('fish/Type_Fish' , 'fish');
			$this->load->model('statistics/Sale_Fish_Statistics' , 'fish_statistics');

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

			//Stat(s)
			$this->data['year'] = $this->fish_statistics->get_all_year();
			$this->data['sold'] = $this->fish_statistics->get_fish_sold();
			$this->data['fishes'] = $this->fish->get_all_type();
			$this->fish->obtain_statistics();;
			
			$monthly_identifier = array();
			$monthly_value = array();
	
			foreach ($this->fish->statistics as $stat) {
				$monthly_identifier[] = $stat->identifier;
				$monthly_value[] = $stat->quantity_sold;
			}
			$this->data['monthly_identifier'] = $monthly_identifier;
			$this->data['monthly_value'] = $monthly_value;

			$this_year_stat = $this->fish_statistics->get_this_year_by_month();
			$this->data['month'] = array();
			$this->data['quantity_sold'] = array();
			foreach ($this_year_stat as $st) {
				$this->data['month'][] = $st['name'];
				$this->data['quantity_sold'][] = $st['coalesce'];
			}


			$this->load->view( 'template/index' , $this->data );
		}

		public function see( $id_ponds = '' ){
			$ponds = $this->ponds->get_pond( $id_ponds );
			$details = $this->ponds->get_details_transaction( $id_ponds );
			$fish_quantity = $this->ponds->get_count_fish( $id_ponds );
			$this->data['ponds'] = $ponds;
			$this->data['fish_quantity'] = $fish_quantity;
			$this->data['details'] = $details;
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
				$this->data['success'] = "Added Successfully";
				echo json_encode($this->data);
			}catch( Exception $e ){
				$this->output->set_status_header('400');
				$this->data['error'] = $e->getMessage();
				echo json_encode($this->data);
			}
		}

	}

?>