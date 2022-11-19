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
    $filterDB = $_POST["filterdb"];
    $filterTB = $_POST["filtertb"];
    $filterCol = $_POST["filtercol"];
    $filterType = $_POST["filtertype"];
    $filterValue = $_POST["filtervalue"];
    $saveStatus = $_POST["savestatus"];

    $creator = $_COOKIE["user"];

    include "./../database/db.php";

    // $con -> close();
    $x = "SELECT * FROM dbs WHERE db = '$filterDB'";
    $x_res = $con -> query($x);
    $x_count = $x_res -> num_rows;
    if($x_count == 0){
        echo "Error";
        exit();
    }
    while($get = $x_res -> fetch_assoc()){
        $user_ps = $get["psw"];
        $user_name = $get["db_user"];
        break;
    }
    $connection = new mysqli($server,$user_name,$user_ps,$filterDB);
    $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$filterTB' AND TABLE_SCHEMA = '$filterDB'";
    $getSchema = $connection->query($sql);

    $col_types = [];
    $col_names = [];

    while($schema = $getSchema->fetch_assoc()){
        // print("<pre>".print_r($schema,true)."</pre>");
        array_push($col_types,$schema["DATA_TYPE"]);
        array_push($col_names,$schema["COLUMN_NAME"]);
    }


    $connection -> close();




    $query = "SELECT * FROM ";
    $query .= $filterDB.'.'.$filterTB.' WHERE '.$filterCol.' ';
    $like = 0;
    if($filterType == '1'){
        $filterType = "<";
    }if($filterType == '2'){
        $filterType = ">";
    }if($filterType == '3'){
        $filterType = "=";
    }if($filterType == '4'){
        $filterType = "<=";
    }if($filterType == '5'){
        $filterType = ">=";
    }if($filterType == '6'){
        $query .= "LIKE '".$filterValue."%"."'";
        $like = 1;
    }if($filterType == '7'){
        $query .= "LIKE '%".$filterValue."'";
        $like = 1;
    }if($filterType == '8'){
        $query .= "LIKE '%".$filterValue."%'";
        $like = 1;
    }

    $supported_int = ["int","tinyint","smallint","mediumint","bigint"];
    $supported_strings = ["varchar","date","text","mediumtext","longtext"];
    

    if($like == 0){
        for($j=0;$j<count($col_names);$j++){
            if($col_names[$j] == $filterCol){
                if(in_array($col_types[$j],$supported_int)){
                    $query .= $filterType.' '.$filterValue;
                }else{
                    $query .= $filterType." '".$filterValue."'";
                }
            }
        }
    }
    // echo $query;

    $query = str_replace("'", "\'",$query);


    // store data in filter table

    $filter_sql = "INSERT INTO 
        filterx 
        (filtername,filterQuery,filterUser,filterPsw,createByUs,filterCreater) 
        VALUES
        ('$filterName','$query','$user_name','$user_ps',1,'$creator')
    ";

    if($con -> query($filter_sql)){
        echo "<h2>Filter Successfully Created!</h2>";
        header('refresh:2;url = ./../inside/Filteration.php');
    }else{
        echo "<h1>Something Went Wrong While Inserting filter...!<br>Please try again</h1>";
        header('refresh:2;url = ./../inside/create_filter.php');
    }
    
    $con -> close();

?>