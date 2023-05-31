<?php
require("../connection.php");
require("../insertions.php");
if (isset($_POST['submit'])) {
        insertion($_POST);
}else{
    echo"not set";
}


?>