<?php
    ob_start();
    include "database/db.php";
    include "logics/checkAuthoritiesExistance.php";
    if($authorities_exist == 0){
        include "./Schema/authorities_schema.php";
        if ($con->query($authorities_schema) === TRUE) {
            header( "refresh:0;url=Resgister_authorities.php" );
            $con -> close();
            exit;
        }else {
            echo "Error creating table: " . $con->error;
        }
    }
    $sql = "SELECT * FROM authorities";
    $res = $con->query($sql);
    if($res->num_rows == 0){
        header( "refresh:0;url=Resgister_authorities.php" );
        $con->close();
        exit;
    }
    session_start();
    if(isset($_COOKIE["user"])){
        $uid = $_COOKIE["user"];
        $sql = "SELECT * FROM authorities WHERE unique_id = '$uid'";
        $response = $con->query($sql);
        if($response -> num_rows == 1){
            setcookie("user", $uid, time() + (86400 * 15), "/");  // 15 days
            header("refresh:0.5;url=./inside/");
            $con -> close();
            exit;
        }else{
            setcookie("user", $uid, time() - (2), "/");  // 15 days
        }
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
        <h1>masterPanel - Login</h1>
        <form action="Operations/login_confirm.php" method="POST">
            <label for="username-inp" class="form-label">Username</label>
            <input type="text" required class="collector" name="usn" placeholder="Admin Username" autocomplete="off" id="username-inp">
            <label for="psw-inp" class="form-label">Password</label>
            <input type="password" required class="collector" name="psw" placeholder="Password" autocomplete="off" id="psw-inp">
            <input type="submit" value="Login" name="Login" class="btn login-btn">
        </form>
    </div>
</body>
</html>