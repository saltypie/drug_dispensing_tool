<?php   
        session_start();
        require_once("../connection.php");
        // print_r($_POST["IDToUpdate"]);
        // print_r($_POST);
        // print_r($_SESSION);
        // if(isset($_POST) and isset($_POST["IDToUpdate"])){            
        //     $sql="UPDATE patientprescriptions SET ApprovalStatus=\"approved\", ApprovingPharamacist=\"".$_SESSION["Name"]."\" WHERE PrescriptionID=".$_POST["IDToUpdate"];
        //     header("Refresh:0;url=double_copy.php");
        //     // echo($sql);
        // }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    

    <script src="paging.js"></script> 
    <link rel="stylesheet" href="../CSS/styles.css">   
    <style>
        .theTb {
            background: white;
            border: 2px solid balck;
            width: 80vw;
            height: auto;
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
            height: 250px;
            border: 2px solid black;
        }
        .centerholder{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .majordiv{
            /* display: flex; */
            height: 100vh;
            /* align-items: center;
            justify-content: center; */
        }
        .content-box-2{
            border: 10px solid rgba(0, 0, 0, 0.135);
            padding: 10px solid black;
            background-color: #05386B;
            color: aliceblue;
        }
        .approve_drug_btn_div{
            color:rgb(241, 241, 255);
            background-color: #05386B;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .approve_drug_btn{
            background-color:blue;
            display: flex;
        }

        .search-input {
            border: none;
            padding: 10px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 20px 0 0 20px;	
        }

        .search-button {
            border: none;
            padding: 10px;
            background-color: #05386B;
            color: #fff;
            cursor: pointer;
            border-radius: 0 20px 20px 0;   
        }     
    </style>
</head>
<body>
    <?php require("../navi.php"); 
    common_navi($_SESSION); ?>




    <div class="majordiv">
        <?php if(!isset($_GET["IDToUpdate"])): ?>
            <div class="all_prescriptions">
                <div class="centerholder">
                    <h2>Prescriptions</h2>
                </div>    
                <div class="centerholder">
                    <h1>Unapproved Prescriptions</h1><br>
                </div>
                <div class="search-container centerholder">
                    <form action="single_prescription.php" method="post">
                        <input type="text" name="patient_srch" class="search-input" placeholder="Search Using Patient SSN...">
                        <button type="submit" type="submit" class="search-button">Search</button>
                    </form>
                </div>
                <br>
                <div class="centerholder">
                    <table class="theTb table" id="theTb">
                        <tr>
                            <!-- <th>PatientSSN</th>
                            <th>DoctorSSN</th> -->
                            <th>Date</th>
                            <th>Illness</th>
                            <th>Begin Approval</th>
                
                        </tr>
                        <!-- <tbody> -->
                
                            <?php
                                if(!isset($_GET["IDToUpdate"])){ 
                                    // echo"IM MET";                   
                                    require_once("../connection.php");
                                    $slctn="SELECT * FROM patientprescription WHERE `ApprovalStatus` IS NULL AND `PharmacyName`='".$_SESSION["Pharmacy"]."';";
                                    $result=$conn->query($slctn);
                                    // $result_array=$result->fetch_assoc();
                                    while($result_array = $result->fetch_assoc())    {
                                        if (!$result) {
                                            die("Invalid Query".$conn->error);
                                        }                    
                                        
                                        echo(
                                            '<tr>'.
                                            // '<td>'.$result_array["PatientSSN"].'</td>'.
                                            // '<td>'.$result_array["DoctorSSN"].'</td>'.
                                            '<td>'.$result_array["Date"].'</td>'.
                                            '<td>'.$result_array["Illness"].'</td>'
                                            // ."<td> <form method=\"get\"><button type=\"submit\" name=\"IDToUpdate\"class=\"button btn-blue\" value=".$result_array["PrescriptionID"].">Approve</button></form></td>"   
                                            ."<td><form method=\"get\"><button type=\"submit\" name=\"IDToUpdate\"class=\"button btn-blue\" value=".$result_array["PrescriptionID"].">Begin Approval</button></form></td>"   
                                            .'</tr>'                
                                        );
                                        // $slctn2="SELECT * FROM prescriptiondrug WHERE `PrescriptionID`=".$result_array["PrescriptionID"];
                                        // $result2=$conn->query($slctn); 
                                        // while($result2_arr = $result2->fetch_assoc())    {
                                        //     echo('<tr><td>'.$result_array["PrescriptionID"].'</td></tr>');
                                        // } 
                                        // $_POST["tableToUpdate"]="patient";//So we know which table to change
                                        // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                                    }
                                    // "<td><a href=\"Update\">Update</a></td>"
                                }
                
                            ?>        
                    </table>
                </div>
            </div>    
        <?php endif;?>

        <?php
            if(isset($_GET) and isset($_GET["IDToUpdate"]) and !isset($_POST["IDToUpdate"])){
                // echo"IM MET";                   
                $slctn2="SELECT drugs.DrugName, prescriptiondrug.DrugCode, prescriptiondrug.PrescriptionID, prescriptiondrug.Dosage FROM prescriptiondrug,drugs WHERE drugs.DrugCode=prescriptiondrug.DrugCode AND prescriptiondrug.`PrescriptionID`=".$_GET["IDToUpdate"];
                $result2=$conn->query($slctn2); 
                echo('<div class="majordiv centerholder">
                        <div class="content-box-2">
                            <h1>Prescription Details</h1>'
                );

                $a=1;
                while($result2_arr = $result2->fetch_assoc())    {
                    echo(
                        '<p><strong>Prescription ID:  </strong>'.$result2_arr["PrescriptionID"].'</p>'.
                        '<p><strong>Drug'.$a.':  </strong>'.$result2_arr["DrugName"].'</p>'.
                        '<p><strong>Dosage:  </strong>'.$result2_arr["Dosage"].'</p>'
                        // '<tr>
                        //   <td>'.$result2_arr["PrescriptionID"].'</td>'.
                        //   '<td>'.$result2_arr["DrugCode"].'</td>'.
                        //   '<td>'.$result2_arr["Dosage"].'</td>'
                        //   .'</tr>'
                    );
                    $a++;
                }
                $_POST["tableToUpdate"]="patientprescription";//So we know which table to change
                $_POST["colsToUpdate"]=array("ApprovalStatus");//So we know which table to change
                echo '<form action="" method="post">
                        <input name="IDToUpdate" value="' . $_GET["IDToUpdate"] . '" hidden>
                        <div class="approve_drug_btn_div">
                            <button type="submit" class="approve_drug_btn">Confirm Approval</button>
                        </div>
                      </form>';
                // echo"<form method=\"post\"><button type=\"submit\" name=\"IDToUpdate\"class=\"button btn-blue\" value=".$_GET["IDToUpdate"].">Confirm Approval</button></form>";

            }
            if(isset($_POST) AND isset($_POST["IDToUpdate"])){
                $sql_update="UPDATE patientprescription SET ApprovalStatus='approved', ApprovingPharmacist='".$_SESSION["SSN"]."' WHERE `PrescriptionID`=".$_POST["IDToUpdate"];
                // echo $sql_update;
                $update_result=$conn->query($sql_update);
                echo'
                <div class="majordiv centerholder">            
                    <div class="content-box-2">
                        <h1> Successfully Approved</h1>
                        <div class="centerholder">
                            <a style="color:white;" href="review_prescriptions.php">Go Back</a>
                        </div>
                    </div>
                </div>
                ';
                unset($_POST);
                unset($_GET);

            }
        ?>  
        <a href="previous_prescs.php">Prescription History</a>
              
    </div>
    <div class="centerholder">
        
    </div>
    <!-- <form action="" method="post"><button type="submit" name="IDToUpdate" class="approve_drug_btn" value='.$_GET["IDToUpdate"].'>Confirm Approval</button></form> -->
    <script>
        $(document).ready(function(){
            $('.theTb').paging({limit:5});
        })
    </script>
</body>
</html>

