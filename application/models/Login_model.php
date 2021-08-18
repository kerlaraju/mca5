<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Login_model extends CI_Model{
   
    function __construct(){
        parent::__construct();    
    }
    public function check_login($data){
        $pwd=$data['password'];
        $data['password']=md5($pwd);
       // print_r($data);exit;
        $check_user=$this->db->get_where('admin_users',array('userid'=>$data['userid'],'password'=>$data['password']));
        if($check_user->num_rows()==1){
            return "success";
        }
        else{
            return "failed";
        }
    }
}