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
                    <h4>Signup Manufacturer</h4>
                    <form action="" method="post"><!--Empty action will call the same file-->
                        <label>CompanyName: </label><input type="text" name="CompanyName"><br>
                        <label>PhoneNumber: </label><input type="text" name="PhoneNumber"><br>
                        <label>Email:</label><input type="email" name="Email"><br>
                        <label>Password: </label><input type="password" name="Password"><br>
                        <input type="text" name="tablename" value="PharmaceuticalCompany" style="display: none;"><!--Which Table Are we inserting to-->
                        <input type="text" name="columns" value="CompanyName,PhoneNumber,Email,Password"style="display: none;"><!--A way of specifying the table columns corresponding to this form-->
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
        session_start();
        $_SESSION["CompanyName"]=$_POST["CompanyName"];
        $_SESSION["loggedin"]=true;
        $_SESSION["role"]="Pharmaceutical";
        header("Location: manufacturer_profile.php");
        
}else{
    // echo"not set";
}
?>
