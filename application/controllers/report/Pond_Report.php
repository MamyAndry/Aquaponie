<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pond_Report extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('report/Report_Pond' , 'report_pond');
		$this->load->model('report/For_All_CSV' , 'all_csv');
		$this->load->model('ponds/Fish_Pond' , 'fish_pond');
        $this->data['header_product'] 	= "";
        $this->data['header_ponds'] 	= "";
        $this->data['header_home'] 		= "";
        $this->data['header_statistics'] = "";
        $this->data['header_report'] = "active";
        $this->data['header_sale'] = "";
	}

	public function index(){

		$id_pond = $_GET['fish'];
		$this->data['ponds'] = $this->fish_pond->get_fish_ponds();
		$this->data['fish_ponds'] = $this->fish_pond->get_fish_pond_quantity_date($id_pond);

		//$this->data['ponds'] = $this->pond->get_all_ponds();

		$this->data['page_title'] = "Insert Report Pond";
		$this->data['body'] = 'report/Insert_report_pond';
		$this->load->view('template/index' , $this->data);

	}

    public function insert_report_pond(){
        $date = $this->input->post('date');
        $alive = $this->input->post('alive');
        $dead = $this->input->post('dead');
        $id_fish_pond = $this->input->post('id_fish_pond');
		$id_pond = $this->input->post('id_pond');
        $data = $this->all_csv->readCSV('category',2);
		$somme = $this->all_csv->searchAveragePond($data);
		try {
			$this->report_pond->insert_report_pond($somme, $id_fish_pond, $date, $alive, $dead, $id_pond);
			redirect(base_url('/pond/Ponds'));
		} catch (\Exception $e) {
			exit($e->getMessage());
		}

	}

}

?>