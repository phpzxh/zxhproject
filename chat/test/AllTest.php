<?php

if (!defined('PHPUNIT_MAIN_METHOD')) {
	define('PHPUNIT_MAIN_METHOD','AllTest::main');
}

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

class AllTest {



	public static function main() 
	{
		 PHPUnit_TextUI_TestRunner::run(self::suite(), $parameters);
	}

	public static function suite()
	{
		$suite = new PHPUnit_Framework_TestSuite('chat');

        $suite->addTest(Zend_AllTests::suite());

        return $suite;
	}

}
