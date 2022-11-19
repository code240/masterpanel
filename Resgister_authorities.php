<?php
ob_start();
    include "database/db.php";

    $sql = "SELECT * FROM authorities";
    $res = $con->query($sql);
    if($res->num_rows != 0){
        header("refresh:0;url=index.php" );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>masterPanel - login</title>
    <link rel="shortcut icon" href="./mediaFiles/favicon.png" type="image/x-icon">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="mainbody">
        <h1>masterPanel - Register</h1>
        <form action="Operations/register_authorities.php" method="POST">
            <label for="username-inp" class="form-label">Full name</label>
            <input type="text" required class="collector" name="fullname" pattern=".{4,}" title="Must contain 4 to 40 character" placeholder="Administrator name" autocomplete="off" id="username-inp">
            
            <label for="em-inp" class="form-label">Email id</label>
            <input type="email" pattern=".{10,}" title="Must contain 10 or more character" required class="collector" name="emailid" placeholder="Email id" autocomplete="off" id="em-inp">
            
            <label for="ph-inp" class="form-label">Phone number</label>
            <input type="number" required class="collector" name="phone" placeholder="Mobile Number" autocomplete="off" id="ph-inp">

            <label for="psw-inp" class="form-label">Password</label>
            <input type="password" pattern=".{6,50}" title="Must contain 6 to 50 character" required class="collector" name="psw" placeholder="Password" autocomplete="off" id="psw-inp">

            <input type="hidden" name="auth_type" value="1" id="auth_type">
            
            <input type="submit" value="Register" name="Register" class="btn login-btn">
        </form>        
    </div>
</body>
</html>