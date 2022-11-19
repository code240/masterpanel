<?php
ob_start();
if(!isset($_SESSION["green_flag_to_pages"])){
    header("refresh:0;url=./../index.php");
    exit;
}
unset($_SESSION["green_flag_to_pages"]);

$total_data = $total_rows;
$pageNeed = 0;

if($total_data > 1000){
    $pageNeed = 1;
}
$totalPage = 1;

if($pageNeed == 1){
    $totalPage = $total_data/1000;
    $totalPage = ceil($totalPage);
    // echo $totalPage;    
    $page_contains_row = 1000;
}



$pgExist = 0;
$pg_number = 0;
$start_point = 0;
if(isset($_GET["pg"])){
    $pgExist = 1;
    $pg_number = (int)$_GET["pg"];
    $pg_number = $pg_number - 1;
    if($pg_number < 0){
        $pg_number = 0;
    }
    $start_point = ($pg_number)*1000;
    $pg_copy = $pg_number + 1;
    if($pg_copy == $totalPage){
        $page_contains_row = $total_data%1000;
    }else{
        $page_contains_row = 1000;
    }
    
}   


?>