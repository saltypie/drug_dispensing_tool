<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <title>Document</title>
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
    <div class="name-header">
        <h4><?php echo("Name: ".$_SESSION["Name"]);?></h4>
    </div>
    
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
                require_once("../connection.php");
                $pName=$_SESSION["Name"];
                $slctn="SELECT * FROM patient WHERE PatientName='$pName'";
                $result=$conn->query($slctn);
                $result_array=$result->fetch_assoc();
                if (!$result) {
                    die("Invalid Query".$conn->error);
                }
                // "<td>".$result_array["Password"]."</td>".
                echo(
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
                    "<td><a href=\"Update\">Update</a></td>"
                );
                // "<td><a href=\"Update\">Update</a></td>"

            ?>        

        <!-- </tbody> -->
    </table>
</body>
</html>