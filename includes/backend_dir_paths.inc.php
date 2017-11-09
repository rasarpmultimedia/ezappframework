<?php
/*
 * This are defined paths to all main directories in the ezAppFrameworkv_1.1 
 * Coder: Abdul-Rahman Sarpong
 * (c) Rasarp Multimedia Systems 
 * */
//Set include Path
$path =".."; //realpath(dirname(__DIR__));//$_SERVER["DOCUMENT_ROOT"]
//var_dump(realpath(dirname(".")));
defined("DS")?null:define("DS",DIRECTORY_SEPARATOR);
(!defined("_SITEPATH"))?define("_SITEPATH", $path.DS):null;

#########################################
#SITE DIRECTORY CONSTANTS (WEBSITE DIRS)#
#########################################

defined("AUTH") 	?null:define("AUTH",	 _SITEPATH."auth".DS);
defined("DASHBOARD")?null:define("DASHBOARD",_SITEPATH."dashboard".DS);
//defined("ADMIN")  ?null:define("ADMIN",    _SITEPATH."admin".DS);
defined("INC") 		?null:define("INC",		 _SITEPATH."includes".DS);
defined("VENDOR")   ?null:define("VENDOR",	 _SITEPATH."_vendor".DS);
defined("WEBROOT")  ?null:define("WEBROOT",	 "_webroot".DS);
defined("MULTIMEDIA")?null:define("MULTIMEDIA",WEBROOT."_multimedia".DS);
defined("SITE_JSONDATA") ?null:define("SITE_JSONDATA", WEBROOT."_jsondata".DS);

###############################################
#APPLICATION DIRECTORY CONSTANTS (SYSTEM DIRS)#
###############################################
defined("BACKEND")	?null:define("BACKEND", _SITEPATH."_backend".DS);
defined("APP")      ?null:define("APP",     _SITEPATH."app".DS);
defined("COMPONENTS")?null:define("COMPONENTS",APP."_components".DS);
defined("CORE") 	?null:define("CORE",	   APP."_core".DS);
defined("TEMPLATE") ?null:define("TEMPLATE",   APP."_skins".DS);
defined("LIB") 		?null:define("LIB",        APP."_lib".DS);
defined("CONFIG") 	?null:define("CONFIG",     APP."_config".DS);
defined("_JSONDATA")?null:define("_JSONDATA", APP."_jsondata".DS);
//defined("PARSERS")?null:define("PARSERS",  APP."_parsers".DS);
defined("ERROR_LOG")?null:define("ERROR_LOG",  APP."_log".DS);
