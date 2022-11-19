<?php
ob_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="./css/stylesheet.css">
    </head>
    <body>
        <script>
            function back_push(){
                window.history.back();
            }
            function Timer(){
                var second = document.getElementById("seconds").innerText;
                second = parseInt(second);
                second = second - 1;
                document.getElementById("seconds").innerText = second;
                if(second == 0){
                    clearInterval(interval);
                }
            }
        </script>
    </body>
</html>

<?php
    if(!isset($_POST["connect"])){
        exit;
    }
    include "./../database/db.php";
    $user = $_POST["user"];  
    $dbserver = $_POST["server"];  
    $psw = $_POST["psw"];
    $dbName = $_POST["dbname"];
    $connect_by = $_COOKIE["user"];

    $test_con = mysqli_connect($dbserver,$user,$psw,$dbName);
    if($test_con){
        $sql = "INSERT INTO dbs (db,servername,db_user,psw,active,connect_by) VALUES ('$dbName','$dbserver','$user','$psw',1,'$connect_by')";
        if($con->query($sql) === TRUE){
            echo "<h2>DataBase Connected!</h2>";
            header("refresh:2;url=./../inside/");
        }else{
            echo "<h1>Error while inserting data in table!!! <br>Retry!</h1>";
        }
    }else{
        error_reporting(E_ALL &  ~E_NOTICE);
        echo "<h1>Invalid Inputs</h1>";
        echo "<script>setTimeout(back_push,20000);</script>";
        echo "<span class='message'>you will go back in Just <strong id='seconds'>20</strong> seconds<span>";
    }
?>
<script>
    const interval = setInterval(Timer,1000);
</script>