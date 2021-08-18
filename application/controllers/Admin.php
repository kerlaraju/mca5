<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         //$this->load->model("Login_model");
        $this->load->helper("form");
        
    }
    public function index(){
       $this->load->view('Admin/dashboard');
    }
    
    
}
?>