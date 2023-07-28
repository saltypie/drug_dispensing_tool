<!DOCTYPE html>
<html>
    <head>
        <title>Landing</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="CSS/styles.css">
    </head>
    <body>
        
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="http://localhost/WORK/drug_dispensing_tool/Homepage.html"><img src="images/logo-final.png" alt="Logo" class="the-logo"></a>
                </div>
                <ul class="nav navbar-nav">

                <li class="active">
                    <div class="dropdown dpdown1">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Login
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                        <li><a href="patient_code/patient_login.php">Patient</a></li>
                        <li><a href="doctor_code/doctor_login.php">Doctor</a></li>
                        <li><a href="pharmacist_code/pharmacist_login.php">Pharmacist</a></li>
                        <li><a href="manufacturer_code/manufacturer_login.php">Pharmaceutical Company</a></li>
                        <li><a href="admin_code/admin_login.php">Admin</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Signup
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                        <li><a href="patient_code/patient_signup.php">Patient</a></li>
                        <li><a href="doctor_code/doctor_signup.php">Doctor</a></li>
                        <li><a href="pharmacist_code/pharmacist_signup.php">Pharmacist</a></li>
                        <li><a href="manufacturer_code/manufacturer_signup.php">Pharmaceutical Company</a></li>
                        <li><a href="#">Admin</a></li>
                        </ul>
                    </div>
                </li>

                </ul>
            </div>
        </nav>
        <div class="container">


    </body>
</html>
