<?php   
        require_once("connection.php");
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
    <script src="paging.js"></script>    
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
    <h1>ADMIN CENTRE</h1><br>
    <!-- Patient tb -->
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
                require_once("connection.php");
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

    <!-- Doctor tb -->

    <h2>Doctor</h2>
    <table class="theTb" id="theTb">
        <tr>
        <th> Doctor Name </th>
        <th> PhoneNumber </th>
        <th> Hospital </th>
        </tr>
        <!-- <tbody> -->

            <?php
                require_once("connection.php");
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

    <!-- Manu tb -->

    <h2>Manufacturer</h2>
    <table class="theTb" id="theTb">
        <tr>
        <th> Name </th>
        <th> Phone </th>
        </tr>
        <!-- <tbody> -->

            <?php
                require_once("connection.php");
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

    <!-- Pharmacist tb -->

    <h2>Pharmacy Staff</h2>
    <table class="theTb" id="theTb">
        <tr>
        <th> Name </th>
        <th> Roles </th>
        <th> PhoneNumber </th>
        </tr>
        <!-- <tbody> -->

            <?php
                require_once("connection.php");
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
    
<script>
    $(document).ready(function(){
        $('.theTb').paging({limit:5});
    })
</script>
</body>
</html>
