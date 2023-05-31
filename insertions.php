<?php
require("connection.php");

    function insertion(array $input) {
        global $conn;
            $columns=$input['columns'];
            $tablename=$input['tablename'];
            $values="";
            foreach($input as $key=>$value){
                if($key!='tablename'and$key!='columns'and$key!='submit'){
                    echo "\n KEY ".$key."KEY \n";
                    $values=$values."'$value',";
                }
            } 
            $values=substr($values, 0, -1);
            echo "Values--".$values."--values";           
            $query="INSERT INTO ". $tablename."(".$columns.") VALUES(".$values.")";
            echo "\n".$query;
            $run=mysqli_query($conn,$query)or die(mysqli_error($conn));
            if ($run) {
                echo "<h1>WELCOME!</h1>";
                print_r($input);
            }else {
                echo "unsuccessful";
            }
        return;
    }
    
    
?>