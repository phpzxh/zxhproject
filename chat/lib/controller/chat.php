<?php

require_once ROOTPATH.'/lib/controller/contrllerbase.php';
require_once ROOTPATH.'/lib/common/template.php';
class ChatController extends BaseController
{

	function __construct($act)
	{
		

		$config = array(
			             'path' => ROOTPATH.'/lib/view',
			             'cacheDir' => ROOTPATH.'/cache',

			           );
		$this->view = new CTemplate($config);

		
		parent::__construct($act);

		

		
	}

	public function indexAction()
	{

		
		
       $this->loginAction();
		
	

	}



	/**
	 用户登录

	 **/

	public function loginAction()
	{


		$url = $this->url('chat','login');

		if(isset($_POST['submit'])) {

		  $_SESSION['userName'] = $_POST['userName'];	

		  $url = self::url('chat','show');

		  self::redirectUrl($url);

		}


		
		
		

		//显示登录页面
		$this->view->assign('loginUrl',$url);
		$this->view->display('login');



	}

	/**
	 用户发言
	**/

	function sayAction()
	{
	}

	/**
	 显示聊天记录
	**/
	function showAction()
	{

		$url = self::url('chat','content');
	}

	/**
	 显示聊天内容页面
	**/

	function contentAction()
	{
		//得到聊天的内容
		$content = '';

		$this->view->display('content');
	}

	/**
	 用户注销
	**/

	function logoutAction()
	{
	}


      
}