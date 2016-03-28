<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {
        $data['content']='';
        $page = 'Тест - ';
        $data['title'] = ucfirst($page); // Capitalize the first letter    <INPUT TYPE="HIDDEN" NAME="user_id" VALUE ="1000">
        $data['scripts']='';
    $data['content'].='
    <FORM METHOD="POST" ACTION="/">
    <INPUT TYPE="HIDDEN" NAME="category" VALUE ="tshort">
    <INPUT TYPE="HIDDEN" NAME="billing" VALUE ="robokassa">
    <INPUT TYPE="HIDDEN" NAME="price" VALUE ="1950">
    <INPUT TYPE="HIDDEN" NAME="user_id" VALUE ="38">
    <input type="submit" value="Проверка" />
    </FORM>'; 
echo date('Y-m-d H:i:s');
     $code=mt_rand(10000000,99999999);
    //если код уже существует такой - перегенерируем!
    $query = $this->db->query('SELECT * FROM card WHERE code = '.$code.' LIMIT 1');
    //Если код не уникален - генерим еще в цикле
    while($query->num_rows()>0) {
        $code=mt_rand(10000000,99999999);
    }
    
     $data['content'].=$code;   
    $this->load->view('template', $data);
    }
    

 
        
    

}
