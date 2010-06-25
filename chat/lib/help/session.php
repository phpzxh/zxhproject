<?php




class  Session 
{
	/*
	private $sessionPath;
    */
	private $expreTime;

	private $db = null;
	private $sessionName;
	private $table;
	private $sessionId = '';


	private $sessionCookiePath = '/';
	private $sessionCookieDomain = '';
	private $sessionCookieSecure = false;


	function __construct($db, $table, $sessionName, $expreTime=10, $sessionId = '')
	{
		
		session_set_save_handler( array($this,'open'),
			                      array($this,'close'),
			                      array($this,'read'), 
			                      array($this,'write'), 
			                      array($this,'destroy'), 
			                      array($this, 'gc')
			                    );

		$this->db = $db;
		$this->table = $table;
		$this->expreTime   = $expreTime;
		$this->sessionName = $sessionName;
		

		$this->sessionCookiePath = '/';
		$this->sessionCookieDomain = '';
		$this->sessionCookieSecure = false;

		if ($this->sessionId == '' && !empty($_COOKIE[$this->sessionName])) {
			
			$this->sessionId = $_COOKIE[$this->sessionName];

		}


		if(!$this->sessionId) {
		 
			setcookie($this->sessionName, $this->getSessionId(), 0, $this->sessionCookiePath, $this->sessionCookieDomain, $this->sessionCookieSecure);
		}


	}

	private function getSessionId()
	{
		//$sessionId = md5( uniqid(mt_rand(), true));
		$sessionId = mt_rand(5,20);
		$this->sessionId = $sessionId;
		return $sessionId;
	}


	public function open()
	{
		
		return true;

	}

	public function close()
	{
		
		return true;
	}
	

	public function read($sessionId)
	{
		$sql = 'select * from '.$this->table.' where id =\''.$sessionId.'\'';
		$result = $this->db->getOne($sql);
		return $result;
	}

	public function write($sessionId, $data)
	{
		$time = time() + $this->expreTime;
		$active = true;
		$ipAddress = getenv('REMOTE_ADDR');
		$sql = sprintf("REPLACE INTO `$this->table` (`id`,`update`,`data`,`active`,`ipaddress`) VALUES('%s',%d, '%s', %b, '%s')", $this->sessionId, $time, $data, $active, $ipAddress);
		
		$this->db->query($sql);
		return true;
	}

	public function destroy($sessionId)
	{
		$sql = sprintf('delete * from `'.$this->table.'` where id = \'%s\'',$sessionId);

	    $this->db->query($sql);
	}

	public function getUserOnLine()
	{
		$sql = 'SELECT * FROM `'.$this->table.'` WHERE `active` = true';
		$this->db->query($sql);
		return $this->db->numRows();
	}

	/**
	  清除过期session
	 **/

	public function gc($maxlifetime)
	{
		
		$time = time();

		$sql = 'delete from `'.$this->table.'` where `update` < '.$time;
		echo $sql;

		$this->db->delete($sql);

		return true;
	}



}