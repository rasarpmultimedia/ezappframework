<?php
/** Loads Library classes */
error_reporting(E_ALL);
date_default_timezone_set("Africa/Accra");

require_once "dir_paths.inc.php";
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
function vendorLoader($classname){
	$filename = strtolower($classname).".php";
	$file = VENDOR.$filename;
	if(file_exists($file)){require_once $file;}
}

function compLoader($classname){
	$filename = strtolower($classname).".comp.php";
	$file = COMPONENTS.$filename;
	if(file_exists($file)){require_once $file;}
}

spl_autoload_extensions(".php,.class.php,.comp.php,.inc");
spl_autoload_register("coreLoader");
spl_autoload_register("libLoader");
spl_autoload_register("vendorLoader");
spl_autoload_register("compLoader");

require_once "global_const.inc.php";

//HTML Template Place Holder;
$link = new GenerateUrl;	
$htmlplaceholder =[
	"SideMenu"	=>"",
	"AdminNav"	=>"",
	"MenuNav"	=>"",
	"Title"  	=>"",
	"Banner"	=>"",     
	"Content"	=>"",
	"Footer"	=>""
];

//Registry classes initialisation
$registry = new Registry;
$registry->cfg  = new Settings;
$registry->htmlholder ='';
$registry->htmlholder = $htmlplaceholder;
$registry->view = new View($registry->htmlholder);
$registry->auth = new Auth;

/**
*	url = http://localhost/ezappframework/?/order/15/sells/this-is-the-ttile
*	SET_QSTR_FORMAT : Request::REGEX_CENTERID;
*	url = http://localhost/ezappframework/order/sells/15/this-is-the-ttile
*	SET_QSTR_FORMAT : Request::REGEX_NORMAL;
*	url = http://localhost/ezappframework/order/sells/id
*	SET_QSTR_FORMAT : Request::REGEX_DEFUALT;
**/
(defined("SET_URL_FORMAT")) ?null:define("SET_URL_FORMAT",Request::REGEX_CENTERID);
