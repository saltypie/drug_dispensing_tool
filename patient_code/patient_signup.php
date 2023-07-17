<?php
require("../connection.php");
require("../insertions.php");
if (isset($_POST) and isset($_POST['submit'])) {
        insertion($_POST);
        session_start();
        $_SESSION["Name"]=$_POST["PatientName"];
        $_SESSION["SSN"]=$_POST["PatientSSN"];
        $_SESSION["loggedin"]=true;
        $_SESSION["role"]="Patient";
        header("Location:patient_profile.php");
}else{
    // echo"not set";
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Signup Patient</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/styles.css">
        <style>
            .laform{
                height: auto!important;
            }
            .itsown{
                margin-left: 2%;
                margin-right: 2%;
            }
        </style>
    </head>
    <body>
        <!-- <div class="container d-flex justify-content-center align-items-center" style="padding: 0%;margin:0%;"> -->
            
            <!-- <div class="card hover-card shadowbox">
                <div class="card-body shadowbox-body"> -->
                    <div style="margin-left: 5vw;" class="centerholder ">
                        <form class="laform" action="" method="post">
                            <div class="centerholder">
                                <h4 style="margin-left:1.8vw; margin-top:0.000001vh;">SIGNUP PATIENT</h4><br>
                            </div><br>
                            <div class="centerholder">
                                <div class="itsown">
                                    <label>SSN: </label>
                                    <br>
                                    <input type="text" name="PatientSSN">
                                </div>
                                <div class="itsown">
                                    <label>Email: </label>
                                    <br>
                                    <input type="email" name="Email">
                                </div>
                            </div>
                            <br>
                            <div class="centerholder">
                                <div class="itsown">    
                                    <label>Password: </label><br><input type="password" name="Password">
                                </div>
                                <div class="itsown">
                                    <label>Full Name: </label><br><input type="text" name="PatientName">
                                </div>
                            </div>
                            <br>
                            <div class="centerholder"> 
                                <div class="itsown">
                                    <label>Phone:</label><br>
                                    <input type="text" name="PhoneNumber">    
                                </div>
                                <div class="itsown">
                                    <label>Gender: </label><br><input type="text" name="Gender">
                                </div>
                            </div>
                            <br>
                            <div class="centerholder">
                                <div class="itsown">
                                    <label>Next of Kin: </label><br>
                                    <input type="text" name="NextofKin">
                                </div>
                                <p style="color:white">--</p>
                                <div class="itsown">
                                    <label>Allergies: </label><br>
                                    <input type="text" name="Allergies">
                                </div>
                            </div>
                            <br>
                            <div class="centerholder">
                                    <div class="itsown">
                                        <label>Family Conditions: </label>
                                        <br>
                                        <input type="text" name="FamilyConditions">
                                    </div>
                                    <div class="itsown">
                                        <label>DOB: </label>
                                        <br><input style="width: 180px"type="date" name="Age">
                                    </div>
                            </div>
                            <br>
                            <!-- <label>Gender: </label><input type="text" name="Gender"><br> -->
                            <div class="centerholder">
                                <div class="itsown">
                                    <div class="centerholder">
                                        <label>Address: </label><br>
                                    </div>
                                    <div class="centerholder">
                                        <input style="width: 180%" type="text" name="Address">
                                    </div>
                                </div>
                            </div><br>
                            <input type="text" name="tablename" value="Patient" style="display: none;">
                            <input type="text" name="columns" value="PatientSSN,Email,Password,PatientName,PhoneNumber,Gender,NextofKin,Allergies,FamilyConditions,Age,Address" style="display: none;">
                            <div class="centerholder">
                                <br><button style="width:20vw ;margin-top:0.5vh;" type="submit" name="submit" class="btn btn-primary">Signup</button>         
                            </div>
                        </form>
                    </div>
<!-- 
                </div>            
            </div> -->
        <!-- </div> -->
    </body>
</html>
