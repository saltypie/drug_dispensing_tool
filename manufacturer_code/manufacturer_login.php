<DOCTYPE html> 
<html>
    <head>
        <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="work.css">

    </head>
    <body>
        <form action="" method="post"><!--Link index to the login page post-->
            <h2>LOGIN</h2>
            <?php if(isset($_GET['error'])): ?>
                    <p class="error"><?php echo $_GET['error'];?></p>
            <?php endif ; ?><!--previous 3 lines syntax revise them-->
            <label>Company Name</label>
            <input type="text" name="Email" placeholder="Email" required><br>
            <label>Password</label>
            <input type="Password"name="Password"placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </body>
</html>
<?php
session_start();
include "../connection.php";

if(isset($_POST['Email'])&&isset($_POST['Email'])){
    $Email =$_POST['Email'];
    $Password=$_POST['Password'];
    if(empty($Email)){
        echo("Email is required");
        exit();
    }else if(empty($Password)){
        echo("Password is required");
        exit();
    }
    
    $sql = "SELECT * FROM Pharmaceutical_Company WHERE `Email`='$Email' AND Password='$Password'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
         //$sql = "SELECT * FROM users WHERE user_name='$uname' AND Password='$pass'";
        if($row['Email']===$Email &&$row['Password']===$Password){
            echo "Logged in";
            $_SESSION['Email']=$row['Email'];
            $_SESSION['Name']=$row['CompanyName'];
            $_SESSION['logged_in']=true;
            $_SESSION['role']="Pharmaceutical Company";
            header("Location: manufacturer_profile.php");//How to redirect
            exit();
        }else{
            echo("Email or Password don't match");
            exit();
        }
    }
}
?>