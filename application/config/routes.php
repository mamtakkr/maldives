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
$route['default_controller'] 	= 'home';
$route['superadmin']     		= "superadmin/superadmin/dashboard";
$route['superadmin/module']     = "superadmin/adminPage/index";
$route['superadmin/cms/(:any)'] = "superadmin/cms/index/$1";
$route['404_override']	    	= 'home/error_404';
$route['resorts'] 				= "home/resorts";
$route['search-result'] 	    = "home/resorts";
$route['inspire_me'] 		    = "home/inspire_me";
$route['compare_resorts'] 		= "home/compare_resorts";
$route['villas_suites'] 		= "home/villas_suites";
$route['experiences'] 		    = "home/experiences";
$route['inspiration'] 		    = "home/inspiration";
$route['maldives'] 				= "home/maldives";
$route['reviews'] 				= "home/reviews";
$route['blogs'] 				= "home/blogs";
$route['login'] 				= "home/login";
$route['hotel_login'] 			= "home/hotel_login";
$route['aboutus'] 			    = "home/aboutus";
$route['resort-detail'] 	    = "home/resort_detail";
$route['blog-detail'] 			= "home/blog_details";
$route['privacy_policy'] 		= "home/privacy_policy";
$route['term_and_services'] 	= "home/term_and_services";
$route['transfers'] 			= "home/transfers";
$route['community'] 			= "home/community";
$route['faq'] 					= "home/faq";
// $route['edit_accommodation/(:any)/(:any)'] 	= "home/edit_accommodation";
$route['galllery'] 				= "home/galllery";
$route['translate_uri_dashes']  = FALSE;
$route[ADMIN_KEY] 				= "admin/superadmin/dashboard";
$route['add-insipiration'] 				= "admin/Pages/add_inspiration";
$route[ADMIN_KEY.'/(:any)'] 	= "admin/$1";
$route[ADMIN_KEY.'/(:any)/(:any)'] = "admin/$1/$2";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4/$5";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4/$5/$6";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4/$5/$6/$7";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4/$5/$6/$7/$8";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4/$5/$6/$7/$8/$9";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10/$11";
$route[ADMIN_KEY.'/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10/$11/$12";