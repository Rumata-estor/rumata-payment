<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {
        $data['content']='';
        $page = 'Форма розыска платежа';
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['scripts']='';
    $data['content'].='
    <h1>Обратная связь</h1>
        <p>Мы стремится к предоставлению качественного сервиса, поэтому нам очень 
        важны обращения, которые содержат информацию о любых проблемах, возникших 
        при пользовании нашими услугами. Мы отвечаем на <b>все сообщения</b>, 
        если Вы не получили ответа в течение суток (это максимум), скорее всего Ваше сообщение 
        не дошло до нас. Такого ещё не было ни разу, но может быть. 
        В этом случае напишите нам ещё раз, пожалуйста!</p>
	<p class="text-danger"><b>Если Вы не получили код, возникли сложности с его использованием, заполните эту форму:</b></p>

 


    <p align="left">Если у Вас что-то не получается, не стесняйтесь <a href="https://siteheart.com/webconsultation/446437?s=1" target="siteheart_sitewindow_446437" onclick="o = window.open;
        o(\'https://siteheart.com/webconsultation/446437?s=1\', \'siteheart_sitewindow_446437\', \'width=800,height=400,top=150,left=150,resizable=yes\');
        return false;" class="help"><b>обратиться за помощью!</b></a></p>';
    $this->load->view('template', $data);
    }
}
