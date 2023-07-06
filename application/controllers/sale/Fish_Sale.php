<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish_Sale extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('ponds/Fish_pond' , 'fish_pond');
		$this->load->model('fish/Sale_Fish','sale_fish');
        $this->data['header_product'] 	= "";
        $this->data['header_ponds'] 	= "";
        $this->data['header_home'] 		= "";
        $this->data['header_statistics'] = "";
        $this->data['header_report'] = "";
        $this->data['header_sale'] = "active";
	}

	public function index(){
        $id_pond = $this->input->get('id_pond');
		$this->data['fish_ponds'] = $this->fish_pond->get_fish_pond_by_pond( $id_pond );
		$this->data['page_title'] = "Insert Sale Fish";
		$this->data['body'] = 'sale/add_sale_fish';
		$this->load->view('template/index' , $this->data);

	}

    public function insert_sale_fish(){
        $id_pond = $this->input->post('id_pond');
        $date = $this->input->post('date');
        $quantity = $this->input->post('quantity');
		$this->sale_fish->insert_sale_fish($id_pond, $quantity, $date);
		redirect(base_url('sale/Fish_Sale'));
    }

}

?>