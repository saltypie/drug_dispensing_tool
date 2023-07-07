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
<div class="container d-flex justify-content-center align-items-center" style="padding: 0%;margin:0%;">
            <img src="../images/logo-final.png" alt="Logo" class="the-logo">
            <div class="card hover-card shadowbox">
                <div class="card-body shadowbox-body">
                    <h4>Signup Doctor</h4>
                    <form action="" method="post"><!--Empty action will call the same file-->
                        <label>DoctorID:</label><input type="text" name="DoctorID"><br>
                        <label>DoctorName:</label><input type="text" name="DoctorName"><br>
                        <label>Hospital:</label><input type="text" name="Hospital"><br>
                        <label>Phone: </label><input type="text" name="Phone"><br>
                        <label>Email:</label><input type="email" name="Email"><br>
                        <label>Password: </label><input type="password" name="Password"><br>
                        <input type="text" name="tablename" value="Doctor" style="display: none;"><!--Which Table Are we inserting to-->
                        <input type="text" name="columns" value="DoctorSSN,DoctorName,Hospital,Phone,Email,Password"style="display: none;"><!--A way of specifying the table columns corresponding to this form-->
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
        $_SESSION["SSN"]=$_POST["DoctorSSN"];
        $_SESSION["Name"]=$_POST["DoctorName"];
        $_SESSION["loggedin"]=true;
        $_SESSION["role"]="Doctor";

        header("Location: prescribe.php");
        
}else{
    // echo"not set";
}
?>
