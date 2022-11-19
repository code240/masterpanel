<?php
ob_start();
?><html><head>
    <title>Adding authorities... - masterPanel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
    <script> function back_push(){window.history.back();} </script>
</head></html>
<?php
    if(!isset($_GET["auth"])){
        header("refresh:0;url=./../");
        exit;
    }
    if(!isset($_COOKIE["user"])){
        header("refresh:0;url=./../");
        exit;
    }
    include "./../database/db.php";
    $sa = $_GET["auth"];

    $sql = "UPDATE authorities SET block_status = 1 WHERE unique_id = '$sa'";

    if($con->query($sql)){
        echo '<h4 class="alert alert-success alert-logout">Sub-Admin Block Successfully</h4>';
        header('refresh:2;url = ./../inside/Authorities.php');
    }else{
        echo '<h4 class="alert alert-danger alert-logout">Something went wrong</h4>';
        echo "<script>setTimeout(back_push,2000);</script>";
    }
?>