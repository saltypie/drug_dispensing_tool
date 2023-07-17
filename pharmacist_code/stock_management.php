<?php   
      
        session_start();
        require("../connection.php");
        // print_r($_POST);
        if(isset($_POST) and isset($_POST["whatToUpdate"])){            
            $sql="UPDATE pharmacydrug SET DrugPrices='".$_POST["DrugPrices"]."' WHERE pharmacydrug.DrugCode='".$_POST["whatToUpdate"]."' AND pharmacydrug.PharmacyName='".$_SESSION["Pharmacy"]."';";
            mysqli_query($conn,$sql);
            
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
    <script src="../paging.js"></script>  
    <script src="admin.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/styles.css">      
    <style>
        table {
            /* border: 2px solid black; */
            width: 70%;
            background-color: lightblue !important;
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
   
     
    <?php require("../navi.php"); 
    common_navi($_SESSION); ?>
    <!-- tb -->
    <div class="centerholder">
        <h2>Drugs</h2>
    </div>
    <div class="patientTb centerholder">
        <table class="theTb" id="theTb">
            <tr>
            <th> DrugCode </th>
            <th> DrugName </th>
            <th> Price </th>

            </tr>
            <!-- <tbody> -->
    
                <?php
                    require_once("../connection.php");
                    $slctn="SELECT pharmacydrug.DrugCode,drugs.DrugName,pharmacydrug.DrugPrices FROM `pharmacydrug`,`drugs` WHERE pharmacydrug.DrugCode=drugs.DrugCode AND pharmacydrug.PharmacyName='".$_SESSION["Pharmacy"]."';";
                    $result=$conn->query($slctn);
                    // $result_array=$result->fetch_assoc();
                    while($result_array = $result->fetch_assoc())    {
                        if (!$result) {
                            die("Invalid Query".$conn->error);
                        }
                        // "<td>".$result_array["Password"]."</td>".
                        echo(
                            "<tr><form action=\"\" method=\"post\">".
                            '<td>'.$result_array["DrugCode"].'</td>'.
                            '<td>'.$result_array["DrugName"].'</td>'.
                            '<td><input type="text" name="DrugPrices" value="'.$result_array["DrugPrices"].'"></td>'.
                            '<td style="display: none"><input type="text" name="tableToUpdate" value="pharmacydrug"></td>'.
                            '<td style="display: none"><input type="text" name="colsToUpdate" value="DrugName,Quantity,Manufacturer,Formula,DrugCode"></td>'.
                            "<td><button onclick='alerting()' type=\"submit\" name=\"whatToUpdate\"class=\"button\" value=".$result_array["DrugCode"].">Update</button></td>".
                            "</form><tr>"
                        );
                        // $_POST["tableToUpdate"]="patient";//So we know which table to change
                        // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                    }
                    // "<td><a href=\"Update\">Update</a></td>"
    
                ?>        
        </table>
    </div>


    
<script>
    // $(document).ready(function(){
    //     $('.theTb').paging({limit:5});
    // })
    function alerting() {
        alert("Updated");
    }
</script>
</body>
</html>
