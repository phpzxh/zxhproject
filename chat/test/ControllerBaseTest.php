<?php

require '../config.php';
require_once '../lib/controller/default.php';

class ControllerBaseTest extends PHPunit_Framework_TestCase
{
     private $controller ;


	public function setup()
	{
		$this->controller = new DefaultController('indexAction');
	}

	function testUrl()
	{
        $controller = 'default';
		$action = 'select';
		$args= array('id'=>1,'page'=>2);
		$target = "http://localhost:8080/chat/index.php?act=$action&ctl=$controller&id=1&page=2";
		$source = $this->controller->url($controller,$action,$args);

		echo $source;

		$this->assertEquals($source, $target);


	}






}