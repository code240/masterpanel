<?php
    ob_start();
    include "./../database/db.php";
    $are_you_admin = 0;

    $sql = "SELECT * FROM authorities WHERE job_post = '1'";
    $xx = $con -> query($sql);
    if($xx -> num_rows <= 0){
        echo "No admin exist<br>It is impossible that your panel doesn't contain any admin.<br>It must contain an admin.";
        setcookie("user", "xyz", time() - (2), "/"); // Kill Cookies
        exit;
    }

    $sql = "SELECT * FROM authorities WHERE block_status = 0";
    $get_res = $con -> query($sql);
    $total_row = $get_res -> num_rows;
    if($get_res -> num_rows <= 0){
        setcookie("user", "xyz", time() - (2), "/"); // Kill Cookies
        header("refresh:0;url=./../");
        exit;
    }
    $z = 0;
    $add_btn = '<button class="btn btn-purple btn-add-db disabled">Add Authority &nbsp;<i class="fa-solid fa-plus"></i></button>';
    $subAdmin_exist = 0;
    $Admin_exist = 0;
    while($row = $get_res -> fetch_assoc()){
        if($row["job_post"] == '1' && $row["unique_id"] == $_COOKIE["user"]){
            $are_you_admin = 1;
            $add_btn = '<button class="btn btn-purple btn-add-db"  onclick="add_auth(\''.$_COOKIE["user"].'\');">Add Authority &nbsp;<i class="fa-solid fa-plus"></i></button>';
        }
    }
    $get_res = $con -> query($sql);
    while($row = $get_res -> fetch_assoc()){
        $auth_name[$z] = $row["fullname"];
        $authEmail[$z] = $row["email_id"];     
        $phNumber[$z] = $row["phone_number"];     
        $uid[$z] = $row["unique_id"];
        $jobPost[$z] = $row["job_post"];    
        if($jobPost[$z] == '1'){
            $Admin_exist = 1;
        }if($jobPost[$z] == '2'){
            $subAdmin_exist = 1;
        } 
        $parent[$z] = $row["parent"]; 
        if($are_you_admin == 1){
          $block_button[$z]  = '<button onclick="block_auth(\''.$row["unique_id"].'\')" class="btn btn-danger"><i class="fa-solid fa-ban"></i></button>';
        }else{
            $block_button[$z]  = '<button class="btn btn-danger disabled"><i class="fa-solid fa-ban"></i></button>';
        }
        $z++;
    }
    
?>