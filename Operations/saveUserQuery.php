<?php
ob_start();
?>
<html><head>
    <title>Creating Filter...</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <script> function back_push(){window.history.back();} </script>
</head></html>
<?php
$filterName = $_POST["filtername"];
$db_user = $_POST["db_user"];
$user_ps = $_POST["user_ps"];
$filterQuery = $_POST["filterquery"];
$saveStatus = $_POST["savestatus"];

$filterQuery = str_replace("'", "\'",$filterQuery);

$creator = $_COOKIE["user"];


include "./../database/db.php";



$connection = new mysqli($server,$db_user,$user_ps);

if($connection -> connect_errno){
    echo "<h1>Database Connection error!<br>You enter the wrong database user and its password.</h1>";
    exit;
}
$connection -> close();

if($saveStatus == '1'){
    

    $filter_sql = "INSERT INTO 
        filterx 
        (filtername,filterQuery,filterUser,filterPsw,createByUs,filterCreater) 
        VALUES
        ('$filterName','$filterQuery','$db_user','$user_ps',0,'$creator')
    ";
    if($con -> query($filter_sql)){
        echo "<h2>Filter Successfully Created!</h2>";
        header('refresh:2;url = ./../inside/Filteration.php');
    }else{
        echo "<h1>Something Went Wrong While Inserting filter !<br>Please try again</h1>";
        header('refresh:2000;url = ./../inside/create_filter.php');
    }


}else{
    echo "Direct View of filter is in progress";
}
$con -> close();

?>