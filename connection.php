<?php
$userName="root";
$Password="208hr882";
$dbName ='drug_dispensing_tool';

$conn=new mysqli('localhost',$userName,$Password,$dbName);
if($conn->connect_error){
    die("Connection Failed");
}else{
     echo("Connection Success");
}
?>