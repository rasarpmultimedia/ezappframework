<?php

class IndexExceptions extends Exception{}
class Member_Controller extends Controller{
	protected $reg;
	protected $model;
	protected $view;
	protected $auth;

	public function __construct($registry,$model){
		$this->reg    = $registry;
		$this->model  = $model;
		$this->view   = isset($this->reg->view)?$this->reg->view :(new View($this->reg->htmlholder));
		$this->auth   = isset($this->reg->auth)?$this->reg->auth :(new Auth);
	}
	//index page
	public function index(){
		$file = WEBROOT."view/index.view";
		//$this->view->setauth  = $this->auth;//auth object
		$this->view->setmodel = $this->model;
		$this->view->render($this->view,$file,"index");
	}
	public function register(){
		$file = WEBROOT."view/register.view";
		//$this->view->setauth  = $this->auth;//auth object
		$this->view->setmodel = $this->model;
		$this->view->render($this->view,$file,"form");
	}
	
	public function signin(){
		$file = WEBROOT."view/signin.view";
		//$this->view->setauth  = $this->auth;//auth object
		$this->view->setmodel = $this->model;
		$this->view->render($this->view,$file,"form");
	}


}

?>