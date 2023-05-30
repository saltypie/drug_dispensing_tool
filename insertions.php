<?php
require("connection.php");

    function insertion(array $vals) {
        global $conn;
        if (!empty($vals['name'])&&!empty($vals['phone'])&&!empty($vals['age'])&&!empty($vals['ssn'])) {
            $name=$vals['name'];
            $phone=$vals['phone'];
            $age=$vals['age'];
            $ssn=$vals['ssn'];
            $columns=$vals['columns'];
            $tablename=$vals['tablename'];
            $vals="'$ssn','$name','$phone','$age'";
            $query="INSERT INTO ". $tablename."(".$columns.") VALUES(".$vals.")";
            echo "\n".$query;
            $run=mysqli_query($conn,$query)or die(mysqli_error($conn));
            if ($run) {
                echo "<h1>WELCOME!</h1>";
                print_r($vals);
            }else {
                echo "unsuccessful";
            }
        }else {
            echo "all fields required";
        }        

        return;
    }
    
    
?>