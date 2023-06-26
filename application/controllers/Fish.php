<?php

class Fish extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $data = array();
    }
    public function index(){
        $this->load->view('fish');
    }
    public function insert_type_fish(){
        $this->load->model('fish/Type_fish', 'type_fish');
        $name_type_fish = $this->input->post('name_type_fish');
        $maturity_period = $this->input->post('maturity_period');
        $maturity_size = $this->input->post('maturity_size');
        try{
            $this->type_fish->insert_type_fish($name_type_fish, $maturity_period, $maturity_size);
        }catch (Exception $e){
            $data['error'] = $e->getMessage();
        }
    }
}