<?php
include_once"../../includes/init.php";

$filesys = new FileSystem; 
$json 	 = new JSONData([]);
$link 	 = new GenerateUrl;
$ajaxform = new AjaxForm;
$settings = new Settings;
$config   = $settings->config();
$dataset  = new RecordSet;
$ajaxformprocess = new ProcessAjaxForm;
$util = $ajaxformprocess->util;
$sesscookie = $ajaxformprocess->sesscookie;