<?php

class Field extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('field/Field_plantation' , 'field_plantation');
        $unities = get_unities();
        $this->data['unities'] = $unities;
        $this->data['header_product'] = "text-secondary";
        $this->data['header_ponds'] = "text-secondary";
        $this->data['header_home'] = "text-secondary";
    }

    public function index(){
        $field_plantations = $this->field_plantation->get_field_plantation();

        $this->data['field_plantations'] = $field_plantations;
        $this->data['page_title'] = "Field plantation pages";
        $this->data['body'] = 'fields/index';


        $this->load->view('template/index' , $this->data);
    }

    public function see( $field_plantation = '' ){
        $field_plantations = $this->field_plantation->get_details_field_by_id_type_plantation( $field_plantation );
        $this->data['field_plantations'] = $field_plantations;
        $this->data['page_title'] = " Field plantation page ";
        $this->data['body'] = 'fields/details';
        $this->load->view('template/index' , $this->data);
    }
}