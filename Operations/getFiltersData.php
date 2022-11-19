<?php
ob_start();
    if(!isset($_GET["filter"])){
        header("refresh:0;url=./../inside/Filteration.php");
       exit; 
    }

    $pageNeed = 0;

    include "./../database/db.php";
    $filter = (int)$_GET["filter"];

    $sql = "SELECT  * FROM filterx WHERE id = $filter";
    $get_filters = $con->query($sql);

    if($get_filters -> num_rows == 0 || $get_filters -> num_rows > 1){
        echo "<h1>Something went wrong! May be you make some change in our database.<br>Kindly do not edit any data from masterPanel tables.</h1>";
        header("refresh:10;url=./../inside/Filteration.php");
        exit;
    }

    while($get_rows = $get_filters -> fetch_assoc()){
        $filtername = $get_rows["filtername"];
        $filter_query = $get_rows["filterQuery"];
        $filter_user = $get_rows["filterUser"];
        $filter_ps = $get_rows["filterPsw"];
        $filter_creater = $get_rows["createByUs"];
        break;
    }


    $con -> close();

    $connect = new mysqli($server,$filter_user,$filter_ps);
    if($connect -> connect_errno){
        echo "<h1>Database Connection Error!! Kindly re-Create This filter.<br>May be you change the user or password who can access this filter.</h1>";
        header("refresh:7;url=./../inside/Filteration.php");
        exit;
    }

    $get_output = $connect -> query($filter_query);
    
    $total_rows = $get_output -> num_rows;

    while($mycols = $get_output -> fetch_assoc()){
        $cols = array_keys($mycols);
    }

    $get_output = $connect -> query($filter_query);
    $ss=0;
    $WholeData = [];
    while($whole = $get_output -> fetch_assoc()){
    for($ff=0;$ff<count($cols);$ff++){
        $WholeData[$ff][$ss] = $whole[$cols[$ff]];
    }
    $ss++;
}

$page_contains_row = $total_rows;

// Code for sorting


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
    





$_SESSION["green_flag_to_pages"] = "yes";




?>