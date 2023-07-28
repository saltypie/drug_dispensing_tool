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
            $sql="UPDATE doctor SET Deactivated='true' WHERE DoctorSSN='".$_SESSION["SSN"]."';";
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
        .suredelete{
            color:black;
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
            <h2><?php echo$_SESSION["Name"];?>'s Profile </h2>
        </div>
        <div class="DoctorTb centerholder">
            <table class="theTb" id="theTb">
                <tr>
                <th> SSN </th>
                <th>Hospital</th>
                <th>Phone</th>
                <th>Email</th>

                <th>Update</th>
                <th>Disable</th>

                </tr>
                <!-- <tbody> -->
        
                    <?php
                        require_once("../connection.php");
                        $slctn="SELECT * FROM Doctor WHERE DoctorSSN='".$_SESSION["SSN"]."';";
                        $result=$conn->query($slctn);
                        // $result_array=$result->fetch_assoc();
                        while($result_array = $result->fetch_assoc())    {
                            if (!$result) {
                                die("Invalid Query".$conn->error);
                            }
                            // "<td>".$result_array["Password"]."</td>".
                            echo(
                                "<tr><form action=\"\" method=\"post\">".
                                '<td>'.$result_array["DoctorSSN"].'</td>'.
                                '<td><input type="text" name="Hospital" value="'.$result_array["Hospital"].'"></td>'.
                                '<td><input type="text" name="Phone" value="'.$result_array["Phone"].'"></td>'.
                                '<td><input type="text" name="Email" value="'.$result_array["Email"].'"></td>'.
                                '<td style="display: none"><input type="text" name="tableToUpdate" value="doctor"></td>'.
                                '<td style="display: none"><input type="text" name="colsToUpdate" value="Hospital,Phone,Email"></td>'.
                                '<td style="display: none"><input type="text" name="criteria" value="DoctorSSN"></td>'.                    
                                "<td><button type=\"submit\" onclick='success()' name=\"whoToUpdate\"class=\"button\" value=".$result_array["DoctorSSN"].">Update</button></td>".
                                "<td><button type=\"submit\" name=\"whoToDelete\"class=\"button\" value=".$result_array["DoctorSSN"].">Disable</button></td>".
                                "</form><tr>"
                            );
                        }
        
                    ?>        
            </table>
        </div>
    <?php endif;?>
    <?php  if(isset($_POST) and isset($_POST["whoToDelete"])):?>
        <div class="content-box-2">
            <p>Are You Sure</p>
            <form action="" method="get">
                <div class="centerholder">
                    <button class="suredelete"name="suredelete" value="true">Yes</button>
                    <button class="suredelete" name="suredelete" value="false">No</button>
                </div>
            </form>
        </div>
    <?php endif;?>
   
<script>
    function success(){
        alert("Successfully Updated")
    }
</script>
</body>
</html>
