<?php
/*
 * This are defined paths to all main directories in the ezAppFrameworkv_1.1 
 * Coder: Abdul-Rahman Sarpong
 * (c) Rasarp Multimedia Systems 
 * */
//Set include Path
$path = realpath(dirname(__DIR__));//$_SERVER["DOCUMENT_ROOT"]
//var_dump(realpath(dirname(".")));
defined("DS")?null:define("DS",DIRECTORY_SEPARATOR);
(!defined("_SITEPATH"))?define("_SITEPATH", $path.DS):null;

#########################################
#SITE DIRECTORY CONSTANTS (WEBSITE DIRS)#
#########################################

defined("AUTH") 	?null:define("AUTH", _SITEPATH."auth".DS);
defined("DASHBOARD")?null:define("DASHBOARD", _SITEPATH."dashboard".DS);
defined("ADMIN")    ?null:define("ADMIN",     _SITEPATH."admin".DS);
defined("MULTIMEDIA")?null:define("MULTIMEDIA",_SITEPATH."_multimedia".DS);
################################################
#FRAMEWORK DIRECTORY CONSTANTS (FRAMEWORK DIRS)#
################################################
defined("INC") 		?null:define("INC",	    _SITEPATH."includes".DS);
defined("MODULES") 	?null:define("MODULES", _SITEPATH."modules".DS);
defined("VENDOR")   ?null:define("VENDOR",  _SITEPATH."_vendor".DS);
defined("TEMPLATE") ?null:define("TEMPLATE",_SITEPATH."_skins".DS);
defined("COMPONENTS")?null:define("COMPONENTS",MODULES."_components".DS);
defined("CORE") 	?null:define("CORE",	   MODULES."_core".DS);
defined("LIB") 		?null:define("LIB",        MODULES."_lib".DS);
defined("CONFIG") 	?null:define("CONFIG",     MODULES."_config".DS);

###############################################
#APPLICATION DIRECTORY CONSTANTS (SYSTEM DIRS)#
###############################################

defined("APP")      ?null:define("APP", _SITEPATH."app".DS);
defined("BACKEND")	?null:define("BACKEND", APP."_backend".DS);
defined("WEBROOT")	?null:define("WEBROOT", APP."_webroot".DS);
defined("PARSERS")  ?null:define("PARSERS",	   APP."_parsers".DS);
defined("ERROR_LOG")?null:define("ERROR_LOG",  APP."_log".DS);
