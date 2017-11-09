<?php
/*
 * This are defines base controller
 * @Author: Abdul-Rahman Sarpong
 * @Copyright (c) Rasarp Multimedia Systems 
 * */
abstract class Controller{
	protected $model;
	protected $controller;
	protected $view;
	protected $registry;
	
	public function __construct($registry,$model){
		$this->registry = $registry ? $registry : new Registry;
        $this->model = $model;
	}
	/*Magic method called when a non-existent or inaccessible method is
     * called on an object of this class.*/
	
	public function __call($name, $arg){
		$method  = $name."Action";
	}
   abstract public function index();
}

?>