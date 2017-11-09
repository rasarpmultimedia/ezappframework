<?php

class Registry{
	private $data = array();
	
	public function __set($key,$value){
		$this->data[$key] = $value;
	}
	public function __get($key){
		if(array_key_exists($key, $this->data)){
			return $this->data[$key];
		}
	}
	public function __isset($key){
		return isset($this->data[$key]);
	}
	public function __unset($key){
		unset($this->data[$key]);
	}
}
