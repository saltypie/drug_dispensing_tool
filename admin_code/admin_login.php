<DOCTYPE html> 
<html>
    <head>
        <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="work.css">

    </head>
    <body>
        <form action="" method="post"><!--Link index to the login page post-->
            <h2>LOGIN</h2>
            <?php if(isset($_GET['error'])){ ?>
                    <p class="error"><?php echo $_GET['error'];?></p>
            <?php } ?><!--previous 3 lines syntax revise them-->
            <label>Username</label>
            <input type="text" name="Username" placeholder="Username" required><br>
            <label>Password</label>
            <input type="Password"name="Password"placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </body>
</html>
<?php
session_start();
include "../connection.php";

if(isset($_POST['Username'])&&isset($_POST['Username'])){
    $Username =$_POST['Username'];
    $Password=$_POST['Password'];
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
        if($row['Username']===$Username &&$row['Password']===$Password){
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