<?php
/** 
This piece of software is written by Sarpong A-Rahman o Rasarp Mutimedia System please don't delete this comment. liences GPL and MIT 
 **/
class Auth extends Session{
	
	private $logged_in = false;
	private $accesslevel;
	private $session;
    
    protected $setcookies = false;
    protected $cookie_expire;
	protected $user;
    protected $cfg;
    protected $accessctrl;
    private static $sses_query;    
	
	public $userid;
	
	function __construct(){
		//$this->sessname = session_name("Authen_Sess");
        parent::__construct();
        static::$sses_query = parent::dataRecordSet();
        $conf = new Settings;
        $this->cfg  = $conf->config()["Tables"];
        $this->user = $this->getRecord($this->cfg["Member"]);
        $this->cookie_expire = time()+(60*60*24*7);//1 week
		$this->checkAuth();
		
	}
    private function checkAuth(){
  	     if(parent::getSession("userid")!==null){
  	     	$this->userid = parent::getSession("userid");
			$this->logged_in = true;
  	     }else{
  	     	unset($this->userid);
			unset($this->accesslevel);
			$this->logged_in = false;
  	     }
    }
    
    protected function getRecord($table=null){
    return static::$sses_query->initQuery($table);
    }
    
    public function isLoggedIn(){
		return $this->logged_in;
    }
	
	protected function accesslevel($accesslevel){
		$access = $this->getRecord($this->cfg["Role"]);
		$access::$placeholder = [":access"=>$accesslevel];
		$getrole = $access->selectRecord("Accesslevel=:access");
		return $getrole->Accesslevel;
	}
	
    public function isAdmin(){
        //$this->user = $this->getRecord($this->cfg["Tables"]["Login"]);
        $user = $this->user;
  	     if($this->isLoggedIn()){ 
  	        $user::$placeholder = array(":id"=>$this->userid);
            $userinfo = $user->selectRecord("MemberId=:id");
            return (strcasecmp($this->accesslevel("A"),$userinfo->Accesslevel)==0)?true:false;
         }
    }
	public function isModerator(){
		// $this->user = $this->getRecord($this->cfg["Tables"]["Login"]);
         $user = $this->user;
  	      if($this->isLoggedIn()){
			  $user::$placeholder = array(":id"=>$this->userid);
              $userinfo = $user->selectRecord("MemberId=:id");
              return (strcasecmp($this->accesslevel("M"),$userinfo->Accesslevel)==0)?true:false;
		  }
	}
	public function isEditor(){ 
        //$this->user = $this->getRecord($this->cfg["Tables"]["Login"]);
        $user = $this->user;$user_role = $this->accessctrl; 
  	      if($this->isLoggedIn()){
  	        $user::$placeholder = array(":id"=>$this->userid);
            $userinfo = $user->selectRecord("MemberId=:id");
            return (strcasecmp($this->accesslevel("E"),$userinfo->Accesslevel)==0)?true:false;
          }
    }
    

  public function isUser(){  
      //$this->user = $this->getRecord($this->cfg["Tables"]["Login"]);
        $user = $this->user;
  	      if($this->isLoggedIn()){
			$user::$placeholder = array(":id"=>$this->userid);
            $userinfo = $user->selectRecord("MemberId=:id");
            return (strcasecmp($this->accesslevel("U"),$userinfo->Accesslevel)==0)?true:false;
		  }
  }
 public function LogIn($user){
   	   	 if( ($user)){
   	   		 $this->userid      = parent::setSession("userid",$user->MemberId);
			 $this->accesslevel = parent::setSession("accesslevel",$user->Accesslevel);
             $this->logged_in = true;
         }
      return $this->logged_in;
  }
   /** This method authenticates a login **/
 public function authenticate($userinput,$password){
	 $sql = static::$sses_query;
	 $query= 'SELECT * FROM member WHERE Email =:email AND Password =:password LIMIT 1';
	 //$query = "SELECT * FROM login WHERE Username =:username AND Password =:password OR Email =:email AND Password =:password LIMIT 1";
     //$sql::$placeholder = [":username"=>$userinput,":email"=>$userinput,":password"=>$password];
	 $sql::$placeholder = [":email"=>$userinput,":password"=>$password];
     $results = $sql->getSingleRow($sql->readQuery($query));
     return $results;
 }
	
public function authCredentials(){
	$userinfo = null;$user = $this->user;
	if($this->isLoggedIn()){
           $user::$placeholder = [":id"=>$this->userid];
           $userinfo = $user->selectAllRecords("WHERE MemberId=:id");
        }
     return $user->getSingleRow($userinfo);         
 }
 
	
public function fullname(){
        $userinfo = $this->authCredentials();
	 	if(isset($userinfo->Firstname) && isset($userinfo->Lastname)){
	 		return ucfirst($userinfo->Firstname).", ".ucfirst($userinfo->Lastname);
	 	}else{ return "";}	
	 }

public function MemberId(){
	$userinfo = $this->authCredentials();
	 	if(isset($userinfo->MemberId)){
	 		return $userinfo->MemberId;
	 	}else{ return "";}
}
	
public function avatarimg(){
	 $userinfo = $this->authCredentials();
	 if($userinfo->Avatar!=null){
	 	 return $userinfo->Avatar;
	 	}else{ return "";}
}
	
public function username(){
        $userinfo = $this->authCredentials();
	 	if(isset($userinfo->Username)){
	 		return ucfirst($userinfo->Username);
	 	}else{ return "";}	
	 }

public function logOut(){
  	   unset($this->userid);
	   parent::delSession("userid");
	   parent::delSession("accesslevel");
	   $this->logged_in = false;
	  return $this->logged_in;
  }
                      
  /**
   * @method rememberMe($name,$value)
   * @param $name  cookie name
   * @param $value cookie value
  **/
                      
  public function rememberMe($name,$value){
      if(($value == "Yes"||$value == "Y" || $value ="1")){
      parent::setCookie($name,strtolower($value),$this->cookie_expire);
      $this->setcookies=true;
      return $this->setcookies;
      }
  }
                      
  public function isRememberMe(){
       return $this->setcookies;
   }
                      
  public function setRememberMeValue($name,$value){
    parent::setCookie($name,$value,$this->cookie_expire);
      $this->setcookies=true;
      return $this->setcookies;
  }
  public function getRememberMeValue($name){
    if(null !== parent::getCookie($name)){ parent::getCookie($name); } 
    return $this->setcookies;
   }
     
  

}
