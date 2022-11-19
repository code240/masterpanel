<?php
ob_start();
?>
<html><head>
    <title>Loging you out... - masterPanel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
    <script> function back_push(){window.history.back();} </script>
</head></html>
<?php
    if(isset($_COOKIE["user"])){
        setcookie("user", "", time() - (10), "/");  // delete cookie
        echo '<h4 class="alert alert-danger alert-logout">Successfully logout</h4>';
        echo '<h6 class="alert alert-success alert-logout redirect-you">Redirecting....</h6>';
        header("refresh:3;url=./../");
    }else{
        echo '<h4 class="alert alert-danger alert-logout">Successfully logout</h4>';
        echo '<h6 class="alert alert-success alert-logout redirect-you">Redirecting....</h6>';
        header("refresh:3;url=./../");
    }

?>