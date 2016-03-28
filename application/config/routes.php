<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome'; // главная страница
$route['feedback'] = 'feedback'; // заявка о потерянном платеже
$route['help'] = 'help'; // помощь
$route['test'] = 'test'; // помощь

// по робокасса
$route['robokassa'] = 'robokassa'; // ответ робокассы
$route['robokassaSuccess'] = 'robokassa/success'; // успешная оплата
$route['robokassaFail'] = 'robokassa/fail'; // отказ от оплаты


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
