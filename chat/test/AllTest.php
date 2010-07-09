<?php

if (!defined('PHPUNIT_MAIN_METHOD')) {
	define('PHPUNIT_MAIN_METHOD','AllTest::main');
}

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';
require './all.php';

class AllTest {



	public static function main() 
	{
		 PHPUnit_TextUI_TestRunner::run(self::suite());
	}

	public static function suite()
	{
		$suite = new PHPUnit_Framework_TestSuite('chat');

        $suite->addTest(Chat_All::suite());

        return $suite;
	}

}

if(PHPUNIT_MAIN_METHOD == 'AllTest::main') {

	AllTest::main();

}
