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

		$this->data['ponds'] = $this->fish_pond->get_fish_ponds();
		$this->data['page_title'] = "Insert Report Field";
		$this->data['body'] = 'report/Insert_report_pond';
		$this->load->view('template/index' , $this->data);

	}

	public function save(){
		
	}

    public function insert_report_field(){
        $date = $this->input->post('date');
        $alive = $this->input->post('alive');
        $dead = $this->input->post('dead');
        $name = 'category';
        $id_fish_pond = $this->input->post('id_fish_pond');
        $data = $this->all_csv->readCSV($name);
		$somme = $this->all_csv->searchAverage($data);
		$this->report_pond->insert_report_pond($somme, $id_fish_pond, $date, $alive, $dead);
    }


}

?>