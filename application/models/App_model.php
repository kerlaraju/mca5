<?php
class App_model extends CI_model {
   
/* ----------------------------------Dashboard info ------------------------------------------------------------------*/
public function getdashboardinfo(){
    $users=$this->db->get_where('user_profile',array("is_active"=>"1"));
    $data['users_count']=$users->num_rows();
    $bulk_vendors=$this->db->get_where('user_profile',array("role"=>"1"));
    $data['bulk_vendors']=$bulk_vendors->num_rows();
    $retail_vendors=$this->db->get_where('user_profile',array("role"=>"2"));
    $data['retail_vendors']=$retail_vendors->num_rows();
    $special_customers=$this->db->get_where('user_profile',array("role"=>"3"));
    $data['special_customers']=$special_customers->num_rows();
    $gen_users=$this->db->get_where('user_profile',array("role"=>"4"));
    $data['gen_users']=$gen_users->num_rows();
    $data['products_count']=$this->db->get('product_master')->num_rows();
    $data['orders_count']=$this->db->get("order_master")->num_rows();
    $order_value=$this->db->query("select sum(order_amount) as sum from order_master where trim( payment_status )='PAID'")->row();
    //print_r($order_value);exit;
    $data['orders_value']=$order_value->sum;
    return $data;
}
/* ------------------------------------Alert Message-------------------------------------------------------------------------------- */
public function alert_messages(){
        
    $query=$this->db->get('alert_messages');
    $data=$query->result();
    return $data;
}

public function add_alert($data){
    $check_alert=$this->db->get_where('alert_messages',array("message_title"=>$data['message_title']));
  
    
    if($check_alert->num_rows()>0){
        $data['message']="Alert Message ".$data['message_title']." Already Exists";
     
    }
    else{
        $insert=$this->db->insert('alert_messages',$data);
        if($insert){
            
            $data['message']="Alert Message ".$data['message_title']." Added Successfully";
           
        }else{
           
            $data['message']='Something Went Wrong';
        }
    }
    return $data;
}

public function update_alert($data)
{
   
    $id = $data['message_id'];
    unset($data['message_id']);
    $upd = $this->db->where('message_id',$id);
           $this->db->update('alert_messages',$data);
    if($upd)
    {
        return "success";
    }else{
        return "error";
    }
}


public function get_alert($message_id){

    $array = array('message_id'=>$message_id);
    $data = $this->db->get_where('alert_messages',$array)->row();
    
    return $data;
}


/* ------------------------------------Category-------------------------------------------------------------------------------- */
    public function category(){
        
        $query=$this->db->get('category');
        $data=$query->result();
        return $data;
    }
    public function add_cat($data){
        $check_category=$this->db->get_where('category',array("cat_name"=>$data['cat_name']));
        
        if($check_category->num_rows()>0){
            $data['code']='2';
            $data['message']="category ".$data['cat_name']." Already Exists";
         
        }
        else{
            $insert=$this->db->insert('category',$data);
            if($insert){
                $data['code']='4';
                $data['message']="category ".$data['cat_name']." Added Successfully";
                
                
            }else{
                $data['code']='1';
                $data['message']='Something Went Wrong';
            }
        }
        return $data;
    }

    public function update_cat($data)
    {
       
        $id = $data['cat_id'];
        unset($data['cat_id']);
        $upd = $this->db->where('cat_id',$id);
               $this->db->update('category',$data);
        if($upd)
        {
            return "success";
        }else{
            return "error";
        }
    }


    public function get_category($cat_id){

       $data = $this->db->get_where('category',array('cat_id'=>$cat_id))->row();
        
        return $data;


    }
/* ------------------------------------Brand-------------------------------------------------------------------------------- */

     public function brand(){
        $sql="select B.*,C.cat_name from brand B left join category C on B.cat_id=C.cat_id";
        $query=$this->db->query($sql);
        $data=$query->result();
        return $data;
    }
    public function add_brand($data){
        $check_brand=$this->db->get_where('brand',array("brand_name"=>$data['brand_name']));
        
        if($check_brand->num_rows()>0){
            $data['code']='2';
            $data['message']="brand ".$data['brand_name']." Already Exists";
         
        }
        else{
            $insert=$this->db->insert('brand',$data);
            if($insert){
                $data['code']='4';
                $data['message']="brand ".$data['brand_name']." Added Successfully";
                
                
            }else{
                $data['code']='1';
                $data['message']='Something Went Wrong';
            }
        }
        return $data;
    }

    public function update_brand($data)
    {
       
        $id = $data['brand_id'];
        unset($data['brand_id']);
        $upd = $this->db->where('brand_id',$id);
               $this->db->update('brand',$data);
        if($upd)
        {
            return "success";
        }else{
            return "error";
        }
    }


    public function get_brand($brand_id){

       $data = $this->db->get_where('brand',array('brand_id'=>$brand_id))->row();
        
        return $data;


    }
/* ----------------------------------------Product--------------------------------------------------------------------------------- */
public function product_master(){
    $qry="select PM.*,C.cat_name,B.brand_name from product_master PM left join category C on PM.cat_id=C.cat_id left join brand B on B.brand_id=PM.brand_id ";    
    $query=$this->db->query($qry);
    $data=$query->result();
    return $data;
}

public function add_pro($data){

    $check_pro=$this->db->get_where('product_master',array("HSN_CODE"=>$data['HSN_CODE']));
    
    if($check_pro->num_rows()>0){
        
        $data['message']="Product ".$data['product_name']." Already Exists";
     
    }
    else{
      
        $insert=$this->db->insert('product_master',$data);
        if($insert){
            $data['code']='2';
           
            $data['message']="Product ".$data['product_name']." Added Successfully";
           
        }else{
            $data['code']='1';
            $data['message']='Something Went Wrong';
        }
    }
    return $data;
}

public function update_pro($data)
{
   
    $id = $data['pid'];
    unset($data['pid']);
    $upd = $this->db->where('pid',$id);
           $this->db->update('product_master',$data);
    if($upd)
    {
        return "success";
    }else{
        return "error";
    }
}


public function get_pro($pid){

    $array = array('pid'=>$pid);
    
    $data = $this->db->get_where('product_master',$array)->row();
    
    return $data;


}



/* -----------------------------------------State-------------------------------------------------------------------------------- */
 
public function state_master(){
        
    $query=$this->db->get('state_master');
    $data=$query->result();
    return $data;
}

public function add_state($data){
    $check_state=$this->db->get_where('state_master',array("state"=>$data['state']));
  
    
    if($check_state->num_rows()>0){
        $data['message']="State ".$data['state']." Already Exists";
     
    }
    else{
        $insert=$this->db->insert('state_master',$data);
        if($insert){
            
            $data['message']="State ".$data['state']." Added Successfully";
           
        }else{
           
            $data['message']='Something Went Wrong';
        }
    }
    return $data;
}

public function update_state($data)
{
   
    $id = $data['state_id'];
    unset($data['state_id']);
    $upd = $this->db->where('state_id',$id);
           $this->db->update('state_master',$data);
    if($upd)
    {
        return "success";
    }else{
        return "error";
    }
}


public function get_state($state_id){

    $array = array('state_id'=>$state_id);
    $data = $this->db->get_where('state_master',$array)->row();
    
    return $data;
}

/* ----------------------------------------District--------------------------------------------------------------------------------- */
public function district_master(){
    $sql="Select DM.*,SM.state from district_master DM left join state_master SM on SM.state_id=DM.state_id";   
    $query=$this->db->query($sql);
    $data=$query->result();
    return $data;
}

public function add_dis($data){
    $check_dis=$this->db->get_where('district_master',array("state_id"=>$data['state_id']));
    $check_dis=$this->db->get_where('district_master',array("district"=>$data['district']));
    
    if($check_dis->num_rows()>0){
        $data['code']='2';
        $data['message']="District".$data['district']." Already Exists";
     
    }
    else{
        $insert=$this->db->insert('district_master',$data);
        if($insert){
            $data['code']='1';
            $data['message']="District".$data['state_id']." Added Successfully";
            $data['message']="District".$data['district']." Added Successfully";
        }else{
            $data['code']='1';
            $data['message']='Something Went Wrong';
        }
    }
    return $data;
}

public function update_dis($data)
{
   
    $id = $data['district_id'];
    unset($data['district_id']);
    $upd = $this->db->where('district_id',$id);
           $this->db->update('district_master',$data);
    if($upd)
    {
        return "success";
    }else{
        return "error";
    }
}


public function get_dis($district_id){

    $array = array('district_id'=>$district_id);
    $data = $this->db->get_where('district_master',$array)->row();
    
    return $data;


}
/* --------------------------------Vendor----------------------------------------------------------------------------------------- */
public function vendor_rating(){
        
    $query=$this->db->get('vendor_rating');
    $data=$query->result();
    return $data;
}

public function add_ven($data){
    $check_ven=$this->db->get_where('vendor_rating',array("member_id"=>$data['member_id']));
    $check_ven=$this->db->get_where('vendor_rating',array("no_of_points"=>$data['no_of_points']));
    
    if($check_ven->num_rows()>0){
        $data['code']='2';
        $data['message']="Vendor".$data['no_of_points']." Already Exists";
     
    }
    else{
        $insert=$this->db->insert('vendor_rating',$data);
        if($insert){
            $data['code']='1';
            $data['message']="Vendor".$data['member_id']." Added Successfully";
            $data['message']="Vendor".$data['no_of_points']." Added Successfully";
        }else{
            $data['code']='1';
            $data['message']='Something Went Wrong';
        }
    }
    return $data;
}

public function update_ven($data)
{
   
    $id = $data['id'];
    unset($data['id']);
    $upd = $this->db->where('id',$id);
           $this->db->update('vendor_rating',$data);
    if($upd)
    {
        return "success";
    }else{
        return "error";
    }
}


public function get_ven($id){

    $array = array('id'=>$id);
    $data = $this->db->get_where('vendor_rating',$array)->row();
    
    return $data;


}


public function get_users(){
    $sql=$this->db->get("user_profile")->result();
    return $sql;
}

public function get_users_type($type){
    $sql=$this->db->get_where("user_profile",array('role'=>$type))->result();
    return $sql;
}

public function add_vendor($data){
    $insert=$this->db->insert('user_profile',$data);
        if($insert){
         return "success";
        }else{
            return "fail";
        }
}

public function app_vendor(){
    $sql="select * from user_profile where role=4 and (gstno!='' and gstno!='NA')";
    $query=$this->db->query($sql);
    $data=$query->result();
    return $data;
}

public function approve($id){
    $memberid="";
}




/* ------------------------Radius------------------------------------------------------------------------------------------------- */

     public function radius_master(){
        
        $query=$this->db->get('radius_master');
        $data=$query->result();
        return $data;
    }
    
    public function update_radius($data)
    {
       
        $id = $data['radius_id'];
        unset($data['radius_id']);
        $upd = $this->db->where('radius_id',$id);
               $this->db->update('radius_master',$data);
        if($upd)
        {
            return "success";
        }else{
            return "error";
        }
    }


    public function get_radius($radius_id){

       $data = $this->db->get_where('radius_master',array('radius_id'=>$radius_id))->row();
        
        return $data;
    }

/* -----------------------Banner-------------------------------------------------------------------------------------------------- */
 public function banner_master(){
        
        $query=$this->db->get('banner_master');
        $data=$query->result();
        return $data;
    }
    public function add_banner($data){
        $check_banner=$this->db->get_where('banner_master',array("banner_name"=>$data['banner_name']));
        
        if($check_banner->num_rows()>0){
            $data['code']='2';
            $data['message']="banner_master ".$data['banner_name']." Already Exists";
         
        }
        else{
            $insert=$this->db->insert('banner_master',$data);
            if($insert){
                $data['code']='4';
                $data['message']="banner_master ".$data['banner_name']." Added Successfully";
                
                
            }else{
                $data['code']='1';
                $data['message']='Something Went Wrong';
            }
        }
        return $data;
    }

    public function update_banner($data)
    {
       
        $id = $data['banner_id'];
        unset($data['banner_id']);
        $upd = $this->db->where('banner_id',$id);
               $this->db->update('banner_master',$data);
        if($upd)
        {
            return "success";
        }else{
            return "error";
        }
    }


    public function get_banner($banner_id){

       $data = $this->db->get_where('banner_master',array('banner_id'=>$banner_id))->row();
        
        return $data;


    }
/* -------------------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------------------- */
}
?>
