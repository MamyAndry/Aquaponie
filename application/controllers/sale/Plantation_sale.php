<?php

class Plantation_sale extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('field/Field_plantation' , 'field_plantation');
        $this->load->model('plantation/Sale_Plantation','sale_plantation');
        $this->data['header_product'] 	= "";
        $this->data['header_ponds'] 	= "";
        $this->data['header_home'] 		= "";
        $this->data['header_statistics'] = "";
        $this->data['header_report'] = "";
        $this->data['header_sale'] = "active";
    }

    public function index(){
        $id_field = $this->input->get('id_field');
        $this->data['fields'] = $this->field_plantation->get_field_plantation_by_id_field($id_field);
        $this->data['page_title'] = "Insert Sale Plantation";
        $this->data['body'] = 'sale/add_sale_plantation';
        $this->load->view('template/index' , $this->data);

    }

    public function insert_sale_plantation(){
        $id_pond = $this->input->post('id_field_plantation');
        $date = $this->input->post('date');
        $quantity = $this->input->post('quantity');
        $this->sale_plantation->insert_sale_plantation($id_pond, $quantity, $date);
        redirect(base_url('sale/Fish_Sale'));
    }
}