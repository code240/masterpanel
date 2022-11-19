<?php
ob_start();
    if(!isset($_POST["pv"])){
        echo "Error";
        header("refresh:0;url=./../");
        exit;
    }
    session_start();
    $_SESSION["db"] = $_POST["db"];
    $_SESSION["tb"] = $_POST["tb"];
    $_SESSION["pk"] = $_POST["pk"];
    $_SESSION["pv"] = $_POST["pv"];
    header("refresh:0;url=./../edit_row.php");
?>