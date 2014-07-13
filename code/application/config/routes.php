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
|	$route['default_controller'] = 'welcome';
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

$route['default_controller'] = "admin";
$route['404_override'] = '';
$route['admin'] = 'admin';
$route['admin/login'] = 'admin/login';
$route['logout'] = 'admin/logout';
$route['admin/logout'] = 'admin/logout';
$route['admin/clients'] = 'clients/clients_list';
$route['admin/addclient'] = 'clients/add_client';
$route['admin/updateclient'] = 'clients/update_client';
$route['admin/delclent'] = 'clients/del_client';

$route['admin/addclient/(:any)'] = 'clients/add_client/$1';
$route['admin/updateclient/(:any)'] = 'clients/update_client/$1';
$route['admin/delclient/(:any)'] = 'clients/del_client/$1';

$route['admin/email'] = 'email/email';
$route['admin/emailsend'] = 'email/email_send';
$route['admin/emailsend/(:any)'] = 'email/email_send/$1';



/* End of file routes.php */
/* Location: ./application/config/routes.php */