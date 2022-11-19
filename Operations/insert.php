<?php
ob_start();
?>
<html><head>
    <title>Inserting data... - masterPanel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylesheet.css">
    <script> function back_push(){window.history.back();} </script>
</head></html>
<?php
session_start();
if(!isset($_SESSION["input_types"]) || !isset($_SESSION["input_names"]) || !isset($_SESSION["db"]) || !isset($_SESSION["tb"]) || !isset($_SESSION["db_u"]) || !isset($_SESSION["db_p"])){
    echo "errorrrrr..";
    header("refresh:0;url=./../");
    exit;
}
if(!isset($_POST["insert_save"])){
    header('refresh:0;url = ./../');
    exit;
}
$db_server = $_SESSION["db_server"];
$db = $_SESSION["db"];
$db_user = $_SESSION["db_u"];
$db_psw = $_SESSION["db_p"];
$tb = $_SESSION["tb"];
include "./../database/db.php";

$con->close();

$connect = new mysqli($db_server,$db_user,$db_psw,$db);
if($connect-> connect_errno){
    echo "Database Connection Error";
    exit;
}
$input_names = explode("**#9*",$_SESSION["input_names"]);
$input_types = explode("**#9*",$_SESSION["input_types"]);
array_pop($input_names);
array_pop($input_types);


$all_values = [];
for($i=0;$i<count($input_names);$i++){
    array_push($all_values,$_POST[$input_names[$i]]);
}   


$sql = "INSERT INTO $tb (";


for($i=0;$i<count($input_names);$i++){
    if($i<count($input_names)-1){
        $sql .= $input_names[$i].", ";
    }else{
        $sql .= $input_names[$i].") VALUES (";
    }
}

$supported_int = ["int","tinyint","smallint","mediumint","bigint"];
$supported_strings = ["varchar","date","text","mediumtext","longtext"];

for($i=0;$i<count($input_names);$i++){
    if($i<count($input_names)-1){
        if(in_array($input_types[$i],$supported_int)){
            $sql .= $all_values[$i].", ";
        }else{
            $sql .= "'".$all_values[$i]."', ";
        }
    }else{
        if(in_array($input_types[$i],$supported_int)){
            $sql .= $all_values[$i].")";
        }else{
            $sql .= "'".$all_values[$i]."')";
        }
    }

}
$isQuerySuccess = $connect -> query($sql);
if($isQuerySuccess){
    unset($_SESSION["db_server"],$_SESSION["db"],$_SESSION["tb"],$_SESSION["db_u"],$_SESSION["db_p"],$_SESSION["input_types"],$_SESSION["input_names"]);
    echo "<h2>Data Successfully Inserted!</h2>";
    header('refresh:2;url = ./../inside/table_view.php?db='.$db.'&tb='.$tb);
}else{
    echo "<h1 style='width:fit-content' class='error-head'>ERROR</h1>";
    echo "<h3 class='alert alert-danger'>";
    echo "  
            There is some error, While inserting the data! Kindly note that, 
            Your input must fulfill the rules of your column.<br><br>
    ";
    echo "</h3>";
    echo "<h3 class='alert alert-warning'>";
    echo "  
            <b>RULES: </b><br>
            Primary key cannot be same to another row and cannot be null.
            <br>Unique key cannot be same to another row.<br>
            Not Null columns cannot be store null.
    ";
    echo "</h3>";
    echo "<h3 class='alert alert-success'>";
    echo "  
            Kindly go back and check your inputs again.
    ";
    echo "</h3>";
    echo "<button onclick='back_push();' class='btn btn-success btn-go-back'>Go Back</button>";
    
}



?>
