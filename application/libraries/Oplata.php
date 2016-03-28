<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Oplata {

    /**
     * Index Page for this controller.
     *
     */
    public function payment($params) {
    $CI = &get_instance();
    
    switch ($params['category']) {
        case 'movie':
            $res = array(
                    'category' => $params['category'], 
                    'nameCategory' =>'Ролики', 
                    'payLink' => 'https://oplata.info/asp2/pay_wm.asp?id_d=1886620',
                    'price' => $params['price']
                    );
            break;
        case 'novelty':
            $res = array(
                    'category' => $params['category'], 
                    'nameCategory' =>'Новинки', 
                    'payLink' => 'https://oplata.info/asp2/pay_wm.asp?id_d=1097938',
                    'price' => $params['price']
                    );
            break;
        case 'mainstream':
            $res = array(
                    'category' => $params['category'], 
                    'nameCategory' =>'Скидки', 
                    'payLink' => 'https://oplata.info/asp2/pay_wm.asp?id_d=1098823',
                    'price' => $params['price']
                    );
            break;
        case 'sale':
            $res = array(
                    'category' => $params['category'], 
                    'nameCategory' =>'Распродажа', 
                    'payLink' => 'https://oplata.info/asp2/pay_wm.asp?id_d=1103220',
                    'price' => $params['price']
                    );
            break;
        case 'test':
            $res = array(
                    'category' => $params['category'], 
                    'nameCategory' =>'Тестовый', 
                    'payLink' => 'https://oplata.info/asp2/pay_wm.asp?id_d=1143174',
                    'price' => $params['price']
                    );
            break;
        case 'russian':
            $res = array(
                    'category' => $params['category'], 
                    'nameCategory' =>'Русские', 
                    'payLink' => 'https://oplata.info/asp2/pay_wm.asp?id_d=1242539',
                    'price' => $params['price']
                    );
            break;
        case 'tshort':
            $res = array(
                    'category' => $params['category'], 
                    'nameCategory' =>'Футболка', 
                    'price' => $params['price']
                    );
            break;
        default:
            /* page 404 - not found */
            $this->load->helper('alarm');
            alarm('Neizvestnaja kategorja v Oplata');
            exit('<h1>Неизвестный биллинг</h1>');
        }
    return $res;
    }
}
