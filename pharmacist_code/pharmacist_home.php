<?php   
        session_start();
        require_once("../connection.php");
        // print_r($_POST);
        if(isset($_POST) and isset($_POST["IDToUpdate"])){            
            $sql="UPDATE patientprescription SET ApprovalStatus=\"approved\", ApprovingPharamacist=\"".$_SESSION["Name"]."\" WHERE PrescriptionID=".$_POST["IDToUpdate"];
            mysqli_query($conn,$sql);
            header("Refresh:0;url=pharmacist_home.php");
            // echo($sql);
        }
        if(isset($_POST['logout']) and $_POST['logout']=="true"){
            session_destroy();
            header("Location: ../Homepage.html");
        }        
        // header("Location: select_copy.php");
        // $result=$conn->query($slctn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="paging.js"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../CSS/styles.css">
    <style>
        table {
            background: lightblue;
            border: 2px solid balck;
            width: 100%;
        }

        thead, tbody {
            display: block;
            border: 2px solid black;
        }
        th{
            border: 2px solid black;
            width: 10%;
            text-align: center;
        }
        td{
            border: 2px solid black;
            width: 10%;
            text-align: center;
            background-color: lightblue;

        }


        tbody {
            overflow-y: scroll;
            /* height: 100px; */
            border: 2px solid black;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="http://localhost/WORK/drug_dispensing_tool/Homepage.html"><img src="../images/logo-final.png" alt="Logo" class="the-logo"></a>
            </div>
            <ul class="nav navbar-nav">

            <li>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_SESSION["Name"]?>
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li><form action="" method="post"><button type="submit"name="logout" value="true">Logout</button></form></li>
                    <li><a href="pharmacist_profile.php">Profile</a></li>
                    </ul>
                </div>
            </li>

            </ul>
        </div>
    </nav>
 

    <h1>Unapproved Prescriptions</h1><br>
    <!-- Patient tb -->
    <h2>Prescriptions\</h2>
    <table class="theTb table table-striped" id="theTb">
        <tr>
            <th>PatientSSN</th>
            <th>DrugCodes</th>
            <th>Dosages</th>
            <th>DoctorSSN</th>
            <th>Date</th>
            <th>Illness</th>
            <th>Approve</th>

        </tr>
        <!-- <tbody> -->

            <?php
                require_once("../connection.php");
                $slctn="SELECT * FROM patientprescription WHERE `ApprovalStatus` IS NULL AND `PharmacyName`=\"".$_SESSION["Pharmacy"]."\";";
                echo $slctn;
                $result=$conn->query($slctn);
                // $result_array=$result->fetch_assoc();
                while($result_array = $result->fetch_assoc())    {
                    if (!$result) {
                        die("Invalid Query".$conn->error);
                    }
                    // "<td>".$result_array["Password"]."</td>".
                    echo(
                        '<td>'.$result_array["PatientSSN"].'</td>'.
                        '<td>'.$result_array["DrugCodes"].'</td>'.
                        '<td>'.$result_array["Dosages"].'</td>'.
                        '<td>'.$result_array["DoctorSSN"].'</td>'.
                        '<td>'.$result_array["Date"].'</td>'.
                        '<td>'.$result_array["Illness"].'</td>'.
                        "<td> <form method=\"post\"><button type=\"submit\" name=\"IDToUpdate\"class=\"button btn-blue\" value=".$result_array["PrescriptionID"].">Approve</button></form></td>"
                    );
                    // $_POST["tableToUpdate"]="patient";//So we know which table to change
                    // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                }
                // "<td><a href=\"Update\">Update</a></td>"

            ?>        
    </table>
  
<script>
    $(document).ready(function(){
        $('.theTb').paging({limit:5});
    })
</script>
</body>
</html>
