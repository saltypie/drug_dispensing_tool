<?php
    if(isset($_POST['logout']) and $_POST['logout']=="true"){
        session_destroy();
        header("Location: ../landing.php");
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .options-container {
                position: relative;
                display: inline-block;
            }
            .nav-btns{
                background: none!important;
                border: none;
                padding: 0!important;
                /*optional*/
                font-family: arial, sans-serif;
                /*input has OS specific font-family*/
                color: #069;
                text-decoration: underline;
                cursor: pointer;    
            }        
            .option-title{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 5vh;
                margin-top: 1vh;
                background-color: #05386B;
                color: white;
                border-radius: 10px 10px 10px 10px;
            }
            
            .options-container:hover .options {
            display: block;
            }
            
            .options {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ccc;
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/styles.css">    
    </head>
    <body>
    <?php

        function common_navi($session_vars){
            if($session_vars["role"]=="Pharmacist"){
                echo(
                    '<nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                        <a class="navbar-brand" href="http://localhost/WORK/drug_dispensing_tool/landing.php"><img src="../images/logo-final.png" alt="Logo" class="the-logo"></a>
                        </div>
                        <div class="options-container dropdown navbar-nav">
                            <p class="option-title">'.$session_vars["role"].' ⌄</p>
                            <div class="options">
                                <a href="pharmacist_profile.php">View Profile</a><br>
                                <a href="propose_contract.php">Contracts</a><br>
                                <form action="" method="post"><button class="nav-btns" type="submit" name="logout" value="true">Logout</button></form>
                                <a href="stock_management.php">Drugs Stock</a>
                            </div>
                        </div>
                    </div>
                    </nav> '
                );
            }
            if($session_vars["role"]=="Pharmaceutical Company"){
                echo(
                    '<nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                        <a class="navbar-brand" href="http://localhost/WORK/drug_dispensing_tool/landing.php"><img src="../images/logo-final.png" alt="Logo" class="the-logo"></a>
                        </div>
                        <div class="options-container dropdown navbar-nav">
                            <p class="option-title">'.$session_vars["Name"].' ⌄</p>
                            <div class="options">
                                <a href="manufacturer_profile.php">View Profile</a><br>
                                <a href="approve_contracts.php">Contracts</a><br>
                                <a href="products.php">Products</a><br>
                                <form action="" method="post"><button class="nav-btns" type="submit" name="logout" value="true">Logout</button></form>
                            </div>
                        </div>
                    </div>
                    </nav> '
                );
            }
            if($session_vars["role"]=="Doctor"){
                echo(
                    '<nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                        <a class="navbar-brand" href="http://localhost/WORK/drug_dispensing_tool/landing.php"><img src="../images/logo-final.png" alt="Logo" class="the-logo"></a>
                        </div>
                        <div class="options-container dropdown navbar-nav">
                            <p class="option-title">'.$session_vars["Name"].' ⌄</p>
                            <div class="options">
                                <a href="doc_profile.php">View Profile</a><br>
                                <a href="prescribe.php">Prescribe</a><br>
                                <form action="" method="post"><button class="nav-btns" type="submit" name="logout" value="true">Logout</button></form>
                            </div>
                        </div>
                    </div>
                    </nav> '
                );
            }


            // echo(
            //     '<nav class="navbar navbar-default">
            //     <div class="container-fluid">
            //         <div class="navbar-header">
            //         <a class="navbar-brand" href="http://localhost/WORK/drug_dispensing_tool/landing.php"><img src="../images/logo-final.png" alt="Logo" class="the-logo"></a>
            //         </div>
            //         <ul class="nav navbar-nav">
                
                
            //         <li>
            //             <div class="dropdown">
            //                 <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">'.$session_vars["Name"].'
            //                 <span class="caret"></span></button>
            //                 <ul class="dropdown-menu">
            //                 <li><form action="" method="post"><button type="submit"name="logout" value="true">Logout</button></form></li>
            //                 </ul>
            //             </div>
            //         </li>
                
            //         </ul>
            //     </div>
            //     </nav> '
            // );

            // if(isset($_POST['contract']) and $_POST['contract']=="true"){
            //     header("Location: contract.php");
            // } 
        }
    ?>



    </body>
</html>



<!-- <select>
    <option value=""></option>
    <option value=""></option>
</select> -->
<!-- <form action="" method="post"><button type="submit" name="logout" value="true"></form> -->
<!-- <form action="" method="post"><button class="nav-btns" type="submit" name="contract" value="true">Contract</button></form> -->
