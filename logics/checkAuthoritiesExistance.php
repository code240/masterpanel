<?php
include "./database/db.php";

// masterPanel CopyRights - Panel Version v(1.0.0)
// maseterPanel - 2022 all right reserved

// Check For the authorities exists or not
$sql = "SHOW TABLES IN `$database`";
$authorities_exist = 0;
$db_exist = 0;
$filter_exist = 0;
// perform the query and store the result
$result = $con->query($sql);
$tables_counts = $result -> num_rows;
$looping = 0;
if($tables_counts != 0){
    while($row = $result->fetch_assoc()) {
        $table_names[$looping] = $row['Tables_in_'.$database];
        $looping = $looping + 1;
    }
    if(in_array("authorities",$table_names)){
        $authorities_exist = 1;
    }
    if(in_array("dbs",$table_names)){
        $db_exist = 1;
    }
    if(in_array("filterx",$table_names)){
        $filter_exist = 1;
    }
}else{
    $authorities_exist = 0;
}

if($db_exist == 0){
    include "./Schema/dbs_schema.php";
    if ($con->query($dbs_schema) === TRUE) {
        $db_exist = 1;
    }else {
        echo "Error creating table (dbs): " . $con->error;
        exit;
    }
}
if($filter_exist == 0){
    include "./Schema/FilterSchema.php";
    if ($con->query($filter_schema) === TRUE) {
        $filter_exist = 1;
    }else {
        echo "Error creating table (filterx): " . $con->error;
        exit;
    }
}


?>