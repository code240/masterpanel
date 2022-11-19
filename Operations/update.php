<?php
ob_start();
?>
<html><head>
    <title>Updating your database...</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <script> function back_push(){window.history.back();} </script>
</head></html>
<?php
    if(!isset($_POST["update_save"])){
        header('refresh:0;url = ./../');
        exit;
    }
    session_start();
    $db = $_SESSION["db"];
    $db_server = $_SESSION["db_server"];
    $db_user = $_SESSION["db_u"];
    $db_psw = $_SESSION["db_p"];
    $tb = $_SESSION["tb"];
    $pk = $_SESSION["pk"];
    $pv = $_SESSION["pv"];
    $pk_type = $_SESSION["pk_type"];
    include "./../database/db.php";
    $con->close();
    $all_cols = $_SESSION["mycols"];
    $all_types = $_SESSION["mytypes"];
        
    $connect = new mysqli($db_server,$db_user,$db_psw,$db);
    if($connect-> connect_errno){
        echo "Database Connection Error";
        exit;
    }
    $sql = "UPDATE $tb SET ";
    $all_cols = explode("**#9*",$all_cols);
    array_pop($all_cols);
    $all_types = explode("**#9*",$all_types);
    array_pop($all_types);
    $all_values = [];
    for($i=0;$i<count($all_cols);$i++){
        array_push($all_values,$_POST[$all_cols[$i]]);
    }   
    for($i=0;$i<count($all_cols);$i++){
        if($i < count($all_cols)-1){
            if($all_types[$i] == "tinyint" || $all_types[$i] == "smallint" || $all_types[$i] == "mediumint" || $all_types[$i] == "int" || $all_types[$i] == "bigint"){
                $sql .= $all_cols[$i]." = ".$all_values[$i]." , ";
            }else{
                $sql .= $all_cols[$i]." = '".$all_values[$i]."' , ";
            }
        }else{
            if($all_types[$i] == "tinyint" || $all_types[$i] == "smallint" || $all_types[$i] == "mediumint" || $all_types[$i] == "int" || $all_types[$i] == "bigint"){
                $sql .= $all_cols[$i]." = ".$all_values[$i];
            }else{
                $sql .= $all_cols[$i]." = '".$all_values[$i]."'";
            }
        }
    }

    if($pk_type == "tinyint" || $pk_type == "smallint" || $pk_type == "mediumint" || $pk_type == "int" || $pk_type == "bigint"){
        $sql .= " WHERE $pk = $pv";
    }else{
        $sql .= " WHERE $pk = '".$pv."'";
    }


    if($connect->query($sql)){
        unset($_SESSION["db"],$_SESSION["tb"],$_SESSION["db_u"],$_SESSION["db_p"],$_SESSION["pk"],$_SESSION["pv"],$_SESSION["pk_type"],$_SESSION["mycols"],$_SESSION["mytypes"]);
        echo "<h2>Data Successfully Updated!</h2>";
        header('refresh:2;url = ./../inside/table_view.php?db='.$db.'&tb='.$tb);
    }else{
        echo "<h1>Something Went Wrong While Updating Data...!</h1>";
        echo "<script>setTimeout(back_push,2000);</script>";
    }


    // echo $sql;
?>