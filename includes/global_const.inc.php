<?php
/**
 * Set to ? if you have not configured the .htaccess to work with Rewrite 
 * @example (defined("QUERY_STRING")) ?null:define("QUERY_STRING","?");
 * 
 * **/
(defined("QUERY_STRING")) ?null:define("QUERY_STRING","?");

/** Application constants **/
(defined("APP_NAME")) ?null:define("APP_NAME" , "ezappframework");
(defined("APP_VERSION")) ?null:define("APP_VERSION" , "_v1.3");

/** Change this to website domain when on live server (example.com) or **/
/*  Please remove the SIT_NAME constant value when site is uploaded to a live server */

(defined("SITE_NAME")) ?null:define("SITE_NAME" , "ezappframework");

/** Site Layout constants 
 *  This help set whole application themes and templates directory
**/

(defined("LAYOUT_DIR")) ?null:define("LAYOUT_DIR" , "core_theme");

(defined("FRONTEND_HEADER")) ?null:define("FRONTEND_HEADER" , "");
(defined("FRONTEND_FOOTER")) ?null:define("FRONTEND_FOOTER" , "");

(defined("COPYRIGHTS")) ?null:define("COPYRIGHTS" ,"<p class=\"copy_text\"> &copy; Rasarp Multimedia Inc and ".APP_NAME.APP_VERSION."&trade; - ".date("Y",time())."</p>");

(defined("BACKEND_HEADER")) ?null:define("BACKEND_HEADER", "");
(defined("BACKEND_FOOTER")) ?null:define("BACKEND_FOOTER", "");

(defined("BACKEND_COPYRIGHT")) ?null:define("BACKEND_COPYRIGHT" , "<p class=\"copy_text\"> &copy; Rasarp Multimedia Inc & Powered by ".APP_NAME.APP_VERSION."&trade; - ".date("Y",time())."</p>");

/*Set base URL for the Application */
if(isset($_SERVER["HTTPS"])&&$_SERVER["HTTPS"]=="on"){
 (defined("URI")) ?null:define("URI" ,"https://".$_SERVER["SERVER_NAME"]."/".SITE_NAME."/");
}else{
 (defined("URI")) ?null:define("URI" ,"http://".$_SERVER["SERVER_NAME"]."/".SITE_NAME."/");
}
(defined("BASE_URL")) ?null:define("BASE_URL" ,URI); 
//TEMPLATE_URI
(defined("TEMPLATE_URI")) ?null:define("TEMPLATE_URI" , BASE_URL."_templates/".LAYOUT_DIR."/");

