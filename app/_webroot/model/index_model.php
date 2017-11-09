<?php
class IndexError extends Error{}
class Index_Model extends Model{
     protected $registry;
     protected $sql;
     public $request;
     public $process;
     public $validate;
	 public $form_data  = array();
     public $parse_data = array();

    public function __construct($registry){
		parent::__construct();
        $this->reg = $registry;
        $this->request = parent::$make_request;
        $this->dataset = $this->data_record; //query datasets in database
        //$this->process  = $this->process;
        //$this->validate = $this->process->validate();$this->form_data  = !empty($this->form_data)?$this->form_data:null;
		$this->parse_data = $this->parse_data;
        $this->form_data  = $this->form_data;
	}
    
   
    public function indexModel(){
		$dbtable = $this->dbtable; $sql  = $this->dataset;
		$process = $this->process; $util = $this->util;
		$session = $this->session; $request = $this->request;
		/*/initialize variables/*/
    }
}


?>