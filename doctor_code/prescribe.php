    <?php session_start();

    #echo("Name: ".$_SESSION["Name"]);
    //    if($_SESSION["Role"]!="Doctor"){
    //     header("Location: ../notfound.html");
    //    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">    
    <link rel="stylesheet" href="../CSS/styles.css">    
    <title>Prescribe</title>
</head>
<body>
        <nav class="navbar navbar-default">
           <div class="container-fluid">
               <div class="navbar-header">
               <a class="navbar-brand" href="http://localhost/WORK/drug_dispensing_tool/landing.php"><img src="../images/logo-final.png" alt="Logo" class="the-logo"></a>
               </div>
               <ul class="nav navbar-nav">

               <li class="active">
                   <div class="dropdown dpdown1">
                       <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Login
                       <span class="caret"></span></button>
                       <ul class="dropdown-menu">
                       <li><a href="../patient_code/patient_login.php">Patient</a></li>
                       <li><a href="../doctor_code/doctor_login.php">Doctor</a></li>
                       <li><a href="../pharmacist_code/pharmacist_login.php">Pharmacist</a></li>
                       <li><a href="../manufacturer_code/manufacturer_login.php">Pharmaceutical Company</a></li>
                       <li><a href="#">Admin</a></li>
                       </ul>
                   </div>
               </li>

               <li>
                   <div class="dropdown">
                       <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Signup
                       <span class="caret"></span></button>
                       <ul class="dropdown-menu">
                       <li><a href="../patient_code/patient_signup.php">Patient</a></li>
                       <li><a href="../doctor_code/doctor_signup.php">Doctor</a></li>
                       <li><a href="../pharmacist_code/pharmacist_signup.php">Pharmacist</a></li>
                       <li><a href="../manufacturer_code/manufacturer_signup.php">Pharmaceutical Company</a></li>
                       <li><a href="#">Admin</a></li>
                       </ul>
                   </div>
               </li>
               
               <p class="name-header"> <?php if(isset($_SESSION["Name"])){echo("Name: ".$_SESSION["Name"]);}?></p>
               </ul>
           </div>
       </nav>
    <div class="container">

        <form action="" method="post"><!--Empty action will call the same file-->
            <label>Patient SSN:</label><input type="text" name="PatientSSN"><br>
            <label>Pharmacy:</label><input type="text" name="PharmacyName"><br>
            <label>Illness:</label><input type="text" name="Illness"><br>
            <label>Drug Codes:<input type="text" name="DrugCodes" class="form-control" data-role="tagsinput"><br>
            <label>Dosages: </label><input type="text" name="Dosages" class="form-control" data-role="tagsinput"><br>
            <?php 
                $_SESSION["SSN"]=1;
                echo'<input type="text" name="DoctorSSN" value="'.$_SESSION["SSN"].'" style="display: none;">'
            ?>
            <input type="text" name="tablename" value="patientprescription" style="display: none;"><!--Which Table Are we inserting to-->
            <input type="text" name="columns" value="PatientSSN,PharmacyName,Illness,DrugCodes,Dosages,DoctorSSN"style="display: none;"><!--A way of specifying the table columns corresponding to this form-->
            <button type="submit" name="submit" class="btn btn-primary" style="top:60%; position:fixed" onclick="myFunction()">Submit</button> 
        </form>        
        <?php
            require("../connection.php");
            require("../insertions.php");
            if (isset($_POST['submit'])) {
                    insertion($_POST);

                    
            }else{
                // echo"not set";
            }

        ?>
    </div>
    <script>
        function myFunction() {
        alert("Submitted successfully");
        }
    </script>    
</body>
</html>