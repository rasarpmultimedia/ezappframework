<?php
header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once"../../includes/init.php";

$auth = new Auth; $util = new Utility;
$filesys = new FileSystem; $json = new JSONData([]);
$link = new GenerateUrl; $settings = new Settings;
$config = $settings->config(); $dataset = new RecordSet;
$sesscookie = new SessCookie; $ajaxformprocess = new ProcessAjaxForm;
//$ajaxpaginate = new AjaxPaginate;

