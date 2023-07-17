<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="work.css">
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
</head>
<body>
    <div class="centerholder">
        <form class="laform" action="" method= "POST">
            <h3>LOGIN</h3>
            <?php if(isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error'];?></p>
            <?php } ?><!--previous 3 lines syntax revise them-->
            <label>Email</label>
            <input type="text" name="Email" placeholder="Email" required><br>
            <label>Password</label>
            <input type="Password"name="Password"placeholder="Password" required><br>
            <button type="submit">Login</button>   
        </form>
    </div>

</body>
</html>
<?php
session_start();
include "../connection.php";
if(isset($_POST['Email'])&&isset($_POST['Password'])){
    $Email =$_POST['Email'];
    $Password=$_POST['Password'];
    if(empty($Email)){
        echo("Email is required");
        exit();
    }else if(empty($Password)){
        echo("Password is required");
        exit();
    }

    $sql = "SELECT * FROM pharmacystaff WHERE `Email`='$Email' AND Password='$Password'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
         //$sql = "SELECT * FROM users WHERE user_name='$uname' AND Password='$pass'";
        if($row['Email']===$Email &&$row['Password']===$Password){
            echo "Logged in";
            $_SESSION['Email']=$row['Email'];
            $_SESSION['SSN']=$row['StaffSSN'];
            $_SESSION['logged_in']=true;
            $_SESSION['role']=$row["Roles"];
            $_SESSION['Name']=$row["Names"];
            $_SESSION['Pharmacy']=$row["PharmacyName"];
            header("Location: review_prescriptions.php");//How to redirect
            exit();
        }else{
            echo("Email or Password don't match");
            exit();
        }
    }
}

