<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index()
    {
        $data['content']='';
        $page = 'Сервис оплаты - помощь';
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['scripts']='';
    $data['content'].='
    <h1>Помощь при оплате электронными деньгами</h1>
    <h4>Как правильно произвести оплату, что делать, если Вы не получили код, что делать, если код не подходит</h4>

    <p align="left">Нажмите на кнопку &quot;Оплатить и получить код&quot; и перейдите на сайт оплаты. Вы увидите примерно вот что:</p>
    <img src="/img/1.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">Выберите способ оплаты, в нашем примере производится оплата с кошелька WebMoney в рублях. Если у Вас нет необходимой суммы в рублях, Вы можете выбрать другой тип валюты, например доллары, евро, гривны и т.п.</p>
    <p align="left">Тут же нужно указать Ваш e-mail, на который Вам будет отправлено письмо со ссылкой на получение кода. Это на тот случай, если Вы его потеряете. Будьте внимательны, не ошибитесь в написании электронного адреса Вашей почты!</p>
    <img src="/img/2.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">После того, как Вы нажмёте конпку &quot;Оплатить&quot;, Вы перейдёте на сайт сервиса Webmoney Merchant, где продолжите оплату (см. картинку ниже). Ваш веб-кошелёк должен быть запущен.</p>
    <img src="/img/3.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">Нажмите кноку &quot;Далее&quot;, откроется дополнительное окошко Вашего кошелька, Вы пройдёте авторизацию в нём, после чего откроется окно подтверждения оплаты (если у Вас включена опция подтверждения оплаты). Нажмите кнопку &quot;Платеж подтверждаю&quot;.</p>
    <img src="/img/5.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">Оплата произведена. Вы увидите окно с реквизитами платежа (см. картинку ниже).</p>
    <img src="/img/6.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">Через несколько секунд автоматически откроется окно с оплаченными кодом  (см. следующую картинку). </p>
    <div class="alert alert-info"><p align="left"><b>Внимание!</b> Если этого не произошло, Вам нужно самостоятельно нажать на кнопку &quot;Вернуться к продавцу&quot;. Очень многие &quot;застревают&quot; на этом моменте. Увидев, что оплата произведена, многие закрывают окно оплаты. В результате деньги со счёта списаны, а код так и не получен. Если Вы случайно поступили также, дальше мы напишем, как Вам получить оплаченный код.</p></div>
    <p align="left">Если автоматический переход сработал, Вы попадаете на окно с оплаченным кодом. Его Вы видите в строке &quot;Оплаченный товар&quot;. Его и нужно ввести на сайте, с которого пришли. </p>
    <img src="/img/7.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">Кроме того, на указанный Вами адрес электронной почты будет выслано письмо примерно следующего содержания:</p>
    <p align="left"><i>Уважаемый покупатель!<br />
    </i><i>На сайте нашего интернет-магазина вы приобрели товар под названием «Тестовый». Для получения оплаченного товара перейдите по ссылке https://www.oplata.info/... По этой ссылке вы также найдёте наши контактные реквизиты.</i><br />
    <i>Спасибо за покупку! <br />
    С уважением, администрация интернет-магазина. </i></p>
    <p align="left">Пройдя по ссылке, указанной в письме, Вы всегда можете посмотреть уже оплаченные Вами коды. Воспользуйтесь ею, если Вы потеряли Ваш код.</p>
    <div class="alert alert-info"><p align="left"><b>Внимание! </b>Многие  по привычке копируют код из этого окна, а на других сайтах он не определяется и не подходит! Это особенность некторых браузеров, например, Firefox или Opera. Лучше всего ввести код вручную.</p></div>
    <img src="/img/8.jpg" /><br />
    <p>&nbsp;</p>

    <div class="alert alert-info"><p align="left"><b>Внимание! </b>Если по каким-то причинам деньги с Вашего счёта были списаны, а код Вы так и не получили, Вам нужно сделать следующее. Зайдите на сайт <a href="http://oplata.info/">Oplata.info</a>, откройте вкладку &quot;Мои покупки&quot;. Вы увидите следующее:</p></div>
    <img src="/img/10.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">Авторизутесь социальной сетью или другим OpenID-провайдером, если Вы делали это раньше или укажите e-mail, который вводили при оплате, или выберите способ оплаты, которым Вы пользовались, оплачивая товар (см. картинку ниже)</p>
    <img src="/img/11.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">Нажмите кнопку "Далее". Если Вы оплачивали с помощью WebMoney, возможно потребуется авторизация через веб-кошелек. После того как Вы подтвердите, что Вы — это Вы, Вы увидите список всех купленных Вами товаров. </p>
    <img src="/img/13.jpg" /><br />
    <p>&nbsp;</p>


    <p align="left">Нажмите на ссылку нужного Вам товара, последняя покупка будет вверху списка. Вы попадёте на страницу товара, где найдёте оплаченный Вами код.</p>
    <img src="/img/7.jpg" /><br />
    <p>&nbsp;</p>

    <p align="left">Если у Вас что-то не получается, не стесняйтесь <a href="https://siteheart.com/webconsultation/446437?s=1" target="siteheart_sitewindow_446437" onclick="o = window.open;
        o(\'https://siteheart.com/webconsultation/446437?s=1\', \'siteheart_sitewindow_446437\', \'width=800,height=400,top=150,left=150,resizable=yes\');
        return false;" class="help"><b>обратиться за помощью!</b></a></p>';
    $this->load->view('template', $data);
    }
}
