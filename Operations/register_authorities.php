<?php
ob_start();
    if(!isset($_POST["Register"])){
        header("refresh:0;url=./../index.php" );
        exit;
    }
    $auth_name = $_POST["fullname"];
    $auth_email = $_POST["emailid"];
    $auth_phone = $_POST["phone"];
    $auth_psw = base64_encode($_POST["psw"]);
    $auth_job = (int)$_POST["auth_type"];



    // Create a unique_id
    date_default_timezone_set("Asia/Calcutta");
    $auth_code = "Authority".date("dmYhms");

    include "./../database/db.php";

    if($auth_job == 1){
        $sql = "SELECT * FROM authorities";
        $res = $con->query($sql);
        if($res->num_rows == 0){
            $sql = "INSERT INTO authorities (fullname,email_id,phone_number,user_password,unique_id,job_post,parent,block_status,auth_power) VALUES ('$auth_name','$auth_email','$auth_phone','$auth_psw','$auth_code',$auth_job,'masterPanel',0,0)";
            if($con->query($sql)){
                echo "<h1>Administrator Register Successfully</h1>";
                header("refresh:2;url=./../index.php" );
            }else{
                echo "database insertion error";
                $con -> close();
                exit;
            }
        }else{
            echo "Administrator Already exist!";
            $con->close();
            exit;
        }
    }
?>