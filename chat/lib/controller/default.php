<?php
require_once ROOTPATH.'/lib/controller/contrllerbase.php';
class DefaultController extends BaseController
{

	function __construct($act)
	{
		
		parent::__construct($act);
	}

	public function indexAction()
	{

		
        echo 'indexAction';
		
	//	$this->replayAction();
	   
	   $url = $this->url('chat');

	   $this->redirectUrl($url);

	}


	public function replayAction()
	{
		$controller = 'default';
		$action = 'select';
		$args= array('id'=>1,'page'=>2);
		
		$url =   $this->url($controller,$action,$args);

		$this->redirectUrl($url);

 
	}

	public function selectAction()
	{
		$args = $_REQUEST;

		print_r($args);
	}
      
}