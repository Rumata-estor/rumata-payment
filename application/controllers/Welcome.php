<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
    //начальные переменные для вывода отображения
    $data['content']='';
    $data['title'] = 'Сервис оплаты - ';
    $data['scripts']='<script>jQuery(document).ready(function($){$(\'[data-toggle=tooltip]\').tooltip();});</script>';

    //Считаем данные POST
    $billing = $this->input->post('billing');

    switch ($billing) {
        case 'oplata':
            $params = array('category' => $this->input->post('category'), 'price' => $this->input->post('price'));
            $this->load->library('oplata');
            $res = $this->oplata->payment($params);
                // формируем содержимое страницы
                $data['title'].= 'Категория '.$res['nameCategory'];
                $data['content'].='<h1>Оплата кода "'.$res['nameCategory'].'" <small>('.$res['price'].' руб.)</small></h1>';
                    // одноразовое оповещение. Нужно изменить имя куки
                    if (!isset($_COOKIE['dollar'])) {
                        $data['content'].='<div class="alert alert-info" id="nav"><p class="text-left">Друзья, в связи с нестабильностью курса рубля и гривны 
                        мы вынуждены привязать стоимость наших услуг к курсу доллара, так как все расчёты между нами, сотовыми операторами, 
                        платёжными системами и банками ведутся в твёрдой валюте. Мы надеемся на ваше понимание, и что со стабилизацией экономической и политической 
                        ситуации в ваших странах мы сможем вернуться к постоянной, стабильной цене.</p><p>&nbsp;</p>
                        <small><p class="text-right"><a style="cursor:pointer;" onClick="document.getElementById(\'nav\').style.display = \'none\', document.cookie = \'dollar=1\';">Я прочитал и понял, больше не показывать</a></p></small>
                        </div>';
                    }
                $data['content'].='<h4 class="text-info">Оплачивайте быстро и легко с помощью платёжных систем или интернет-банкинга!</h4>'
                .'<p>&nbsp;</p>'
                .'<a href='.$res['payLink'].'&currency=WMR class="btn btn-success btn-lg">Оплатить и получить код "'.$res['nameCategory'].'"&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>'
                .'<p>&nbsp;</p>'
                .'<p>Всё очень просто: кликаете по конопке &quot;Оплатить и получить&quot;, '
                .'выбираете удобный Вам способ оплаты, производите оплату и получаете код доступа.'
                .' В настоящее время доступна оплата</p>'
                .'<p>'
                .'<a class="ico_WMR placeholder" href='.$res['payLink'].'&currency=WMR data-toggle=tooltip data-placement=bottom title="WebMoney"></a> '
                .'<a class="ico_MTS placeholder" href='.$res['payLink'].'&currency=MTS data-toggle=tooltip data-placement=bottom title="Со счёта MTC"></a> '
                .'<a class="ico_BLN placeholder" href='.$res['payLink'].'&currency=BLN data-toggle=tooltip data-placement=bottom title="Со счёта Билайн"></a> '
                .'<a class="ico_MGF placeholder" href='.$res['payLink'].'&currency=MGF data-toggle=tooltip data-placement=bottom title="Со счёта Мегафон"></a> '
                .'<a class="ico_TL2 placeholder" href='.$res['payLink'].'&currency=TL2 data-toggle=tooltip data-placement=bottom title="Со счёта TELE2"></a> '
                .'<a class="ico_PCR placeholder" href='.$res['payLink'].'&currency=PCR data-toggle=tooltip data-placement=bottom title="Яндекс.Деньги"></a> '
                .'<a class="ico_PLE placeholder" href='.$res['payLink'].'&currency=PPL data-toggle=tooltip data-placement=bottom title="PayPal"></a> '
                .'<a class="ico_QSR placeholder" href='.$res['payLink'].'&currency=QSR data-toggle=tooltip data-placement=bottom title="QIWI"></a> '
                .'<a class="ico_RUB placeholder" href='.$res['payLink'].'&currency=RUB data-toggle=tooltip data-placement=bottom title="Терминалы оплаты"></a> '
                .'<a class="ico_PPZ placeholder" href='.$res['payLink'].'&currency=PPZ data-toggle=tooltip data-placement=bottom title="WM-карты"></a> '
                .'<a class="ico_MRR placeholder" href='.$res['payLink'].'&currency=MRR data-toggle=tooltip data-placement=bottom title="Деньги@Mail.Ru"></a>'
                .'<a class="ico_ALF placeholder" href='.$res['payLink'].'&currency=BNK data-toggle=tooltip data-placement=bottom title="АльфаБанк"></a>'
                .'<a class="ico_SBR placeholder" href='.$res['payLink'].'&currency=BNK data-toggle=tooltip data-placement=bottom title="Сбербанк"></a>'
                .'<a class="ico_SVB placeholder" href='.$res['payLink'].'&currency=BNK data-toggle=tooltip data-placement=bottom title="Связной Банк"></a>'
                .'<a class="ico_BNK placeholder" href='.$res['payLink'].'&currency=BNK data-toggle=tooltip data-placement=bottom title="Интернет-банк"></a>'
                .'<a class="ico_PRR placeholder" href='.$res['payLink'].'&currency=PRR data-toggle=tooltip data-placement=bottom title="Почта России"></a>'
                .'<a class="ico_GRU placeholder" href='.$res['payLink'].'&currency=GRU data-toggle=tooltip data-placement=bottom title="Подарочная карта"></a>'
                .'<a class="ico_RBX placeholder" href='.$res['payLink'].'&currency=BNK data-toggle=tooltip data-placement=bottom title="ВТБ24, Русский стандарт, Промсвязьбанк и другое"></a>'
                . '</p>'
                .'<p>напрямую со счёта Вашего телефона (без отправки смс на короткие номера), '
                .'электронными деньгами (<a href="http://webmoney.ru" target="_blank">WebMoney</a>, '
                .'<a href="https://money.yandex.ru" target="_blank">Яндекс.Деньги</a>, '
                .'<a href="https://www.paypal.com" target="_blank">PayPal</a>), '
                .'с кошелька <a href="https://qiwi.com" target="_blank">QIWI</a>, через терминалы оплаты и многое-многое другое.</p>'
                .'<p>&nbsp;</p>'
                .'<p><a href="/help.php" target="_blank" class="btn btn-default"><i class="fa fa-life-ring text-danger"></i>&nbsp;Помощь&nbsp;по&nbsp;оплате&nbsp;(с&nbsp;картинками)</a> &nbsp;&nbsp;&nbsp;<a  class="btn btn-default" href="https://siteheart.com/webconsultation/446437?s=1" target="siteheart_sitewindow_446437" onclick="o = window.open;
                o(\'https://siteheart.com/webconsultation/446437?s=1\', \'siteheart_sitewindow_446437\', \'width=700,height=400,top=150,left=150,resizable=yes\');
                return false;"><i class="fa fa-question-circle  text-danger"></i>&nbsp;Есть&nbsp;вопросы?&nbsp;Задайте&nbsp;их&nbsp;нам!</a></p>
                <p style="color: grey"><small><b>Выдача кода происходит автоматически.</b> Если этого не произошло и Вы не получили код, при этом средства были списаны с Вашего счёта (кошелька), Вам надо самостоятельно зайти на сервис <a href="http://www.oplata.info" target="_blank">Oplata.Info</a>, ссылка &quot;Мои покупки&quot; и получить его вручную. В случае возникновения затруднений с получением кода на данном сервисе <a href="https://siteheart.com/webconsultation/446437?s=1" target="siteheart_sitewindow_446437" onclick="o = window.open;
                o(\'https://siteheart.com/webconsultation/446437?s=1\', \'siteheart_sitewindow_446437\', \'width=700,height=400,top=150,left=150,resizable=yes\'); return false;">свяжитесь с нами </a> или техподдержкой (<a href="mailto:support@digiseller.ru">support@digiseller.ru</a>). В письме обязательно нужно сообщить реквизиты своего платежа и email или номер телефона, который Вы указывали при оплате.</small></p>';
            break;
        case 'liqpay':
          //  $this->category = 'mainstream';
          //  $this->nameCategory = 'Скидки';
          //  $this->payLink = 'http://www.oplata.info/asp/pay_wm.asp?id_d=1098823';// формируем содержимое страницы
            $data['content'].= $res['category'];
            $data['content'].='<h1>Оплатить код "'.$res['nameCategory'].'"</h1>
            <h4>Цените Ваше время и деньги — производите оплату банковскими карточками!</h4>
            <h3><b>Стоимость при оплате картой всего '.$res['price'].' руб.</b></h3>
            <p>Выдача кода происходит автоматически. Для его получения нажимте на кнопку "Перейти на сайт оплаты". Вам нужно будет ввести данные карточки и на сайте Вашего банка подвердить оплату. В случае возникновения затруднений свяжитесь с техподдержкой и сообщите реквизиты платежа.</p>
            <p>&nbsp;</p>';
            $data['content'].='
    <form method="POST" action="'.PAY_URL.'" name="form1" accept-charset="utf-8">
        <input type="hidden" name="signature" value="'.$signature.'" />
        <input type="hidden" name="data" value="'.$data.'" />
        <a class="btn btn-success btn-lg" href="javascript:void(0);" onClick="form1.submit();">Перейти на сайт оплаты <span class="glyphicon glyphicon-chevron-right icon-white"></span></a>
    </form>
    <p>&nbsp;</p>';
            // текст после формы оплаты, выводится в темплейте
            $data['content'].='<p>К оплате принимаются карты <b>Visa</b> стран СНГ или <b>MasterCard</b>
            всего мира, выпущенные любым банком и не имеющие ограничений на совершение интернет-платежей. 
            Счёт карты может быть в любой валюте, 
            система производит автоматическую конвертацию в рубли. Текущий курс ЦБ РФ '.$rub_eur.' RUB/EUR.</p>';

            break;
        case 'robokassa':
            
            #define('PAY_URL', 'http://test.robokassa.ru/Index.aspx'); // ЭТО ТЕСТОВЫЙ УРЛ
            define('PAY_URL', 'https://auth.robokassa.ru/Merchant/Index.aspx'); // ЭТО БОЕВОЙ УРЛ
            // регистрационная информация (пароль #2)
            $mrh_pass2 = "29rvoybhoukhaoslsa";
            // регистрационная информация (логин, пароль #1)
            $mrh_login = "payment-service";
            $mrh_pass1 = "19rvoybhoukhaoslsa";
            
        
 
            // получаем данные о платеже и заносим в сессию
            $params = array('category' => $this->input->post('category'), 'price' => $this->input->post('price'), 'user_id' => $this->input->post('user_id'));
            $this->session->set_userdata($params);
            
            
            // создаем новый счет
            $order = array('category' => $this->input->post('category'), 
                'price' =>$this->input->post('price'),
                'billing' => 'robokassa', 
                'user_id' => $this->input->post('user_id')
                 );
            // делаем запрос и сохраняем в базу данных, предварительно обработав данные хелпером 
            $query = $this->db->query($this->db->insert_string('card', $order));
            // получаем номер счета, равно номеру записи
            $id= $this->db->insert_id();
            // добваляем к сессии номер счета
            $this->session->set_userdata('id', $id);
            
            // Формируем данные для запроса к робокассе
            
            // Оплата заданной суммы с выбором валюты на сайте ROBOKASSA
            // формирование подписи $crc  = md5($mrh_login:$out_summ:$id:$mrh_pass1:Shp_item=$shp_item);   
            // $str = $mrh_login.":".$out_summ.":".$id.":".$mrh_pass1;
            // в переменных Shp_result=result здесь и дальше в форме 
            // передаются пользовательские параметры. должно быть по алфавиту
            // Shp_result=result - чтобы в роутере понять, что это ответ сервера робокассы
           
            $str = $mrh_login.":".$this->session->userdata('price').":".$id.":".$mrh_pass1.":Shp_category=".$this->session->userdata('category').":Shp_result=result:Shp_user_id=".$this->session->userdata('user_id');
            $crc = md5($str);
        
            // форма оплаты, выводится в темплейте
             
            // подключаем библиотеку Оплата для получения русского названия товара
            $this->load->library('oplata');
            $res = $this->oplata->payment($params);           
            
            // собираем данные для формы
            $attr_form = array('name'=>'robokassa'); // общее по форме
            $hidden = array('MrchLogin' => $mrh_login, 
                'OutSum' => $this->session->userdata('price'),
                'InvId' => $this->session->userdata('id'),
                'Desc' => 'Оплата счета '.$id.' - '.$res['nameCategory'],
                'SignatureValue' => $crc,
                'Encoding' => 'utf-8',
                'Culture' => 'ru',
                'IncCurrLabel' => '',
                'Shp_category' => $this->session->userdata('category'),
                'Shp_result' => 'result',
                'Shp_user_id' => $this->session->userdata('user_id')
                );
            
            
if ($this->input->post('category')=='tshort') {
    $data['content']='';
    $data['title'] = 'Сервис оплаты - ';
    $data['scripts']='';
    $data['content'].='<h4 class="text-info">Цените Ваше время — легко и быстро производите оплату банковскими карточками!</h4><p>&nbsp;</p>';       
            // показываем форму оплаты
            $data['content'].= 
                form_open(PAY_URL, $attr_form, $hidden).
                '<a href="javascript:void(0);" onClick="robokassa.submit();" name="robokassa" class="btn btn-success btn-lg">Оплатить заказ ('.$res['price'].' руб.)&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>';
                form_close().'';
            // подвал страницы
            $data['content'].='<p>&nbsp;</p>
                <p>Всё очень легко: кликаете по конопке &quot;Оплатить заказ&quot;,
                переходите на сайт ROBOKASSA, выбираете удобный Вам способ оплаты, производите оплату и подтверждаете её.</p>
                <p>Если Вы выберете оплату карточкой, Вам нужно будет ввести её данные и на сайте Вашего банка подвердить оплату. 
                Если Вы не получили код, при этом средства были списаны с Вашего счёта (кошелька), <a href="https://siteheart.com/webconsultation/446437?s=1" target="siteheart_sitewindow_446437" onclick="o = window.open;
                o(\'https://siteheart.com/webconsultation/446437?s=1\', \'siteheart_sitewindow_446437\', \'width=700,height=400,top=150,left=150,resizable=yes\'); return false;">свяжитесь с нами </a>.</p>
                <p>&nbsp;</p><p><a href="/help.php" target="_blank" class="btn btn-default"><i class="fa fa-life-ring text-danger"></i>&nbsp;Помощь&nbsp;(с&nbsp;картинками)</a> &nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="https://siteheart.com/webconsultation/446437?s=1" target="siteheart_sitewindow_446437" onclick="o = window.open;
                o(\'https://siteheart.com/webconsultation/446437?s=1\', \'siteheart_sitewindow_446437\', \'width=700,height=400,top=150,left=150,resizable=yes\');
                return false;"><i class="fa fa-question-circle  text-danger"></i>&nbsp;Есть&nbsp;вопросы?&nbsp;Задайте&nbsp;их!</a></p>

                <p style="color: grey"><small>Оплата осуществляется через платёжную систему <a href="http://robokassa.ru/" target="_blank">ROBOKASSA</a>, 
                сервис обеспечивает <a href="http://oceanbank.ru/" target="_blank">ОКЕАН БАНК</a> 
                (ЗАО "ОКЕАН БАНК", генеральная лицензия ЦБ РФ №1697 от 19.07.07 г.), 
                технологическую составляющую процесса приема платежей обеспечивает <a href="http://roboxchange.com/" target="_blank">ЗАО "Центр Интернет Платежей"</a>.
                Сервисы ROBOKASSA прошли сертификацию на соответствие стандарту <a href="https://ru.wikipedia.org/wiki/PCI_DSS" target="_blank">PCI DSS</a>, 
                что подтверждает, что применяемые технологии, регламентирующие сохранность данных держателей карт, соответствуют самым строгим международным требованиям.</small></p>

            <div style="width: 90%; margin: 0 auto;">
                <div class="my-pull-left">
                    <img src="/img/ssl.png" width="25" height="25" title="Защищено SSL-сертификатом" />&nbsp;&nbsp;&nbsp;<img src="/img/logo_pci.gif" width="97" height="32" title="Безопасность гарантируется сертификатами THAWTE и PCI" />&nbsp;&nbsp;&nbsp;<img src="/img/okeanbank.png" width="101" height="24" title="Сервис обеспечивает ОКЕАНБАНК" />&nbsp;&nbsp;&nbsp;<img src="/img/robokassa.png" width="121" height="15" title="Сервис обеспечивает ROBOKASSA" />
                </div>
                <div class="my-pull-right">
                    <img src="/img/visanew_mt.png" width="94" height="25" title="Visa Personal Payments" />&nbsp;&nbsp;&nbsp;<img src="/img/mastercard.png" width="43" height="25" title="MasterCard" />
                </div>
            </div>
            <div class="clearfix"></div>';
   
} else {
    

    

  
  
            
            // вывод содержимого старницы
            $data['title'].= 'Категория '.$res['nameCategory'];
            $data['content'].='<h1>Оплата кода "'.$res['nameCategory'].'" <small>('.$res['price'].' руб.)</small></h1>';
            
            // одноразовое оповещение. Нужно изменить имя куки
                    if (!isset($_COOKIE['dollar'])) {
                        $data['content'].='<div class="alert alert-info" id="nav"><p class="text-left">Друзья, в связи с нестабильностью курса рубля и гривны 
                        мы вынуждены привязать стоимость наших услуг к курсу доллара, так как все расчёты между нами, сотовыми операторами, 
                        платёжными системами и банками ведутся в твёрдой валюте. Мы надеемся на ваше понимание, и что со стабилизацией экономической и политической 
                        ситуации в ваших странах мы сможем вернуться к постоянной, стабильной цене.</p><p>&nbsp;</p>
                        <small><p class="text-right"><a style="cursor:pointer;" onClick="document.getElementById(\'nav\').style.display = \'none\', document.cookie = \'dollar=1\';">Я прочитал и понял, больше не показывать</a></p></small>
                        </div>';
                    }
                    
            $data['content'].='<h4 class="text-info">Цените Ваше время — легко и быстро производите оплату банковскими карточками!</h4><p>&nbsp;</p>';       
            // показываем форму оплаты
            $data['content'].= 
                form_open(PAY_URL, $attr_form, $hidden).
                '<a href="javascript:void(0);" onClick="robokassa.submit();" name="robokassa" class="btn btn-success btn-lg">Оплатить и получить код "'.$res['nameCategory'].'"&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></a>';
                form_close().'';
            // подвал страницы
            $data['content'].='<p>&nbsp;</p>
                <p>Всё очень легко: кликаете по конопке &quot;Оплатить и получить&quot;,
                переходите на сайт ROBOKASSA, выбираете удобный Вам способ оплаты, производите оплату, подтверждаете её и получаете код доступа. Выдача кода происходит автоматически. </p>
                <p>Если Вы выберете оплату карточкой, Вам нужно будет ввести её данные и на сайте Вашего банка подвердить оплату. 
                Если Вы не получили код, при этом средства были списаны с Вашего счёта (кошелька), <a href="https://siteheart.com/webconsultation/446437?s=1" target="siteheart_sitewindow_446437" onclick="o = window.open;
                o(\'https://siteheart.com/webconsultation/446437?s=1\', \'siteheart_sitewindow_446437\', \'width=700,height=400,top=150,left=150,resizable=yes\'); return false;">свяжитесь с нами </a>.</p>
                <p>&nbsp;</p>
                <p><a href="/feedback.php" target="_blank" class="btn btn-default"><i class="fa fa-pencil-square-o text-danger"></i>&nbsp;Не&nbsp;получили&nbsp;код?&nbsp;Заполните&nbsp;форму!</a> &nbsp;&nbsp;&nbsp; 
                <a href="/help.php" target="_blank" class="btn btn-default"><i class="fa fa-life-ring text-danger"></i>&nbsp;Помощь&nbsp;(с&nbsp;картинками)</a> &nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="https://siteheart.com/webconsultation/446437?s=1" target="siteheart_sitewindow_446437" onclick="o = window.open;
                o(\'https://siteheart.com/webconsultation/446437?s=1\', \'siteheart_sitewindow_446437\', \'width=700,height=400,top=150,left=150,resizable=yes\');
                return false;"><i class="fa fa-question-circle  text-danger"></i>&nbsp;Есть&nbsp;вопросы?&nbsp;Задайте&nbsp;их!</a></p>

                <p style="color: grey"><small>Оплата осуществляется через платёжную систему <a href="http://robokassa.ru/" target="_blank">ROBOKASSA</a>, 
                сервис обеспечивает <a href="http://oceanbank.ru/" target="_blank">ОКЕАН БАНК</a> 
                (ЗАО "ОКЕАН БАНК", генеральная лицензия ЦБ РФ №1697 от 19.07.07 г.), 
                технологическую составляющую процесса приема платежей обеспечивает <a href="http://roboxchange.com/" target="_blank">ЗАО "Центр Интернет Платежей"</a>.
                Сервисы ROBOKASSA прошли сертификацию на соответствие стандарту <a href="https://ru.wikipedia.org/wiki/PCI_DSS" target="_blank">PCI DSS</a>, 
                что подтверждает, что применяемые технологии, регламентирующие сохранность данных держателей карт, соответствуют самым строгим международным требованиям.</small></p>

            <div style="width: 90%; margin: 0 auto;">
                <div class="my-pull-left">
                    <img src="/img/ssl.png" width="25" height="25" title="Защищено SSL-сертификатом" />&nbsp;&nbsp;&nbsp;<img src="/img/logo_pci.gif" width="97" height="32" title="Безопасность гарантируется сертификатами THAWTE и PCI" />&nbsp;&nbsp;&nbsp;<img src="/img/okeanbank.png" width="101" height="24" title="Сервис обеспечивает ОКЕАНБАНК" />&nbsp;&nbsp;&nbsp;<img src="/img/robokassa.png" width="121" height="15" title="Сервис обеспечивает ROBOKASSA" />
                </div>
                <div class="my-pull-right">
                    <img src="/img/visanew_mt.png" width="94" height="25" title="Visa Personal Payments" />&nbsp;&nbsp;&nbsp;<img src="/img/mastercard.png" width="43" height="25" title="MasterCard" />
                </div>
            </div>
            <div class="clearfix"></div>';
            
                            
         //   отправляем запрос
         //   получаем ответ заход робокассы
         //   добавляем данные в сессию
         //   сохраняем в своей базе данных 
         //   если юзер после оплаты (ок)
         //   выдаем код
         //   если неуспешная оплата - ваыход
         //   $this->nameCategory = 'Распродажа';
         //   $this->payLink = 'http://www.oplata.info/asp/pay_wm.asp?id_d=1103220';
}
            break;
        default:
        /* page 404 - not found */
        //$this->load->helper('alarm');
        //alarm('Neizvestny billing');
        redirect('http://payment-service.biz/index.html');
        die;
    }
    $this->load->view('template', $data);

    }
}
