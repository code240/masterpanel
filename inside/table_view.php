<?php
ob_start();
    include "./../Operations/get_data.php";
    include "./../Operations/get_schema.php";
    include "./../Operations/handle_pages.php";

    
    $_SESSION["db_server"] = $dbs_server;
    $_SESSION["db_u"] = $dbs_user;
    $_SESSION["db_p"] = $dbs_psw;
    $_SESSION["db"] = $db;
    $_SESSION["tb"] = $tb;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
    <!-- fonts file -->
    <link rel="stylesheet" href="./../cdn/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <!-- My Files -->
    <script src="./js/handle.js"></script>
    <script src="./js/handle_two.js"></script>
    <link rel="stylesheet" href="css/lightHome.css">
    <link rel="stylesheet" href="css/viewJsonLight.css">
    <link rel="stylesheet" href="css/viewTableLight.css">
    <link rel="stylesheet" href="css/view_curd.css">
    <title><?php echo "Tabular-View-".$db."-".$tb ?> - masterPanel</title>
</head>
<body onload="on_table_load();"> 

    <!-- Loading before page load -->
    <div class="loading-bgs" id="doc-load">
        <div class="loadings"></div>
    </div>



    <header class="header">
        <div class="left-in-header">

        </div>
        <div class="right-in-header">
            <span class="head-btn active-header-btn"  id="tab-btn">Tabular &nbsp; <i class="bi bi-table"></i></span>
            <span class="head-btn" onclick="window.location.assign('json_view.php?db=<?php echo $db; ?>&tb=<?php echo $tb; ?>');" id="json-btn">Json { } </span>
        </div>
        <div class="cb"></div>
    </header>
    <section class="side">
        <div class="forBranding">
            <span class="branding">
                <span class="setting-logo"><i class="fa-solid fa-gear"></i></span>m-<span class="P-letter">P</span>anel
            </span>
        </div>
        <div class="forButtons">
            <button class="btn btn-purple btn-add-db"  >Add a Table &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>
            <div class="more-btns">
                <a href="./" class="btn-sides active"><i class="fa-solid fa-database"></i><span class="btnFont"> Databases</span></a>
                <a href="Authorities.php" class="btn-sides"><i class="fa-solid fa-user-group"></i><span class="btnFont">Authorities</span></a>
                <a href="Filteration.php" class="btn-sides"><i class="fa-solid fa-window-maximize"></i><span class="btnFont">Filteration</span></a>
                <a href="./insight.php" class="btn-sides"><i class="fas fa-chart-pie"></i><span class="btnFont">Insight</span></a>
                <a href="./settings.php" class="btn-sides"><i class="fa-solid fa-gear"></i><span class="btnFont">Settings</span></a>
                <a href="./guideline.php" class="btn-sides"><i class="fa-solid fa-file-circle-exclamation"></i><span class="btnFont">Guidelines</span></a>
                <a href="./../Operations/logout.php" class="btn-sides"><i class="fa-solid fa-right-from-bracket"></i><span class="btnFont">Logout</span></a>
            </div>
        </div>
    </section>





<!-- Tabular view start -->

<div class="tabular-main" id="tab-view">
    <div class="inner-main-tabular">
        <div class="for-tabular-heading">
            <h2 class="tabular-heading"><span style="text-transform:capitalize;"><?php echo $db; ?></span> / <?php echo $tb; ?></h2>
            <div class="for-tab-dots">
                <span class="tab-dot tab-dot-1" onclick="go_to_tab('<?php echo $page_contains_row; ?>')">
                    <span class="goto_toolkit-tab1">Goto a specific row</span>
                </span>
                <span class="tab-dot tab-dot-2"></span>
                <span class="tab-dot tab-dot-3"></span>
            </div>
            <div class="cb"></div>
        </div>
<?php
$id = 1;
if($total_rows!=0){
    echo '<div class="for-main-table">';
        echo '<table class="table ">';
            echo '<thead class="table-head">';
                echo '<tr>';
if($primary_exist == 1){                        
    echo '<th class="editing" scope="col">Edit</th>';
    echo '<th class="editing" scope="col">Delete</th>';
}
for($x=0;$x<count($cols);$x++){
    echo '<th scope="col">'.$cols[$x].'</th>';
}
?>
                    </tr>
                </thead>
                <tbody class="table-body">
<?php
for($y=$start_point;$y<count($WholeData[0]);$y++){
    if($primary_exist == 1){
        $primary_value = $WholeData[$primary_column_number_in_data][$y];
        echo '<tr id="tab'.$id.'">';
            echo<<<editBtn
            <td class="editing" id="edit_row"><button onclick="edit_row('$db','$tb','$primary_column_name','$primary_value')" class="btn btn-success">edit</button></td>
            <td class="editing" id="delete_row"><button onclick="delete_row('$primary_column_name','$primary_value','$pk_type')" class="btn btn-danger">delete</button></td>
editBtn;
    }
        for($x=0;$x<count($cols);$x++){
            echo '<td>'.$WholeData[$x][$y].'</td>';
        }        
    
    echo '</tr>';
    $id++;
    if($id > 1000){
        break;
    }

}
                echo '</tbody>';
            echo '</table>';
        echo '</div>';
}else{
    echo "<h6 class='no-data'>No data in this table</h6>";
}
?>
 
    </div>
    <div class="inner-tabular-settings">
        <span class="tab-settings-heading"><span class="pink">TAB</span>ULAR<br>FOR<span class="pink">MAT</span></span>

<!-- Control Page Settings -->

<?php

if($pageNeed == 1){
echo<<<pageNeed
        <span class="setting-1">Page Number <span class="red">*</span></span>
        <div class="div-for-pages" placeholder="Page Numbers" id="selectjsonpage" onchange="">
            <div class="for-next-pre">
                <button class="btn btn-primary btn-pre" onclick="pre_page($pg_number)"><i class="fa-solid fa-angles-left"></i> &nbsp; Pre</button>
                <button class="btn btn-primary btn-next" onclick="next_page($pg_number,$totalPage)">Next  &nbsp; <i class="fa-solid fa-angles-right"></i></button>
                <div class="cb"></div>
            </div>
            <div class="page-counts">
pageNeed;
        for($d=1;$d<=$totalPage;$d++){
            echo<<<pageNumbers
            <span class="page-numbers" onclick='goto_page($d);'>$d</span>

pageNumbers;
        }
echo<<<pageNeed


                <div class="cb"></div>
            </div>
        </div>
pageNeed;
}
?>

        <span class="tab-setting-1">Table Sort</span>
        <select class="btn dropdown-font-size" id="tabsort" onchange="new_sorting(0);">
            <option disabled selected value>Sort Table</option>
            <option value="1">Top Down (Default)</option>
            <option value="2">Bottom up </option>
        </select>
        <span class="tab-setting-1 table-gap">Operations on DB</span>
        <button class="btn btn-primary enable-editing-btn" onclick="enable_editing('<?php echo $primary_exist; ?>')">Enable Editing</button>
        <button class="btn btn-success enable-editing-btn" onclick="window.location.assign('insert_row.php')">Insert Data </button>
    </div>
    <div class="cb"></div>
</div>

<!-- Tabular view ends -->






<div id="new"></div>




<form action="middleware/set_edit_session.php" method="POST" id="edit_form">
    <input type="hidden" name="db" id="val_db">
    <input type="hidden" name="tb" id="val_tb">
    <input type="hidden" name="pk" id="val_pk">
    <input type="hidden" name="pv" id="val_pv">
</form>

<form action="./../Operations/delete_row.php" method="POST" id="delete_form">
    <input type="hidden" name="pk" id="del_pk">
    <input type="hidden" name="pv" id="del_pv">
    <input type="hidden" name="pt" id="del_pt">
</form>



<!-- <div class="black-bg"></div> -->



</body>
</html>