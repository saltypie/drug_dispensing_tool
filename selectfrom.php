<?php
require("connection.php");
$sql = "SELECT * FROM patient";
$results = $conn->query($sql);
if ($result-> numof >0){

    while($row->$result->fetch_assoc()){
        echo "ssn: ".$_POST["ssn"] . "  name ". $_POST['name']." phone ".$_POST["phone"]. "  age ".$_POST["age"];
    }
}

?>
