<?php
abstract class Template{
    protected $HTML = array();
    public 	  $data = array();
	protected $key;
    protected $model;
    
    function __construct(){
     $this->HTML = array();
     $this->model ="";
    } 
    
    public function addElement($element,$location="Content"){
		$this->HTML[$location] = $element;           
    }
    
    abstract protected  function setView($key,$value);
    public function getView($key){
     return array_key_exists($key, $this->HTML)?$this->HTML[$key]:null;
    }
   /**/
    abstract protected function loadData(array $data);
    abstract public function render(View $view,$name,$layoutfile="");
    protected static function loadTemplate($view,$file){}
	
}



