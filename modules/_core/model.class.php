<?php

abstract class Model{
    protected $registry;
    protected $data_record;
    protected $sql;
    protected $session;
    public static $make_request;
	protected static $config;
    public $process;
    public $validate;
    public static $set_closure = [];//set closure function collection
    public $form_data  = [];
    public $parse_data = [];
	public $dbtable;
	public $auth;

    public function __construct(){
		$settings = new Settings;
		static::$config = $settings;
		$set_data = $settings->config();
		$this->data_record = new RecordSet;
		$this->dbtable = $set_data["Tables"];
		static::$make_request = Dispatcher::getRequest();
		$this->session = new SessCookie;
		$this->process = new ProcessForm;
		$this->auth    = new Auth;
		$this->util    = new Utility;
        $this->validate = $this->process->validate();
        $this->form_data = !empty($this->form_data)?$this->form_data:null;
		$this->parse_data = !empty($this->parse_data)?$this->parse_data:null;
    }
    
 //abstract public function indexModel();
   public function indexModel(){}
	
  public function __call($name,$args){
		 $method = $name;
		if(method_exists($this,$method)){
			call_user_func_array([$this,$method],$args);
		}else{
			throw new Error("Method $method could not be found.");
		}
	}
	
    public function setData($key,$value){
        return $this->query_results[$key] = $value;
	 }
	 
    public function getData($key){
        return array_key_exists($key, $this->query_results)?$this->query_results[$key]:null;
	 }
	 
    public function hasData($key){
	 	return isset($this->query_results[$key]);
	 }
    
    public function removeData($key){
     unset($this->query_results[$key]);
    }
	 
}

?>