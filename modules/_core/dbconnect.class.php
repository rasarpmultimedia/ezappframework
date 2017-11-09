<?php

//include_once"../lib/settings.class.php";
class DBConnect {
	 protected  static $dbinstance = 0;
	 protected $connect;
	 protected $dns; 
	 protected $driver;
	 protected $user; 
	 protected $password;
	 protected $host;
	 protected $dbname;
	 protected static $stmt;
	 protected static $last_query;
	 
	 public function __construct() {
	 	$this->driver = "mysql";
	 	$dbconf = new Settings;
	 	$dbcon = $dbconf->config();
	 	$this->host = $dbcon["Database"]["Host"];
	 	$this->user = $dbcon["Database"]["User"];
		$this->password = $dbcon["Database"]["Password"];
		$this->dbname   = $dbcon["Database"]["Database_Name"];
	 	$this->dns =$this->driver.":host=".$this->host.";dbname=".$this->dbname;
         
		try{
			$this->connect = new PDO($this->dns,$this->user,$this->password);
			$this->connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           //var_dump($con->getAttribute(PDO::ATTR_DRIVER_NAME));
		if(!$this->connect){
			throw new Exception("Error Occured: could not connected to database".$this->connect->errorInfo(), $this->connect->errorCode());
		    static::$dbinstance = 0;
		}else{
		    static::$dbinstance = 1;	
		}
		
		}catch(PDOException $e){
		//Error Message here
		echo "<p class=\"dberror\"> Unable to connect to Database: 
             --ErrorCode: ".$e->getCode()."<br>
		     Error Message: ".$e->getMessage().
             " in <br>File: ".$e->getFile().
             " <br>on  Line Number: ".$e->getLine()."</p>";
		static::$dbinstance = 0;
		}
       //Database Connection
		 //$this->connect = $con;
	   // echo "<h1>Successfully connected to database :)</h1>";
	 }
   
   //Executes prepared statements $fields=array(':username'=>$username,':password'=>$password);
   public  function exeQuery($sql,array $fields){
       try{
           //Prepared statement
		  // var_dump($fields);
         static::$stmt = $this->connect->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		   
         static::$stmt->execute($fields);
		 return true;
       }catch(PDOException $e){
       echo "<p class=\"dberror\">Opp an Error Occured, Could not Query Database -- ErrorCode: ".$e->getCode()."<br>
		     Error Message: ".$e->getMessage().
             " in <br> File: ".$e->getFile().
             " <br> on  Line Number: ".$e->getLine()."</p>";
       }
	  
   }
   public function closeConnection(){
   	 return static::$stmt->closeCursor();
   }
   //Last inserted id in last executed statement
   //public  function sqlLastInsetedId($name=null){
   	 //  return static::$connect->lastInsertId($name);
   //}
   //counts number of rows in a sql statement
   public  function sqlNumRows(){
   	   return static::$stmt->rowCount();
   }
   //Fetch Data from database
   public  function fetchArray(){
   	   return static::$stmt->fetch(PDO::FETCH_ASSOC);
   }
   public  function fetchObject($classname){
   	   return static::$stmt->fetchObject($classname);
   }
   //Start Database Transaction methods
   public  function startTranstaction(){
   	return static::$connect->beginTransaction();
   }
   public  function commit(){
   	return static::$connect->commit();
   }
   public  function rollBack(){
   	return static::$connect->rollBack();
   }
   /* This Function is for General Perpose query to databases */
   public function errorInfo($results){
       if(!$results){
           $output = "Can not query form database: ".static::$connect->errorInfo();
           $output .= "<br />Last SQL Query: ".$this->last_query;
           echo $output;
           exit();
       }
   }

}
//$db = new DBConnect;
?>