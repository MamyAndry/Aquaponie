<?php

class Plantation extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('plantation/Type_Plantation' , 'plantation');
    }

    // To list all type of fishes
    public function index(){

        $plantations = $this->plantation->get_all_type();

        $data['header_plantation'] = "text-white";
        $data['header_fish'] = "text-secondary";
        $data['plantations'] = $plantations;
        $data['page_title'] = "Plantations Pages";
        $data['body'] = 'plantation/index';

        $this->load->view('template/index' , $data);

    }

    public function insert(){
        $data['header_plantation'] = "text-white";
        $data['header_fish'] = "text-secondary";
        $data['page_title'] = "Plantation Pages / Insert Plantation";
        $data['body'] = 'plantation/insert_plantation';

        $this->load->view('template/index' , $data);
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


        $this->plantation->insert_type_plantation( $type, $w_max_baby, $w_max_semi_mature );
        redirect(base_url('plantation'));
    }
}