<?php

class Error extends Exception{
    private $output;
	private $messege;
	private $code;
    public function __construct($message,$logfile="error.log",$code = 0){
		parent::__construct($message,$code);
		$this->code = $code;
		$this->messege = $messege;
		if(method_exists(self,"errorHandler")){
		 set_exception_handler('errorHandler');	
		}
    }

    public static function errorHandler($e,$logfile="error.log"){
         $output = $logerror="";
         $output .="<div class=\"errormsg\" >";
         $output .="A Error Occured: ".$e->getMessage()." in ".$e->getFile()." on ".$e->getLine();
         $output .="<br> Trace: ".$e->getTraceAsString();
         $output .="<br> Error Code: ".$e->getCode();
         $output .="</div>";
         $logpath = ERROR_LOG.$logfile;
         $logerror = file_put_contents($logpath,$output,FILE_APPEND|LOCK_EX);
      }
	
    }
    //public function __toString(){
     //return $this->output;
    
    //}
    
}
?>