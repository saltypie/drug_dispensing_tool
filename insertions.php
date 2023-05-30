<?php
require("connection.php");

    function insertion(string $columns, string $tablename,string $vals) {
        global $conn;
        $query="INSERT INTO ". $tablename."(".$columns.") VALUES(".$vals.")";
        echo "\n".$query;
        $run=mysqli_query($conn,$query)or die(mysqli_error($conn));

        if ($run) {
            echo "<h1>WELCOME BACK!</h1>";
        }else {
            echo "unsuccessful";
        }
        return;
    }
    
    
?>