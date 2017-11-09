<?php
class GenerateUrl{
   private $Url;
   private $Urlparams = array();
   //private $Query_str;
  // private $Requsetinfo;
   private $File;
   
   function __construct($url=""){
   	 $this->Url = $url;
   }
   private function addFile($filename=null){
   	  $this->File = (isset($filename)<>null)?$filename:"."; 
   } 
   private function addUrlParams($param_name,$param_value){
  	$this->Urlparams[$param_name] = $param_value; 
  }
  private function createUrl(){
  	    $url = "";
	    $url .= ($this->File !='')?$this->Url.'/'.$this->File:$this->Url;
  	    $params = $this->Urlparams;
   	     if(count($params)>0){ $index = 0;
			foreach ($params as $param_key => $param_value) {    
				$url .= ($index === 0)?"?":"&";
				$url .= urldecode($param_key) ."=".urldecode($param_value);
				$index++;	 
			}		
   	   	} 
	return $url;
  }
  private function addUrlPath(){
  	    $url = "";
        $this->Url = preg_replace("#/$#i","",$this->Url);
	    $url .= ($this->File !='')?$this->Url.'/'.$this->File:$this->Url;
  	    $params = $this->Urlparams;
   	     if(count($params)>0){
   	     	 $index = 0;
			foreach ($params as $param_key => $param_value) {    
				$url .= ($index >= 0)?"/":"";
				$url .= urldecode($param_value);
				$index++;	 
			}		
   	   	} 
	return $url;
  }
  public static function buildLink($url,$addfile,$linktext,$param_list='',$extra_param=''){
	//creating links
  	  $makeurl = new GenerateUrl($url);
	  $makeurl->addFile($addfile);
	  var_dump($param_list);
	 if(strlen($param_list)!=0){
	 	$param_list = explode(",", $param_list);
		//putting parameters together eg fname=ama
	 	foreach ($param_list as $params) {
			$params = preg_split("/=/", $params);
			//var_dump($params);
			//$paramkey = $params[0]; $paramval = $params[1]; 
		    $makeurl->addUrlParams($paramkey, $paramval);
		 }
	 }
     $linktext = (strlen($linktext)==0)?$makeurl->createUrl():trim($linktext);
      
  	return "<a href=\"".$makeurl->createUrl()."\"{$extra_param}>$linktext</a>";
  }

  public static function buildPrettyUrl($url,$addfile,$linktext,$param_list='',$extra_param=''){
	//creating links
  	$makeurl = new GenerateUrl($url);
     $makeurl->addFile($addfile);
	 if(strlen($param_list)!=0){
	 	$param_list = explode(",", $param_list);
		  //putting parameters together eg fname=ama
	 	foreach ($param_list as $paramkey=>$params) { 
		    $makeurl->addUrlParams($paramkey, $params);
		 }
	 }
     $linktext = (strlen($linktext)==0)?$makeurl->addUrlPath():trim($linktext);
  	return "<a href=\"".$makeurl->addUrlPath()."\" {$extra_param}>$linktext</a>";
  }

}

/*
 *@example Create a hyperlink 
 * echo GenerateUrl::buildLink("sirenghana.com","index.php","Go to sirenghana.com","page=123,action=view,target=news");
*echo  "<br><br>".GenerateUrl::buildPrettyUrl("sirenghana.com","index.php","Go to sirenghana.com","pagename,action,id,target");
*echo "<br>".$makeurl = GenerateUrl::buildPrettyUrl("Go somewhere",$_SERVER["PHP_SELF"],"Go to sirenghana.com");
*/






