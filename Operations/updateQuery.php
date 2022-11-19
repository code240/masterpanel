<?php
ob_start();
?>
<html><head>
    <title>Updating your database...</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <script> function back_push(){window.history.back();} </script>
</head></html>

<?php
    if(!isset($_POST["filter_id"]) && !isset($_POST["filter_q"])){
        header("refresh:0;url=./../inside/");
        exit;
    }
    $filter_id = (int)$_POST["filter_id"];
    $filter_query = $_POST["filter_q"];

    $filter_query = str_replace("'", "\'",$filter_query);

    include "./../database/db.php";

    $sql = "UPDATE filterx SET filterQuery = '$filter_query' WHERE id = $filter_id";
    
    if($con -> query($sql)){
        if(isset($_POST["jsonPage"])){
            echo "<h2>Query Successfully Updated!</h2>";
            header('refresh:2;url = ./../inside/viewFilterJson.php?filter='.$filter_id);
        }else{
            echo "<h2>Query Successfully Updated!</h2>";
            header('refresh:2;url = ./../inside/viewFilterTable.php?filter='.$filter_id);
        }
    }else{
        echo "<h1>Something Went Wrong While Updating Query...!</h1>";
        echo "<script>setTimeout(back_push,2000);</script>";
    }
?>