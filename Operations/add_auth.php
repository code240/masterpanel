<?php
ob_start();
?>
<html><head>
    <title>Adding authorities... - masterPanel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
    <script> function back_push(){window.history.back();} </script>
</head></html>
<?php
if(!isset($_COOKIE["user"])){
    header("refresh:0;url=./../");
    exit;
}
if(!isset($_POST["sa_name"])){
    header("refresh:0;url=./../");
    exit;
}
$uid = $_COOKIE["user"];
$sa_name = $_POST["sa_name"];
$sa_email = $_POST["sa_email"];
$sa_mobile = $_POST["sa_phone"];
$jobPost = $_POST["job_post"];
$sa_psw = base64_encode($_POST["sa_psw"]);

include "./../database/db.php";

// Create a unique_id
date_default_timezone_set("Asia/Calcutta");
$unique = "Sub-Auth_".date("dmYhms");

$sql = "INSERT INTO authorities (fullname,email_id,phone_number,user_password,unique_id,job_post,parent,block_status,auth_power) VALUES ('$sa_name','$sa_email','$sa_mobile','$sa_psw','$unique','$jobPost','$uid',0,0)";


if($con -> query($sql)){
    echo '<h4 class="alert alert-success alert-logout">Sub-Admin Register Successfully</h4>';
    header('refresh:2;url = ./../inside/Authorities.php');
}else{
    echo '<h4 class="alert alert-danger alert-logout">Something went wrong</h4>';
    echo "<script>setTimeout(back_push,2000);</script>";
}

$con -> close()

?>