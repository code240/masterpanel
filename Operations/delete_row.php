<?php
ob_start();
?>
<html><head>
    <title>Deleting a row... - masterPanel</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <script> function back_push(){window.history.back();} </script>
</head></html>
<?php
    if(!isset($_POST["pk"]) || !isset($_POST["pv"]) || !isset($_POST["pt"])){
        echo "Error..";
        header("refresh:0;url=./../inside");
        exit;
    }
    session_start();
    if(!isset($_SESSION["db"]) || !isset($_SESSION["tb"]) || !isset($_SESSION["db_u"]) || !isset($_SESSION["db_p"])){
        echo "errorrrrrx..";
        header("refresh:0;url=./../");
        exit;
    }
    $db_server = $_SESSION["db_server"];    
    $db = $_SESSION["db"];
    $db_user = $_SESSION["db_u"];
    $db_psw = $_SESSION["db_p"];
    $tb = $_SESSION["tb"];
    include "./../database/db.php";
    
    
    // Close Old Connection 
    $con->close();

    // Get New Connection
    $connect = new mysqli($db_server,$db_user,$db_psw,$db);
    if($connect-> connect_errno){
        echo "Database Connection Error";
        exit;
    }

    $pk = $_POST["pk"];
    $pv = $_POST["pv"];
    $pk_type = $_POST["pt"];

    // Creating Query
    $sql = "DELETE FROM $tb WHERE $pk = ";   

    if($pk_type == "tinyint" || $pk_type == "smallint" || $pk_type == "mediumint" || $pk_type == "int" || $pk_type == "bigint"){
        $sql .= $pv;
    }else{
        $sql .= "'".$pv."'";
    }

    if($connect -> query($sql)){
        unset($_SESSION["db_server"],$_SESSION["db"],$_SESSION["tb"],$_SESSION["db_u"],$_SESSION["db_p"]);
        echo "<h2>Data Successfully Deleted!</h2>";
        header('refresh:2;url = ./../inside/table_view.php?db='.$db.'&tb='.$tb);
    }else{
        echo "<h1>Something Went Wrong While Deleting the row...!</h1>";
        echo "<script>setTimeout(back_push,2000);</script>";
    }

?>