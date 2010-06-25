<?php


require_once './config.php';





$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'index';

$ctl = isset($_REQUEST['ctl']) ? trim($_REQUEST['ctl']) : 'default';
$ctl = strtolower($ctl);

require_once ROOTPATH.'/'.'lib'.'/controller/'.$ctl.'.php';

$ctl = ucfirst($ctl).'Controller';
$act = ucfirst($act).'Action';

$app = new $ctl($act);

