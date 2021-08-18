<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Common_api_model extends CI_Model{
   
    function __construct(){
        parent::__construct();    
    }
    
    public function sendsms($mobile)
    {
        $otp = rand(111111,999999);
    	
    	$check_user = $this->db->get_where('user_profile',array("mobileno"=>$mobile));
    	
    	if($check_user->num_rows()==1)
    	{
    		$row = $check_user->row();
    		if($row->is_active==0){
    			$response2=array("statusCode"=>0,"Message"=>"Your account is inactive. please contact our customer support center for further information. Thank you");
    			http_response_code(200);
    			return json_encode($response2);
    		}else{
    			$response=array("statusCode"=>1,"otp"=>$otp,"isRegistered"=>true,"data"=>array());
    			
    			$this->sendmsg($mobile,$otp);  
    			$image_root_path = image_root_path;
    			$role_name = $this->getUserRoleNameByRoleID($row->role);
    			$data=array(
    				"member_id"=>$row->member_id,
    				"name"=>$row->name,
    				"mobileno"=>$row->mobileno,
    				"email"=>$row->email,
    				"gstno"=>$row->gstno,
    				"role"=>$row->role,
    				"role_name"=>$role_name,
    			);
    			if(!empty($row->gstimg))
    			{
    			    $data["gstimg"] = $image_root_path.$row->gstimg;
    			}
    			else{ $data["gstimg"] = "NA"; }
    			if(!empty($row->profilepic))
    			{
    			    $data["profilepic"] = $image_root_path.$row->profilepic;
    			}
    			else{ $data["profilepic"] = "NA"; }

    			array_push($response['data'],$data);
    		}
    	
    		http_response_code(200);
    		return json_encode($response);
    	}else{
    	    $this->sendmsg($mobile,$otp);
    		$response=array("statusCode"=>1,"otp"=>$otp,"isRegistered"=>false,"data"=>array());			  
    		$data=array(
    			"mobileno"=>$mobile
    		);
    		array_push($response['data'],$data);			
    		http_response_code(200);
    		return json_encode($response);
    	}
    }
    
    public function sendmsg($mobile_no,$otp)
    {
        $message = "Dear user, use $otp to validate your mobile number with BUILDUP STORE";
        $username="buildupstore";
        $password="801731";
        $from="RAAPID";
        $peid="1201160481392494053";
        $templateid="1207161814919643955";
        $url = "sms.hamsasolutions.com/api.php?username=$username&password=$password&to=$mobile_no&from=$from&message=".urlencode($message)."&PEID=$peid&templateid=$templateid";    //Store data into URL variable
        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        
        // grab URL and pass it to the browser
        $n = curl_exec($ch);
        
        // close cURL resource, and free up system resources
        curl_close($ch);
        return $n;   
    }
    
    public function validateEmail($email)
    {
        if(!empty($email))
        {
            $checkemail = $this->db->get_where('user_profile',array('email'=>$email))->num_rows();
            if($checkemail>0)
            {
                $response=array("statusCode"=>1,"Message"=>"Email Address already exists");
                echo json_encode($response);
            }else{
                $response=array("statusCode"=>0,"Message"=>"Email Address not found");
                echo json_encode($response);
            }
        }
    }
    
    public function getUserRoleNameByRoleID($role)
    {
              
        $sql_query = $this->db->get_where("role",array("role_id"=>$role))->row();
        if(!empty($sql_query)){
        	$role_name = $sql_query->role_name;
        }else{ $role_name='';}
        return $role_name;
    }
    
    public function getallCategories()
    {
        $categories = $this->db->get_where('category',array('is_active'=>1));
        if($categories->num_rows()>0)
        {
            $res['statusCode'] = '1';
            $res['Message'] = 'Data Found';
            foreach($categories->result() as $cat)
            {
                $cat->cat_image = image_real_path.$cat->cat_image;
                $data[] = $cat;
            }
            $res['data']  = $data;
            return json_encode($res);
        }else{
            $response=array("statusCode"=>0,"Message"=>"No Data Found");
            echo json_encode($response);
        }
    }
    
    public function getallStates()
    {
        $states = $this->db->get_where('state_master');
        if($states->num_rows()>0)
        {
            $res['statusCode'] = '1';
            $res['Message'] = 'Data Found';
            $res['data'] = $states->result();
            return json_encode($res);
        }else{
            $response=array("statusCode"=>0,"Message"=>"No Data Found");
            echo json_encode($response);
        }
    }
    
    public function getDistrictbyStateid($id)
    {
        $districts = $this->db->query('select * from district_master left join state_master on state_master.state_id = district_master.state_id where district_master.state_id="'.$id.'"');
        if($districts->num_rows()>0)
        {
            $res['statusCode'] = '1';
            $res['Message'] = "Data Found";
            $res['data'] = $districts->result();
            return json_encode($res);
        }else{
            $response=array("statusCode"=>0,"Message"=>"No Data Found");
            echo json_encode($response);
        }
    }
    
    public function getBannerImages()
    {
        $banners = $this->db->order_by('banner_order', 'ASC')->get_where('banner_master',array('is_active'=>'1'));
        if($banners->num_rows()>0)
        {
            $res['statusCode'] = '1';
            $res['Message'] = "Data Found";
            $i=0;
            foreach($banners->result() as $banner)
            {
                $banner->banner_image = image_real_path.$banner->banner_image;
               $data[] = $banner; 
            }
            $res['data'] = $data;
            return json_encode($res);
        }else{
            $response=array("statusCode"=>0,"Message"=>"No Data Found");
            echo json_encode($response);
        }
    }
    
    public function insert_profile()
    {
        $input = file_get_contents('php://input');
        $alldetails_arr = explode("&", $input);
        $image_root_path = image_root_path;
        $mobileno=$name=$email=$gstno=$gstimg=$profilepic='';
        foreach($alldetails_arr as $key=>$dr){
        	$value_key=explode("=", $dr);
        	if($value_key[0]=='mobileno'){$data['mobileno'] = urldecode($value_key[1]);}
        	if($value_key[0]=='name'){$data['name'] = urldecode($value_key[1]);}
        	if($value_key[0]=='email'){$data['email'] = urldecode($value_key[1]);}
        	if($value_key[0]=='gstno'){$data['gstno'] = urldecode($value_key[1]);}
        	if($value_key[0]=='gstimg'){$data['gstimg'] = $value_key[1];}
        	if($value_key[0]=='profilepic'){$data['profilepic'] = $value_key[1];}
        	if($value_key[0]=='location'){$data['location'] = urldecode($value_key[1]);}
        	if($value_key[0]=='district_id'){$data['district_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='state_id'){$data['state_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='pincode'){$data['pincode'] = urldecode($value_key[1]);}
        	if($value_key[0]=='lat'){$data['lat'] = urldecode($value_key[1]);}
        	if($value_key[0]=='lang'){$data['lang'] = urldecode($value_key[1]);}
        }
        
        if(isset($data['mobileno'])){	
        	$checkmobileno="";
        	if($data['mobileno']!=""){
        		$checkmobileno = $this->check_mobileno($data['mobileno']);
        		if($checkmobileno==1){
        			http_response_code(200);
        			$response=array("statusCode"=>0,"Message"=>"Mobile number already regsitered");
        			echo json_encode($response);
        			return;
        		}
        	}
        	if(isset($data['gstno']) && $data['gstno']!=""){
        		$result = $this->gst_check($data['gstno']);
        		if($result==0){
        			$data['gstno'] = $data['gstno'];
        		}
        		else{
        			http_response_code(200);
        			$response=array("statusCode"=>0,"Message"=>"GST Number already regsitered, Pleas check your GST NUMBER");
        			echo json_encode($response);
        			return;
        		}
        	}
        	else{
        		$data['gstno'] = "NA";
        	}
        	
        
        	// Upload GST IMAGE and get Path
        	$uploadgst="";
        	 if(isset($data['gstimg']) && $data['gstimg']!=""){	  
        	  $uploadgst = $this->uploadImage("gst_images", $gstimg); 
        	}
        	$data['gstimg'] = isset($uploadgst) ? $uploadgst :"NA";
        	
        	// Upload Profile Image and Get Path
        	 if(isset($data['profilepic']) && $data['profilepic']){
        	  $profilepic1 = $profilepic;	  
        	  $profilepic = $this->uploadImage("profile_images", $profilepic1); 
        	}
        	$data['profilepic'] = isset($profilepic)?$profilepic:"NA";
        	
        	$data['role'] = 4;
        	$data['is_active'] = 1;
        	$tdate=date("Y-m-d H:i:s");
        	$data['member_id'] = "BS".date("dmyhs");
        	
        	$sql = $this->db->insert('user_profile',$data);
        	
        	if($sql){
        		$sql2 = $this->db->get_where("user_profile",array("mobileno"=>$data['mobileno']))->row();
        		$response=array("statusCode"=>1,"data"=>array());
        			$role_name = $this->getUserRoleNameByRoleID($sql2->role);
        			$data=array(
    				"member_id"=>$sql2->member_id,
    				"name"=>$sql2->name,
    				"mobileno"=>$sql2->mobileno,
    				"email"=>$sql2->email,
    				"gstno"=>$sql2->gstno,
    				"role"=>$sql2->role,
    				"role_name"=>$role_name,
    			);
    			if(!empty($sql2->gstimg))
    			{
    			    $data["gstimg"] = $image_root_path.$sql2->gstimg;
    			}
    			else{ $data["gstimg"] = "NA"; }
    			if(!empty($sql2->profilepic))
    			{
    			    $data["profilepic"] = $image_root_path.$sql2->profilepic;
    			}
    			else{ $data["profilepic"] = "NA"; }
                $response['statusCode'] = '1';
                $response['Message'] = 'Data Found';
    			array_push($response['data'],$data);
        		//$response['data'] = $sql2;
        		http_response_code(200);
        		echo json_encode($response);
        	}
        	else{
        		http_response_code(200);
        		$response=array("statusCode"=>0,"Message"=>"ERROR");
        		echo json_encode($response);
        	} 
        }
        else{
        	http_response_code(200);
        	$response=array("statusCode"=>0,"Message"=>"Mobile Number not submitted or Invalid Call Method");
        	echo json_encode($response);
        }
     }
     
    public function update_profile()
    {
        $input = file_get_contents('php://input');
        $alldetails_arr = explode("&", $input);
        $image_root_path = image_root_path;
        $mobileno=$name=$email=$gstno=$gstimg=$profilepic='';
        foreach($alldetails_arr as $key=>$dr){
        	$value_key=explode("=", $dr);
        	if($value_key[0]=='name'){$data['name'] = urldecode($value_key[1]);}
        	if($value_key[0]=='email'){$data['email'] = urldecode($value_key[1]);}
        	if($value_key[0]=='gstno'){$data['gstno'] = urldecode($value_key[1]);}
        	if($value_key[0]=='gstimg'){$pdata['gstimg'] = $value_key[1];}
        	if($value_key[0]=='profilepic'){$pdata['profilepic'] = $value_key[1];}
        	if($value_key[0]=='location'){$data['location'] = urldecode($value_key[1]);}
        	if($value_key[0]=='district_id'){$data['district_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='state_id'){$data['state_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='pincode'){$data['pincode'] = urldecode($value_key[1]);}
        	if($value_key[0]=='lat'){$data['lat'] = urldecode($value_key[1]);}
        	if($value_key[0]=='lang'){$data['lang'] = urldecode($value_key[1]);}
        	if($value_key[0]=='member_id'){$member_id = urldecode($value_key[1]);}
        }
        
            if(!empty($member_id )){
        /*	if(isset($data['gstno']) && $data['gstno']!=""){
        		$result = $this->gst_check($data['gstno']);
        		if($result==0){
        			$data['gstno'] = $data['gstno'];
        		}
        		else{
        			http_response_code(200);
        			$response=array("statusCode"=>0,"Message"=>"GST Number already regsitered, Pleas check your GST NUMBER");
        			echo json_encode($response);
        			return;
        		}
        	} */

        	// Upload GST IMAGE and get Path
        	$uploadgst="";
        	 if(isset($pdata['gstimg']) && $pdata['gstimg']!=""){	  
        	  $uploadgst = $this->uploadImage("gst_images", $pdata['gstimg']); 
        	  $data['gstimg'] = $uploadgst;
        	}
        	
        	// Upload Profile Image and Get Path
        	 if(isset($pdata['profilepic']) && $pdata['profilepic']!=''){
        	     
        	  $profilepic1 = $pdata['profilepic'];	  
        	  $profilepic = $this->uploadImage("profile_images", $profilepic1); 
        	  $data['profilepic'] = $profilepic;
        	}
    
           $sql =  $this->db->where('member_id', $member_id);
            $this->db->update('user_profile', $data);
        	//$sql = $this->db->insert('user_profile',$data);
        	
        	if($sql){
        		$sql2 = $this->db->get_where("user_profile",array("member_id"=>$member_id))->row();
        		$response=array("statusCode"=>1,"data"=>array());
        			$role_name = $this->getUserRoleNameByRoleID($sql2->role);
        			$data=array(
    				"member_id"=>$sql2->member_id,
    				"name"=>$sql2->name,
    				"mobileno"=>$sql2->mobileno,
    				"email"=>$sql2->email,
    				"gstno"=>$sql2->gstno,
    				"role"=>$sql2->role,
    				"role_name"=>$role_name,
    			);
    			if(!empty($sql2->gstimg))
    			{
    			    $data["gstimg"] = image_real_path.$sql2->gstimg;
    			}
    			else{ $data["gstimg"] = "NA"; }
    			if(!empty($sql2->profilepic))
    			{
    			    $data["profilepic"] = image_real_path.$sql2->profilepic;
    			}
    			else{ $data["profilepic"] = "NA"; }

    			array_push($response['data'],$data);
        		//$response['data'] = $sql2;
        		http_response_code(200);
        		echo json_encode($response);
        	}
        	else{
        		http_response_code(200);
        		$response=array("statusCode"=>0,"Message"=>"ERROR");
        		echo json_encode($response);
        	} 
        }
        else{
        		http_response_code(200);
        		$response=array("statusCode"=>0,"Message"=>"Member Id Required");
        		echo json_encode($response);
        	} 
     }
     
     public function check_mobileno($mobile)
     {
         $check_user = $this->db->get_where('user_profile',array("mobileno"=>$mobile));
    	 return $check_user->num_rows();
     }
     
     public function gst_check($gstno)
     {
         $check_user = $this->db->get_where('user_profile',array("gstno"=>$gstno));
    	 return $check_user->num_rows();
     }
     
     public function uploadImage($foldername, $base64) {
        $image_parts = explode(";base64,", urldecode($base64));
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $foldername . '/' . uniqid() . date('Y-m-d') . '.png';
        file_put_contents(FCPATH.$file, $image_base64);
        return $file;
    }
    
    public function getBrandsbyCategory($catid)
    {
        if(!empty($catid)){
            $input = file_get_contents('php://input');
            $data = json_decode($input);
        	http_response_code(200);
        	$image_root_path = image_root_path;
        
        	$sql_query = $this->db->get_where("brand",array("cat_id"=>$catid,"is_active"=>1));
        	 $get_results_arr = $sql_query->num_rows();
        
        	if(isset($get_results_arr) && $get_results_arr>0){
        		$response=array("StatusCode"=>1,"data"=>array());
        		$brands = $sql_query->result();
        		foreach($brands as $brand){
        			$brand_id = $brand->brand_id;
        			/* get all the images and add into a variable with root url start here */
        				$imagea_arr =  $brand->brand_image;
        			$images_all = explode(',', $imagea_arr);
        			$total_imges = count($images_all);
        			$xx=1;
        			$brand_image='';
        			foreach($images_all as $imgs)
        			{
        				$brand_image .= image_real_path.$imgs;
        				if($xx<$total_imges){$brand_image .=",";}
        				$xx++;
        			}
        			/* get all the images and add into a variable with root url end here */
        	        
        			$d = array(
        				"brand_id"=> $brand->brand_id,
        				"brand_name"=> $brand->brand_name,
        				"description"=> $brand->description,
        				"brand_image"=>$brand_image,
        			
        				"is_active"=> $brand->is_active
        				);
        				array_push($response['data'],$d);
        		}
        		echo json_encode($response);
        	}
        	else{
        		$response=array("statusCode"=>0,"Message"=>"No Brands found on this category");
        		echo json_encode($response);
        	}
        }else{
        	$response=array("statusCode"=>0,"Message"=>"Sorry, Category id is missing.");            
        	echo json_encode($response);
        }
    }     
    
    public function insertDeliveryaddress()
    {
        $input = file_get_contents('php://input');
        $alldetails_arr = explode("&", $input);
        $mobileno=$name=$email=$gstno=$gstimg=$profilepic='';
        foreach($alldetails_arr as $key=>$dr){
        	$value_key=explode("=", $dr);
        	if($value_key[0]=='member_id'){$data['member_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='contact_name'){$data['contact_name'] = urldecode($value_key[1]);}
        	if($value_key[0]=='mobile_no'){$data['mobile_no'] = urldecode($value_key[1]);}
        	if($value_key[0]=='house_no'){$data['house_no'] = urldecode($value_key[1]);}
        	if($value_key[0]=='location'){$data['location'] = urldecode($value_key[1]);}
        	if($value_key[0]=='district_id'){$data['district_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='state_id'){$data['state_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='latitude'){$data['latitude'] = urldecode($value_key[1]);}
        	if($value_key[0]=='longitude'){$data['longitude'] = urldecode($value_key[1]);}
        	if($value_key[0]=='pincode'){$data['pincode'] = urldecode($value_key[1]);}
        }
        
        if(!empty($data['member_id']) && !empty($data['district_id']) && !empty($data['state_id']))
        {
            $ins = $this->db->insert('delivery_address',$data);
            if($ins)
            {
                $response=array("statusCode"=>1,"Message"=>"Address added successfully");            
            	echo json_encode($response);
            }
        }
        else{
            	$response=array("statusCode"=>0,"Message"=>"Sorry, Member id,District Id ,State Id are mandatory.");            
            	echo json_encode($response);
        }
    }
    
    public function listDeliveryAddress($member_id)
    {
        if(!empty($member_id))
        {
            $data = $this->db->get_where('delivery_address',array('member_id'=>$member_id,'is_active'=>1));
            $i=0;
            if($data->num_rows()>0)
            {
                foreach($data->result() as $d)
                {
                    $address[$i]['delivery_address_id'] = $d->delivery_address_id;
                    $address[$i]['member_id'] = $d->member_id;
                    $address[$i]['contact_name'] = $d->contact_name;
                    $address[$i]['mobile_no'] = $d->mobile_no;
                    $address[$i]['house_no'] = $d->house_no;
                    $address[$i]['location'] = $d->location;
                    $address[$i]['district_id'] = $d->district_id;
                    $address[$i]['state_id'] = $d->state_id;
                    $address[$i]['latitude'] = $d->latitude;
                    $address[$i]['longitude'] = $d->longitude;
                    $address[$i]['pincode'] = $d->pincode;
                    $address[$i]['district'] = $this->getDistrictbydistrictid($d->district_id);
                    $address[$i]['state'] = $this->getStatebystateid($d->state_id);
                    $i++;
                }
                $res['statusCode'] = '1';
                $res['Message'] = 'Data Found';
                $res['data'] = $address;
                return  json_encode($res);
            }else{
                	$response=array("statusCode"=>0,"Message"=>"No Data Found");            
            	echo json_encode($response);
            }
        }else{
            	$response=array("statusCode"=>0,"Message"=>"Sorry, Member id is missing.");            
            	echo json_encode($response);
        }
    }
    
    public function getDeliveryaddress($addressid)
    {
        if(!empty($addressid))
        {
            $adata = $this->db->get_where('delivery_address',array('delivery_address_id'=>$addressid));
            if($adata->num_rows()>0)
            {
                $data = $adata->row();
                $address['delivery_address_id'] = $data->delivery_address_id;
                $address['member_id'] = $data->member_id;
                $address['contact_name'] = $data->contact_name;
                $address['mobile_no'] = $data->mobile_no;
                $address['house_no'] = $data->house_no;
                $address['delivery_location'] = $data->delivery_location;
                $address['delivery_district_id'] = $data->delivery_district_id;
                $address['delivery_state_id'] = $data->delivery_state_id;
                $address['latitude'] = $data->latitude;
                $address['longitude'] = $data->longitude;
                $address['pincode'] = $data->pincode;
                $address['district'] = $this->getDistrictbydistrictid($data->delivery_district_id);
                $address['state'] = $this->getStatebystateid($data->delivery_state_id);
                
                $res['statusCode'] = '1';
                $res['Message'] = 'Data Found';
                $res['data'] = $address;
                echo json_encode($res);
            }else{
                $response=array("statusCode"=>0,"Message"=>"Sorry, Invalid Address Id");            
            	echo json_encode($response);
            }
        }else{
            	$response=array("statusCode"=>0,"Message"=>"Sorry, Address id is missing.");            
            	echo json_encode($response);
        }
    }
    
    public function updateDeliveryaddress()
    {
        $input = file_get_contents('php://input');
        $alldetails_arr = explode("&", $input);
        $mobileno=$name=$email=$gstno=$gstimg=$profilepic='';
        foreach($alldetails_arr as $key=>$dr){
        	$value_key=explode("=", $dr);
        	if($value_key[0]=='delivery_address_id'){$delivery_address_id = urldecode($value_key[1]);}
        	if($value_key[0]=='contact_name'){$data['contact_name'] = urldecode($value_key[1]);}
        	if($value_key[0]=='mobile_no'){$data['mobile_no'] = urldecode($value_key[1]);}
        	if($value_key[0]=='house_no'){$data['house_no'] = urldecode($value_key[1]);}
        	if($value_key[0]=='delivery_location'){$data['location'] = urldecode($value_key[1]);}
        	if($value_key[0]=='delivery_district_id'){$data['district_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='delivery_state_id'){$data['state_id'] = urldecode($value_key[1]);}
        	if($value_key[0]=='latitude'){$data['latitude'] = urldecode($value_key[1]);}
        	if($value_key[0]=='longitude'){$data['longitude'] = urldecode($value_key[1]);}
        	if($value_key[0]=='pincode'){$data['pincode'] = urldecode($value_key[1]);}
        }
        
        if(!empty($delivery_address_id))
        {
             $sql =  $this->db->where('delivery_address_id', $delivery_address_id);
                      $this->db->update('delivery_address', $data);
            if($sql)
            {
                $response=array("statusCode"=>1,"Message"=>"Address Updated successfully");            
            	echo json_encode($response);
            }
        }
        else{
            	$response=array("statusCode"=>0,"Message"=>"Sorry, Delivery address id is missing.");            
            	echo json_encode($response);
        }
    }
    
    public function deleteDeliveryAddress($address_id)
    {
        if(!empty($address_id))
        {
             $sql =  $this->db->where('delivery_address_id', $address_id);
                      $this->db->update('delivery_address',array('is_active'=>0));
            if($sql)
            {
                $response=array("statusCode"=>1,"Message"=>"Address Deleted successfully");            
                echo json_encode($response);
            }
        }
        else{
            $response=array("statusCode"=>0,"Message"=>"Sorry, Delivery address id is missing.");            
            	echo json_encode($response);
        }
    }
    
    public function getDistrictbydistrictid($districtid)
    {
        $data = $this->db->get_where('district_master',array('district_id'=>$districtid));
        if($data->num_rows()>0)
        {
            /*$res['statusCode'] = "1";
            $res['Message'] = "Data Found";*/
            
            return  $data->row();
        }else{
            $res['statusCode'] = "0";
            $res['Message'] = "No Data Found";
            return $res;
        }
    }
    
    public function getStatebystateid($stateid)
    {
         $data = $this->db->get_where('state_master',array('state_id'=>$stateid));
        if($data->num_rows()>0)
        {
            /*$res['statusCode'] = "1";
            $res['Message'] = "Data Found";*/
            //$res['state'] = 
            return $data->row();
        }else{
            $res['statusCode'] = "0";
            $res['Message'] = "No Data Found";
            return $res;
        }
    }
    
    public function getProducts()
    {
        $input = file_get_contents('php://input');
        $alldetails_arr = explode("&", $input);
        
        foreach($alldetails_arr as $key=>$dr){
        	$value_key=explode("=", $dr);
        	if($value_key[0]=='order_type'){$order_type = urldecode($value_key[1]);}
        	if($value_key[0]=='delivery_address_id'){$delivery_address_id = urldecode($value_key[1]);}
        	if($value_key[0]=='brand_id'){$brand_id = urldecode($value_key[1]);}
        }
        if($order_type!='' && $delivery_address_id!='' && $brand_id!='')
        {
            $delivery_address = $this->db->get_where('delivery_address',array('delivery_address_id'=>$delivery_address_id))->row();
            $deliverylongitude =  $delivery_address->longitude;
            $deliverylatitude =  $delivery_address->latitude;
            $districtid = $delivery_address->district_id;
            $stateid = $delivery_address->state_id;
            if($order_type=='1')
            {
                $vendors = $this->db->query("SELECT *, SQRT(POW(69.1 * (lat - $deliverylatitude), 2) + POW(69.1 * ($deliverylongitude - lang) * COS(lat / 57.3), 2)) AS distance FROM user_profile HAVING distance < 25 and role='1' ORDER BY distance");
                if($vendors->num_rows()>0)
                {
                    $vendor = $vendors->result();
                    foreach($vendor as $ven)
                    {
                        $products = $this->db->query("select * from bulk_vendor_products left join product_master on product_master.pid = bulk_vendor_products.pid where member_id='".$ven->member_id."' and state_id='".$stateid."' and district_id='".$districtid."' and brand_id='".$brand_id."'")->result();
                        foreach($products as $p)
                        {
                            $getrating = $this->db->query("select CAST(AVG(rating) AS DECIMAL(10,1)) as rating from vendor_rating where vendor_id='".$p->member_id."'");
                            $p->rating = $getrating->row()->rating;
                            $p->product_imgs = new stdClass();
                            $p->product_vids = new stdClass();
                            $pimg = explode(",",$p->product_img);
                            $pvideo = explode(",",$p->product_video);
                            for($i=0;$i<count($pimg);$i++)
                            {
                                $p->product_imgs->$i = image_real_path.$pimg[$i];
                            }
                             for($i=0;$i<count($pvideo);$i++)
                            {
                                $p->product_vids->$i = image_real_path.$pvideo[$i];
                            }
                            unset($p->product_img);
                            unset($p->product_video);
                            $data[] = $p;
                        }
                        
                    }
                    if(!empty($data[0]))
                    {
                        $rdata['statusCode'] = 1;
                        $rdata['data'] = $data;
                        return json_encode($rdata);
                    }else{  $response=array("statusCode"=>0,"Message"=>"Sorry, No Products Found in this location.");            
                        echo json_encode($response);
                    }
                }else{
                        $response=array("statusCode"=>0,"Message"=>"Sorry, No Vendor Found in this location.");            
                        echo json_encode($response);
                }
            }
            if($order_type=='2')
            {
                $vendors = $this->db->query("SELECT *, SQRT(POW(69.1 * (lat - $deliverylatitude), 2) + POW(69.1 * ($deliverylongitude - lang) * COS(lat / 57.3), 2)) AS distance FROM user_profile HAVING distance < 25 and role='2' ORDER BY distance");
               
                if($vendors->num_rows()>0)
                {
                    $vendor = $vendors->result();
                    foreach($vendor as $ven)
                    {
                        $products = $this->db->query("select * from retail_vendor_products left join product_master on product_master.pid = retail_vendor_products.pid where member_id='".$ven->member_id."'  and brand_id='".$brand_id."'")->result();
                        foreach($products as $p)
                        {
                            $getrating = $this->db->query("select CAST(AVG(rating) AS DECIMAL(10,1)) as rating from vendor_rating where vendor_id='".$p->member_id."'");
                            
                            $p->rating = $getrating->row()->rating;
                            
                            $p->product_imgs = new stdClass();
                            $p->product_vids = new stdClass();
                            $pimg = explode(",",$p->product_img);
                            $pvideo = explode(",",$p->product_video);
                            for($i=0;$i<count($pimg);$i++)
                            {
                                $p->product_imgs->$i = image_real_path.$pimg[$i];
                            }
                             for($i=0;$i<count($pvideo);$i++)
                            {
                                $p->product_vids->$i = image_real_path.$pvideo[$i];
                            }
                            unset($p->product_img);
                            unset($p->product_video);
                            $data[] = $p;
                        }
                    }
                    if(!empty($data[0]))
                    {
                        $rdata['statusCode'] = 1;
                         $rdata['data'] = $data;
                        return json_encode($rdata);
                    }else{  $response=array("statusCode"=>0,"Message"=>"Sorry, No Products Found in this location.");            
                        echo json_encode($response);
                    }
                }else{
                        $response=array("statusCode"=>0,"Message"=>"Sorry, No Vendor Found in this location.");            
                        echo json_encode($response);
                }
            }
        }else{
                $response=array("statusCode"=>0,"Message"=>"Sorry, Some details are missing.");            
                echo json_encode($response);
            }
        
    }
    
    public function getAlertMessages()
    {
        $date = date("Y-m-d");
        $messages = $this->db->query("select * from alert_messages where from_date<='".$date."' and to_date>='".$date."' and is_active='1'");
        
        if($messages->num_rows()>0)
        {
            $data['statusCode'] = 1;
            $data['Message'] = "Data Found";
            foreach($messages->result() as $message)
            {
                $data['data'] = $message;
            }
            
            return json_encode($data);
        }
        
    }
    
    public function InsertintoCart()
    {
        $input = file_get_contents('php://input');
        $alldetails_arr = explode("&", $input);
        
        foreach($alldetails_arr as $key=>$dr){
        	$value_key=explode("=", $dr);
        	if($value_key[0]=='member_id'){$member_id = urldecode($value_key[1]);}
        	if($value_key[0]=='vendor_id'){$vendor_id = urldecode($value_key[1]);}
        	if($value_key[0]=='product_id'){$product_id = urldecode($value_key[1]);}
        	if($value_key[0]=='quantity'){$quantity = urldecode($value_key[1]);}
        	if($value_key[0]=='ordertype'){$ordertype = urldecode($value_key[1]);}
        	if($value_key[0]=='delivery_address_id'){$delivery_address_id = urldecode($value_key[1]);}
        	
        }
        if(!empty($member_id) && !empty($vendor_id) && !empty($product_id) && !empty($quantity) && !empty($ordertype) && !empty($delivery_address_id))
        {
            $chkarray = array('member_id'=>$member_id,'vendor_id'=>$vendor_id,'product_id'=>$product_id);
            $checkproduct = $this->db->get_where('cart',$chkarray)->num_rows();
            if($checkproduct>0)
            {
                $this->db->set('quantity',$quantity);
                $this->db->where('member_id',$member_id);
                $this->db->where('vendor_id',$vendor_id);
                $this->db->where('product_id',$product_id);
                $upd =   $this->db->update('cart');
        
                if($upd)
                {
                    $response=array("statusCode"=>1,"Message"=>"Product Quantity Updated Successfully.");            
                    echo json_encode($response);
                }
            }else{
                $insarray = array('member_id'=>$member_id,'vendor_id'=>$vendor_id,'product_id'=>$product_id,'quantity'=>$quantity,'ordertype'=>$ordertype,'delivery_address_id'=>$delivery_address_id);
                $ins = $this->db->insert("cart",$insarray);
                if($ins)
                {
                    $response=array("statusCode"=>1,"Message"=>"Product Added Successfully.");            
                    echo json_encode($response);
                }
            }
        }else{
            $response=array("statusCode"=>0,"Message"=>"Sorry, Member Id,Vendor Id,Product Id,Quantity,Order Type are mandatory.");            
            echo json_encode($response);
        }
    }
    
    public function DeleteProductinCart()
    {
        $input = file_get_contents('php://input');
        $alldetails_arr = explode("&", $input);
        
        foreach($alldetails_arr as $key=>$dr){
        	$value_key=explode("=", $dr);
        	if($value_key[0]=='member_id'){$member_id = urldecode($value_key[1]);}
        	if($value_key[0]=='vendor_id'){$vendor_id = urldecode($value_key[1]);}
        	if($value_key[0]=='product_id'){$product_id = urldecode($value_key[1]);}
        }
        if(!empty($member_id) && !empty($vendor_id) && !empty($product_id))
        {
            $delete = $this->db->delete('cart',array('member_id'=>$member_id,'vendor_id'=>$vendor_id,'product_id'=>$product_id));
            if($delete)
            {
                $response=array("statusCode"=>1,"Message"=>"Product Removed from cart.");            
                echo json_encode($response);
            }
        }else{
            $response=array("statusCode"=>0,"Message"=>"Sorry, Member Id,Vendor Id,Product Id are mandatory.");            
            echo json_encode($response);
        }
    }
    
    public function ListCartProducts()
    {
        $input = file_get_contents('php://input');
        $alldetails_arr = explode("&", $input);
        
        foreach($alldetails_arr as $key=>$dr){
        	$value_key=explode("=", $dr);
        	if($value_key[0]=='member_id'){$member_id = urldecode($value_key[1]);}
        }
        if(!empty($member_id))
        {
            $cartproducts = $this->db->get_where('cart',array('member_id'=>$member_id));
            if($cartproducts->num_rows()>0)
            {
                foreach($cartproducts->result() as $products)
                {
                    if($products->ordertype=='1')
                    {
                        $addressdetails = $this->db->get_where('delivery_address',array('delivery_address_id'=>$products->delivery_address_id))->row();
                        
                        $products_d = $this->db->query("select category.cat_name,bulk_vendor_products.member_id as vendor_id,bulk_vendor_products.price,bulk_vendor_products.discount,bulk_vendor_products.min_qty,product_master.pid,product_master.product_name,product_master.product_img,product_master.brand_id,brand.brand_name from bulk_vendor_products left join product_master on product_master.pid = bulk_vendor_products.pid left join brand on brand.brand_id = product_master.brand_id left join category on category.cat_id = product_master.cat_id where product_master.pid='".$products->product_id."' and bulk_vendor_products.state_id='".$addressdetails->state_id."' and bulk_vendor_products.district_id='".$addressdetails->district_id."'")->row();
                    
                        $products_d->quantity = $products->quantity;
                        $products_d->member_id = $products->member_id;
                        $products_d->product_imgs = new stdClass();
                        
                        $pimg = explode(",",$products_d->product_img);
                        
                        for($i=0;$i<count($pimg);$i++)
                        {
                        $products_d->product_imgs->$i = image_real_path.$pimg[$i];
                        }
                        unset($products_d->product_img);
                        $data[] = $products_d;
                    }
                    if($products->ordertype=='2')
                    {
                        $addressdetails = $this->db->get_where('delivery_address',array('delivery_address_id'=>$products->delivery_address_id))->row();
                        $products_d = $this->db->query("select retail_vendor_products.stock,retail_vendor_products.member_id as vendor_id,retail_vendor_products.price,retail_vendor_products.discount,retail_vendor_products.min_qty,product_master.pid,product_master.product_name,product_master.product_img,product_master.brand_id,brand.brand_name from retail_vendor_products left join product_master on product_master.pid = bulk_vendor_products.pid left join brand on brand.brand_id = product_master.brand_id where product_master.pid='".$products->product_id."' and retail_vendor_products.state_id='".$addressdetails->state_id."' and retail_vendor_products.district_id='".$addressdetails->district_id."'")->row();
                        
                        $products_d->quantity = $products->quantity;
                        $products_d->member_id = $products->member_id;
                        $products_d->product_imgs = new stdClass();
                        
                        $pimg = explode(",",$products_d->product_img);
                        
                        for($i=0;$i<count($pimg);$i++)
                        {
                        $products_d->product_imgs->$i = image_real_path.$pimg[$i];
                        }
                        unset($products_d->product_img);
                        $data[] = $products_d;
                    }
                }
                $rdata['statusCode'] = 1;
                $rdata['data'] = $data;
                echo json_encode($rdata);
            }else{
                $response=array("statusCode"=>0,"Message"=>"Cart is empty");            
              echo json_encode($response);
            }
        }else{
            $response=array("statusCode"=>0,"Message"=>"Sorry, Member Id is missing.");            
            echo json_encode($response);
        }
    }
    
    public function InsertOrder()
    {
        $json = file_get_contents('php://input');
        $items = json_decode($json);
        
        if(count($items)>0)
        {
             $orderarray['order_id'] = $this->getorderid($items->order_type);
             $orderarray['order_date'] = date("Y-m-d H:i");
             $orderarray['member_id'] = $items->member_id;
             $orderarray['order_type'] = $items->order_type;
             $orderarray['delivery_address_id'] = $items->delivery_address_id;
             $orderarray['order_amount'] = $items->order_amount;
             $orderarray['payment_mode'] = $items->payment_mode;
             $orderarray['payment_status'] = $items->payment_status;
             $orderarray['payment_date'] = $items->payment_date;
             $orderarray['transaction_details'] = $items->transaction_details;
             
             $insertorder = $this->db->insert('order_master',$orderarray);
             $orderid = $this->db->insert_id();
             
             foreach($items->order_items as $oitems)
             {
                 $orderitems['order_id'] = $orderid;
                 $orderitems['product_id'] = $oitems->product_id;
                 $orderitems['vendor_id'] = $oitems->vendor_id;
                 $orderitems['qty'] = $oitems->qty;
                 $orderitems['mrp'] = $oitems->mrp;
                 $orderitems['offer_price'] = $oitems->offer_price;
                 $orderitems['cgst'] = $oitems->cgst;
                 $orderitems['sgst'] = $oitems->sgst;
                 $orderitems['total_gst'] = $oitems->total_gst;
                 $orderitems['total'] = $oitems->total;
                 $orderitems['product_order_status'] = $oitems->product_order_status;
                    $insorderitems = $this->db->insert('order_details',$orderitems);
                    
                 $ordertracking['order_id'] = $orderid;
                 $ordertracking['product_id'] = $oitems->product_id;
                 $ordertracking['order_status'] = 1;
                 $ordertracking['remarks'] = 'Order Recieved';
                 $ordertracking['tdate'] = date('Y-m-d H:i');
                    $insordertracking = $this->db->insert('order_tracking',$ordertracking);
             }
            if($insertorder && $insorderitems && $insordertracking)
            {
                $response=array("statusCode"=>1,"Message"=>"Order Placed Successfully");            
            echo json_encode($response);
            }else{
                 $response=array("statusCode"=>0,"Message"=>"Something went wrong. Please try again");            
            echo json_encode($response);
            }
        }else{
             $response=array("statusCode"=>0,"Message"=>"Sorry, order data is missing.");            
            echo json_encode($response);
        }
    }
    
    public function getorderid($ordertype)
    {
        if($ordertype=='1')
        {
            $orderid = "BO-".substr(str_shuffle(rand(1111,9999).time()),0,7);
        }
        if($ordertype=='2')
        {
            $orderid = "RO-".substr(str_shuffle(rand(1111,9999).time()),0,7);
        }
        return $orderid;
    }
    
    public function GetUserProfile($memberid)
    {
        if(!empty($memberid))
        {
            $data = $this->db->get_where('user_profile',array('member_id'=>$memberid));
            
            if($data->num_rows()>0)
            {
                $res['statusCode'] = 1;
                $res['Message'] = "Data Found";
                $userdata = $data->row();
                $res['data'] = $data->row();
                $res['data']->profilepic = image_real_path.$userdata->profilepic;
                $res['data']->gstimg = image_real_path.$userdata->gstimg;
                $res['data']->district = $this->getDistrictbydistrictid($userdata->district_id);
                $res['data']->state = $this->getStatebystateid($userdata->state_id);
                unset($res['data']->district_id);
                unset($res['data']->state_id);
                echo json_encode($res);
                
            }else{
                 $response=array("statusCode"=>0,"Message"=>"Sorry, Data Not Found");            
            echo json_encode($response);
            }
        }else{
            $response=array("statusCode"=>0,"Message"=>"Sorry, Member Id is missing.");            
            echo json_encode($response);
        }
    }
}

?>