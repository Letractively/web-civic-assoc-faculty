<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = '...';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']                =   "auth";
$route['404_override']                      =   '';

$route['administration']                    =   "payments/index";
$route['degrees/(:num)']                    =   "degrees/index/$1";

$route['events/(:num)']                     =   "events/index/$1";
$route['events/(:num)/(:num)']              =   "events/index/$1/$2";
$route['events/newest/(:num)']              =   "events/newest/$1";
$route['events/newest/(:num)/(:num)']       =   "events/newest/$1/$2";
$route['events/prior/(:num)']               =   "events/prior/$1";
$route['events/prior/(:num)/(:num)']        =   "events/prior/$1/$2";

$route['payments/(:num)']                   =   "payments/index/$1";
$route['payments/(:num)/(:num)']            =   "payments/index/$1/$2";
$route['payments/nopaid/(:num)']            =   "payments/nopaid/$1";
$route['payments/nopaid/(:num)/(:num)']     =   "payments/nopaid/$1/$2";
$route['payments/paid/(:num)']              =   "payments/paid/$1";
$route['payments/paid/(:num)/(:num)']       =   "payments/paid/$1/$2";

$route['posts/(:num)']                      =   "posts/index/$1";
$route['users/(:num)']                      =   "users/index/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */