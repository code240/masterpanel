
<?php
ob_start();
if(!(isset($_GET["tb"]))){
    header("refresh:0;url=./index.php");
    exit;
}
if(!(isset($_GET["db"]))){
    header("refresh:0;url=./index.php");
    exit;
}
$tb = $_GET["tb"];
$db = $_GET["db"];

$page_contains_row = 0;

include "./../database/db.php";
$sql = "SELECT * FROM dbs WHERE db = '$db' AND active = 1";
$res = $con->query($sql);
if($res->num_rows == 0){
    echo "db does not exist";
    exit();
}
while($dbs = $res->fetch_assoc()){
    $dbs_user = $dbs["db_user"];
    $dbs_psw = $dbs["psw"];
    $dbs_server = $dbs["servername"];
    break;
}
$con->close();
$connect = mysqli_connect($dbs_server,$dbs_user,$dbs_psw,$db);
if(!$connect){
    echo "Connection Error! There is something wrong!";
    exit;
}
$sql = "SHOW TABLES IN `$db`";
$tables_res = $connect->query($sql);
if($tables_res -> num_rows == 0){
    echo "No Tables in This Database";
    exit;
}
$ii=0;
while($table = $tables_res->fetch_assoc()){
    $tabs[$ii] = $table["Tables_in_".$db];
    $ii++;
}
if(!in_array($tb,$tabs)){
    echo "Table doesnt exist!";
    exit;
}


$sql = "SELECT * FROM `$tb`";
$fetch_mycols = $connect->query($sql);
$total_rows = $fetch_mycols -> num_rows;
while($mycols = $fetch_mycols -> fetch_assoc()){
    $cols = array_keys($mycols);
}

$fetch_mycols = $connect->query($sql);
$ss=0;
$WholeData = [];
while($whole = $fetch_mycols -> fetch_assoc()){
    for($ff=0;$ff<count($cols);$ff++){
        $WholeData[$ff][$ss] = $whole[$cols[$ff]];
    }
    $ss++;
}

if(isset($_GET["sort"])){
$sort = $_GET["sort"];
    if($sort == "bu"){

        // Create Copy of array
        
        for($c=0;$c<count($WholeData);$c++){
            for($d=0;$d<count($WholeData[$c]);$d++){
                $temp_WholeData[$c][$d] =  $WholeData[$c][$d];
            }
        }
        
        // Initialize again

        for($c=0;$c<count($temp_WholeData);$c++){
            $god = 0;
            for($d=count($temp_WholeData[$c])-1;$d>=0;$d--){
                $WholeData[$c][$god] = $temp_WholeData[$c][$d];
                $god++;
            }
        }
    }    
}

// $page_contains_row = count($WholeData[0]);
$page_contains_row = $total_rows;

// for getting schema 
// Session for get_schema.php

session_start();
$_SESSION["green_flag_to_schema"] = $server."**&&**".$dbs_user."**&&**".$dbs_psw."**&&**".$db."**&&**".$tb."**&&**".$database."**&&**".$password."**&&**".$user;

// $connect->close();

?>