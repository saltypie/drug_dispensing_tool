<?php
require("connection.php");
require("insertions.php");
if (isset($_POST['submit'])) {
    if (!empty($_POST['name'])&&!empty($_POST['phone'])&&!empty($_POST['age'])&&!empty($_POST['ssn'])) {
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $age=$_POST['age'];
        $ssn=$_POST['ssn'];
        $columns=$_POST['columns'];
        $tablename=$_POST['tablename'];
        $vals="'$ssn','$name','$phone','$age'";
        insertion($columns,$tablename,$vals);
    }else {
        echo "all fields required";
    }
}else{
    echo"not set";
}


?>