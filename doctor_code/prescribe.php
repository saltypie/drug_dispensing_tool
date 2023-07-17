    <?php session_start();
        require_once("../connection.php");
        $slct_pharmacy="SELECT * FROM pharmacy";
        $pharmacy_result=$conn->query($slct_pharmacy);
        if(isset($_POST) AND isset($_POST["goback"])){
            unset($_POST);
            unset($_GET);
            header("Refresh:0;url=prescribe.php");
        }
        if(isset($_GET) and isset($_GET["patient_srch"])){
            $sql_patient="SELECT PatientSSN FROM patient WHERE PatientName='".$_GET["patient_srch"]."';";
            $patient_ssn=(($conn->query($sql_patient))->fetch_assoc())["PatientSSN"];
        }else{
            $patient_ssn="";
        }
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
    <?php require("../navi.php"); 
    common_navi($_SESSION); ?>
    <div class="container">
        <?php if(isset($_POST) and !isset($_POST["number_of_drugs"]) and !isset($_POST['submit_presc'])): ?>
            <div class="search-container centerholder">
                        <form action="" method="get">
                            <input type="text" name="patient_srch" class="search-input" placeholder="Search Using Patient Name...">
                            <button type="submit" type="submit" class="search-button">Search</button>
                        </form>
            </div>
            <br>
            <div class="centerholder">
                <form class="laform" action="" method="post"><!--Empty action will call the same file-->
                    
                    <label>Patient SSN:</label><input type="text" name="PatientSSN" value="<?php echo $patient_ssn;?>"><br>
                    
                    
                    <label>Illness:</label><input type="text" name="Illness"><br>
                    <?php 
                        // $_SESSION["SSN"]=1;
                        echo'<input type="text" name="DoctorSSN" value="'.$_SESSION["SSN"].'" style="display: none;">'
                    ?>
                    <input type="text" name="tablename" value="patientprescription" style="display: none;"><!--Which Table Are we inserting to-->
                    <input type="text" name="columns" value="PatientSSN,Illness,DoctorSSN"style="display: none;"><!--A way of specifying the table columns corresponding to this form-->
                    <button type="submit" name="submit_presc" class="btn btn-primary">Submit</button> 
                </form>       
            </div>
        <?php endif;?>
            

        <?php
            require("../insertions.php");
            if (isset($_POST['submit_presc'])) {
                // print_r($_POST);
                insertion(array_slice($_POST, 0, 5));     
            }else{
            }

        ?>

    </div>
    <?php if(isset($_POST['submit_presc'])): ?>
        <div class="centerholder">
            <form class="laform" action="" method="post">
                <label>How many drugs will you enter</label>
                <input type="text" name="number_of_drugs"><br>
    
                <select name='PharmacyName'>
                    <option>Choose Pharmacy</option>
                    <?php 
                        while($result_array=$pharmacy_result->fetch_assoc()){
                            echo "<option value='".$result_array["PharmacyName"]."'><button type='submit' name='submit'>".$result_array["PharmacyName"]."</button></option>";
                        }
                    ?>
                </select><br>
                        
                <button type="submit" name="number_of_drugs_submit">Confirm</button>
            </form>
        </div>
    <?php endif;?>
    

    <!-- <form action="" method="post">
            <button type='submit' name='submit'>Confirm</button>
    </form> -->
    <?php if(isset($_POST) and isset($_POST["number_of_drugs"])):?>
        <div class="centerholder">
            <form action="" method="post" class="laform">
                <?php
                    echo('<form action="" method="post">');
                    for($i=0;$i<$_POST["number_of_drugs"];$i++){
                            echo'<select name="DrugCode[]">';
                                echo'<option value="">Choose Drug</option>';
        
                                $slct_drug="SELECT pharmacydrug.DrugCode,pharmacydrug.PharmacyName ,drugs.DrugName FROM `pharmacydrug`,`drugs` WHERE pharmacydrug.DrugCode=drugs.DrugCode AND pharmacydrug.PharmacyName='".$_POST["PharmacyName"]."';";
                                $drug_result=$conn->query($slct_drug);
        
                                while($drugs_array=$drug_result->fetch_assoc()){
                                    echo("<option value='".$drugs_array["DrugCode"]."'>".$drugs_array["DrugName"]."</option>");
                                }
                                
                            echo"</select>";           
                            echo('<label>Dose</label><input type="text" name="Dosage[]"><br>');
                    }
                    echo('<input type="text" name="PharmacyName" hidden value='.$_POST["PharmacyName"].'>');
                    echo('<input type="text" name="number_of_drugs" hidden value='.$_POST["number_of_drugs"].'>');
                    echo('<button type="submit" name="drug_submit">Confirm</button>') ;
                ?>         
            </form>
        </div>
    <?php endif;?>    


    <?php
        // $slct_last_presc="SELECT PrescriptionID FROM `patientprescription` WHERE DoctorSSN='".$_SESSION["SSN"]."' ORDER BY PrescriptionID DESC LIMIT 1; ";
        // $lst_presc_result=$conn->query($slct_last_presc);
        // $prescID;
        // $res_arr=$lst_presc_result->fetch_assoc();
        // $prescID=$res_arr["PrescriptionID"];
        
        
        if (isset($_POST) and isset($_POST["drug_submit"])) {
                $slct_last_presc="SELECT PrescriptionID FROM `patientprescription` WHERE DoctorSSN='".$_SESSION["SSN"]."' ORDER BY PrescriptionID DESC LIMIT 1; ";
                $lst_presc_result=$conn->query($slct_last_presc);
                $prescID;
                $res_arr=$lst_presc_result->fetch_assoc();
                $prescID=$res_arr["PrescriptionID"];
                for($i=0;$i<$_POST["number_of_drugs"];$i++){
                    $drug_post_arr=array();
                    $drug_post_arr["PrescritionID"]=$prescID;
                    $drug_post_arr["PharmacyName"]=$_POST["PharmacyName"];
                    $drug_post_arr["Dosage"]=$_POST["Dosage"][$i];
                    $drug_post_arr["DrugCode"]=$_POST["DrugCode"][$i];
                    $drug_post_arr["columns"]="PrescriptionID,PharmacyName,Dosage,DrugCode";
                    $drug_post_arr["tablename"]="prescriptiondrug";
                    insertion($drug_post_arr);     
                }

                echo("
                        <div class='centerholder'>
                            <form class='laform' action='' method='post'>
                                <p>Successfully Submitted</p>
                                <button type='submit' name='goback' value='true'>Go Back</button>
                            </form>
                        </div>"
                    );

        }
    ?>
    <script>
        // function myFunction() {
        //  alert("Submitted successfully");
        // }
    </script>    

</body>
</html>