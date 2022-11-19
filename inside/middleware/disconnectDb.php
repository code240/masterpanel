<?php
ob_start();
?>
<html><head>
    <title>DataBase Disconnecting...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head></html>
<?php
    error_reporting(0);
    include "./../../database/db.php";
    $disconnect_id = $_GET["db"];
    $q = "UPDATE dbs SET active = 0,psw='mp_null' WHERE id = $disconnect_id";
    if($con->query($q)){
        echo '<h4 class="alert alert-danger alert-logout">Database Disconnected</h4>';
        echo '<h6 class="alert alert-success alert-logout redirect-you">Successfully</h6>';
        header("refresh:3;url=./../settings.php");
    }else{
        echo '<h4 class="alert alert-danger alert-logout">Failed to disconnect....</h4>';
        header("refresh:3;url=./../settings.php");
    }
?>