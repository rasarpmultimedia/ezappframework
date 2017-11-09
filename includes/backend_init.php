<?php
//namespace App;

/** Loads Library classes */
error_reporting(E_ALL);
date_default_timezone_set("Africa/Accra");

require_once "dir_paths.inc.php";
require_once "global_const.inc.php";
//debuger
function _debug($data){
    echo"<pre>";var_dump($data);echo"</pre>";	
}

function coreLoader($classname){
	$filename = strtolower($classname).".class.php";
	$file = CORE.$filename;
	if(file_exists($file)){require_once $file;}
}

function libLoader($classname){
	$filename = strtolower($classname).".class.php";
	$file = LIB.$filename;
	if(file_exists($file)){require_once $file;}
}

function compLoader($classname){
	$filename = strtolower($classname).".comp.php";
	$file = COMPONENTS.$filename;
	if(file_exists($file)){require_once $file;}
}

spl_autoload_extensions(".class.php,.comp.php,.php,.inc");
spl_autoload_register("coreLoader");
spl_autoload_register("libLoader");
spl_autoload_register("compLoader");

//HTML Template Place Holder;
		
$htmlplaceholder =[
	"AdminNav"=>"",
	"UserProfile"=>"",
	"Header_info"=>"",
	"Charts"=>"",
	"ContentImage"=>"",
	"ContentVideo"=>"",
];
//Registry classes initialisation
$registry = new Registry;
$registry->cfg  = new Settings;
$registry->htmlholder ='';
$registry->htmlholder = $htmlplaceholder;
$registry->view = new View($registry->htmlholder);
$registry->auth = new Auth;


