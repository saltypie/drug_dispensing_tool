<?php
    session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <!-- This page would be visible to the manufacturers only, they can only add drugs under their own name, another table called stock w/ diff page would be used by Supervisors & managers-->
        <title>Add Drug</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/styles.css">
    </head>
    <body>
        <?php require("../navi.php"); 
        common_navi($_SESSION); ?>
        <?php if((isset($_POST)or !isset($_POST)) and !isset($_POST['submit'])):?>
            <div class="majordiv centerholder">
                <form class="laform" action="" method="post"><!--Empty action will call the same file-->
                    <h4>Add A New Drug Product</h4>
                    <label>Drugcode: </label><br><input type="text" name="DrugCode"><br>
                    <label>Drugname: </label><br><input type="text" name="DrugName"><br>
                    <label>DrugType: </label><br><input type="text" name="DrugType"><br>
                    <label>Quantity: </label><br><input type="text" name="Quantity"><br>
                    <input type="manufacturer" name="Manufacturer" value='<?php echo $_SESSION["Name"];?>' hidden><br>
                    <label>Formula: </label><br><input type="formula" name="Formula"><br><br>
                    <input type="text" name="tablename" value="drugs" style="display: none;">
                    <input type="text" name="columns" value="DrugCode,DrugName,DrugType,Quantity,Manufacturer,Formula"style="display: none;"><!--A way of specifying the table columns corresponding to this form-->
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>         
                </form>
            </div>
        <?php endif;?>

        <?php
            require("../connection.php");
            require("../insertions.php");
            if (isset($_POST) and isset($_POST['submit'])) {
                    insertion($_POST);
                    $sql1="SELECT PharmacyName FROM contracts WHERE CompanyName='".$_SESSION["Name"]."' AND ApprovalStatus='approved';";
                    $result1=$conn->query($sql1);
                    while($pharm_names=$result1->fetch_assoc()){

                        $insert_arr=array();
                        $insert_arr["columns"]="DrugCode,PharmacyName,Stock";
                        $insert_arr["DrugCode"]=$_POST['DrugCode'];
                        $insert_arr["PharmacyName"]=$pharm_names["PharmacyName"];
                        $insert_arr["Stock"]=100;
                        $insert_arr["tablename"]="pharmacydrug";
                        insertion($insert_arr);
                    }
                    echo(
                        '
                        <div class="majordiv centerholder">
                            <div class="content-box-2">
                                <h1> Successfully Added</h1>
                                <div class="centerholder">
                                    <a style="color: white;" href="add_drug.php">Go Back</a>                                
                                </div>
                            </div>
                        </div>
                        '
                    );
                    unset($_POST);
                    // header("Refresh:0;url=add_drug.php");
            }else{
                // echo"not set";
            }
        ?>


    </body>
</html>

