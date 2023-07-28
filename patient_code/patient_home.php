<?php   
        session_start();
        require_once("../connection.php");
        if(isset($_POST['logout']) and $_POST['logout']=="true"){
            session_destroy();
            header("Location: ../Homepage.html");
        }
        if(isset($_POST) AND isset($_POST["goback"])){
            unset($_POST);
            unset($_GET);
            header("Refresh:0;url=patient_home.php");
        }
        // print_r($_POST);
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
        .centerholder{
            display: flex;
            align-items: center;
            justify-content: center
        }
        .majordiv{
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .content-box-2{
            border: 10px solid rgba(0, 0, 0, 0.135);
            padding: 10px solid black;
            background-color: #05386B;
            color: aliceblue;
        }
        .goback_btn_div{
            color:rgb(241, 241, 255);
            background-color: #05386B;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .goback_btn{
            background-color:blue;
            display: flex;
        }

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
            /* background-color: lightblue; */

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
                    <li><a href="patient_profile.php">Profile</a></li>
                    </ul>
                </div>
            </li>

            </ul>
        </div>
    </nav>
 
    

    <?php if(isset($_GET) and !isset($_GET["PrescriptionToView"])): ?>    
        <h2>Prescriptions</h2>
        <table class="theTb table table-striped" id="theTb">
            <tr>
                <!-- <th>PatientSSN</th>
                <th>DrugCodes</th>
                <th>Dosages(ml)</th>
                <th>DoctorSSN</th> -->
                <th>Illness</th>
                <th>Date</th>
                <th>View</th>
            </tr>
            <!-- <tbody> -->

                <?php
                    $slctn="SELECT * FROM patientprescription WHERE `ApprovalStatus`=\"approved\" AND `PatientSSN`=\"".$_SESSION["SSN"].'"';
                    // echo $slctn;
                    $result=$conn->query($slctn);
                    // $result_array=$result->fetch_assoc();
                    while($result_array = $result->fetch_assoc())    {
                        if (!$result) {
                            die("Invalid Query".$conn->error);
                        }
                        // "<td>".$result_array["Password"]."</td>".
                        echo(
                            '<tr>'.  
                                '<td>'.$result_array["Illness"].'</td>'.
                                '<td>'.$result_array["Date"].'</td>'.
                                "<td><form method=\"get\"><button type=\"submit\" name=\"PrescriptionToView\"class=\"button btn-blue\" value=".$result_array["PrescriptionID"].">View Prescription</button></form></td>".   
                            '<tr>'
                        );
                        // $_POST["tableToUpdate"]="patient";//So we know which table to change
                        // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                    }
                ?> 
        </table>               
    <?php endif;?>    
    <!-- Patient tb -->

         <?php 
            if(isset($_GET) and isset($_GET["PrescriptionToView"])){
                $slctn="SELECT drugs.DrugName, prescriptiondrug.DrugCode, prescriptiondrug.PrescriptionID, prescriptiondrug.Dosage FROM prescriptiondrug,drugs WHERE drugs.DrugCode=prescriptiondrug.DrugCode AND prescriptiondrug.`PrescriptionID`=".$_GET["PrescriptionToView"];
                // echo $slctn;
                $result2=$conn->query($slctn);
                $slct_pharmacyname="SELECT patientprescription.PharmacyName FROM patientprescription WHERE PrescriptionID=".$_GET["PrescriptionToView"];
                $pharmacy_name=(($conn->query($slct_pharmacyname))->fetch_assoc())["PharmacyName"];
                echo('<div class="majordiv">
                        <div class="content-box-2">
                            <h1>Prescription Details</h1>
                            <div class="centerholder">
                                <h3>Prescription ID: '.$_GET["PrescriptionToView"].'</h3>
                            </div>'
                );

                $a=1;
                while($result_arr = $result2->fetch_assoc())    {
                    // print_r($result_arr);
                    $slct_price="SELECT DrugPrices FROM pharmacydrug WHERE PharmacyName='".$pharmacy_name. "' AND DrugCode=".$result_arr["DrugCode"];
                    // echo $slct_price;
                    $price=(($conn->query($slct_price))->fetch_assoc())["DrugPrices"];
                   
                    echo(
                        
                        '<p style="white-space: pre;"><strong>Drug'.$a.':  </strong>'.$result_arr["DrugName"]."----------------------------  Price:".$price.'/=</p>'.
                        '<p><strong>Dosage:  </strong>'.$result_arr["Dosage"].'</p>'
                    );
                    $a++;
                }
                echo '<form action="" method="post">
                        <div class="goback_btn_div">
                            <button type="submit" name="goback" value="True" class="goback_btn">Go Back</button>
                        </div>
                      </form>';                
            }
         ?>      
<script>
    $(document).ready(function(){
        $('.theTb').paging({limit:5});
    })
</script>
</body>
</html>
