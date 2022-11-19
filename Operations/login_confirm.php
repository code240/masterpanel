<?php
ob_start();
?>
<html>
<head>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
<script>
    function back_push(){
        window.history.back();
    }
</script>
</body>
</html>
<?php
    if(!isset($_POST["Login"])){
        header( "refresh:0;url=./../index.php" );
        exit;
    }
    $user_email = strtolower($_POST["usn"]);
    $user_psw = $_POST["psw"];
    include "./../database/db.php";
    $sql = "SELECT * FROM authorities WHERE block_status = 0";

    $res = $con -> query($sql);

    $email_true = 0;
    $psw_true = 0;

    while($row = $res->fetch_assoc()) {
        $get_user = strtolower($row["email_id"]);
        $get_psw = base64_decode($row["user_password"]);
        $get_num = $row["phone_number"];
        $uid = $row["unique_id"];
        if($get_user == $user_email || $get_num == $user_email){
            $email_true = 1;
            if($user_psw == $get_psw){
                $email_true = 1;
                $psw_true = 1;
                echo "<h2>Login Successfully</h2><br><br><center><h3>Redirecting You to panel...<h3><br>Please Wait...</center>";
                session_start();
                setcookie("user", $uid, time() + (86400 * 15), "/");  // 15 days
                $_SESSION["uid"] = $user_email;
                header("refresh:2;url=./../inside/");
            }
        }
    }

    

    if($email_true == 0){
        echo "<h1>Incorrect Username!</h1>";
        echo "<script>setTimeout(back_push,2000);</script>";
        exit;
    }

    if($email_true == 1 && $psw_true == 0){
        echo "<h1>Incorrect Password!</h1>";
        echo "<script>setTimeout(back_push,2000);</script>";
        exit;
    }
    // if(){}
?>