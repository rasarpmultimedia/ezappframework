<?php
class Index_Model extends Model{
     protected $registry;
     protected $dataset;
     public $request;
     public $process;
     public $validate;
     public $form_data = array();

     public function __construct($registry){
		parent::__construct();
        $this->reg = $registry;
        $this->request = parent::$make_request;
        $this->dataset = $this->data_record; // datasets in databaset objec
        //$this->process  = $this->process;
        //$this->validate = $this->process->validate();
        $this->form_data  = $this->form_data;
		$this->parse_data = $this->parse_data;
	

      }
    
     /** Shows User Summary Data for Manage Users Screen **/ 
    
     public function indexModel(){
		 $dbtable = $this->dbtable; $sql  = $this->dataset;
		 $process = $this->process; $util = $this->util;
		 $session = $this->session; $request = $this->request;
		/*/initialize variables/*/
     }
 
}
?>