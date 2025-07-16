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
|	https://codeigniter.com/userguide3/general/routing.html
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


// Default controller
$route['default_controller'] = 'landing';

// Custom Routes
$route['landing'] = 'landing';

$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['reset-password'] = 'auth/reset_password';
$route['logout'] = 'auth/logout';

$route['admin'] = 'admin/index';
$route['admin/stock'] = 'admin/stock_barang';
$route['admin/input'] = 'admin/input_barang';
$route['admin/pesanan'] = 'admin/pesanan';
$route['admin/laporan'] = 'admin/laporan';
$route['admin/profile'] = 'admin/profile';

$route['pembeli'] = 'pembeli/index';
$route['pembeli/barang'] = 'pembeli/barang';
$route['pembeli/keranjang'] = 'pembeli/keranjang';
$route['pembeli/checkout'] = 'pembeli/checkout';
$route['pembeli/profile'] = 'pembeli/profile';
$route['pembeli/tambah/(:num)'] = 'pembeli/tambah_keranjang/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
