<html>
    <head>
        <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./../logics/css/style.css" />
    </head>
</html>
<?php
    include "./../database/db.php";
    $no_db = 1;
    $ok = 0;

    $sql = "SELECT * FROM dbs WHERE active = 1";
    $res = $con->query($sql);
    if($res->num_rows == 0){
        $no_db = 0;
    }else{
        while($new_row = $res->fetch_assoc()){
            $my_db_name = $new_row["db"];
            $my_db_id = $new_row["id"];
            $servername = $new_row["servername"];
            $my_db_user = $new_row["db_user"];
            $my_db_ps = $new_row["psw"];
            $can_connect = new mysqli($servername,$my_db_user,$my_db_ps,$my_db_name);

            if($can_connect -> connect_errno){
                $sql2 = "DELETE FROM dbs WHERE db = '$my_db_name'";
                echo<<<html
                <div class='alert alert-danger alert-harm' role='alert'>
                <b>**FIRSTLY, READ THE ABOVE ERROR**</b><br><br>
                You make some changes with the connected database.<br>
                That's Why we are unable to access your all connected Databases.<br><br>
                Kindly Give us some time to Debug Your problem.<br>
                </div>
                <div class='alert alert-warning alert-warn' role='alert'>
                We will disconnect the database which is causing some problem.<br>
                You can reconnect to that database with the correct connecting credentials.
                </div>
                <div class='alert alert-success alert-good' role='alert'>
                    Refresh Again & Again Until Your Problem Get Resolve!
                </div>
                <button class='btn btn-primary btn-refresh' onclick="location.reload();"> Debug and Refresh </button>
html;
                $con->query($sql2);
                $con -> close();
                exit;
            }else{
                $can_connect->close();
                $ok = 1;
            }
            
        }
    }


    $con -> close();
?>