<?php
    ob_start();
    include "./../database/db.php";
    $sql = "SELECT * FROM filterx";

    $get_filters = $con -> query($sql);
    $filters_row = $get_filters -> num_rows;
    if($filters_row > 0){
        $i = 0;
        while($res = $get_filters -> fetch_assoc()){
            $filterId[$i] = $res["id"];
            $filternames[$i] = $res["filtername"];
            $createBy[$i] = $res["createByUs"];
            if($createBy[$i] == '1'){
                $createrName[$i] = "masterPanel";
            }else{
                $createrName[$i] = "YourQuery";
            }
            $i++;
        }

    }
    


if($filters_row > 0){

    $colorArray = array("#ffa06f","#ff628f","#41b6ff","#7831df");
    $backGroundColorArray = array("#fff4ef","#ffeef2","#effaff","#f3ecfd");
    
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
        if($color_complete == $filters_row){
            break;
        }
    }   

    
}
?>