<?php
require("../connection.php");
require("../insertions.php");
if (isset($_POST['submit'])) {
        insertion($_POST);
        session_start();
        $_SESSION["Name"]=$_POST["PatientName"];
        $_SESSION["loggedin"]=true;
        $_SESSION["role"]="Patient";
        header("Location:patient_profile.php");
}else{
    echo"not set";
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Signup Patient</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/styles.css">

    </head>
    <body>
        <div class="container d-flex justify-content-center align-items-center" style="padding: 0%;margin:0%;">
            <img src="../images/logo-final.png" alt="Logo" class="the-logo">
            <div class="card hover-card shadowbox">
                <div class="card-body shadowbox-body">
                    <h4>SIGNUP PATIENT</h4>
                    <form action="" method="post">
                        <label>SSN: </label><input type="text" name="PatientSSN"><br>
                        <label>Email: </label><input type="email" name="Email"><br>
                        <label>Password: </label><input type="password" name="Password"><br>
                        <label>Full Name: </label><input type="text" name="PatientName"><br>
                        <label>Phone:</label><input type="text" name="PhoneNumber"><br>
                        <label>Gender: </label><input type="text" name="Gender"><br>
                        <label>Next of Kin: </label><input type="text" name="NextofKin"><br>
                        <label>Allergies: </label><input type="text" name="Allergies"><br>
                        <!-- <label>Gender: </label><input type="text" name="Gender"><br> -->
                        <label>Family Conditions: </label><input type="text" name="FamilyConditions"><br>
                        <label>Age: </label><input type="text" name="Age"><br>   
                        <label>Address: </label><input type="text" name="Address"><br>   
                        <input type="text" name="tablename" value="Patient" style="display: none;">
                        <input type="text" name="columns" value="PatientSSN,Email,Password,PatientName,PhoneNumber,Gender,NextofKin,Allergies,FamilyConditions,Age,Address" style="display: none;">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>         
                    </form>

                </div>            
            </div>
        </div>
    </body>
</html>
