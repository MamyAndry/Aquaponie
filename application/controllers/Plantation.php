<?php

class Plantation extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('plantation/Type_Plantation' , 'plantation');
        $unities = get_unities();
        $this->data['unities'] = $unities;
        $this->data['header_product'] = "active";
        $this->data['header_ponds'] = "";
        $this->data['header_home'] = "";
        $this->data['header_statistics'] = "";
        $this->data['header_report'] = "";
        $this->data['header_sale'] = "";
    }

    // To list all type of fishes
    public function index(){

        $plantations = $this->plantation->get_all_type();

        $this->data['plantations'] = $plantations;

        $this->data['page_title'] = "Plantations Pages";
        $this->data['body'] = 'plantation/index';

        $this->load->view('template/index' , $this->data);

    }

    // For seeing details for one type of fish
    public function see( $plantation = '' ){
        try{
            $plantations = $this->plantation->get_Plantation( $plantation );
            $this->data['plantations'] = $plantations;
            $this->data['page_title'] = " Plantation page ";
            $this->data['body'] = 'plantation/abouts';
            $this->load->view('template/index' , $this->data);
        }catch(Exception $e){
            echo $e->getMessage();
        }

    }

    public function insert(){
        $this->data['page_title'] = "Plantation Pages / Insert Plantation";
        $this->data['body'] = 'plantation/insert_plantation';
        $this->load->view('template/index' , $this->data);
    }

    public function save(){
        $config = array(

            array(
                'field' => 'type',
                'label' => 'type of fish',
                'rules' => 'required',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),
            array(
                'field' => 'w_max_baby',
                'label' => 'max weight when baby',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),
            array(
                'field' => 'w_max_semi_mature',
                'label' => 'max weight when semi-mature',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '<span class="text-danger"> You must provide a %s </span>'
                )
            ),

        );

        // Avy eo mametaka an'izany form_validation izany ka
        $this->form_validation->set_rules( $config );
        if (!$this->form_validation->run()){
            $this->insert();
            return;
        }
        $type 		= $this->input->post('type');
        $w_max_baby = $this->input->post('w_max_baby');
        $w_max_semi_mature 	= $this->input->post('w_max_semi_mature');

        try {
            $this->plantation->insert_type_plantation( $type, $w_max_baby, $w_max_semi_mature );
        } catch (\Exception $e) {
			exit($e->getMessage());
        }
        redirect(base_url('plantation'));
    }
}