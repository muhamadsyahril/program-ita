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

$route['default_controller'] = "frontend/front";
$route['404_override'] = '';
$routes['allow_multiple_subfolders'] = TRUE;


// START ALIAS WEB BACKEND //
$route['backend'] 		= "backend/auth";
$route['backend/home'] 		= "backend/ui_backend/home";


$route['backend/user'] 		= "backend/user/user";
$route['backend/user/simpan'] 		= "backend/user/user/simpan";
$route['backend/user/edit'] 		= "backend/user/user/edit";
$route['backend/user/hapus/(:any)'] 		= "backend/user/user/hapus/";
$route['backend/user/tambah'] 		= "backend/user/user/tambah";

$route['backend/produk'] 		= "backend/produk/produk";
$route['backend/produk/simpan'] 		= "backend/produk/produk/simpan";
$route['backend/produk/edit'] 		= "backend/produk/produk/edit";
$route['backend/produk/hapus/(:any)'] 		= "backend/produk/produk/hapus/";
$route['backend/produk/tambah'] 		= "backend/produk/produk/tambah";

$route['backend/petugas'] 		= "backend/petugas/petugas";
$route['backend/petugas/simpan'] 		= "backend/petugas/petugas/simpan";
$route['backend/petugas/edit'] 		= "backend/petugas/petugas/edit";
$route['backend/petugas/hapus/(:any)'] 		= "backend/petugas/petugas/hapus/";
$route['backend/petugas/tambah'] 		= "backend/petugas/petugas/tambah";

$route['backend/area'] 						= "backend/area/area";
$route['backend/area/simpan'] 				= "backend/area/area/simpan";
$route['backend/area/edit'] 				= "backend/area/area/edit";
$route['backend/area/hapus/(:any)'] 		= "backend/area/area/hapus/";
$route['backend/area/tambah'] 				= "backend/area/area/tambah";

$route['backend/pelanggan'] 						= "backend/pelanggan/pelanggan";
$route['backend/pelanggan/simpan'] 				= "backend/pelanggan/pelanggan/simpan";
$route['backend/pelanggan/edit'] 				= "backend/pelanggan/pelanggan/edit";
$route['backend/pelanggan/hapus/(:any)'] 		= "backend/pelanggan/pelanggan/hapus/";
$route['backend/pelanggan/tambah'] 				= "backend/pelanggan/pelanggan/tambah";

$route['api'] 						= "backend/api_andro/getUser";

$route['front'] 		= "frontend/front";



/* End of file routes.php */
/* Location: ./application/config/routes.php */