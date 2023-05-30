<!DOCTYPE html>
<html>
    <head>
        <title>Signup Patient</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/styles.css">

    </head>
    <body>
        <div class="container d-flex justify-content-center align-items-center" style="padding: 0%;margin:0%;">
            <img src="images/thelogo.png" alt="Logo" class="the-logo">
            <div class="card hover-card shadowbox">
                <div class="card-body shadowbox-body">
                    <h4>SIGNUP PATIENT</h4>
                    <form action="add_patient.php" method="post">
                        <label>SSN: </label><input type="number" name="ssn"><br>
                        <label>Full Name: </label><input type="text" name="name"><br>
                        <label>Phone:</label><input type="text" name="phone"><br>
                        <label>Age: </label><input type="text" name="age"><br>
                        <input type="text" name="tablename" value="patient" style="display: none;">
                        <input type="text" name="columns" value="ssn,name,phone,age" style="display: none;">
                        <!-- <label>Allergies: </label><input type="text" name="allergies"><br>
                        <label>Next of Kin: </label><input type="text" name="next_of_kin"><br>
                        <label>Gender: </label><input type="text" name="gender"><br>
                        <label>Family Conditions: </label><input type="text" name="family_conditions"><br>
                        <label>Address: </label><input type="text" name="address"><br>    -->
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>         
                    </form>
                </div>            
            </div>
        </div>
    </body>
</html>