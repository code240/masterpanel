<?php
ob_start();
session_start();
$db = $_SESSION["db"];
$db_server = $_SESSION["db_server"];
$db_user = $_SESSION["db_u"];
$db_psw = $_SESSION["db_p"];
$tb = $_SESSION["tb"];
$pk = $_SESSION["pk"];
$pv = $_SESSION["pv"];
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

$supported = ["int","varchar","text","mediumtext","longtext","date","tinyint","smallint","mediumint","bigint"];
$primary_exist = 0;
$xx=0;
$primary_column_number = -1;
$primary_column_name = "";
while($schema = $getSchema->fetch_assoc()){
    // print("<pre>".print_r($schema,true)."</pre>");
    if($schema["EXTRA"] == "auto_increment"){
        array_push($col_auto_incr,1);
    }else{
        array_push($col_auto_incr,0);
    }
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


$pk_type =  $col_type[$primary_column_number];

$_SESSION["pk_type"] = $pk_type;



// Get Data
$sql2 = "SELECT * FROM $tb WHERE $pk = ";

if($pk_type == "tinyint" || $pk_type == "smallint" || $pk_type == "mediumint" || $pk_type == "int" || $pk_type == "bigint"){
    $sql2 .= $pv;
}else{
    $sql2 .= "'".$pv."'";
}

// echo $sql2."<br>";
$res_vals = $connect->query($sql2);
if($res_vals -> num_rows == 0){
    echo "Data Fetch Error";
    exit;
}
$col_values = [];
$ii=0;
while($vals = $res_vals->fetch_assoc()){
    for($ii=0;$ii<count($col_names);$ii++){
        array_push($col_values,$vals[$col_names[$ii]]);
    }
    break;
}

// print_r($col_values);




$cols_names_str = "";
$cols_type_str = "";

 
$html = "<input type='hidden' name='$pk' value='$pv' >";
for($i = 0; $i < count($col_type); $i++){
    if(in_array($col_type[$i],$supported)){
        if(($col_type[$i] == "varchar")){
            $length = (int)$col_len[$i];
            if($length <= 100){
                $html .= '<label class="label-form">'.$col_names[$i].'</label>';
                $html .= '<input type="text" autocomplete="off" class="collector" value="'.$col_values[$i].'" name="'.$col_names[$i].'" placeholder="'.$col_names[$i].'">';
                $cols_names_str .= $col_names[$i]."**#9*";
                $cols_type_str .= $col_type[$i]."**#9*";
            }else if($length > 100){
                $html .= '<label class="label-form">'.$col_names[$i].'</label>';
                $html .= '<textarea class="textarea" name="'.$col_names[$i].'" placeholder="Enter Your Data">'.$col_values[$i].'</textarea>';
                $cols_names_str .= $col_names[$i]."**#9*";
                $cols_type_str .= $col_type[$i]."**#9*";
            }
        }
        if(($col_type[$i] == 'text')  ){
            $html .= '<label class="label-form">'.$col_names[$i].'</label>';
            $html .= '<textarea class="textarea" name="'.$col_names[$i].'" placeholder="Enter Your Data">'.$col_values[$i].'</textarea>';
            $cols_names_str .= $col_names[$i]."**#9*";
            $cols_type_str .= $col_type[$i]."**#9*";
        }
        if(($col_type[$i] == 'mediumtext' || $col_type[$i] == 'longtext')){
            $html .= '<label class="label-form">'.$col_names[$i].'</label>';
            $html .= '<textarea class="textarea big-text" name="'.$col_names[$i].'" placeholder="Enter Your Data">'.$col_values[$i].'</textarea>';
            $cols_names_str .= $col_names[$i]."**#9*";
            $cols_type_str .= $col_type[$i]."**#9*";
        }
        if(($col_type[$i] == 'int' || $col_type[$i] == 'tinyint' || $col_type[$i] == 'smallint' || $col_type[$i] == 'mediumint' || $col_type[$i] == 'bigint') && ($col_auto_incr[$i] == 1) && ($col_isPri[$i] == '0')){
            $html .= '<label class="label-form">'.$col_names[$i].'</label>';
            $html .= '<input type="number"  autocomplete="off" name="'.$col_names[$i].'" value="'.$col_values[$i].'" class="collector red-placeholder" placeholder="Leave this column as it is. (Auto Increment)">';
            $cols_names_str .= $col_names[$i]."**#9*";
            $cols_type_str .= $col_type[$i]."**#9*";
        }
        if(($col_type[$i] == 'int' || $col_type[$i] == 'tinyint' || $col_type[$i] == 'smallint' || $col_type[$i] == 'mediumint' || $col_type[$i] == 'bigint') && ($col_auto_incr[$i] == 0) && ($col_isPri[$i] == '0')){
            $html .= '<label class="label-form">'.$col_names[$i].'</label>';
            $html .= '<input type="number"  autocomplete="off" name="'.$col_names[$i].'" value="'.$col_values[$i].'" class="collector" placeholder="'.$col_names[$i].'">';
            $cols_names_str .= $col_names[$i]."**#9*";
            $cols_type_str .= $col_type[$i]."**#9*";
        }

        if(($col_type[$i] == 'int' || $col_type[$i] == 'tinyint' || $col_type[$i] == 'smallint' || $col_type[$i] == 'mediumint' || $col_type[$i] == 'bigint') && ($col_auto_incr[$i] == 0) && ($col_isPri[$i] == '1')){
            $html .= '<label class="label-form">'.$col_names[$i].'</label>';
            $html .= '<input type="number"  autocomplete="off" name="'.$col_names[$i].'" value="'.$col_values[$i].'" class="collector" placeholder="'.$col_names[$i].' (Primary Key)">';
            $cols_names_str .= $col_names[$i]."**#9*";
            $cols_type_str .= $col_type[$i]."**#9*";
        }


        if(($col_type[$i] == 'date')){
            $html .= '<label class="label-form">'.$col_names[$i].'</label>';
            $html .= '<input type="date"  autocomplete="off" name="'.$col_names[$i].'" value="'.$col_values[$i].'" class="collector" placeholder="'.$col_names[$i].'">';
            $cols_names_str .= $col_names[$i]."**#9*";
            $cols_type_str .= $col_type[$i]."**#9*";
        }
    }
}

$_SESSION["mycols"] = $cols_names_str;
$_SESSION["mytypes"] = $cols_type_str;
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
    <title>Edit Data</title>
 </head>
 <body>
     <h1 class="masterPanel-heading">masterPanel</h1>
     <div class="form-div">
         <div class="inner-form-div">
            <h2 class="edit-data-heading">Edit Tupple of <?php echo $tb; ?></h2>
            <form action="./../Operations/update.php" method="POST">
                <?php echo $html; ?>

                <input type="submit" name="update_save" value="Update" class="btn btn-primary btn-save">
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