<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

#$this->load->library('email');
#$this->email->from('your@your-site.com', 'Your Name');
#$this->email->to('larin@ya.ru');
#$this->email->cc('another@another-example.com');
#$this->email->bcc('them@their-example.com'); 


#$this->email->initialize($config);