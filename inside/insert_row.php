<?php
ob_start();
$html = "";
session_start();
if(!isset($_SESSION["db"]) || !isset($_SESSION["tb"]) || !isset($_SESSION["db_u"]) || !isset($_SESSION["db_p"])){
    echo "errorrrrr..";
    header("refresh:0;url=./");
    exit;
}
$db = $_SESSION["db"];
$db_server = $_SESSION["db_server"];
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

// Get Schema

$sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tb' AND TABLE_SCHEMA = '$db'";
$getSchema = $connect->query($sql);

$col_names = [];
$col_type = [];
$col_isNull = [];
$col_isPri = [];
$col_len = [];
$col_auto_incr = [];
$col_key = [];
$supported = ["int","varchar","text","mediumtext","longtext","date","tinyint","smallint","mediumint","bigint"];
$supported_int = ["int","tinyint","smallint","mediumint","bigint"];
$supported_text = ["text","mediumtext","longtext"];
$primary_exist = 0;
$xx=0;
$primary_column_number = -1;
$primary_column_name = "";
while($schema = $getSchema->fetch_assoc()){
    // print("<pre>".print_r($schema,true)."</pre>");
    if($schema["EXTRA"] == "auto_increment"){
        array_push($col_auto_incr,"1");
    }else{
        array_push($col_auto_incr,"0");
    }
    array_push($col_key,$schema["COLUMN_KEY"]);
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



// Create a form
$input_names = "";
$input_types = "";


for($i = 0; $i < count($col_type); $i++){
    if(in_array($col_type[$i],$supported)){
        $type = $col_type[$i];
        $key = $col_key[$i];
        $auto = $col_auto_incr[$i];
        $pri = $col_isPri[$i];
        if($auto == 0){
            
            // Varchar , Not Unique , Not Primary
            if($type == "varchar" && $key == ""){
                $length = (int)$col_len[$i];
                if($length <= 100){
                    $html .= '<label class="label-form">'.$col_names[$i].' <span class="no-key"></span></label>';
                    $html .= '<textarea class="textarea mini-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].'"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }else if($length > 100 && $length < 500){
                    $html .= '<label class="label-form">'.$col_names[$i].' <span class="no-key"></span></label>';
                    $html .= '<textarea class="textarea normal-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].'"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }else if($length >= 500){
                    $html .= '<label class="label-form">'.$col_names[$i] .'<span class="no-key"></span></label>';
                    $html .= '<textarea class="textarea large-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].'"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }
            }



            // Varchar , Unique
            if($type == "varchar" && $key == "UNI"){
                $length = (int)$col_len[$i];
                if($length <= 100){
                    $html .= '<label class="label-form">'.$col_names[$i].' <span class="u-key"> <i class="fa-solid fa-key"></i></span></label>';
                    $html .= '<textarea class="textarea mini-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (Unique_key)"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }else if($length > 100 && $length < 500){
                    $html .= '<label class="label-form">'.$col_names[$i].' <span class="u-key"> <i class="fa-solid fa-key"></i></span></label>';
                    $html .= '<textarea class="textarea normal-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (Unique_key)"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }else if($length >= 500){
                    $html .= '<label class="label-form">'.$col_names[$i] .'<span class="u-key"> <i class="fa-solid fa-key"></i></span></label>';
                    $html .= '<textarea class="textarea large-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (Unique_key)"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }
            }

        
            // Varchar , primary
            if($type == "varchar" && $key == "PRI"){
                $length = (int)$col_len[$i];
                if($length <= 100){
                    $html .= '<label class="label-form">'.$col_names[$i].' <span class="p-key"> <i class="fa-solid fa-key"></i></span></label>';
                    $html .= '<textarea class="textarea mini-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (primary_key)"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }else if($length > 100 && $length < 500){
                    $html .= '<label class="label-form">'.$col_names[$i].' <span class="p-key"> <i class="fa-solid fa-key"></i></span></label>';
                    $html .= '<textarea class="textarea normal-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (primary_key)"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }else if($length >= 500){
                    $html .= '<label class="label-form">'.$col_names[$i] .'<span class="p-key"> <i class="fa-solid fa-key"></i></span></label>';
                    $html .= '<textarea class="textarea large-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (primary_key)"></textarea>';
                    $input_names .= $col_names[$i]."**#9*";
                    $input_types .= $type."**#9*";
                }
            }

            // Text mediumtext longtext etc...

            // Text , primary
        
            if(in_array($type,$supported_text) && $key == "PRI"){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="p-key"> <i class="fa-solid fa-key"></i></span></label>';
                $html .= '<textarea class="textarea large-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (primary_key)"></textarea>';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }
            // Text , Unique
            if(in_array($type,$supported_text) && $key == "UNI"){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="u-key"> <i class="fa-solid fa-key"></i></span></label>';
                $html .= '<textarea class="textarea large-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (Unique_key)"></textarea>';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }
            // Text , Not Primary and Not Unique
            if(in_array($type,$supported_text) && $key == ""){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="u-key"> </span></label>';
                $html .= '<textarea class="textarea large-area" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].'"></textarea>';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }


            // Int TinyInt MediumInt etc

            // Int , Primary 

            if(in_array($type,$supported_int) && $key == "PRI"){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="p-key"> <i class="fa-solid fa-key"></i></span></label>';
                $html .= '<input type="number" autocomplete="off" class="collector" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (primary_key)">';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }
            // Int , Unique 
            if(in_array($type,$supported_int) && $key == "UNI"){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="u-key"> <i class="fa-solid fa-key"></i></span></label>';
                $html .= '<input type="number" autocomplete="off" class="collector" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (Unique_key)">';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }
            // Int , not Unique , not Primary 
            if(in_array($type,$supported_int) && $key == ""){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="p-key"> </span></label>';
                $html .= '<input type="number" autocomplete="off" class="collector" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].'">';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }
            
            // Date Column

            // Date, Primary
            if($type == "date" && $key == "PRI"){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="p-key"> <i class="fa-solid fa-key"></i></span></label>';
                $html .= '<input type="date" class="collector" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (primary_key)">';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }
            // Date, Unique
            if($type == "date" && $key == "UNI"){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="u-key"> <i class="fa-solid fa-key"></i></span></label>';
                $html .= '<input type="date" class="collector" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].' (Unique_key)">';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }
            // Date, not Primary , not Unique
            if($type == "date" && $key == ""){
                $html .= '<label class="label-form">'.$col_names[$i] .'<span class="p-key"></i></span></label>';
                $html .= '<input type="date" class="collector"  name="'.$col_names[$i].'" placeholder="'.$col_names[$i].'">';
                $input_names .= $col_names[$i]."**#9*";
                $input_types .= $type."**#9*";
            }



            
        }

    }
}


// print_r($col_key);



$_SESSION["input_names"] = $input_names;
$_SESSION["input_types"] = $input_types;


?>



 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fonts file -->
    <link rel="stylesheet" href="./../cdn/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="./js/handle_two.js"></script>
    <link rel="stylesheet" href="./css/lightHome.css">
    <link rel="stylesheet" href="css/edit_row.css">
    <link rel="stylesheet" href="css/insert.css">
    <title>InsertData - masterPanel</title>
 </head>
 <body>
     <h1 class="masterPanel-heading">masterPanel</h1>
     <div class="form-div">
         <div class="inner-form-div">
            <h2 class="edit-data-heading">Insert data in <?php echo $tb; ?></h2>
            <form action="./../Operations/insert.php" method="POST">
                <?php echo $html; ?>

                <input type="submit" name="insert_save" value="Insert Data" class="btn btn-primary btn-save">
            </form>
         </div>
     </div>
 </body>
 </html>


 <!-- 
        <label class="label-form">Username_db</label>
        <input type="text" class="collector" placeholder="Username">
        <label class="label-form">Username_db</label>
        <input type="date" class="collector" placeholder="Username">
        <label class="label-form">Username_db</label>
        <textarea class="textarea" placeholder="Enter Your Data"></textarea>
-->
<!-- 

// if in varchar , but not primary
        if(($col_type[$i] == "varchar") && ($col_isPri[$i] == '0')){
            $length = (int)$col_len[$i];
            if($length <= 100){
                
            }else if($length > 100){
               
            }
        }

        // if in varchar, and also primary

        if(($col_type[$i] == 'text') && ($col_isPri[$i] == '0') ){
           
        }
        if(($col_type[$i] == 'mediumtext' || $col_type[$i] == 'longtext') && ($col_isPri[$i] == '0')){
            
        }
        if(($col_type[$i] == 'int' || $col_type[$i] == 'tinyint' || $col_type[$i] == 'smallint' || $col_type[$i] == 'mediumint' || $col_type[$i] == 'bigint') && ($col_auto_incr[$i] == 1) && ($col_isPri[$i] == '0')){
            
        }
        if(($col_type[$i] == 'int' || $col_type[$i] == 'tinyint' || $col_type[$i] == 'smallint' || $col_type[$i] == 'mediumint' || $col_type[$i] == 'bigint') && ($col_auto_incr[$i] == 0) && ($col_isPri[$i] == '0')){
           
        }
        if(($col_type[$i] == 'date') && ($col_isPri[$i] == '0')){
          
        } -->