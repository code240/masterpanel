<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "masterpanel";


    // error_reporting(0);
    $con = mysqli_connect($server,$user,$password,$database);
    
    if($con -> connect_errno){
        echo "<h1>Database error! Cannot connect with database.<br>
                Visit Database/db.php file and add your database there.<br><br>
                Create a database for better work performance of panel.
            </h1>";
            exit;
    }

?>