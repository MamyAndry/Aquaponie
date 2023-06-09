<?php

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('auth/Profile', 'profile');
        $this->load->model('auth/User', 'aqua_user');
        $unities = get_unities();
        $this->data['unities'] = $unities;
        $this->data['header_product'] = "text-white";
        $this->data['header_ponds'] = "text-secondary";
        $this->data['header_home'] = "text-secondary";
        $this->data['header_statistcs'] = "text-secondary";
    }

    public function index(){
        $this->display_profile();
    }

    public function sign_in(){
        if(isset($_POST['identifier'], $_POST['password'])){
            if($this->aqua_user->sign_in($_POST['identifier'], 
                $_POST['password'])){
                    echo $_SESSION['user']->name;
                }else echo "error";
        }else echo "error";
    }

    public function display_profile(){
        $this->data['profiles'] = $this->profile->get_all_profile();
        $this->data['page_title'] = 'Login';
        $this->data['body'] = 'auth/login';

        $this->load->view('template/index', $this->data);
    }

}