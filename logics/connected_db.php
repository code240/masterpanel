<?php
    include "../database/db.php";    
// Colors array
    $colorArray = array("#ffa06f","#ff628f","#41b6ff","#7831df");
    $backGroundColorArray = array("#fff4ef","#ffeef2","#effaff","#f3ecfd");
// Table empty array
    $pre = count($colorArray)+10;

    $sql = "SELECT * FROM dbs WHERE active = 1";
    $res = $con->query($sql);
    
    $loop = 0;
    if($res->num_rows != 0){
        while($row = $res->fetch_assoc()){
            $db_names[$loop] = $row["db"];
            $db_id[$loop] = $row["id"];
            $db_user[$loop] = $row["db_user"];
            $db_psw[$loop] = $row["psw"];
            $db_server[$loop] = $row["servername"];
            $db_total_table = 1;
            $new_con = mysqli_connect($db_server[$loop],$db_user[$loop],$db_psw[$loop],$db_names[$loop]);
            $sql = "SHOW TABLES IN `$db_names[$loop]`";
            $tables_res = $new_con->query($sql);
            $total_tables = $tables_res->num_rows;
            if($total_tables == 0){
                $db_table_count[$loop] = 0;
            }else{
                $tloop = 0;
                $dbx = $db_names[$loop];
                while($tab = $tables_res->fetch_assoc()){
                
                    $rnd = rand(0,count($colorArray)-1);
                    if($rnd == $pre){
                        $rnd = rand(0,count($colorArray)-1);
                    }else{
                        $pre = $rnd;
                    }
                    $table_names[$loop][$tloop] =  $tab["Tables_in_".$dbx];
                    $t_color[$loop][$tloop] = $colorArray[$rnd];
                    $t_bgcolor[$loop][$tloop] = $backGroundColorArray[$rnd];
                    $tn = $table_names[$loop][$tloop];
                    $sql2 = "SELECT * FROM $db_names[$loop].$tn";
                    $table_query_exectue = $new_con->query($sql2);
                    $table_rows[$loop][$tloop] = $table_query_exectue->num_rows;
                    $tloop++;
                }
                $db_table_count[$loop] = $tloop;
            }
            
            $new_con -> close();
            $loop++;
        }
    // here


    $db_color = array();
    $db_bg = array();

    $previous = count($colorArray)+10;

    $color_complete = 0;
    while(1){

        $random = rand(0,count($colorArray)-1);
        if($random != $previous){
            array_push($db_color,$colorArray[$random]);
            array_push($db_bg,$backGroundColorArray[$random]);
            $previous = $random;
            $color_complete++;
        }
        if($color_complete == $loop){
            break;
        }
    }   

    }
    $con -> close();
    
?>