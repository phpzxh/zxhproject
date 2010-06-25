<?php

abstract class BaseController
{

	function __construct($act)
	{
		if(!empty($act) && !method_exists($this, $act) || empty($act)) {
			include_once ROOTPATH.'/lib/controller/controllerexception.php';
			throw new ControllerException('控制器方法不存在!');
		}

		$this->$act();
		
	}

	public function redirectUrl($url)
	{
		$url = strtr(trim($url), array('\r'=>'', '\n'=>''));
		header('location:'.$url, true);
		exit();
	}


	
}