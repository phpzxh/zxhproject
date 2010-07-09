<?php

abstract class BaseController
{

	protected $view;

	

	function __construct($act)
	{
		if(!empty($act) && !method_exists($this, $act) || empty($act)) {
			include_once ROOTPATH.'/lib/controller/controllerexception.php';
			throw new ControllerException('控制器方法不存在!');
		}

		$this->$act();
		
	}

	/**
	   跳转到指定的Url
	  @param $url 跳转的url
	  @return void 
	**/

	public static function redirectUrl($url)
	{
		$url = strtr(trim($url), array('\r'=>'', '\n'=>''));
		header('location:'.$url, true);
		exit();
	}

    /**
	 @param $controller 控制器
	 @param $action   方法
	 @return $string 合法的url
	**/
	public static function url($controller, $action, $args=array())
	{

		if(!isset($controller)) return ;
        $url = array();

		//合并请求url数组
		$url['act'] = isset($action) ? $action :'index';
		$url['ctl'] = $controller;
		$result = array_merge($url, $args);

		//生成Url
		$strArgs =null;


		foreach ($result as $key=>$v) {
			$strArgs .= $key.'='.$v.'&';
		}
		$strArgs = substr($strArgs, 0,-1);

		$baseUrl = PROTOCOL.'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/'.PROJECT.'/index.php?'.$strArgs;

		return $baseUrl;

		
	}


	
}