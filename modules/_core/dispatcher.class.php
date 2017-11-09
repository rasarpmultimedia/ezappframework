<?php

class Dispatcher{
   static $request;
   public $querystr;
    
    function __construct($path=null,$registry=null,$querystr=""){
        $this->querystr = $querystr;
		static::$request = new Request($this->querystr,SET_QSTR_FORMAT);
        $this->dispatch($path,$registry);
        return 1;
    }
	
	private function dispatch($path,$registry){
        $dispatch = new Router(static::$request,$registry);
        echo $dispatch->loadController($path);
	}
	
	public static function getRequest(){ return static::$request;}	
}

