<?php

class Field extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('field/Field_plantation' , 'field_plantation');
        $this->load->model('field/Fields' , 'field');
        $unities = get_unities();
        $this->data['unities'] = $unities;
        $this->data['header_product'] 	= "";
        $this->data['header_ponds'] 	= "active";
        $this->data['header_home'] 		= "";
        $this->data['header_statistics'] = "";
        $this->data['header_report'] = "";
        $this->data['header_sale'] = "";
    }

    public function index(){
        $fields = $this->field->get_all_field();

        $this->data['fields'] = $fields;

        $this->data['page_title'] = "Fields plantation pages";
        $this->data['body'] = 'fields/index';


        $this->load->view('template/index' , $this->data);
    }

    public function see( $field = '' ){
        $field = $this->field->get_field( $field );
        $this->data['fields'] = $field;
        $this->data['page_title'] = " Fields page ";
        $this->data['body'] = 'fields/details';
        $this->load->view('template/index' , $this->data);
    }

    public function insert(){
        $this->field->insert_field();

        $this->data['page_title'] = 'Fields Pages/ Add new field';
        $this->data['body'] = 'fields/add_fields';


        redirect(base_url('field/fields/add_details'));
    }
}