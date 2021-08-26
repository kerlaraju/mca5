<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller{
        public function __construct()
    {
        parent::__construct();
         date_default_timezone_set("Asia/kolkata");
		
		 $this->load->helper('url'); 
        $this->load->model("App_model");
        $this->load->helper("form");
        
    }
    public function index()
    {
       $dashboard_info=$this->App_model->getdashboardinfo();
       
       $this->load->view('Admin/dashboard',$dashboard_info);
      
    }
/* ------------------------------------Alert Message-------------------------------------------------------------------------------- */
public function alert_messages(){
	
	$data=$this->App_model->alert_messages();
	$result['alert_messages']=$data;
	$this->load->view("Admin/alert_messages",$result);
}

public function add_alert(){
	if($_POST){
		$data['message_title']=$this->input->post('message_title');
		$data['message']=$this->input->post('message');
		$data['from_date']=$this->input->post('from_date');
		$data['to_date']=$this->input->post('to_date');
	   
		
		$ins=$this->App_model->add_alert($data);
		$this->session->set_flashdata('smsg',$ins['message']);
		redirect(base_url('index.php/add_alert'));
	}


		$this->load->view('Admin/add_alert');
}


public function delete_alert($message_id)
{
	$sql = $this->db->query("delete from alert_messages where message_id=$message_id");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/alert_messages'));
	}
}


public function edit_alert($message_id)
{
	
		  if($_POST)
	{
		$data['message_id'] = $this->input->post('message_id');
		$data['message_title'] = $this->input->post('message_title');
		$data['message'] = $this->input->post('message');
		$data['from_date'] = $this->input->post('from_date');
		$data['to_date'] = $this->input->post('to_date');
	   
		
		$this->load->model('App_model');
		$upd = $this->App_model->update_alert($data);
		if($upd=='success')
		{
			$this->session->set_flashdata('smsg','Alert Message data updated');
			redirect(base_url('index.php/alert_messages'));
		}
		else{
			$this->session->set_flashdata('wmsg','Something Went wrong');
			redirect(base_url('index.php/edit_alert/'.$data['message_id']));
		}
	}
		$this->load->model('App_model');
		$data['alert_messages']=$this->App_model->get_alert($message_id);
	  
		   $this->load->view('Admin/add_alert',$data);
	
}

/* ------------------------------------Category-------------------------------------------------------------------------------- */
  
    public function category(){
	
	$data=$this->App_model->category();
	$result['category']=$data;
	$this->load->view("Admin/category",$result);
    }

    public function add_cat()
    {   
	if($_POST)
	{
		$data['cat_name']=$this->input->post('cat_name');
		$data['cat_description']=$this->input->post('cat_description');
	
		$new=$this->input->post('is_new');
		$active=$this->input->post('is_active');
		$data['is_new']=isset($new)?1:0;
		$data['is_active']=isset($active)?1:0;
        
        $config['upload_path'] = 'category_images';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
        $config['max_size'] = '100000';
        $config['remove_spaces'] = TRUE;
        $fname=$_FILES["cat_image"]["name"];
        $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
        $config['file_name']='img_'.uniqid().".".$ext;

        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        
        if ( ! $this->upload->do_upload('cat_image'))
        {
            $x['error'] = array('error' => $this->upload->display_errors());
            print_r($config['upload_path']);
            print_r($x['error']);exit;
            
        }
         else
        {
            $data['cat_image']=$config['upload_path']."/".$config['file_name'];
            $x=$this->App_model->add_cat($data);
                       
            
              $this->session->set_flashdata('smsg',$x['message']);  
                           
           
            
            redirect(base_url('index.php/add_cat'));
        }
                
                
                
                
		
			 
	}


		$this->load->view('Admin/add_cat');
    }


    public function delete_cat($cat_id)
    {
	$sql = $this->db->query("delete from category where cat_id=$cat_id");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/category'));
	}
    }


    public function edit_cat($cat_id)
    {
	
	    if($_POST)
	    {
		    $data['cat_id'] = $cat_id;
		    $data['cat_name'] = $this->input->post('cat_name');
		    $data['cat_description'] = $this->input->post('cat_description');
		    $is_new=$this->input->post('is_new');
		    $data['is_new'] = isset($is_new)?1:0;
		    $active=$this->input->post('is_active');
		    $data['is_active']=isset($active)?1:0;
		    $fileupload=$_FILES["cat_image"]["name"];;
		    
		    if(empty($fileupload) == false){
		        $config['upload_path'] = 'category_images';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["cat_image"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('cat_image'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['cat_image']=$config['upload_path']."/".$config['file_name'];
                }
        
        
                
		    }
		    else{
		        $data['cat_image']=$this->input->post('old_file');
		    }
		   
		   
		    $upd = $this->App_model->update_cat($data);
		    if($upd=='success')
		    {
			    $this->session->set_flashdata('smsg','category data updated');
			    redirect(base_url('index.php/category'));
		    }
		    else
		    {
			    $this->session->set_flashdata('wmsg','Something Went wrong');
			    redirect(base_url('index.php/edit_cat/'.$data['cat_id']));
		    }
	   }
		
	    $data['category_info']=$this->App_model->get_category($cat_id);
		$this->load->view('Admin/add_cat',$data);
	
    }
/* ------------------------------------Brand-------------------------------------------------------------------------------- */
    public function brand(){
	
	$data=$this->App_model->brand();
	$result['brand']=$data;
	$this->load->view("Admin/brand",$result);
    }

    public function add_brand()
    {   
	if($_POST)
	{
		$data['cat_id']=$this->input->post('cat_id');
		$data['brand_name']=$this->input->post('brand_name');
		$data['description']=$this->input->post('description');
	
	
		$active=$this->input->post('is_active');
		$data['is_active']=isset($active)?1:0;
        
        $config['upload_path'] = 'brand_images';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
        $config['max_size'] = '100000';
        $config['remove_spaces'] = TRUE;
        $fname=$_FILES["brand_image"]["name"];
        $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
        $config['file_name']='img_'.uniqid().".".$ext;

        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        
        if ( ! $this->upload->do_upload('brand_image'))
        {
            $x['error'] = array('error' => $this->upload->display_errors());
            print_r($config['upload_path']);
            print_r($x['error']);exit;
            
        }
         else
        {
            $data['brand_image']=$config['upload_path']."/".$config['file_name'];
            $x=$this->App_model->add_brand($data);
                       
            
              $this->session->set_flashdata('smsg',$x['message']);  
                           
           
            
            redirect(base_url('index.php/add_brand'));
        }
                
                
                
                
		
			 
	}
        $s['categories']=$this->App_model->category();

		$this->load->view('Admin/add_brand',$s);
    }


    public function delete_brand($brand_id)
    {
	$sql = $this->db->query("delete from brand where brand_id=$brand_id");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/brand'));
	}
    }


    public function edit_brand($brand_id)
    {
	
	    if($_POST)
	    {
		    $data['brand_id'] = $brand_id;
		    $data['cat_id'] = $this->input->post('cat_id');
		    $data['brand_name'] = $this->input->post('brand_name');
		     $data['description'] = $this->input->post('description');
		   
		    $active=$this->input->post('is_active');
		    $data['is_active']=isset($active)?1:0;
		    
		    $fileupload=$_FILES["brand_image"]["name"];
		    
		    if(empty($fileupload) == false){
		        $config['upload_path'] = 'brand_images';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["brand_image"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('brand_image'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['brand_image']=$config['upload_path']."/".$config['file_name'];
                }
        
        
                
		    }
		    else{
		        $data['brand_image']=$this->input->post('old_file');
		    }
		   
		   
		    $upd = $this->App_model->update_brand($data);
		    if($upd=='success')
		    {
			    $this->session->set_flashdata('smsg','brand data updated');
			    redirect(base_url('index.php/brand'));
		    }
		    else
		    {
			    $this->session->set_flashdata('wmsg','Something Went wrong');
			    redirect(base_url('index.php/edit_brand/'.$data['brand_id']));
		    }
	   }
		
	    $data['brand_info']=$this->App_model->get_brand($brand_id);
	    $data['categories']=$this->App_model->category();
	    
		$this->load->view('Admin/add_brand',$data);
	
    }
/* --------------------------------------------Prouct----------------------------------------------------------------------------- */
public function product_master(){
	$this->load->model('App_model');
	$data=$this->App_model->product_master();
	$result['product_master']=$data;
	$this->load->view("Admin/product_master",$result);
}

public function add_product(){
    $data1['category_list']=$this->App_model->category();
    
	if($_POST){
		$data['cat_id']=$this->input->post('cat_id');
		$data['brand_id']=$this->input->post('brand_id');
		$data['product_name']=$this->input->post('product_name');
		$data['description']=$this->input->post('description');
		
		$data['CGST']=$this->input->post('CGST');
		$data['SGST']=$this->input->post('SGST');
		$data['IGST']=$this->input->post('IGST');
		$data['HSN_CODE']=$this->input->post('HSN_CODE');
		$active=$this->input->post('is_active');
        $data['is_active']=isset($active)?1:0;
		
		$pimage=$_FILES["product_image"]["name"];
		 
		    if(!empty($pimage) === true){
		        $config['upload_path'] = 'product_images';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["product_image"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('product_image'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['product_img']=$config['upload_path']."/".$config['file_name'];
                }
   
		    }
		    else{
		        $data['product_img']="";
		    }
		    
		    
		   $pvideo=$_FILES["product_video"]["name"];
		    if(!empty($pvideo) === true){
		        $config['upload_path'] = 'product_images';
                $config['allowed_types'] = 'mp4|mpeg|mov|vob|flv';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["product_video"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('product_video'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['product_video']=$config['upload_path']."/".$config['file_name'];
                }
        
        
                
		    }
		    else{
		        $data['product_video']="";
		    }

		$ins=$this->App_model->add_pro($data);
		if(!empty($ins)){
		 
		    $this->session->set_flashdata('smsg',$ins['message']);
			redirect(base_url('index.php/add_pro'));
		}
			 
	}


		$this->load->view('Admin/add_pro',$data1);
}


public function delete_pro($pid)
{
	$sql = $this->db->query("delete from product_master where pid=$pid");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/product_master'));
	}
}


public function edit_pro($pid)
{
	
		  if($_POST)
	{
		$data['pid'] = $pid;
		$data['cat_id'] = $this->input->post('cat_id');
		$data['brand_id'] = $this->input->post('brand_id');
		$data['product_name'] = $this->input->post('product_name');
		$data['description'] = $this->input->post('description');
		$data['product_img'] = $this->input->post('product_img');
		$data['product_video'] = $this->input->post('product_video');
		$data['CGST'] = $this->input->post('CGST');
		$data['SGST'] = $this->input->post('SGST');
		$data['IGST'] = $this->input->post('IGST');
		$data['HSN_CODE'] = $this->input->post('HSN_CODE');
		
		$pimage=$_FILES["product_image"]["name"];
		 
		    if(!empty($pimage) === true){
		        $config['upload_path'] = 'product_images';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["product_image"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('product_image'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['product_img']=$config['upload_path']."/".$config['file_name'];
                }
   
		    }
		    else{
		        $data['product_img']=$this->input->post('old_image');
		    }



			$pvideo=$_FILES["product_video"]["name"];
		    if(!empty($pvideo) === true){
		        $config['upload_path'] = 'product_images';
                $config['allowed_types'] = 'mp4|mpeg|mov|vob|flv';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["product_video"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('product_video'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['product_video']=$config['upload_path']."/".$config['file_name'];
                }
        
        
                
		    }
		    else{
		        $data['product_video']=$this->input->post('old_video');
		    }




		$upd = $this->App_model->update_pro($data);
		if($upd=='success')
		{
			$this->session->set_flashdata('smsg','Product data updated');
			redirect(base_url('index.php/product_master'));
		}
		else{
			$this->session->set_flashdata('wmsg','Something Went wrong');
			redirect(base_url('index.php/edit_pro/'.$data['pid']));
		}
	}
		
		$data1['pinfo']=$this->App_model->get_pro($pid);
		$data1['category_list']=$this->App_model->category();
		$data1['brandinfo']=$this->App_model->brand();
		   $this->load->view('Admin/add_pro',$data1);
	
}


/* --------------------------------------State----------------------------------------------------------------------------------- */
   public function state_master(){
	
        $data=$this->App_model->state_master();
        $result['state_master']=$data;
        $this->load->view("Admin/state_master",$result);
    }

    public function add_state(){
        if($_POST){
			$data['state']=$this->input->post('state');
           
            
            $ins=$this->App_model->add_state($data);
            $this->session->set_flashdata('smsg',$ins['message']);
            redirect(base_url('index.php/add_state'));
        }


            $this->load->view('Admin/add_state');
    }


    public function delete_state($state_id)
    {
        $sql = $this->db->query("delete from state_master where state_id=$state_id");
        if($sql)
        {
            $this->session->set_flashdata('smsg','Record Deleted Successfully');
				redirect(base_url('index.php/state_master'));
        }
    }


    public function edit_state($state_id)
    {
        
              if($_POST)
        {
            $data['state_id'] = $this->input->post('state_id');
			$data['state'] = $this->input->post('state');
           
            
			$this->load->model('App_model');
            $upd = $this->App_model->update_state($data);
            if($upd=='success')
            {
                $this->session->set_flashdata('smsg','state_master data updated');
                redirect(base_url('index.php/state_master'));
            }
            else{
                $this->session->set_flashdata('wmsg','Something Went wrong');
                redirect(base_url('index.php/edit_state/'.$data['state_id']));
            }
        }
			$this->load->model('App_model');
			$data['state']=$this->App_model->get_state($state_id);
          
       		$this->load->view('Admin/add_state',$data);
        
    }

/* --------------------------------------District----------------------------------------------------------------------------------- */
public function district_master(){

	$data=$this->App_model->district_master();
	$result['district_master']=$data;
	$this->load->view("Admin/district_master",$result);
}

public function add_dis(){
    $s['states']=$this->App_model->state_master();
	if($_POST){
		$data['state_id']=$this->input->post('state_id');
		$data['district']=$this->input->post('district');
		
		$ins=$this->App_model->add_dis($data);
		if(!empty($ins)){
		 
			$this->session->set_flashdata('code',$ins['code']);
			$this->session->set_flashdata('smsg',$ins['message']);

		//    print_r($this->session->flashdata('code'));
		//    print_r($this->session->flashdata('msg'));
		//    exit;
			redirect(base_url('index.php/add_dis'));
		}
			 
	}


		$this->load->view('Admin/add_dis',$s);
}


public function delete_dis($district_id )
{
	$sql = $this->db->query("delete from district_master where district_id=$district_id");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/district_master'));
	}
}


public function edit_dis($district_id)
{
	 $s['states']=$this->App_model->state_master();
	 $s['district_info']=$this->App_model->get_dis($district_id);
	if($_POST)
	{
		$data['district_id'] = $district_id;
		$data['state_id'] = $this->input->post('state_id');
		$data['district'] = $this->input->post('district');
		
		$this->load->model('App_model');
		$upd = $this->App_model->update_dis($data);
		if($upd=='success')
		{
			$this->session->set_flashdata('smsg','district data updated');
			redirect(base_url('index.php/district_master'));
		}
		else{
			$this->session->set_flashdata('wmsg','Something Went wrong');
			redirect(base_url('index.php/edit_dis/'.$data['district_id']));
		}
	}
		$this->load->model('App_model');
	
		   $this->load->view('Admin/add_dis',$s);
	
}
/* -----------------------------------Vendor-------------------------------------------------------------------------------------- */
public function vendor_rating(){
	$this->load->model('App_model');
	$data=$this->App_model->vendor_rating();
	$result['vendor_rating']=$data;
	$this->load->view("Admin/vendor_rating",$result);
}

public function add_ven(){
	if($_POST){
		$data['member_id']=$this->input->post('member_id');
		$data['no_of_points']=$this->input->post('no_of_points');
		$this->load->model('App_model');
		$ins=$this->App_model->add_ven($data);
		if(!empty($ins)){
		 
			$this->session->set_flashdata('code',$ins['code']);
			$this->session->set_flashdata('msg',$ins['message']);

		//    print_r($this->session->flashdata('code'));
		//    print_r($this->session->flashdata('msg'));
		//    exit;
			redirect(base_url('index.php/Admin/add_ven'));
		}
			 
	}


		$this->load->view('Admin/add_ven');
}


public function delete_ven($id)
{
	$sql = $this->db->query("delete from vendor_rating where id=$id");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/Admin/vendor_rating'));
	}
}


public function edit_ven($id)
{
	
		  if($_POST)
	{
		$data['id'] = $this->input->post('id');
		$data['member_id'] = $this->input->post('member_id');
		$data['no_of_points'] = $this->input->post('no_of_points');
		
		$this->load->model('App_model');
		$upd = $this->App_model->update_ven($data);
		if($upd=='success')
		{
			$this->session->set_flashdata('smsg','Vendor data updated');
			redirect(base_url('index.php/Admin/vendor_rating'));
		}
		else{
			$this->session->set_flashdata('wmsg','Something Went wrong');
			redirect(base_url('index.php/edit_ven/'.$data['id']));
		}
	}
		$this->load->model('App_model');
		$data['member_id']=$this->App_model->get_ven($id);
		$data['no_of_points']=$this->App_model->get_ven($id);
		   $this->load->view('Admin/add_ven',$data);
	
}


public function vendors(){
    $this->load->view('Admin/view_vendors.php');
}


public function approve_vendor()
{
    $data=$this->App_model->app_vendor();
	$result['app_vendor']=$data;
	$this->load->view("Admin/approve_vendor",$result);
    
}
public function approve($id){
    $memberid=$id;
    $qry="update user_profile set role=3 where member_id='$id'";
    $x=$this->db->query($qry);
    if($x){
        $this->session->set_flashdata('smsg','User approved successfully');
			    redirect(base_url('index.php/approve_vendor')); 

    }else{
        $this->session->set_flashdata('smsg','Something went wrong');
			    redirect(base_url('index.php/approve_vendor')); 

    }
}


public function view_users(){
    $s['users']=$this->App_model->get_users();
    $this->load->view("Admin/list_users.php",$s);
}

public function bulk_vendors(){
    $type=1;
    $s['users']=$this->App_model->get_users_type($type);
     $this->load->view("Admin/list_users.php",$s);
}

public function retail_vendors(){
     $type=2;
    $s['users']=$this->App_model->get_users_type($type);
     $this->load->view("Admin/list_users.php",$s);
}
public function special_vendors(){
    $type=3;
     $s['users']=$this->App_model->get_users_type($type);
     $this->load->view("Admin/list_users.php",$s);
}

public function view_user_info($userid){
    $sql="select UP.*,SM.state,DM.district from user_profile UP left join district_master DM on UP.district_id=DM.district_id left join state_master SM on UP.state_id=SM.state_id where trim(UP.member_id)='$userid'";
    $s['userinfo']=$this->db->query($sql)->row();
    
    $this->load->view('Admin/view_user_info.php',$s);
}

public function add_vendor(){
    if($_POST){
        $id="BS".rand(1000000,9999999);
        $data['member_id']=$id;
        $data['role']=$this->input->post('role');
        $data['name']=$this->input->post('name');
        $data['mobileno']=$this->input->post('mobileno');
        $data['location']=$this->input->post('location');
        $data['lat']=$this->input->post('lat');
        $data['lang']=$this->input->post('lang');
        $data['gstno']=$this->input->post('gstno');
        $data['email']=$this->input->post('email');
        $data['district_id']=$this->input->post('district_id');
        $data['state_id']=$this->input->post('state_id');
        $active=$this->input->post('is_active');
        $data['is_active']=isset($active)?1:0;
        $data['pincode']=$this->input->post('pincode');
        
        	 $gstimage=$_FILES['gstimg']['name'];
        	
		    if(!empty($gstimage) === true){
		        $config['upload_path'] = 'gst_images';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["gstimg"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='gstimg_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('gstimg'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['gstimg']=$config['upload_path']."/".$config['file_name'];
                }
   
		    }
		    else{
		        $data['gstimg']="";
		    }
		    
		    
		    $pimage=$_FILES["profilepic"]["name"];
		    if(!empty($pimage) === true){
		        $config['upload_path'] = 'profile_images';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["profilepic"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='prof_img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('profilepic'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['profilepic']=$config['upload_path']."/".$config['file_name'];
                }
   
		    }
		    else{
		       $data['profilepic']=""; 
		    }
		    
		    
		    $ins=$this->App_model->add_vendor($data);
		    if($ins=="success"){
		       $this->session->set_flashdata('smsg','Vendor Registered successfully');
			    redirect(base_url('index.php/add_vendor')); 
		    }
		    else{
		        $this->session->set_flashdata('smsg','Something went wrong....');
			    redirect(base_url('index.php/add_vendor')); 
		    }
        
        
    }
    $s['states']=$this->db->get("state_master")->result();
    $this->load->view('Admin/add_vendor.php',$s);
}

public function check_mobileno(){
    $mobileno=$this->input->post('mobileno');
    $check=$this->db->get_where('user_profile',array("mobileno"=>$mobileno))->num_rows();
    if($check==1){
        echo json_encode(array("code"=>1));
    }
    else{
          echo json_encode(array("code"=>2));
    }
} 

function get_brands(){
	$cat_id=$this->input->post('cat_id');
	$sql="select * from brand where cat_id=$cat_id and is_active=1";
	$brands=$this->db->query($sql)->result();
	echo json_encode($brands);
}
function get_districts(){
    $state_id=$this->input->post('state_id');
    $districts=$this->db->get_where("district_master",array("state_id"=>$state_id))->result();;
    echo json_encode($districts);
}


function edit_user($id){
    $s['userinfo']=$this->db->get_where("user_profile",array('member_id'=>$id))->row();
    $s['states']=$this->db->get("state_master")->result();
    $s['districts']=$this->db->get("district_master")->result();
    $this->load->view("Admin/add_vendor.php",$s);
}
/* ------------------Radius------------------------------------------------------------------------------------------------------- */
 public function radius_master(){
	
	$data=$this->App_model->radius_master();
	$result['radius_master']=$data;
	$this->load->view("Admin/radius_master",$result);
    }

   
    public function delete_radius($radius_id)
    {
	$sql = $this->db->query("delete from radius_master where radius_id=$radius_id");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/radius_master'));
	}
    }


    public function edit_radius($radius_id)
    {
	
	    if($_POST)
	    {
		    $data['radius_master'] = "";
		   
		   
		    $upd = $this->App_model->update_radius($data);
		    if($upd=='success')
		    {
			    $this->session->set_flashdata('smsg','Radius data updated');
			    redirect(base_url('index.php/radius_master'));
		    }
		    else
		    {
			    $this->session->set_flashdata('wmsg','Something Went wrong');
			    redirect(base_url('index.php/edit_radius/'.$data['radius_id']));
		    }
	   }
		
	    $data['radius_info']=$this->App_model->get_radius($radius_id);
		$this->load->view('Admin/edit_radius',$data);
	
    }
/* -----------------------------Banner-------------------------------------------------------------------------------------------- */
 public function banner_master(){
	
	$data=$this->App_model->banner_master();
	$result['banner_master']=$data;
	$this->load->view("Admin/banner_master",$result);
    }

    public function add_banner()
    {   
	if($_POST)
	{
		$data['screen']=$this->input->post('screen');
		$data['banner_name']=$this->input->post('banner_name');
			$data['navigation_url']=$this->input->post('navigation_url');
		$data['banner_order']=$this->input->post('banner_order');
	
	
		$active=$this->input->post('is_active');
		$data['is_active']=isset($active)?1:0;
        
        $config['upload_path'] = 'banner_files';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
        $config['max_size'] = '100000';
        $config['remove_spaces'] = TRUE;
        $fname=$_FILES["banner_image"]["name"];
        $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
        $config['file_name']='img_'.uniqid().".".$ext;

        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        
        if ( ! $this->upload->do_upload('banner_image'))
        {
            $x['error'] = array('error' => $this->upload->display_errors());
            print_r($config['upload_path']);
            print_r($x['error']);exit;
            
        }
         else
        {
            $data['banner_image']=$config['upload_path']."/".$config['file_name'];
            $x=$this->App_model->add_banner($data);
                       
            
              $this->session->set_flashdata('smsg',$x['message']);  
                           
           
            
            redirect(base_url('index.php/add_banner'));
        }
                
                
                
                
		
			 
	}


		$this->load->view('Admin/add_banner');
    }


    public function delete_banner($banner_id)
    {
	$sql = $this->db->query("delete from banner_master where banner_id=$banner_id");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/banner_master'));
	}
    }


    public function edit_banner($banner_id)
    {
	
	    if($_POST)
	    {
		    $data['banner_id'] = $banner_id;
		    $data['screen'] = $this->input->post('screen');
		    $data['banner_name'] = $this->input->post('banner_name');
		     $data['navigation_url'] = $this->input->post('navigation_url');
		    $data['banner_order'] = $this->input->post('banner_order');
		   
		    $active=$this->input->post('is_active');
		    $data['is_active']=isset($active)?1:0;
		    
		    $fileupload=$_FILES["banner_image"]["name"];;
		    echo $fileupload;exit;
		    if(empty($fileupload) == false){
		        $config['upload_path'] = 'banner_files';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["banner_image"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('banner_image'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['banner_image']=$config['upload_path']."/".$config['file_name'];
                }
        
        
                
		    }
		    else{
		        $data['banner_image']=$this->input->post('old_file');
		    }
		   
		   
		    $upd = $this->App_model->update_banner($data);
		    if($upd=='success')
		    {
			    $this->session->set_flashdata('smsg','Banner data updated');
			    redirect(base_url('index.php/banner_master'));
		    }
		    else
		    {
			    $this->session->set_flashdata('wmsg','Something Went wrong');
			    redirect(base_url('index.php/edit_banner/'.$data['banner_id']));
		    }
	   }
		
	    $data['banner_info']=$this->App_model->get_banner($banner_id);
		$this->load->view('Admin/add_banner',$data);
	
    }

/*
    public function delete_cat($cat_id)
    {
	$sql = $this->db->query("delete from category where cat_id=$cat_id");
	if($sql)
	{
		$this->session->set_flashdata('smsg','Record Deleted Successfully');
			redirect(base_url('index.php/category'));
	}
    }


    public function edit_cat($cat_id)
    {
	
	    if($_POST)
	    {
		    $data['cat_id'] = $cat_id;
		    $data['cat_name'] = $this->input->post('cat_name');
		    $data['cat_description'] = $this->input->post('cat_description');
		    $is_new=$this->input->post('is_new');
		    $data['is_new'] = isset($is_new)?1:0;
		    $active=$this->input->post('is_active');
		    $data['is_active']=isset($active)?1:0;
		    $fileupload=$_FILES["cat_image"]["name"];;
		    echo $fileupload;exit;
		    if(empty($fileupload) == false){
		        $config['upload_path'] = 'category_images';
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|JPEG|svg';
                $config['max_size'] = '100000';
                $config['remove_spaces'] = TRUE;
                $fname=$_FILES["cat_image"]["name"];
                $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
        
                $config['file_name']='img_'.uniqid().".".$ext;

                $this->load->library('upload', $config);
                $this->upload->initialize($config); 
                
                if ( ! $this->upload->do_upload('cat_image'))
                {
                    $x['error'] = array('error' => $this->upload->display_errors());
                    print_r($config['upload_path']);
                    print_r($x['error']);exit;
            
                }
                else{
                    $data['cat_image']=$config['upload_path']."/".$config['file_name'];
                }
        
        
                
		    }
		    else{
		        $data['cat_image']=$this->input->post('old_file');
		    }
		   
		   
		    $upd = $this->App_model->update_cat($data);
		    if($upd=='success')
		    {
			    $this->session->set_flashdata('smsg','category data updated');
			    redirect(base_url('index.php/category'));
		    }
		    else
		    {
			    $this->session->set_flashdata('wmsg','Something Went wrong');
			    redirect(base_url('index.php/edit_cat/'.$data['cat_id']));
		    }
	   }
		
	    $data['category_info']=$this->App_model->get_category($cat_id);
		$this->load->view('Admin/add_cat',$data);
	
    }
    */
/* ------------------------------------------------------------------------------------------------------------------------- */
/* ------------------------------------------------------------------------------------------------------------------------- */
}
