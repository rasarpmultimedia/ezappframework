<?php
class Settings{
	protected  $settings;
	public function __construct($parse_section=true){
		$this->settings = parse_ini_file(CONFIG."config.ini",$parse_section);
	}
	
	protected function getConfig(){
		return $this->settings;
	}
    
    public function config(){
       return $this->getConfig();
    }
}
?>