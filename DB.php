<?php
//api url filter
if(strpos($_SERVER['REQUEST_URI'],"DB.php")){
    require_once 'Utils.php';
    PlainDie();
}

$conn = new mysqli("localhost", "id17641949_idragonytvipmod", "H)7<PMrl0&#w+F|M", "id17641949_idragonytvip");
if($conn->connect_error != null){
    die($conn->connect_error);
}