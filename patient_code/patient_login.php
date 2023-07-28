<!DOCTYPE html> 
<html>
    <head>
        <title>LOGIN</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/styles.css">
    </head>
    <body>
        <div class="majordiv centerholder">            
            <form class="laform" action="" method="post"><!--Link index to the login page post-->
                <div class="centerholder">
                    <a href="../Homepage.html">
                        <img class="login-logo" src="../images/logo-final.png" alt="">
                    </a>
                </div>
                <div class="centerholder">
                    <h2>LOGIN</h2>
                </div>
                <?php if(isset($_GET['error'])){ ?>
                        <p class="error"><?php echo $_GET['error'];?></p>
                <?php } ?><!--previous 3 lines syntax revise them-->
                <label>Email</label><br>
                <input type="Email" name="Email" placeholder="Email" required><br><br>
                <label>Password</label><br>
                <input type="Password"name="Password"placeholder="Password" required><br><br><br>
                <div class="centerholder">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>
<?php
session_start();
include "../connection.php";

if(isset($_POST['Email'])&&isset($_POST['Email'])){
    $Email =$_POST['Email'];
    $Password=$_POST['Password'];
    $Password=sha1($Password);

    if(empty($Email)){
        echo("Email is required");
        exit();
    }else if(empty($Password)){
        echo("Password is required");
        exit();
    }
    
    $sql = "SELECT * FROM patient WHERE `Email`='$Email' AND Password='$Password'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
        // $sql = "SELECT * FROM users WHERE user_name='$uname' AND Password='$pass'";
        if($row['Email']===$Email &&$row['Password']===$Password){
            echo "Logged in";
            $_SESSION['Email']=$row['Email'];
            $_SESSION['SSN']=$row['PatientSSN'];
            $_SESSION['Name']=$row['PatientName'];
            $_SESSION['logged_in']=true;
            $_SESSION['role']="Patient";
            header("Location: patient_home.php");//How to redirect
            exit();
        }else{
            echo("Email or Password don't match");
            exit();
        }
    }
}
?>