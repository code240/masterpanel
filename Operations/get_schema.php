<?php
ob_start();
    if(!isset($_SESSION["green_flag_to_schema"])){
        header("refresh:0;url=./../index.php");
        exit;
    }
    $db_tb = $_SESSION["green_flag_to_schema"];
    $_SESSION["green_flag_to_pages"] = "yes";
    unset($_SESSION["green_flag_to_schema"]);


    if($connect -> connect_errno){
        echo "DB CONNECTION ERROR :233";
        exit;
    }

    $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tb' AND TABLE_SCHEMA = '$db'";
    $getSchema = $connect->query($sql);
    
    $col_names = [];
    $col_type = [];
    $col_isNull = [];
    $col_isPri = [];
    $col_len = [];

    $supported = ["int","varchar","text","mediumtext","longtext","date","tinyint","smallint","mediumint","bigint"];
    $primary_exist = 0;
    $xx=0;
    $primary_column_number = -1;
    $primary_column_name = "";

    while($schema = $getSchema->fetch_assoc()){
        // print("<pre>".print_r($schema,true)."</pre>");
        array_push($col_names,$schema["COLUMN_NAME"]);
        if($schema["IS_NULLABLE"] == "NO"){
            array_push($col_isNull,"0");
        }else{
            array_push($col_isNull,"1");
        }
        if($schema["COLUMN_KEY"] == "PRI"){
            array_push($col_isPri,"1");
            $primary_exist = 1;
            $primary_column_name = $schema["COLUMN_NAME"];
            $primary_column_number = $xx;
        }else{
            array_push($col_isPri,"0");
        }
        $x = $schema["DATA_TYPE"];
        array_push($col_type,$x);
        array_push($col_len,$schema["CHARACTER_MAXIMUM_LENGTH"]);
        $xx++;
    }
    $pk_type = "none";
    if($primary_exist==1){
        $pk_type =  $col_type[$primary_column_number];
    }

    if($total_rows != 0){
        $primary_column_number_in_data = 0;
        for($d=0;$d<count($cols);$d++){
            if($primary_column_name == $cols[$d]){
                $primary_column_number_in_data = $d;
                break;
            }
        }
    }





?>