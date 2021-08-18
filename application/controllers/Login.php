<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         $this->load->model("Login_model");
        $this->load->helper("form");
        
    }
    public function index(){
        if($_POST){
            $data['userid']=$this->input->post('userid');
            $data['password']=$this->input->post('password');
            
            $check_login=$this->Login_model->check_login($data);
            //print_r($check_login);exit;
            if($check_login=='success'){
                $this->session->set_userdata("userid",$data['userid']);
                redirect(base_url("index.php/dashboard"));
            }
            else{
                $this->session->set_flashdata('swmsg',"Invalid login details.....");
                redirect(base_url());
            }
        }
        $this->load->view('Login/login');
    }
    
    public function check_login(){
        
    }
}
?>