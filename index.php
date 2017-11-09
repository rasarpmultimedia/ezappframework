<?php
include_once"includes/init.php";
    new Dispatcher(
        WEBROOT,//Public website constant
        $registry,
        SET_QUERY_STRING // URL string
    );
 
?>
