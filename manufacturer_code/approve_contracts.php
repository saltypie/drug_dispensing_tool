<?php   
        session_start();
        require_once("../connection.php");
        if(isset($_GET) AND isset($_GET["IDToUpdate"])){
            $sql_update="UPDATE contracts SET ApprovalStatus='approved' WHERE `ContractID`=".$_GET["IDToUpdate"];
            echo $sql_update;
            $update_result=$conn->query($sql_update);
            echo'
            <div class="content-box-2">
                <h1> Successfully Approved</h1>
            </div>';
            unset($_POST);
            unset($_GET);
            header("Refresh:0;url=approve_contracts.php");
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    

    <script src="paging.js"></script> 
    <link rel="stylesheet" href="../CSS/styles.css">   
    <style>
        .theTb {
            background: white;
            border: 2px solid balck;
            width: 80vw;
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
        .centerholder{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .majordiv{
            /* display: flex; */
            height: 100vh;
            /* align-items: center;
            justify-content: center; */
        }
        .content-box-2{
            border: 10px solid rgba(0, 0, 0, 0.135);
            padding: 10px solid black;
            background-color: #05386B;
            color: aliceblue;
        }
        .approve_btn_div{
            color:rgb(241, 241, 255);
            background-color: #05386B;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .approve_btn{
            background-color:blue;
            display: flex;
        }

  
    </style>
</head>
<body>
    <?php require("../navi.php"); 
    common_navi($_SESSION); ?>


    <div class="majordiv">
        <?php if(!isset($_GET["IDToUpdate"])): ?>
            <div class="all">
                <div class="centerholder">
                    <h2>Contracts</h2>
                </div>    
                <div class="centerholder">
                    <h1>Unapproved Contracts</h1><br>
                </div>
                <br>
                <div class="centerholder">
                    <table class="theTb table" id="theTb">
                        <tr>

                            <th>Pharmacy Name</th>
                            <th>Company Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Begin Approval</th>
                
                        </tr>
                        <!-- <tbody> -->
                
                            <?php
                                if(!isset($_GET["IDToUpdate"])){ 
                                    require_once("../connection.php");
                                    $slctn="SELECT * FROM contracts WHERE `ApprovalStatus` IS NULL;";
                                    // echo($slctn);
                                    $result=$conn->query($slctn);
                                    while($result_array = $result->fetch_assoc())    {
                                        if (!$result) {
                                            die("Invalid Query".$conn->error);
                                        }                    
                                        
                                        echo(
                                            '<tr>'.
                                            '<td>'.$result_array["ContractID"].'</td>'.
                                            '<td>'.$result_array["PharmacyName"].'</td>'.
                                            '<td>'.$result_array["StartDate"].'</td>'.
                                            '<td>'.$result_array["EndDate"].'</td>'.
                                            "<td><form method=\"get\"><button type=\"submit\" name=\"IDToUpdate\"class=\"button btn-blue\" value=".$result_array["ContractID"].">Begin Approval</button></form></td>"   
                                            .'</tr>'                
                                        );

                                    }
                                }
                
                            ?>        
                    </table>
                </div>
            </div>    
        <?php endif;?>

        <?php

            // if(isset($_GET) AND isset($_GET["IDToUpdate"])){
            //     $sql_update="UPDATE contracts SET ApprovalStatus='approved WHERE `ContractID`=".$_GET["IDToUpdate"];
            //     $update_result=$conn->query($sql_update);
            //     echo'
            //     <div class="content-box-2">
            //         <h1> Successfully Approved</h1>
            //     </div>';
            //     unset($_POST);
            //     unset($_GET);
            //     header("Refresh:0;url=review_prescriptions.php");
            // }
        ?>            
    </div>
    <!-- <form action="" method="post"><button type="submit" name="IDToUpdate" class="approve_drug_btn" value='.$_GET["IDToUpdate"].'>Confirm Approval</button></form> -->
    <script>
        $(document).ready(function(){
            $('.theTb').paging({limit:5});
        })
    </script>
</body>
</html>

