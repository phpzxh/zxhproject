<?php

class Chat_All extends PHPUnit_Framework_TestSuite
{
    static function suite()
    {
        $dir = dirname(__FILE__);
        $suite = new UT_Core_All('UT_Core_Suite');
        $suite->addTestFiles(array(
            "{$dir}/mysqltest.php",
            "{$dir}/ControllerBaseTest.php",
            "{$dir}/TemplateTest.php",
        ));

        return $suite;
    }
}
