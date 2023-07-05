<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Field_Report extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('report/Report_Field' , 'report_field');
		$this->load->model('report/For_All_CSV' , 'all_csv');
		// $this->load->model('ponds/Fish_Pond' , 'fish_pond');
        $this->data['header_product'] 	= "";
        $this->data['header_ponds'] 	= "";
        $this->data['header_home'] 		= "";
        $this->data['header_statistics'] = "";
        $this->data['header_report'] = "active";
        $this->data['header_sale'] = "";
	}

	public function index(){
		$this->data['fields'] = $this->field_plantation->get_field_plantation();
		$this->data['page_title'] = "Insert Field Plantation";
		$this->data['body'] = 'report/Insert_report_field';
		$this->load->view('template/index', $this->data);
	}

    public function insert_report_field(){
        $date = $this->input->post('date');
        $density = $this->input->post('density');
        $surface = $this->input->post('surface');
        $id_field_plantation = $this->input->post('id_field_plantation');
        $data = $this->all_csv->readCSV('weight',1);
		$weight = $this->all_csv->searchAverageField($data);
		$this->report_field->insert_report_field($id_field_plantation, $date, $weight, $density, $surface);
		redirect(base_url('report/Field_Report'));
    }


}

?>