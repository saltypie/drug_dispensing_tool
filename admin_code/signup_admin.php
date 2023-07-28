<!DOCTYPE html>
<html>
    <head>
        <!-- This page would be visible to the manufacturers only, they can only add drugs under their own name, another table called stock w/ diff page would be used by Supervisors & managers-->
        <title>Add Drug</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/styles.css">
        <style>
            /* .laform{
                height: 40vh!important;
            } */
        </style>
    </head>
    <body>
        <!-- <div class="container d-flex justify-content-center align-items-center" style="padding: 0%;margin:0%;">
            <div class="card hover-card shadowbox">-->
                <div class="centerholder"> 
                    <form style="margin-top: 10%" class="laform"action="" method="post"><!--Empty action will call the same file-->
                        <div class="centerholder">
                            <a href="double_copy.php">
                                <img class="login-logo" src="../images/admin-logo-1.gif" alt="">
                            </a>
                        </div>
                        <h4>Register Another Admin</h4><br>
                        <label>UserName: </label><br><input type="text" name="Username"><br>
                        <label>Password: </label><br><input type="password" name="Password"><br>
                        <input type="text" name="tablename" value="admin" style="display: none;"><!--Which Table Are we inserting to-->
                        <input type="text" name="columns" value="Username,Password"style="display: none;"><br><!--A way of specifying the table columns corresponding to this form-->
                        <div class="centerholder">
                            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>         
                        </div>
                    </form>

                 </div>            
           <!-- </div>
        </div> -->
    </body>
</html>
<?php
require("../connection.php");
require("../insertions.php");
if (isset($_POST) and isset($_POST['submit'])) {
        $_POST["Password"] = sha1($_POST["Password"]);   
        insertion($_POST);  
}else{
    // echo"not set";
}
?>
