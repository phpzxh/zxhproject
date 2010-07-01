<?php

class DbMysql
{

	private $db;
	private $user;
	private $password;
	private $host;
	private $dbCharset;
    private $linkHandel;
	private $errorNumber;
	private $errorMessage;
	private $errorLocation;
	private $showErrorMessage = true;

	private $record = array();


	private function __construct($host, $db, $user, $password, $dbCharset)
	{
		$this->host = $host;
	    $this->db = $db;
		$this->user = $user;
		$this->password = $password;
		$this->dbCharset = $dbCharset;
		
		
	}



	public static function getDBInstance($host, $db, $user, $password, $dbCharset='utf-8')
	{
		static $instance =null;

		if (is_null($instance)) {
			$instance = new DbMysql($host, $db, $user, $password, $dbCharset);
		}

		return $instance;

	}

	public function connectDB()
	{
		if (!$this->linkHandel){

	        $this->linkHandel = mysql_connect($this->host, $this->user, $this->password);
			
			if (!$this->linkHandel) {
				$this->echoError('链接数据库');
				return false;
			}
			mysql_query("SET NAMES ".$this->dbCharset,$this->linkHandel);
		}
        return true;
	}


	public function query($sql)
	{
		if (!$this->connectDB()){
	        return false;
		}
		if (!mysql_select_db($this->db, $this->linkHandel)){
			$this->echoError('选择数据库,mysql_select_db');
	        return false;
		}
		$this->queryId = mysql_query($sql, $this->linkHandel);

		if (!$this->queryId){
            $this->echoError('查询数据库<br>mysql_query');
			return false;
		}

		return $this->queryId;

	}

	public function selectRows()
	{
		return mysql_num_rows($this->queryId);

	}

	public function updateRows()
	{
		return mysql_affected_rows($this->linkHandel);
	}

	

    /**
	  查询一条记录
	**/
	public function getOne($sql)
	{
		if (!$this->query($sql) || $this->selectRows() == 0){
			return false;
		}
		return $this->nextRecord();

	}

	public function create($item, $table)
	{
		$keyArray = array_keys($item);
		$valeArray = array_values($item);

		$cols = implode(",", $keyArray);
		

		//生成sql

		//$sql = 'INSERT INTO `'.$table.'` ('

	}

	public function update($sql)
	{
	}

	public function delete($sql)
	{
		if (!$this->query($sql)) 
			return false;
		return $this->updateRows();

	}

	/**
	  查询所有记录
	**/

	public function getAll($sql)
	{
		if (!$this->query($sql)){
			return false;
		}

		$result = array();
		while ($row = $this->nextRecord()){
			
			$result[] = $row;
		}

		return $result;

	}

	private function nextRecord()
	{
		$this->record = mysql_fetch_assoc($this->queryId);
		
		if (!$this->record || !is_array($this->record)){
			return false;
		}
		
		return $this->record;
	}


	public function echoError($location)
	{
		$this->errorNumber = mysql_errno();
		$this->errorMessage = mysql_error();
        $this->errorLocation = $location;
		if ($this->errorNumber && $this->showErrorMessage){
			echo('<br /><b>'.$this->errorLocation.'</b><br />'.$this->errorMessage);
			flush();
		}


	}

	public function insertID()
	{
		return mysql_insert_id($this->linkHandel);
	}


	public function close()
	{

		if ($this->linkHandel){

			mysql_close($this->linkHandel);
			$this->linkHandel = null;

		} 

	}

	public function escapeString($sql)
	{

		if (PHP_VERSION >= '4.3'){
		    return mysql_real_escape_string($sql);
		} else {
			return mysql_escape_string($sql);
		}

	}




}



