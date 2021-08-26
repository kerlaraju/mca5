<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login';
$route['dashboard']='App';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ------------------------------------------------------------------------------- */
$route['category']='App/category';
$route['add_cat']="App/add_cat";
$route['delete_cat/(:any)']="App/delete_cat/$1";
$route['edit_cat/(:any)']="App/edit_cat/$1";
/* ------------------------------------------------------------------------------- */
$route['brand']='App/brand'; 
$route['add_brand']="App/add_brand";
$route['delete_brand/(:any)']="App/delete_brand/$1";
$route['edit_brand/(:any)']="App/edit_brand/$1";
$route['get_brands']="App/get_brands";
/* ------------------------------------------------------------------------------- */
$route['product_master']='App/product_master';
$route['add_pro']="App/add_product";
$route['delete_pro/(:any)']="App/delete_pro/$1";
$route['edit_pro/(:any)']="App/edit_pro/$1";
/* ------------------------------------------------------------------------------- */
$route['state_master']='App/state_master';
$route['add_state']="App/add_state";
$route['delete_state/(:any)']="App/delete_state/$1";
$route['edit_state/(:any)']="App/edit_state/$1";
/* ------------------------------------------------------------------------------- */
$route['district_master']='App/district_master';
$route['add_dis']="App/add_dis";
$route['delete_dis/(:any)']="App/delete_dis/$1";
$route['edit_dis/(:any)']="App/edit_dis/$1";
/* ------------------------------------------------------------------------------- */
$route['vendor_rating']='App/vendor_rating';
$route['add_ven']="App/add_ven";
$route['delete_ven/(:any)']="App/delete_ven/$1";
$route['edit_ven/(:any)']="App/edit_ven/$1";
$route['approve_vendor']="App/approve_vendor";
$route['approve/(:any)']="App/approve/$1";
/* ------------------------------------------------------------------------------- */
$route['vendors']="App/vendors";
$route['view_users']="App/view_users";
$route['bulk_vendors']="App/bulk_vendors";
$route['retail_vendors']="App/retail_vendors";
$route['special_vendors']="App/special_vendors";
$route['user_info/(:any)']="App/view_user_info/$1";
$route['add_vendor']="App/add_vendor";
$route['check_mobileno']="App/check_mobileno";
$route['get_districts']="App/get_districts";
$route['edit_info/(:any)']="App/edit_user/$1";

/* ------------------------------------------------------------------------------- */
$route['banners']="App/banner_master";
$route['add_banner']='App/add_banner';




