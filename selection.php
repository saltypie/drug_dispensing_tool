
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Drugs</title>
</head>
<body>
    <h1>Drugs</h1><br>
    <table>
        <thead>
            <th>Drugcode</th>
            <th>Drugname</th>
            <th>Manufacturer</th>
            <th>Formula</th>
            <th>Action</th>
        </thead>
        <tbody>

            <?php
                require_once("connection.php");
                $slctn="SELECT * FROM drugs";
                $result=$conn->query($slctn);
                if (!$result) {
                    die("Invalid Query".$conn->error);
                }
                while ($row=$result->fetch_assoc()) {
                    echo(
                        "<td>".$row["drugcode"]."</td>".
                        "<td>".$row["drugname"]."</td>".
                        "<td>".$row["manufacturer"]."</td>".
                        "<td>".$row["formula"]."</td>".
                        "<td><a href=\"Update\">Update</a>,<a href=\"Delete\">Delete</a></td>"
                    );
                }
            ?>        

        </tbody>
    </table>
</body>
</html>