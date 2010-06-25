<?php

require_once '../config.php';

require_once '../lib/mysql.php';

class MysqlTest extends PHPunit_Framework_TestCase
{
	
     
    public $db ;


    protected function setUp()
    {

       $this->db = DB_Mysql::getDBInstance('localhost','test','root','');

	   
       
    }

	
	
  

	public function testGetOne()
	{
	  
	
      
    
	  $sql = 'select * from user where id = 1';
	  
	  $result = $this->db->getOne($sql);
	 

	  $this->assertEquals('Admin',$result['name']);

	

	}

	public function testDbConnect()
	{
		$bool = $this->db->connectDB();
		$this->assertEquals(true,$bool);
	}

	public function testGetAll()
	{
		 
		$sql = 'select * from user ';

		$result = $this->db->getAll($sql);

		$this->assertEquals(5,count($result));
		
	}

	/*


	function testCreate()
	{
		$table = 'user';
		$record = array('name'=>'phpzxh', 'password'=>'123456');
		$result = $this->db->create($record, $table);

		$this->assertEquals(true,$result);

		

	}*/

	function testDelete()
	{
		$sql = 'delete from user where id=2';
		$result = $this->db->delete($sql);

		$this->assertEquals(1,$result);
	}
 


    function testEscapeString()
    {
		$sql = "Zak's and Derick's Laptop";
		$target = "Zak\'s and Derick\'s Laptop";
 		$escapeString = $this->db->escapeString($sql);
		
		$this->assertEquals($target, $escapeString);
    }

	protected function tearDown()
	{
		$this->db->close();
		unset($this->db);
	}



	

  
	



	

}


?>