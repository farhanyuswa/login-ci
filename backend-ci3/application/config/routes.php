<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ======== API Routes ========

// Auth routes
$route['api/login']['post']     = 'api/auth/login';
$route['api/register']['post']  = 'api/auth/register';

// Data ekspor-impor
$route['api/eksporimpor']['get'] = 'api/data/eksporimpor';

