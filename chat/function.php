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
	
	 /**
     * 随机字符串
     *
     * @param $length integer       	
     */
    public static function random ($length) {
        $hash = "";
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($chars) - 1;
        mt_srand((double) microtime() * 1000000);
        for ($i = 0; $i < $length; $i ++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    




}
