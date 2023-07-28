<?php   
      
        session_start();
        require("../connection.php");
        // print_r($_POST);
        if(isset($_POST) and isset($_POST["whatToUpdate"])){            
            $sql="UPDATE ".$_POST["tableToUpdate"]." SET ";
            foreach(explode(",",$_POST["colsToUpdate"]) as $col){
                $substring=$col.'="'.$_POST[$col].'",';
                $sql.=$substring;
                // echo$sql;
            }
            $sql=substr($sql, 0, -1);
            $sql.=' WHERE '.$_POST["criteria"].'="'.$_POST["whatToUpdate"]."\"";
            // echo($sql);
            mysqli_query($conn,$sql) or die(mysqli_error($conn)."<br><a href='products.php'>Go Back</a>");
            // header("Refresh:0;url=products.php");
        }
        if(isset($_POST) and isset($_POST["whatToDelete"])){            
            $sql="DELETE FROM ".$_POST["tableToUpdate"]." WHERE DrugCode=\"".$_POST["whatToDelete"]."\"";
            echo $sql;
            mysqli_query($conn,$sql) or die(mysqli_error($conn)."<br><a href='products.php'>Go Back</a>");
            header("Refresh:0; url=products.php");
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
            background-color: lightblue;

        }


        tbody {
            overflow-y: scroll;
            /* height: 100px; */
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
            <th> DrugName </th>
            <th> Quantity </th>
            <th>Formula</th>
            <th>DrugType</th>
            <th>Manufacturer</th>
            <th>Update</th>
            <th>Delete</th>
            </tr>
            <!-- <tbody> -->
    
                <?php
                    require_once("../connection.php");
                    $slctn="SELECT * FROM drugs WHERE Manufacturer='".$_SESSION["Name"]."';";
                    $result=$conn->query($slctn);
                    // $result_array=$result->fetch_assoc();
                    while($result_array = $result->fetch_assoc())    {
                        if (!$result) {
                            die("Invalid Query".$conn->error."<br><a href='products.php'>Go Back</a>");
                        }
                        // "<td>".$result_array["Password"]."</td>".
                        echo(
                            "<tr><form action=\"\" method=\"post\">".
                            '<td><input type="text" name="DrugName" value="'.$result_array["DrugName"].'"></td>'.
                            '<td><input type="text" name="Quantity" value="'.$result_array["Quantity"].'"></td>'.
                            '<td><input type="text" name="Formula" value="'.$result_array["Formula"].'"></td>'.
                            '<td><input type="text" name="DrugType" value="'.$result_array["DrugType"].'"></td>'.
                            '<td>'.$result_array["Manufacturer"].'</td>'.
                            '<td style="display: none"><input type="text" name="tableToUpdate" value="drugs"></td>'.
                            '<td style="display: none"><input type="text" name="colsToUpdate" value="DrugName,Quantity,Formula,DrugType"></td>'.
                            '<td style="display: none"><input type="text" name="criteria" value="DrugCode"></td>'.                    
                            "<td><button type=\"submit\" onclick='success()' name=\"whatToUpdate\"class=\"button\" value=".$result_array["DrugCode"].">Update</button></td>".
                            "<td><button type=\"submit\" name=\"whatToDelete\"class=\"button\" value=".$result_array["DrugCode"].">Delete</button></td>".
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
    function success(){
        alert("Successfully Updated")
    }
</script>
</body>
</html>
