<?php

$host="localhost";
$user="root";
$pass="";
$db="login";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo"failed to connect to DB".$conn->connect_error;

}

$conn->set_charset("utf8");
?>
