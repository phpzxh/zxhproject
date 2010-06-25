<?php

require_once './config.php';
/*
session_start();

if(!isset($_SESSION['name']))
{

	 header('Location:'.SITEURL.'/index.php');
	 
}

*/

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style='border:1px solid #999966; width:802px;height:450'>
 <iframe src='' name=show_win width=800 height=450 scrolling=auto frameborder=0></iframe>
</div>
 <br>
 <marquee width="70%" scrollamount=2> </marquee>&nbsp;&nbsp; [当前在线：$online_sum]
  <iframe src='' name=say_win width=800 height=60 scrolling=no frameborder=0>
  </iframe>