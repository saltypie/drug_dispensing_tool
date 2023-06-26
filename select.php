<?php
require_once("connection.php");
$sql = "SELECT * FROM patient";
$sql_result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($sql_result);
foreach($row as $column => $value) {
        echo $column . " " . $value."<br>";
}
?>