<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stat {
    function stat() {
    $CI = &get_instance();


    $stat = array('user_ip' => $_SERVER['REMOTE_ADDR'], 
                'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
                'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],
                'REQUEST_URI' => $_SERVER['REQUEST_URI']
                 );
            // делаем запрос и сохраняем в базу данных, предварительно обработав данные хелпером 
            $query = $this->db->query($this->db->insert_string('visit_stats', $stat));

    }


    
}  
stat();