<?php
abstract class Session{
	private $data_record;
    
    public function __construct(){
		 $session_status = session_status();
		if($session_status == PHP_SESSION_ACTIVE || session_id()){
			session_regenerate_id();
		}else{
		    session_start();
		}
		$this->data_record = new RecordSet;
    }
    
   public function dataRecordSet(){
	   return $this->data_record;
   }
   public function setSession($sess_name,$sess_value){
   	       if(!in_array($sess_name, $_SESSION)){
   	       	 return $_SESSION[$sess_name] = $sess_value;
   	       } 	   
   }
   
   public function getSession($sess_name){
   	      return isset($_SESSION[$sess_name])?$_SESSION[$sess_name]:null;
   }
   
   public function delSession($sess_name){
   	   unset($_SESSION[$sess_name]);
	   return session_destroy();
   }

//Set Cookies
   public function setCookie($name,$value,$expire=0,$domain="/",$secure=false,$httponly=false){
     return setcookie($name,$value,$expire=0,$domain="/",$secure=false,$httponly=false);
   }
   public function getCookie($name){
      return isset($_COOKIE[$name])?$_COOKIE[$name]:null;
   }
}

?>