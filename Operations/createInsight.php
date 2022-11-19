<?php
ob_start();
include "./../database/db.php";

// masterPanel CopyRights - Panel Version v(1.0.0)
// maseterPanel - 2022 all right reserved

// Check For the authorities exists or not
$sql = "SHOW TABLES IN `$database`";
$insight_exist = 0;
// perform the query and store the result
$result = $con->query($sql);
$tables_counts = $result -> num_rows;
$looping = 0;
if($tables_counts != 0){
    while($row = $result->fetch_assoc()) {
        $table_names[$looping] = $row['Tables_in_'.$database];
        $looping = $looping + 1;
    }
    if(in_array("traffic",$table_names)){
        $insight_exist = 1;
    }
    
}else{
    $insight_exist = 0;
}


if($insight_exist == 0){
    include "./../Schema/insightSchema.php";
    if ($con->query($insight_schema) === TRUE) {
        $insight_exist = 1;
    }else {
        echo "Error creating table (traffic): (Refresh)" . $con->error;
        exit;
    }
}
header( "refresh:1;url=./../inside/insight.php" );


?>