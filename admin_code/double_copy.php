<?php   
        require_once("../connection.php");
        if(isset($_POST['logout']) and $_POST['logout']=="true"){
            session_destroy();
            header("Location: ../landing.php");
        }        
        session_start();
        // print_r($_POST);
        if(isset($_POST) and isset($_POST["whoToUpdate"])){            
            $sql="UPDATE ".$_POST["tableToUpdate"]." SET ";
            foreach(explode(",",$_POST["colsToUpdate"]) as $col){
                $substring=$col."=\"".$_POST[$col]."\",";
                $sql.=$substring;
                // echo$sql;
            }
            $sql=substr($sql, 0, -1);
            $sql.=' WHERE '.$_POST["criteria"].'="'.$_POST["whoToUpdate"]."\"";
            mysqli_query($conn,$sql) or die(mysqli_error($conn));
            header("Refresh:0;url=double_copy.php");
            // echo($sql);
        }
        if(isset($_POST) and isset($_POST["whoToDelete"])){            
            $sql="DELETE FROM ".$_POST["tableToUpdate"]." WHERE patientSSN=\"".$_POST["whoToDelete"]."\"";
            echo $sql;
            mysqli_query($conn,$sql) or die(mysqli_error($conn));
            header("Refresh:0; url=double_copy.php");
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
    <script src="../paging.js"></script>  
    <script src="admin.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/styles.css">      
    <style>
        table {
            background: steelblue;
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
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="http://localhost/WORK/drug_dispensing_tool/landing.php"><img src="../images/logo-final.png" alt="Logo" class="the-logo"></a>
            </div>
            <ul class="nav navbar-nav">


            <li>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_SESSION["Username"]?>
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li><form action="" method="post"><button type="submit"name="logout" value="true">Logout</button></form></li>
                    </ul>
                </div>
            </li>

            </ul>
        </div>
    </nav>    
    <h1>ADMIN CENTRE</h1><br>

    <div class="options" style="border: 1px solid grey; width: 37vw; float: right; position: absolute; left:30vw;"><p class="doctor_displayer" style="display:inline; border: 1px solid grey">Doctor Table</p><p class="pharmacist_displayer" style="display:inline; border: 1px solid grey">Pharmacist Table</p><p class="patient_displayer" style="display:inline; border: 1px solid grey">Patient Table</p><p class="company_displayer" style="display:inline; border: 1px solid grey">Pharmaceutical Company Table</p></div>    
    
    <!-- Patient tb -->
    <div class="patientTb" style="display:none">
        <h2>Patient</h2>
        <table class="theTb" id="theTb">
            <tr>
            <th> PatientName </th>
            <th> PhoneNumber </th>
            <th> NextofKin </th>
            <th> Allergies </th>
            <th> FamilyConditions </th>
            <th> Address </th>
            </tr>
            <!-- <tbody> -->
    
                <?php
                    require_once("../connection.php");
                    $slctn="SELECT * FROM patient";
                    $result=$conn->query($slctn);
                    // $result_array=$result->fetch_assoc();
                    while($result_array = $result->fetch_assoc())    {
                        if (!$result) {
                            die("Invalid Query".$conn->error);
                        }
                        // "<td>".$result_array["Password"]."</td>".
                        echo(
                            "<tr><form action=\"\" method=\"post\">".
                            '<td><input type="text" name="PatientName" value="'.$result_array["PatientName"].'"></td>'.
                            '<td><input type="text" name="PhoneNumber" value="'.$result_array["PhoneNumber"].'"></td>'.
                            '<td><input type="text" name="NextofKin" value="'.$result_array["NextofKin"].'"></td>'.
                            '<td><input type="text" name="Allergies" value="'.$result_array["Allergies"].'"></td>'.
                            '<td><input type="text" name="FamilyConditions" value="'.$result_array["FamilyConditions"].'"></td>'.
                            '<td><input type="text" name="Address" value="'.$result_array["Address"].'"></td>'.
                            '<td style="display: none"><input type="text" name="tableToUpdate" value="patient"></td>'.
                            '<td style="display: none"><input type="text" name="colsToUpdate" value="PatientName,PhoneNumber,NextofKin,Allergies,FamilyConditions,Address"></td>'.
                            '<td style="display: none"><input type="text" name="criteria" value="PatientSSN"></td>'.                    
                            "<td><button type=\"submit\" name=\"whoToUpdate\"class=\"button\" value=".$result_array["PatientSSN"].">Update</button></td>".
                            "<td><button type=\"submit\" name=\"whoToDelete\"class=\"button\" value=".$result_array["PatientSSN"].">Delete</button></td>".
                            "</form><tr>"
                        );
                        // $_POST["tableToUpdate"]="patient";//So we know which table to change
                        // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                    }
                    // "<td><a href=\"Update\">Update</a></td>"
    
                ?>        
        </table>
    </div>

    <!-- Doctor tb -->
     <div class="doctorTb" style="display:none">
         <h2>Doctor</h2>
         <table class="theTb" id="theTb">
             <tr>
             <th> Doctor Name </th>
             <th> PhoneNumber </th>
             <th> Hospital </th>
             </tr>
             <!-- <tbody> -->
     
                 <?php
                     require_once("../connection.php");
                     $slctn="SELECT * FROM doctor";
                     $result=$conn->query($slctn);
                     // $result_array=$result->fetch_assoc();
                     while($result_array = $result->fetch_assoc())    {
                         if (!$result) {
                             die("Invalid Query".$conn->error);
                         }
                         // "<td>".$result_array["Password"]."</td>".
                         echo(
                             "<tr><form action=\"\" method=\"post\">".
                             '<td><input type="text" name="DoctorName" value="'.$result_array["DoctorName"].'"></td>'.
                             '<td><input type="text" name="Phone" value="'.$result_array["Phone"].'"></td>'.
                             '<td><input type="text" name="Hospital" value="'.$result_array["Hospital"].'"></td>'.
                             '<td style="display: none"><input type="text" name="tableToUpdate" value="doctor"></td>'.
                             '<td style="display: none"><input type="text" name="colsToUpdate" value="DoctorName,Phone,Hospital"></td>'.
                             '<td style="display: none"><input type="text" name="criteria" value="DoctorSSN"></td>'.
                             "<td><button type=\"submit\" name=\"whoToUpdate\"class=\"button\" value=".$result_array["DoctorSSN"].">Update</button></td>".
                             "<td><button type=\"submit\" name=\"whoToDelete\"class=\"button\" value=".$result_array["DoctorSSN"].">Delete</button></td>".
                             "</form><tr>"
                         );
                         // $_POST["tableToUpdate"]="patient";//So we know which table to change
                         // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                     }
                     // "<td><a href=\"Update\">Update</a></td>"
     
                 ?>        
     
             <!-- </tbody> -->
         </table>                
     </div>           

    <!-- Manu tb -->
    <div class="companyTb" style="display:none">        
        <h2>Manufacturer</h2>
        <table class="theTb" id="theTb">
            <tr>
            <th> Name </th>
            <th> Phone </th>
            </tr>
            <!-- <tbody> -->

                <?php
                    require_once("../connection.php");
                    $slctn="SELECT * FROM pharmaceuticalcompany";
                    $result=$conn->query($slctn);
                    // $result_array=$result->fetch_assoc();
                    while($result_array = $result->fetch_assoc())    {
                        if (!$result) {
                            die("Invalid Query".$conn->error);
                        }
                        // "<td>".$result_array["Password"]."</td>".
                        echo(
                            "<tr><form action=\"\" method=\"post\">".
                            '<td><input type="text" name="CompanyName" value="'.$result_array["CompanyName"].'"></td>'.
                            '<td><input type="text" name="PhoneNumber" value="'.$result_array["PhoneNumber"].'"></td>'.
                            '<td style="display: none"><input type="text" name="tableToUpdate" value="pharmaceuticalcompany"></td>'.
                            '<td style="display: none"><input type="text" name="colsToUpdate" value="CompanyName,PhoneNumber"></td>'.
                            '<td style="display: none"><input type="text" name="criteria" value="Email"></td>'.
                            "<td><button type=\"submit\" name=\"whoToUpdate\"class=\"button\" value=".$result_array["Email"].">Update</button></td>".
                            "<td><button type=\"submit\" name=\"whoToDelete\"class=\"button\" value=".$result_array["Email"].">Delete</button></td>".
                            "</form><tr>"
                        );
                        // $_POST["tableToUpdate"]="patient";//So we know which table to change
                        // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                    }
                    // "<td><a href=\"Update\">Update</a></td>"

                ?>        

            <!-- </tbody> -->
        </table>    
    </div>

    <!-- Pharmacist tb -->
    <div class="pharmacistTb" style="display:none;">
        <h2>Pharmacy Staff</h2>
        <table class="theTb" id="theTb">
            <tr>
            <th> Name </th>
            <th> Roles </th>
            <th> PhoneNumber </th>
            </tr>
            <!-- <tbody> -->
    
                <?php
                    require_once("../connection.php");
                    $slctn="SELECT * FROM pharmacystaff";
                    $result=$conn->query($slctn);
                    // $result_array=$result->fetch_assoc();
                    while($result_array = $result->fetch_assoc())    {
                        if (!$result) {
                            die("Invalid Query".$conn->error);
                        }
                        // "<td>".$result_array["Password"]."</td>".
                        echo(
                            "<tr><form action=\"\" method=\"post\">".
                            '<td><input type="text" name="Names" value="'.$result_array["Names"].'"></td>'.
                            '<td><input type="text" name="Roles" value="'.$result_array["Roles"].'"></td>'.
                            '<td><input type="text" name="Telephone" value="'.$result_array["Telephone"].'"></td>'.
                            '<td style="display: none"><input type="text" name="tableToUpdate" value="pharmacystaff"></td>'.
                            '<td style="display: none"><input type="text" name="colsToUpdate" value="Names,Roles,Telephone"></td>'.
                            '<td style="display: none"><input type="text" name="criteria" value="StaffSSN"></td>'.
                            "<td><button type=\"submit\" name=\"whoToUpdate\"class=\"button\" value=".$result_array["StaffSSN"].">Update</button></td>".
                            "<td><button type=\"submit\" name=\"whoToDelete\"class=\"button\" value=".$result_array["StaffSSN"].">Delete</button></td>".
                            "</form><tr>"
                        );
                        // $_POST["tableToUpdate"]="patient";//So we know which table to change
                        // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                    }
                    // "<td><a href=\"Update\">Update</a></td>"
    
                ?>        
    
            <!-- </tbody> -->
        </table>
    </div>
    
<script>
    $(document).ready(function(){
        $('.theTb').paging({limit:5});
    })
</script>
</body>
</html>
