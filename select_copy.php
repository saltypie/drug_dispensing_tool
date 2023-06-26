
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Details</title>
    
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
    <table>
        <tr>
            <th>PatientSSN</th>
            <th>Email</th>
            <th>PatientName</th>
            <th>PhoneNumber</th>
            <th>Gender</th>
            <th>NextofKin</th>
            <th>Allergies</th>
            <th>FamilyConditions</th>
            <th>Age</th>
            <th>Address</th>
        </tr>
        <!-- <tbody> -->

            <?php
                require_once("connection.php");
                $slctn="SELECT * FROM patient";
                $result=$conn->query($slctn);
                // $result_array=$result->fetch_assoc();
                while($result_array = $result->fetch_assoc()) {
                    if (!$result) {
                        die("Invalid Query".$conn->error);
                    }
                    // "<td>".$result_array["Password"]."</td>".
                    echo(
                        "<tr>".
                        "<td>".$result_array["PatientSSN"]."</td>".
                        "<td>".$result_array["Email"]."</td>".
                        "<td>".$result_array["PatientName"]."</td>".
                        "<td>".$result_array["PhoneNumber"]."</td>".
                        "<td>".$result_array["Gender"]."</td>".
                        "<td>".$result_array["NextofKin"]."</td>".
                        "<td>".$result_array["Allergies"]."</td>".
                        "<td>".$result_array["FamilyConditions"]."</td>".
                        "<td>".$result_array["Age"]."</td>".
                        "<td>".$result_array["Address"]."</td>".
                        "<td> <form method=\"post\"><button type=\"submit\" name=\"whoToUpdate\"class=\"button\" value=".$result_array["PatientSSN"].">Update</button></form> </td>".
                        "<td> <form method=\"post\"><button type=\"submit\" name=\"whoToDelete\"class=\"button\" value=".$result_array["PatientSSN"].">Delete</button></form> </td>".
                        "<tr>"
                    );
                    $_POST["tableToUpdate"]="patient";//So we know which table to change
                    $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                }
                // "<td><a href=\"Update\">Update</a></td>"

            ?>        

        <!-- </tbody> -->
    </table>
    <?php 
        if(isset($_POST) and isset($_POST["whoToUpdate"])){
            $whoToUpdate=$_POST["whoToUpdate"];
            echo("<p>update user".$_POST["whoToUpdate"]."</p>".
            "<form method=\"post\">".
                "<label >Names</label>".
                "<input type=\"text\" name=\"PatientName\"><br>".
                "<label >Phone</label>".
                "<input type=\"text\" name=\"PhoneNumber\"><br>".
                "<label >NextofKin</label>".
                '<input type="text" name="NextofKin"><br>'.
                '<label >Allergies</label>'.
                '<input type="text" name="Allergies"><br>'.
                '<label >Family Conditions</label>'.
                '<input type="text" name="FamilyConditions"><br>'.
                '<label >Address</label>'.
                '<input type="text" name="Address"><br>'.
                "<input type=\"text\" name=\"whoToUpdate\" style=\"display: block\" value=".$whoToUpdate."><br>".
                '<button type="submit">Update</button>'.
            "</form>"  
        );
        }  
    ?>
</body>
</html>
<?php   
        // print_r($_POST);
        if(isset($_POST) and isset($_POST["whoToUpdate"])){            
            $sql="UPDATE ".$_POST["tableToUpdate"]." SET ";
            foreach($_POST["colsToUpdate"] as $col){
                $substring=$col."=\"".$_POST[$col]."\",";
                $sql.=$substring;
                // echo$sql;
            }
            $sql=substr($sql, 0, -1);
            $sql.=" WHERE patientSSN=\"".$_POST["whoToUpdate"]."\"";
            mysqli_query($conn,$sql) or die(mysqli_error($conn));
            
            // echo($sql);
        }
        if(isset($_POST) and isset($_POST["whoToDelete"])){            
            $sql="DELETE FROM ".$_POST["tableToUpdate"]." WHERE patientSSN=\"".$_POST["whoToDelete"]."\"";
            echo $sql;
            mysqli_query($conn,$sql) or die(mysqli_error($conn));
            header("Refresh:0");
        }
        // header("Location: select_copy.php");
        // $result=$conn->query($slctn);
?>