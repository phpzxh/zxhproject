<?php


class Chat_Help 
{
	

    public static function getClientIP()
    {
	   
	    if(isset($_SERVER['REMORT_ADDR']))
	    {
		   $cIP = $_SERVER['REMOTER_ADDR'];

	   }elseif(getenv('REMOTE_ADDR'))

	   {
			$cIP = getenv('REMOtE_ADDR'); 

		}
		elseif($ip = getenv('HTTP_CLIENT_IP'))
		{
			$cIP = $ip;
		}

		else
		{
			$cIP = 'unknown';
		}

		return $cIP;



    }

    




}
