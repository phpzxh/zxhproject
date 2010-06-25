<?php

class ChatLog 
{

	private $str = '';

	const LOG_LEVEL_ERROR   = 1;
	const LOG_LEVEL_NOTIC   = 2;
	const LOG_LEVEL_WARNING = 3;
	const LOG_FILE = 'chat%s.log';

	protected $dateFormate = 'Y-m-d H:i:s';

	function  __construct(){}

	function __destruct()
	{
		$fileName = sprintf(ROOTPATH.'/'.self::LOG_FILE,date('Ymd'));
		$handle = fopen($fileName, 'a');

		fwrite($handle, $this->str);

	}

	public  function log($str, $level)
	{
		switch($level) {
			case self::LOG_LEVEL_ERROR :
				$this->str .= "[".date($this->dateFormate)."]"."ERROR".$str."\n";
				break;
		    case self::LOG_LEVEL_NOTIC :
				$this->str .= "[".date($this->dateFormate)."]"."NOTICE".$str."\n";
				break;
			case self::LOG_LEVEL_WARNING:
				$this->str .= "[".date($this->dateFormate)."]"."WARINNG".$str.'\n';
				break;
		}

	}

	public function notice($str)
	{
		$this->log($str, self::LOG_LEVEL_NOTIC);
	}

	public function waring($str)
	{
		$this->log($str, self::LOG_LEVEL_WARNING);
	}

	public function error($str)
	{
		$this->log($str, self::LOG_LEVEL_ERROR);

	}


	private function write_log()
	{
		//$filePath = realpath(ROOTPATH.self::LOG_FILE);

		
	}

	




}