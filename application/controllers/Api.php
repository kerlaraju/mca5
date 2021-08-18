<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_api_model');
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }
	
	public function login()
	{
        $input = file_get_contents('php://input');
        $data = json_decode($input);
        if(isset($data->mobile))
        {
           $mobile = $data->mobile;
           $sendsms = $this->Common_api_model->sendsms($mobile);
           echo $sendsms;
        }
        else
        {
            $response=array("statusCode"=>0,"Message"=>"Insufficient Data or Invalid API Call");
            http_response_code(200);	
            echo json_encode($response);
        }
	}
	
	public function register()
	{
	    
	    echo $this->Common_api_model->getallStates();
	}
	
	public function validate_email()
	{
	    $input = file_get_contents('php://input');
        $data = json_decode($input);
        if(isset($data->email))
        {
	     echo $this->Common_api_model->validateEmail($data->email);
	    }else{
	        $response=array("statusCode"=>0,"Message"=>"Email Address is missing");
            http_response_code(200);	
            echo json_encode($response);
	    }
	}
	
	public function insert_profile()
	{
	    echo $this->Common_api_model->insert_profile();
	}
	
	public function update_profile()
	{
	    echo $this->Common_api_model->update_profile();
	}
	
	public function getDistrict($id=null)
	{
	    echo $this->Common_api_model->getDistrictbyStateid($id);
	}
	
	public function getallCategories()
	{
	    echo $this->Common_api_model->getallCategories();
	}
	
	public function getBrandsbyCategory($catid=null)
	{
	    echo $this->Common_api_model->getBrandsbyCategory($catid);
	}
	
	public function delivery_address()
	{
	    echo $this->Common_api_model->getallStates();
	}
	
	public function add_delivery_address()
	{
	    echo $this->Common_api_model->insertDeliveryaddress();
	}
	
	public function edit_delivery_address($address_id=null)
	{
	     $data['states'] = $this->Common_api_model->getallStates();
	     $data['address_details'] = $this->Common_api_model->getDeliveryaddress($address_id);
	     return $data;
	}
	
	public function update_delivery_address()
	{
	    echo $this->Common_api_model->updateDeliveryaddress();
	}
	
	public function list_delivery_address($member_id=null)
	{
	    echo $this->Common_api_model->listDeliveryAddress($member_id);
	}
	
	public function delete_delivery_address($address_id=null)
	{
	    echo $this->Common_api_model->deleteDeliveryAddress($address_id);
	}
	
	public function get_products()
	{
	     echo $this->Common_api_model->getProducts();
	}
	
	public function getBannerImages()
	{
	     echo $this->Common_api_model->getBannerImages();
	}
	
	public function getAlertMessages()
	{
	     echo $this->Common_api_model->getAlertMessages();
	}
	
	public function insertintocart()
	{
	    echo $this->Common_api_model->InsertintoCart();
	}
	public function deleteproductincart()
	{
	    echo $this->Common_api_model->DeleteProductinCart();
	}
	
	public function listcartproducts()
	{
	    echo $this->Common_api_model->ListCartProducts();
	}
	public function insertorder()
	{
	    echo $this->Common_api_model->InsertOrder();
	}
	
	public function getuserprofile($memberid)
	{
	    echo $this->Common_api_model->GetUserProfile($memberid);
	}
}
