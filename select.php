<?php
require_once("connection.php");
$sql = "SELECT * FROM patient";
$results=$conn->query($sql);
$row=$results->fetch_assoc();
print_r($row);

?>