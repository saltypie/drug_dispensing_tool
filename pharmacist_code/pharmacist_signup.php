<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/styles.css">
</head>
<body>

                    <div class="majordiv centerholder">
                        <form class="laform" method="post"><!--Empty action will call the same file-->
                        <div class="centerholder">
                            <a href="../Homepage.html">
                                <img class="login-logo" src="../images/logo-final.png" alt="">
                            </a>
                        </div>
                            <h4 class="centerholder">Pharmacist Signup</h4>
                            <label>SSN:</label>
                            <br><input type="text" name="StaffSSN"><br>
                            <label>Names:</label><br><input type="text" name="Names"><br>
                            <input type="text" name="Roles" value="Pharmacist" style="display: none;">
                            <label>Email:</label><br><input type="email" name="Email"><br>
                            <label>Password: </label><br><input type="password" name="Password"><br>
                            <label>Practicing Years: </label><br><input type="text" name="PracticingYears"><br>
                            <label>Pharmacy Name:</label><br><input type="text" name="PharmacyName"><br>
                            <label>Phone: </label><br><input type="text" name="Telephone"><br>
                            <label>Date of Birth: </label><br><input max="<?= date('Y-m-d', strtotime('-15 years')); ?>" type="date" name="Age"><br>
                            <input type="text" name="tablename" value="pharmacystaff" style="display: none;"><!--Which Table Are we inserting to-->
                            <input type="text" name="columns" value="StaffSSN,Names,Roles,Email,Password,PracticingYears,PharmacyName,Telephone,Age"style="display: none;"><!--A way of specifying the table columns corresponding to this form-->
                            <br><div class="centerholder">
                                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button> 
                            </div>
                        </form>
                    </div>


</body>
</html>

<?php
require("../connection.php");
require("../insertions.php");
if (isset($_POST['submit'])) {
        $_POST["Password"] = sha1($_POST["Password"]);   
        insertion($_POST);
        session_start();
        $_SESSION["SSN"]=$_POST["StaffSSN"];
        $_SESSION["Name"]=$_POST["Names"];
        $_SESSION["loggedin"]=true;
        $_SESSION["role"]=$_POST["Roles"];
        $_SESSION["Pharmacy"]=$_POST["PharmacyName"];
        header("Location: pharmacist_profile.php");
        
}else{
    // echo"not set";
}
?>
