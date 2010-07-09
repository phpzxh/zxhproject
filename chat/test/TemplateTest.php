<?php


require '../config.php';
require_once '../lib/common/template.php';

class TemplateTest extends PHPunit_Framework_TestCase
{
     private $tpl ;


	public function setup()
	{
		$config = array(
			             'path' => ROOTPATH.'/lib/view',
			             'cacheDir' => ROOTPATH.'/cache',
			             'enableCache' => true,
			             'cacheLifeTime' =>1, 

			           );
		$this->tpl = new CTemplate($config);
	}


	function testAssign()
	{

		$news = array( 0 => array('name'=>'phpzxh','email'=>'jxxgzxh@11.com','age'=>24),
			           1=>array('name'=>'phpzxh','email'=>'jxxgzxh@11.com','age'=>24),
			           2=>array('name'=>'phpzxh','email'=>'jxxgzxh@11.com','age'=>24),
			  );

		$this->tpl->assign('person',$news);
	
	   
		
		$this->tpl->assign('title','userlist');

		

		


	}

	function testCache()
	{

		$news = array( 0=> array('name'=>'周晓','email'=>'jxxgzxh@11.com','age'=>24),
			           1=>array('name'=>'abc','email'=>'jxxgzxh@11.com','age'=>24),
			           2=>array('name'=>'abc','email'=>'jxxgzxh@11.com','age'=>24),
			  );

		$this->tpl->assign('person',$news);
	
	   
		
		$this->tpl->assign('title','userlist');
		
		$this->tpl->display('test',1); 

		print_r($this->tpl);
		
	}
	
	function testFetch()
	{
		//生成缓存

	}

	

	function testDisplay()
	{
		/*$news = array( 0 => array('name'=>'phpzxh','email'=>'jxxgzxh@11.com','age'=>24),
			           1=>array('name'=>'phpzxh','email'=>'jxxgzxh@11.com','age'=>24),
			           2=>array('name'=>'phpzxh','email'=>'jxxgzxh@11.com','age'=>24),
			  );

		$this->tpl->assign('person',$news);
	
	   
		
		$this->tpl->assign('title','userlist');
		
		$this->tpl->display('test'); */
	}


	public function tearDown()
	{
		unset($this->tpl);
	}

	




}