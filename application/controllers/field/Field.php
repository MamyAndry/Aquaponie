<?php

class Field extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('field/Field_plantation' , 'field_plantation');
        $this->load->model('statistics/Sale_Plantation_Statistics' , 'plantation_statistics');
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
        $field_plantations = $this->field_plantation->get_field_plantation();

        $this->data['year'] = $this->plantation_statistics->get_all_year();
		$this->data['sold'] = $this->plantation_statistics->get_plantation_sold();
		$this->data['details'] = $this->plantation_statistics->details_sale();
        $this->data['field_plantations'] = $this->field_plantation->add_number_plant( $field_plantations );

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