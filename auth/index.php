<?php
include_once"../includes/init.php";
//url = index.php?controller/action/id-pagetitlehere route formats
new Dispatcher(
    BACKEND, // backend constant
    $registry,
    SET_QUERY_STRING // URL String
);
?>
