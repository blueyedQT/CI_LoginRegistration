<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "/login/index";
$route['login_user'] = "/login/login_user";
$route['register_user'] = "/login/register_user";
$route['welcome'] = "/login/loggedin";
$route['logout'] = "/login/logout";
$route['404_override'] = '';
//end of routes.php