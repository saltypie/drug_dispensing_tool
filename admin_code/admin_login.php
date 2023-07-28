<DOCTYPE html> 
<html>
    <head>
        <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
    </head>
    <body>
        <div class="majordiv centerholder">
            <form class="laform" action="" method="post"><!--Link index to the login page post-->
                 <div class="centerholder">
                    <a href="../Homepage.html">
                        <img class="login-logo" src="../images/admin-logo-1.gif" alt="">
                    </a>
                </div>
                <div class="centerholder">
                    <h2>LOGIN</h2>
                </div>
                <?php if(isset($_GET['error'])){ ?>
                        <p class="error"><?php echo $_GET['error'];?></p>
                <?php } ?><!--previous 3 lines syntax revise them-->
                <label>Username</label><br>
                <input type="text" name="Username" placeholder="Username" required><br>
                <label>Password</label><br>
                <input type="Password"name="Password"placeholder="Password" required><br><br>
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

if(isset($_POST['Username'])&&isset($_POST['Username'])){
    $Username =$_POST['Username'];
    $Password=$_POST['Password'];
    $Password=sha1($Password);
    if(empty($Username)){
        echo("Username is required");
        exit();
    }else if(empty($Password)){
        echo("Password is required");
        exit();
    }
    
    $sql = "SELECT * FROM `admin` WHERE `Username`='$Username' AND Password='$Password'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
        // $sql = "SELECT * FROM users WHERE user_name='$uname' AND Password='$pass'";
        if($row['Username']===$Username &&$row['Password']==$Password){
            echo "Logged in";
            $_SESSION['Username']=$row['Username'];
            $_SESSION['logged_in']=true;
            $_SESSION['role']="admin";
            header("Location: double_copy.php");//How to redirect
            exit();
        }else{
            echo("Username or Password don't match");
            exit();
        }
    }
}
?>