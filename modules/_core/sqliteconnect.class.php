<?php

class SQLiteConnect{
    protected $con;
    function __construct($filename=''){
     $this->con = new PDO("sqlite:".$filename);
    }
}

?>