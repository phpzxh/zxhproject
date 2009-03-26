<?php
// $Id: ut_common.php 2228 2009-02-08 16:08:43Z dualface $

/**
 * 单元测试公用初始化文件
 */

date_default_timezone_set('Asia/Shanghai');

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/Framework/TestSuite.php';

require dirname(__FILE__) . '/../../library/q.php';

Q::changeIni('runtime_cache_dir', dirname(__FILE__) . '/../../tmp');
Q::changeIni('log_writer_dir', dirname(__FILE__) . '/../../tmp');
define('FIXTURE_DIR', dirname(dirname(__FILE__)) . DS . 'fixture');


/**
 * 载入数据库连接信息
 */
$dsn_pool = Helper_YAML::load(FIXTURE_DIR . '/database.yaml');
Q::replaceIni('db_dsn_pool', $dsn_pool);


PHPUnit_Util_Filter::addDirectoryToFilter(dirname(dirname(__FILE__)));

abstract class QTest_UnitTest_Abstract extends PHPUnit_Framework_TestCase
{
    protected function assertEmpty($var, $msg = '')
    {
        $this->assertTrue(empty($var), $msg);
    }
}

abstract class QTest_UnitTest_TestSuite_Abstract extends PHPUnit_Framework_TestSuite
{
}

