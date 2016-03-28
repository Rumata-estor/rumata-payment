<?php defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * Отправка емайла на сотовый
	 */
	function alarm($message)
	{
		return mail('79616666898@sms.beemail.ru','', 'ALARM! '.$_SERVER['REMOTE_HOST'].' *  '.$_SERVER['REMOTE_ADDR'].' * '.$_SERVER['HTTP_USER_AGENT'].' * '.$message);
	}

