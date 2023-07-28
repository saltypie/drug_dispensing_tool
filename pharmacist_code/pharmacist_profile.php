<?php   
      
        session_start();
        require("../connection.php");
        // print_r($_POST);
        if(isset($_POST) and isset($_POST["whoToUpdate"])){            
            $sql="UPDATE ".$_POST["tableToUpdate"]." SET ";
            foreach(explode(",",$_POST["colsToUpdate"]) as $col){
                $substring=$col.'="'.$_POST[$col].'",';
                $sql.=$substring;
                // echo$sql;
            }
            $sql=substr($sql, 0, -1);
            $sql.=' WHERE '.$_POST["criteria"].'="'.$_POST["whoToUpdate"]."\"";
            mysqli_query($conn,$sql) or die(mysqli_error($conn));
            // header("Refresh:0;url=products.php");
            // echo($sql);
        }
        if(isset($_GET) and isset($_GET["suredelete"]) and $_GET["suredelete"]=="true"){  
            $sql="UPDATE pharmacystaff SET Deactivated='true' WHERE StaffSSN='".$_SESSION["SSN"]."';";
            mysqli_query($conn,$sql) or die(mysqli_error($conn));            
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
    <?php if(isset($_POST) and !isset($_POST["whoToDelete"])): ?>  
        <div class="centerholder">
            <h2>Profile: </h2>
        </div>
        <div class="patientTb centerholder">
            <table class="theTb" id="theTb">
                <tr>
                <th> SSN </th>
                <th> Name </th>
                <th> Telephone </th>
                <th>Email</th>
                <th>Update</th>
                <th>Disable</th>

                </tr>
                <!-- <tbody> -->
        
                    <?php
                        require_once("../connection.php");
                        $slctn="SELECT * FROM pharmacystaff WHERE StaffSSN='".$_SESSION["SSN"]."';";
                        $result=$conn->query($slctn);
                        // $result_array=$result->fetch_assoc();
                        while($result_array = $result->fetch_assoc())    {
                            if (!$result) {
                                die("Invalid Query".$conn->error);
                            }
                            // "<td>".$result_array["Password"]."</td>".
                            echo(
                                "<tr><form action=\"\" method=\"post\">".
                                '<td>'.$result_array["StaffSSN"].'</td>'.
                                '<td><input type="text" name="Names" value="'.$result_array["Names"].'"></td>'.
                                '<td><input type="text" name="Telephone" value="'.$result_array["Telephone"].'"></td>'.
                                '<td><input type="text" name="Email" value="'.$result_array["Email"].'"></td>'.
                                '<td style="display: none"><input type="text" name="tableToUpdate" value="pharmacystaff"></td>'.
                                '<td style="display: none"><input type="text" name="colsToUpdate" value="Names,Telephone,Email"></td>'.
                                '<td style="display: none"><input type="text" name="criteria" value="StaffSSN"></td>'.                    
                                "<td><button type=\"submit\" onclick='success()' name=\"whoToUpdate\"class=\"button\" value=".$result_array["StaffSSN"].">Update</button></td>".
                                "<td><button type=\"submit\" name=\"whoToDelete\"class=\"button\" value=".$result_array["StaffSSN"].">Disable</button></td>".
                                "</form><tr>"
                            );
                            // $_POST["tableToUpdate"]="patient";//So we know which table to change
                            // $_POST["colsToUpdate"]=array("PatientName","PhoneNumber","NextofKin","Allergies","FamilyConditions","Address");//So we know which table to change
                        }
                        // "<td><a href=\"Update\">Update</a></td>"
        
                    ?>        
            </table>
        </div>
    <?php endif;?>
    <?php  if(isset($_POST) and isset($_POST["whoToDelete"])):?>
        <div class="content-box-2">
            <p>Are You Sure</p>
            <form action="" method="get">
                <div class="centerholder">
                    <button name="suredelete" value="true">Yes</button>
                    <button name="suredelete" value="false">No</button>
                </div>
            </form>
        </div>
    <?php endif;?>
   
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
