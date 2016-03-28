<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Robokassa extends CI_Controller {

    /**
     * ответ от робокассы
     */
    public function index()
    {
    // их сервер ответил по оплате
    if($this->input->post('Shp_result')) {

        // генерация кода на скачивание
        $code=mt_rand(10000000,99999999);
        //если код уже существует такой - перегенерируем!
        $query = $this->db->query('SELECT * FROM card WHERE code = '.$code.' LIMIT 1');
        //Если код не уникален - генерим еще в цикле
        while($query->num_rows()>0) {
            $code=mt_rand(10000000,99999999);
        }
        
        // записываем в базу статус успешной оплаты и сгенерированный код
        $rob = array('status' => 'success','code' => $code);
        $where = 'id='.$this->input->post('InvId');
        $this->db->query($this->db->update_string('card', $rob, $where));
        
        // какую базу подключить
        switch ($this->input->post('Shp_category')) {
        case 'movie':
            // переносим данные в базу сайта
            $bim = $this->input->post('Shp_category');
            $bom = $this->input->post('OutSum');
            $bum = $this->input->post('Shp_user_id');
            $today = date('Y-m-d H:i:s');

            $link_btm = mysqli_connect('localhost', 'btm', 'HSJ2k3y82hy', 'btm_3');
            $str_btm ='INSERT INTO card (category_film, money, password, id_user, status, time_create) VALUES ("'.$bim.'","'.$bom.'","'.$code.'","'.$bum.'","success","'.$today.'")';
            $result_btm = mysqli_query($link_btm, $str_btm);

            mysqli_close($link_btm);
            break;
        case 'russian':
            break;
        case 'tshort':
            // переносим данные в базу сайта
            $bim = $this->input->post('Shp_category');
            $bom = $this->input->post('OutSum');
            $bum = $this->input->post('Shp_user_id');
            $today = date('Y-m-d H:i:s');

            $link_btm = mysqli_connect('localhost', 'rumata', '9053915911', 'tshort');
            $str_btm ='UPDATE orders SET payment="1" WHERE id="'.$bum.'"';
# error_log(var_export($str_btm, true).PHP_EOL,3,'loggin.log');
            $result_btm = mysqli_query($link_btm, $str_btm);

            mysqli_close($link_btm);
            break;
        default:
            $bim = $this->input->post('Shp_category');
            $bom = $this->input->post('OutSum');
            $bum = $this->input->post('Shp_user_id');
            $today = date('Y-m-d H:i:s');

            $link_btm = mysqli_connect('localhost', 'btm', 'HSJ2k3y82hy', 'btm_1');
            $str_btm ='INSERT INTO card (category_film, money, password, id_user, status, time_create) VALUES ("'.$bim.'","'.$bom.'","'.$code.'","'.$bum.'","success","'.$today.'")';
            $result_btm = mysqli_query($link_btm, $str_btm);

            mysqli_close($link_btm);
        }


        
        // надо ответить серверу робокассы 
        // Факт успешности сообщения магазину об исполнении операции определяется по результату, 
        // возвращаемому обменному пункту. Результат должен содержать "OKnMerchantInvId", 
        // т.е. для счета #5 должен быть возвращен текст "OK5".
        // 
        $query = $this->db->query('SELECT status FROM card WHERE id='.$this->input->post('InvId'));
        if ($query->num_rows() > 0) {
            $row = $query->row(); 
            }    
            //   error_log(var_export($query, true).PHP_EOL,3,'loggin.log');
            if ($row->status =='success'){
                echo "OK".$this->input->post('InvId')."\n";
            }
        die;
        }
    
    }
    
    // успешная оплата
    public function success() {
        //начальные переменные для вывода отображения
        $data['content']='';
        $data['title'] = 'Сервис оплаты - ';
        $data['scripts']='';
        
        // юзер зашел с оплаченным заказом
    if($this->input->post('Shp_user_id')>0){
        if ($this->input->post('Shp_category')=="tshort") {
        redirect('http://print-vk.com/order/success.html');
        }
            
        // Этот ли юзер делал заказ.
        if($this->session->userdata('user_id')!==$this->input->post('Shp_user_id')){
            $this->session->sess_destroy(); // разрушаем сессию
            $data['title'].= 'Ошибка платежа';
            $data['content'].='<h1 class="text-danger">Сессия закрыта</h1>
            <p>Произошёл обрыв связи или слишком долгое время ожидания оплаты.
            В целях безопасности платежа мы прервали сеанс оплаты. 
            Вернитесь на сайт с которого пришли и повторите оплату.</p> 
            <p class="text-danger">Если с Вашего счёта были списаны деньги, свяжитесь со службой поддержки.</p>'; 
            $this->load->view('template', $data);
        }
            
        $query = $this->db->query('SELECT status, code FROM card WHERE id='.$this->input->post('InvId'));
        
        // есть ли такой номер счета - вернулось ноль строк
        if($query->num_rows()==0){
            $data['title'].= 'Ошибка платежа';
            $data['content'].='<h1 class="text-danger">Такого счёта не существует</h1>
            <p>В целях безопасности платежа мы прервали сеанс оплаты. 
            Вернитесь на сайт с которого пришли и повторите оплату.</p>
            <p class="text-danger">Если с Вашего счёта были списаны деньги, свяжитесь со службой поддержки.</p>'; 
            $this->load->view('template', $data);
        }
        
        // вернулось больше нуля строк
        if ($query->num_rows() > 0) {
            $row = $query->row(); 
            } 
            
        // заказ был оплачен
        if($row->status=='success'){
        $data['title'].= 'Оплата прошла успешно';

	$data['content'].='<h1 class="text-success">Оплата прошла успешно</h1>
        <h3 class="text-primary">Ваш код s'.$row->code.'</h3>
        <p>Введите этот код на сайте, с которого пришли.
        Запишите этот код, Вы не сможете получить его второй раз самостоятельно. 
        Если Вы потеряете или забудете код, обратитесь в поддержку сайта, с которого пришли, 
        или по ссылке "Есть вопросы? Задайте их нам" внизу страницы</p>
        <div class="alert alert-info"><p align="left"><b>Внимание! 
        </b>Многие копируют код из этого окна, а на других сайтах он не определяется и не подходит. 
        Этот код рабочий на 100%! Попробуйте ввести код вручную, а не копированием. 
        Это особенность некторых браузеров, например, Firefox или Opera.</p></div>';
        $this->load->view('template', $data);      
        } else {
            $data['title'].= 'Ошибка платежа';
            $data['content'].='<h1 class="text-danger">Неуспешный платёж</h1>
            <p>Ваш платёж не был выполнен Вашим банком. 
            В целях безопасности платежа мы прервали сеанс оплаты. Проверьте наличие 
            необходимой суммы на счету Вашей карты и возможность производить по ней платежи в интернете.</p>    
            <p class="text-danger">Если с Вашего счёта были списаны деньги, свяжитесь со службой поддержки.</p>';
            $this->load->view('template', $data); 
            }
    
    }
        
    
    }
    
    // отказ от оплаты
    public function fail() {
        // если заход от рббокассы
        if($this->input->post('InvId')) {
        
        // если заход по футболкам 
        if ($this->input->post('Shp_category')=="tshort") {
        redirect('http://print-vk.com/order/fail.html');    
        }
            
        //начальные переменные для вывода отображения
        $data['content']='';
        $data['title'] = 'Сервис оплаты - ';
        $data['scripts']='';
        
        $data['title'].= 'Отказ от оплаты';
        $data['content'].='<h1 class="text-danger">Отказ от оплаты</h1>
                <h3 class="text-danger">Вы отказались от платежа, платёж не был выполнен.</h3>
                <p>Нам очень жаль, что Вы передумали. Если этот произошло случайно, Вы можете вернуться назад и произвести оплату.</p>
                <p>&nbsp;</p><a href="javascript:void(0);" onClick="history.go(-1);" class="btn btn-success btn-lg"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Вернуться и оплатить</a>
                <p>&nbsp;</p><p>Как только Вы закроете это окно браузера, в целях безопасности платежа мы полностью прервём сеанс оплаты.</p>';
        $this->load->view('template', $data);
        }

    }
 
}
