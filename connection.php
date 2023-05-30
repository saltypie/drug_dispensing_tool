<?php
$userName="root";
$password="";
$dbName ='testdb';

$conn=new mysqli('localhost',$userName,$password,$dbName);
if($conn->connect_error){
    die("Connection Failed");
}else{
    // echo("Connection Success");
}
?>