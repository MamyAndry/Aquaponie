<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fish_Sale extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('ponds/Fish_Pond' , 'fish_pond');
		$this->load->model('fish/Sale_Fish','sale_fish');
        $this->data['header_product'] = "text-white";
        $this->data['header_ponds'] = "text-secondary";
        $this->data['header_home'] = "text-secondary";
	}

	public function index(){

		$this->data['ponds'] = $this->fish_pond->get_fish_ponds();
		$this->data['page_title'] = "Insert Sale Fish";
		$this->data['body'] = 'sale/add_sale_fish';
		$this->load->view('template/index' , $this->data);

	}

    public function insert_sale_fish(){
        $id_fish_pond = $this->input->post('id_fish_pond');
        $date = $this->input->post('date');
        $quantity = $this->input->post('quantity');
		$this->sale_fish->insert_sale_fish($id_fish_pond, $quantity, $date);
		redirect(base_url('sale/Fish_Sale'));
    }


}

?>