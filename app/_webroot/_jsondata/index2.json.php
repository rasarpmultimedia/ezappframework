<?php
header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once"../../app/_components/json.comp.php";
//Index JSON File Sends Data to index page via ajax
$output="";
$jsondata = array();
$json = new JSONData($jsondata);
$output = $json->encodeJSON(
    ["Content"=>"Welcome to JSON and Ajax",
    "HomeMenu"=>["Home"=>"index.php","About"=>"about.php","Blogs"=>"blogs.php"],
     "Page"=>[
         "Title"=>"Welcome to ezAppFramework Build Some Cool Web Apps More easily",
         "Body"=>"ezAppFramework is a Rapid Application Development Framework build with the MVC Architecture, its suitable for all kinds of  WebApp development.",
         "Source"=>"companyhouse.com.gh"]
    ],$json->opt_as["pretty"]
);
//echo $output;
?>