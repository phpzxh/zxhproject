<?php
// $Id: all.php 2194 2009-02-04 15:10:09Z dualface $

Q::import(dirname(dirname(__FILE__)));

class UT_All extends QTest_UnitTest_TestSuite_Abstract
{
    static function suite()
    {
        $suite = new UT_All('UT_Core_Suite');
        $suite->addTestSuite(UT_Core_All::suite());

        return $suite;
    }

}

