<?php

/*
$host = $_SERVER['SERVER_NAME'];
$project = dirname(__FILE__);

if(!defined(DIRECTORY_SEPARATOR))
{
   define(DIRECTORY_SEPARATOR, strtolower(substr(PHP_OS,0,3)=='WIN') ? '\\' : '/');
}

$array =  explode(DIRECTORY_SEPARATOR ,$project);


$project = $array[count($array)-1];

define('URL',$host.DIRECTORY_SEPARATOR.$project); 
*/
define('PROTOCOL','http');
define('ROOTPATH', dirname(__FILE__));

define('SITEURL', PROTOCOL.'://'.$_SERVER['HTTP_HOST'].'/chat');

define('PROJECT','chat');
define("CHAT_NOTE", "./chat.txt");
define("ONLINE_LIST", "./online.txt");

/** 配置数据库 **/
$GLOBALS['db']['host'] = '127.0.0.1'; 
$GLOBALS['db']['user'] = 'test';
$GLOBALS['db']['dbName'] = 'test';
$GLOBALS['db']['password'] = '';

global $config;







?>