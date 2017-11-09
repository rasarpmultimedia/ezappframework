<?php
header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once"../../app/_components/json.comp.php";
//Index JSON File Sends Data to index page via ajax
$output="";
$jsondata = array();
$json = new JSONData($jsondata);
$output = $json->encodeJSON(
    [
     "HomeMenu"=>["Home"=>"index.php","About"=>"about.php","Blogs"=>"blogs.php"]
    ],$json->opt_as["pretty"]
);
//echo $output;
?>