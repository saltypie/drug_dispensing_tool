<?php 
    session_start();
    require("../connection.php");
    require("../navi.php");
    $sql="SELECT pharmaceuticalcompany.CompanyName FROM pharmaceuticalcompany;";
    $result1=$conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- This page would be visible to the manufacturers only, they can only add drugs under their own name, another table called stock w/ diff page would be used by Supervisors & managers-->
        <title>Add Drug</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/styles.css">

        <style>
            .laform{
                background-color: white;
                padding: 2vw;
                border-radius: 4px 4px 4px 4px;
            }
        </style>
    </head>
    <body>
        
        <?php common_navi($_SESSION)?>
        <div class="centerholder">
            <h4>Propose Contract</h4>
        </div>
        <div class="centerholder">
            <div class="centerholder">
                    <form class="laform" action="" method="post"><!--Empty action will call the same file-->
                        <input type="text" name="PharmacyName" value="<?php echo $_SESSION["Pharmacy"]?>" hidden><br>
                        
                        <label for="CompanyName">Company: </label>
                        <select name="CompanyName">
                            <option>Choose Company</option>
                            <?php
                                while($result_arr=$result1->fetch_assoc()){
                                    echo('<option value="'.$result_arr["CompanyName"].'">'.$result_arr["CompanyName"].'</option>');
                                }
                            ?>
                        </select><br>
                        
                        <label>Start Date:</label><input type="date" name="StartDate"><br>
                        <label>End Date: </label><input type="date" name="EndDate"><br>
                        <input type="text" name="SupervisorSSN" value="<?php echo $_SESSION["SSN"];?>" hidden><br>
                        <input type="text" name="tablename" value="contracts" hidden>
                        <input type="text" name="columns" value="PharmacyName,CompanyName,StartDate,EndDate,SupervisorSSN"style="display: none;">
                        <div class="centerholder">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>         
                        </div>
                    </form>
            </div>
        </div>
    </body>
</html>
<?php
// require("../connection.php");
require("../insertions.php");
if (isset($_POST['submit'])) {
        insertion($_POST);
}else{
    // echo"not set";
}
?>
