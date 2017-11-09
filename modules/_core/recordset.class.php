<?php
//include_once"dbconnect.class.php";
/** 
This piece of software is written by Sarpong A-Rahman o Rasarp Mutimedia System please don't delete this comment. liences GPL and MIT 
 **/
class SQLRecords{
  /** SQL Records is SQL Query Method
    @param $id is unique identifer for data records in a sql database 
    @param $tablename table name in sql database 
    @param $dbcon database connection attribute
    @methods
  **/
	 protected $tablename;
	 protected static $dbcon;
	 
	 public static $placeholder=array();
	 public static $tablefields=array();
     public static $id;
     public static $where_clause;
	 public $getsql;
    
	 /* Connect to Database class */
     public function __construct($tablename='') {
		 $database = new DBConnect;
		 static::$dbcon = $database;
		 return $this->getTable($tablename);
	 } 
	
	 private  function setTable($tablename=""){
	   $this->tablename = ($tablename)?$tablename:"";
	}
    
	protected function getTable($tablename='') {
   	  return (!empty($tablename))?$this->setTable($tablename):"";
	}
	
	public function numRowsAffected(){
		return static::$dbcon->sqlNumRows();
	}
	/*Creates RecordSet Object */
   
	
	/*Pass ID form URL into the function to fatch id form database */
	public static function getRowId($id){
		return static::$id = isset($id)?$id:null;
	}
    /* Custom Sql Select Statments Starts here */
	
	 /**This method be use to select the database using sql syntax 
	  * in a table and return the values into object array
	  * @method query, $sql->readQuery("select name,email from users where id=:id");
	  * @param  $prep_query  this parameter is for prepared stataments or query statement
	  * @param  public static $placeholder= array(":id"=>"1") for name placeholder=array("1") 
	  * @return $results array : use foreach to go thru this array
	  * */
	
    public function readQuery($prep_query){
        $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
		$this->getsql = $prep_query;
        $results =  static::getQuery($prep_query,$placeholder);
		return $results;  
    }
	
	 /**This method be use to update and insert queries into the database using sql syntax 
	  * in a table and return the values into object array
	  * @method query, $sql->writeQuery("update users set name = rahman where id=:id");
	  * @param  $prep_query  this parameter is for prepared stataments or query statement
	  * @param  public static $placeholder= array(":id"=>"1") for name placeholder=array("1") 
	  * @return $results array : use foreach to go thru this array
	  * */
    public function writeQuery($prep_query){
        $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
		$this->getsql = $prep_query;
        $results =  static::sendQuery($prep_query,$placeholder);
		return $results;   
    }
	
    /**This function return the values of a single row data object
	 * @method getSingleRow,
	 * @param $query_results
	 * */
	public function getSingleRow($query_results){
        return (!empty($query_results))?array_shift($query_results):false;
    }
    
	 /**This function selects all rows in a table and return the values into object array
	 * @method selectAllRecords,
	 * @param  $addclause = null, e.g default value is null. usage "order by desc" or "where Id=?"
	 * @param  public static $placeholder= array(":name"=>"ama") for name placeholder or array("ama") 
	 * @return $results array : use foreach to go thru this array
	  * */
	 public  function selectAllRecords($addclause=''){
	 	$placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
	  	$sql = "SELECT * FROM ".$this->tablename." $addclause ";
		$this->getsql = $sql;
	  	$results =  static::getQuery($sql,$placeholder);
		return $results;
	  }
    
	/**This function selects one row in a table and return the values into an object array
	 * @method selectRecord,
	 * @param  $whichfield = null, e.g default value is null. usage "Id=:id" or "Id=?"
	 * @param  public static $placeholder= array(":id"=>"1") for name placeholder or array("1")
	 * */
    public  function selectRecord($whichfield=null){
        $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
        $query = "SELECT * FROM ".$this->tablename."";
	 	$query .= ($whichfield!=null?static::where($whichfield):"");
	 	$results = static::getQuery($query,$placeholder);
		$this->getsql = $query;
        return $this->getSingleRow($results);
	 }
     /**Get Last Insetered ID **/
	 public function lastInsertedID(){
         $result =  $this->query("SELECT LAST_INSERT_ID() AS Inserted_Id");
         $id = $this->getSingleRow($result);
         return $id->Inserted_Id;
     } 
    
	/** This method joins two tables into one statement
	 * @method joinRecords,
	 * @param  $join_table eg the second table to join 
	 * @param  $join_on eg page.category_id = category.id
	 * @param  array $setfields usage e.g. array('Fieldname1','Fieldname1')
     * @param  $whichfield = null, e.g default value is null. usage "Id=:id" or "Id=?"
	 * @param  public static $placeholder = array(":id"=>"1") or array("1") 
     * @param  $order ='' e.g default value is empty. usage "ORDER BY Id ASC|DESC"
     * @param  $limit ='' e.g default value is empty. usage "5 or 10 OFFSET 50"
     * @return $results object array: use foreach to go thru this array
    * */
	 public function joinRecords(array $setfields,$join_table,$join_on,$whichfield = null,$join_type='LEFT',$orderby='',$limit=''){
        
        $placeholder = (!empty(static::$placeholder))?static::$placeholder:[];
	 	$setfields = is_array($setfields)?$setfields:"";
        $query = "SELECT "; 
	  	$query .= (count($setfields)>=1)?implode(",",$setfields):"*";
	  	$query .=" FROM ".$this->tablename;
	    $query .=" $join_type JOIN ".$join_table." ON ".$join_on;
        $where = ($whichfield!=null?static::where($whichfield):"");
	    $limit = (!empty($limit)?"LIMIT $limit":"");
	    $query .=" $where $orderby  $limit";
		$this->getsql = $query;
	   $results = static::getQuery($query,$placeholder);
      return $results ;	
	 }
	 
	/** Finds specified in object array
    * @method selectExactRecord,
    * @param  array$setfields usage e.g. array('Fieldname1','Fieldname1')
    * @param  $whichfield = null, e.g default value is null. usage "Id=:id" or "Id=?"
	* @param  public static $placeholder = array(":id"=>"1") for name placeholder or array("1") 
    * @param  $order ='' e.g default value is empty. usage "ORDER BY Id ASC|DESC"
    * @param  $limit ='' e.g default value is empty. usage "5 or 10 OFFSET 50"
    * @return $results array : use foreach to go thru this array
    * */
	public  function selectExactRecord(array $setfields,$whichfield = null,$orderby='',$limit=null){
      $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
	  $query = "SELECT "; 
	  $query .= (count($setfields)>=1)?implode(",",$setfields):"*";
	  $query .=" FROM ".$this->tablename;
	  $query .=" ".($whichfield!=null?static::where($whichfield):"");
	  $limit = !empty($limit)?"LIMIT $limit":"";
	  $query .=" $orderby $limit";
	  $this->getsql = $query;
      $results = static::getQuery($query,$placeholder);
      return $results ;
	}
	
	 /**Finds and checks specified field and instantiate row into object array
	 * @method fieldExists,
	 * @param  $tblfield , e.g default value is null. usage "Fisrtname=:firstname or Fisrtname=?"
	 * @param  public static $placeholder = array(":id"=>"1") for name placeholder or array("1") 
	 * @return $foundfield stdClass array
	 * */
	public  function fieldExists($tablefield){
        $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
        $split_var = preg_split("/=/",$tablefield);
		$fieldname  = $split_var[0]; $fieldvalue = $split_var[1];
        $sql ="SELECT $fieldname FROM ".$this->tablename;
        $sql .= static::where("$fieldname = $fieldvalue")." LIMIT 1";
        $this->getsql = $sql;
        $results = static::getQuery($sql,$placeholder);
        return $this->getSingleRow($results);
     } 
	
	 /**This function count rows in a table
	 * @method countCount,
	 * @param $field eg count(id)
	 * @param  $whichfield = null, e.g default value is null. usage "Id=:id" or "Id=?"
	 * @param  public static $placeholder= array(":name"=>"ama") for name placeholder or array("ama") 
	 * */
	public function selectCount($field=null,$whichfield=null){
        $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
		$field = ($field<>null)?$field:"*";
	 	$query = "SELECT COUNT($field) as Totalcount FROM ".$this->tablename;
		$query .=" ".($whichfield!=null?static::where($whichfield):"");
		$this->getsql = $query;
		$results = static::getQuery($query,$placeholder);
		return $this->getSingleRow($results);
	}
	
	/**sql statement phaser method usage:insert data into tables;
	 * @method insertData,
	 * @param public static $tablefields = array('fieldname1'=>':value1','fieldname2'=>':value2',...) or 
	 * @param public static $tablefields = array('fieldname1'=>'?','fieldname2'=>'?',...) ;
	 * @param public static $placeholder = array(":value1"=>$_POST["value1"]) for name placeholder or array($_POST["value1"])  
	 * */
	private function insertData(){
        $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
		$query = "INSERT INTO ".$this->tablename;
		$query .= "(";
		$query .= implode(", ",array_keys(static::$tablefields));
		$query .= ") VALUES (";
		$fieldvalues = [];
		  foreach (array_values(static::$tablefields) as $value) {
	     	 $fieldvalues[] = $value;
		  }
		$query .= implode(",",$fieldvalues);
		$query .= ")";
        $this->getsql = $query;//var_dump($query);
        static::sendQuery($query,$placeholder);
    }
	
	/**sql statement phaser method, update data in tables;
	 * @method updateData, 
	 * @param public static $tablefields = array('fieldname1'=>':value1','fieldname2'=>':value2',...) or 
	 * @param public static $tablefields = array('fieldname1'=>'?','fieldname2'=>'?',...) ;
	 * @param public static $placeholder = array(":value1"=>$_POST["value1"]) for name placeholder or array($_POST["value1"])  
	 * */
   private function updateData(){
       $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
		 $query = "UPDATE ".$this->tablename; 
		 $query .= " SET ";
	     $setfields = [];
		 	foreach (static::$tablefields as $fieldname => $fieldvalue) {
		 	 $setfields[] = "{$fieldname} = "."{$fieldvalue}"."";
		 	}
		 $query .= implode(", ",$setfields);
		 $query .= " ".static::where(static::$where_clause)." LIMIT 1";
         $this->getsql = $query;
	     //var_dump($query);
         static::sendQuery($query,$placeholder);
   }
    
   /**sql statement phaser method usage: replaces data in tables;
     * @method replaceData,
     * @param public static $tablefields = array('fieldname1'=>':value1','fieldname2'=>':value2',...) or 
	 * @param public static $tablefields = array('fieldname1'=>'?','fieldname2'=>'?',...) ;
	 * @param $placeholder = array(":value1"=>$_POST["value1"]) for name placeholder or array($_POST["value1"])  
	 * */
   public function replaceData(){
   		$query = "REPLACE INTO ".$this->tablename;
		$query .= "(";
		$query .= implode(", ",array_keys(static::$tablefields));
		$query .= ") VALUES ( '";
		  foreach (array_values(static::$tablefields) as $value) {
	     	 $fieldvalues[] = $value;
		  }
		$query .= implode("','",$fieldvalues);
		$query .= "' )";
	    $this->getsql = $query;
        static::sendQuery($query,static::$placeholder); 
   }
   
   /**sql statement phaser methodthis deletes row in a table;
    * @method delete, 
	 * */
   public function delete(){
       $placeholder = (!empty(static::$placeholder))?static::$placeholder:array();
 	 $query = "DELETE FROM ".$this->tablename." ".static::where(static::$where_clause);
	 $query .= " LIMIT 1"; 
	 $this->getsql = $query;
	 return static::sendQuery($query,$placeholder);
   }
   /* Custom Sql Select Statments Ends here */
	
	// MySQL where clause
	protected static function where($clause){
     	return " WHERE {$clause} ";
     }
	//sends data to database
	protected static function sendQuery($sql,$fields=array()){
		    $fields = (isset($fields)&&!empty($fields))?$fields:array();
		    if(static::$dbcon->exeQuery($sql,$fields)){
               return true;
			 }else{
			   return static::$dbcon->errorInfo($sql);
			 }
		return static::$dbcon->closeConnection();
	}
    /*/get datasets from database*/
    protected static function getQuery($sql,$fields=array()){
		    $fields = (isset($fields)&&!empty($fields))?$fields:array();
		//var_dump($fields);
		    if(static::$dbcon->exeQuery($sql,$fields)){
			 return (static::$dbcon->sqlNumRows()!=0)? static::instantiate():null;
			 }else{
			   return static::$dbcon->errorInfo($sql);
			 }
		return static::$dbcon->closeConnection();
	}
	 /** sql statement phaser method this initialize rows into objects arrays
          * @method instantiate,
	 * */
 	 private static function instantiate(){
 	 	     $objects = array();
		     $classname = __CLASS__;
	         while($row = static::$dbcon->fetchObject($classname)){
			    $objects[] = $row;
	     	 }
	   return $objects;
	}

    /** it saves data into database,
	*@method save,*/
    public function save(){
      return (static::$id != null ?$this->updateData():$this->insertData());
	}


}

/**This Class is use to initiate SQL Records **/
class RecordSet extends SQLRecords{
     public static $id;
     public static $placeholder=[];
	 public static $tablefields=[];
    /* Connect to Database class */
     public function __construct($tablename='') {
      parent::__construct($tablename);
      static::$id = parent::$id;
      static::$placeholder = parent::$placeholder;
      static::$tablefields = parent::$tablefields;
	 }
	 public function initQuery($tablename=''){
       $sql = new RecordSet($tablename);
		return $sql;
    }
};


   /* 
   How to use SQLRecords Class
   $rec = new SQLRecords;  
   //$sql::$placeholder=array(":id=>1");
   echo"<br><br>";
   $rec->getTable("users");
   $query = $rec::selectAllRecords(); 
     //$rec::readQuery("select name,email from users where id=:id");
    foreach($query as $row){
    	echo "".$row->name." ----- ".$row->email."<br>";
    }
    echo $rec::$dbcon->sqlNumRows()."<br><br>";
	$rec::$dbcon->closeConnection();
      //var_dump($query);  
      //$rec::$placeholder = array(":value1"=>$_POST["value1"]) for name placeholder or array($_POST["value1"],$_POST["value2"])
     //$rec::$tablefields = array('fieldname1'=>'?','fieldname2'=>'?',...) or ;
   
     //$rec::$tablefields = array('fieldname1'=>':value1','fieldname2'=>':value2',...) ;
	 
 */
?>