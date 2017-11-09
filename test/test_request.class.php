<?php
/**
 *Router Class to control page routes
 *This class would direct how url to pages will be formated
 *Router partterns e.g. alphanum:Page/alpha:action/num:id or -alphanum:topic
 *url = index.php?route=controller/action/id:pagetitlehere route formats
 *url = http://localhost/ezappframework/test/?buy/56/coin/ route formats
 **/

 class Request{
     protected $request;
     protected $params = [];
	 protected $routes = [];
	 
     const DEFUALT = '\/(?P<controller>[a-z0-9-]+?)\/(?:(?P<action>[a-z0-9-]+))';
	 const REGEX_NORMAL   = '\/(?P<controller>[a-z0-9-]+?)\/(?P<action>[a-z0-9-]+)\/(?P<id>(?:\d+))?(?:\/?(?P<title>[a-z0-9-]+)?)';
	 const REGEX_CENTERID = '\/(?P<controller>[a-z0-9-]+?)\/(?P<id>(?:\d+))\/(?P<action>[a-z0-9-]+)?(?:\/?(?P<title>[a-z0-9-]+)?)';
	 
     public function __construct($uri="",$pattern=self::REGEX_CENTERID) {
          if(isset($_GET[$uri])){
               $this->request = strval($_GET[$uri]);
		  }elseif($_SERVER['QUERY_STRING']){
			   $this->request = strval($_SERVER['QUERY_STRING']);
		  }
     
	  // $route = $this->formatUrl($uri,self::REGEX_CENTERID);
      $request = explode("=",$this->request);
	  $_querypart = !empty($request[0])?$request[0]:null;
	  $uri = !empty($request[1])?$request[1]:$request[0];
	   
		 if($this->formatUrl($uri,$pattern)){
			$params = $this->formatUrl($uri,$pattern);
		 }else{
			$params = $this->formatUrl($uri,self::DEFUALT);
		 }
	     $param = [
		   "controller"=>isset($params["controller"])?$params["controller"]:null,
		   "action"=>isset($params["action"])?$params["action"]:null,
		   "id"=>isset($params["id"])?$params["id"]:null,
		   "title"=>isset($params["title"])?$params["title"]:null
	   ];
       $this->routes = $this->addParam($param);
	  // var_dump($param); 
     }
	 
	 public function formatUrl($url,$pattern=self::DEFUALT){
		 if(preg_match('#'.$pattern.'#i',$url,$matches)){
			return $matches;
		 }
	 }
		 
     protected function addParam($param=[]){
     	 $this->params = array_merge($this->params,$param);
     }

     public function __set($index,$value){
         $this->params[$index] = $value ;
     }

     public function __get($index)   {
         if(array_key_exists($index,$this->params)){
           return $this->params[$index];
         }

     }

}
 /*/Router */
 $req = new Request;
 echo "<pre>";
// var_dump($req->controller);
 echo "<br>";

echo "Id: {$req->id} --++-- Controller: {$req->controller}_controller.php --++-- Action: {$req->action}<br><br>";
//echo $req->target;
 echo "</pre>";

?>