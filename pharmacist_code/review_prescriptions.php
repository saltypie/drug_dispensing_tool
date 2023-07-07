<?php   
        session_start();
        require_once("../connection.php");
        // print_r($_POST);
        if(isset($_POST) and isset($_POST["IDToUpdate"])){            
            $sql="UPDATE patientprescriptions SET ApprovalStatus=\"approved\", ApprovingPharamacist=\"".$_SESSION["Name"]."\" WHERE PrescriptionID=".$_POST["IDToUpdate"];
            header("Refresh:0;url=double_copy.php");
            // echo($sql);
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
    <title>Profile Details</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="paging.js"></script>    
    <style>
        table {
            background: white;
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
        }


        tbody {
            overflow-y: scroll;
            height: 100px;
            border: 2px solid black;
        }
    </style>
</head>
<body>
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
                require_once("connection.php");
                $slctn="SELECT * FROM patientprescriptions WHERE `ApprovalStatus`=NULL AND `PHARMACY_NAME`='".$_SESSION["Pharmacy"]."'";
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
