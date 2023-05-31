<!DOCTYPE html>
<html>
    <head>
        <!-- This page would be visible to the manufacturers only, they can only add drugs under their own name, another table called stock w/ diff page would be used by Supervisors & managers-->
        <title>Add Drug</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/styles.css">
    </head>
    <body>
        <div class="container d-flex justify-content-center align-items-center" style="padding: 0%;margin:0%;">
            <img src="../images/logo-final.png" alt="Logo" class="the-logo">
            <div class="card hover-card shadowbox">
                <div class="card-body shadowbox-body">
                    <h4>Add A New Drug Product</h4>
                    <form action="" method="post"><!--Empty action will call the same file-->
                        <label>Drugcode: </label><input type="drugcode" name="drugcode"><br>
                        <label>Drugname: </label><input type="drugname" name="drugname"><br>
                        <label>Manufacturer:</label><input type="manufacturer" name="manufacturer"><br>
                        <label>Formula: </label><input type="formula" name="formula"><br>
                        <input type="text" name="tablename" value="drugs" style="display: none;">
                        <input type="text" name="columns" value="drugcode,drugname,manufacturer,formula"style="display: none;"><!--A way of specifying the table columns corresponding to this form-->
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>         
                    </form>

                </div>            
            </div>
        </div>
    </body>
</html>
<?php
require("../connection.php");
require("../insertions.php");
if (isset($_POST['submit'])) {
        insertion($_POST);
}else{
    // echo"not set";
}
?>
