<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pond_Report extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('report/Report_Pond' , 'report_pond');
		$this->load->model('report/For_All_CSV' , 'all_csv');
		$this->load->model('ponds/Fish_Pond' , 'fish_pond');
		$this->load->model('ponds/Pond' , 'pond');
        $this->data['header_product'] = "text-white";
        $this->data['header_ponds'] = "text-secondary";
        $this->data['header_home'] = "text-secondary";
	}

	public function index(){

		$this->data['ponds'] = $this->pond->get_all_ponds();
		$this->data['page_title'] = "Insert Report Pond";
		$this->data['body'] = 'report/Insert_report_pond';
		$this->load->view('template/index' , $this->data);

	}

    public function insert_report_pond(){
        $date = $this->input->post('date');
        $alive = $this->input->post('alive');
        $dead = $this->input->post('dead');
        $id_pond = $this->input->post('id_pond');
        $data = $this->all_csv->readCSV('category',2);
		$somme = $this->all_csv->searchAveragePond($data);
		try {
			$this->report_pond->insert_report_pond($somme, $id	_pond, $date, $alive, $dead);
		} catch (\Exception $e) {
			exit($e->getMessage());
		}
	}


}

?>