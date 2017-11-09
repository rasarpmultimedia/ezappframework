<?php
header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once"../../app/_components/json.comp.php";
//Index JSON File Sends Data to index page via ajax
$output="";
$jsondata = array();
$json = new JSONData($jsondata);
$json->encodeJSON(["Content"=>"Json data to work with, Welcome to JSON"]);
echo $output;
?>