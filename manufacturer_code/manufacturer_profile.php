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
    <h1>Your Profile</h1><br>
    <div class="name-header">
        <h4><?php echo("Name: ".$_SESSION["Name"]);?></h4>
    </div>
    <table>
        <tr>
            <td> CompanyName </td>
            <td> PhoneNumber </td>
            <td> Email </td>
            <!-- <td> Password </td> -->
        </tr>
        <!-- <tbody> -->

            <?php
                require_once("../connection.php");
                $Name=$_SESSION["Name"];
                $slctn="SELECT * FROM pharmaceuticalcompany WHERE CompanyName='$Name'";
                $result=$conn->query($slctn);
                $result_array=$result->fetch_assoc();
                if (!$result) {
                    die("Invalid Query".$conn->error);
                }
                // "<td>".$result_array["Password"]."</td>".
                echo(
                    "<td>".$result_array["CompanyName"]."</td>".
                    "<td>".$result_array["PhoneNumber"]."</td>".
                    "<td>".$result_array["Email"]."</td>".
                    // "<td>".$result_array["Password"]."</td>".
                    "<td><a href=\"Update\">Update</a></td>"
                );
                // "<td><a href=\"Update\">Update</a></td>"

            ?>        

        <!-- </tbody> -->
    </table>
    <a href="add_drug.php"><h3>Add new Product</h3></a>
</body>
</html>