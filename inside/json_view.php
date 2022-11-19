<?php
ob_start();
    include "./../Operations/get_data.php";
    include "./../Operations/get_schema.php";
    include "./../Operations/handle_pages.php";


    
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
    <title><?php echo "JSON-View-".$db."-".$tb ?> - masterPanel</title>
</head>
<body onload="on_json_load(<?php echo $pageNeed; ?>);"> 

    
<!-- Loading before page load -->
<div class="loading-bgs" id="doc-load">
    <div class="loadings"></div>
</div>



    <header class="header">
        <div class="left-in-header">

        </div>
        <div class="right-in-header">
            <span class="head-btn"  onclick="window.location.assign('table_view.php?db=<?php echo $db; ?>&tb=<?php echo $tb; ?>');" id="tab-btn">Tabular &nbsp; <i class="bi bi-table"></i></span>
            <span class="head-btn active-header-btn" id="json-btn">Json { } </span>
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
    
<!-- main body -->

<div class="main-json-format" id="json-view">
    
    <div class="inner-main-json" id="json-screen">
        <div class="for-data-table-heading" id="json-head">
            <h1 class="data-table-heading">
                <span style="text-transform:capitalize;">
                <?php
                    echo $db.' </span> /  '.$tb; 
                    if($pageNeed == 1){
                        echo ' ('.($pg_number+1).')';
                    }
                ?>
            </h1>
            <div class="design-dots">
                <span class="dot red-dot" onclick="go_to('<?php echo $page_contains_row; ?>')">
                    <span class="goto_toolkit">Goto a specific column</span>
                </span>
                <span class="dot yellow-dot"></span>
                <span class="dot green-dot"></span>
                <div class="cb"></div>
            </div>
            <div class="cb"></div>
        </div>
        <!-- heading Part Complete -->
        <div class="json-content" id="jsc">
            <span class="square-bracket square-open">[</span>
                <div class="json-all-item" id="json-all">
<?php
if($total_rows != 0){
$x=0;
$y=$start_point;
$id = 1;
while($y<count($WholeData[0])){
$inner_comma = ",";
$outer_comma = ",";
$x=0;
echo<<<json1
                    <div class="json-item" id="json-item">
                        <span class="curly"  id="json$id">{</span>
json1;
while($x<count($cols)){
$value = $WholeData[$x][$y];
if($x==count($cols)-1){$inner_comma = "";}
echo<<<json2

                            <p class="jdata">
                                <span class="col-name">"$cols[$x]"</span>
                                <span class="colon">:</span>
                                <span class="col-value">"$value"</span>
                                <span class="comma">$inner_comma</span>
                            </p>

json2;
$x++;
}
if($y==count($WholeData[0])-1){$outer_comma="";}
if($pageNeed == 1){if($y == $start_point+999){$outer_comma="";}}
echo<<<json3

                        <span class="curly">} 
                            <span class="comma"> $outer_comma</span>
                        </span>
                    </div>
json3;
$y++;
$id++;
if($id > 1000){
    break;
}
}

}else{
    echo "<h6>No data in this table</h6>";
}
?>

                </div>
            <span class="square-bracket square-open">]</span>
        </div>

    </div>

    <div class="json-settings">
        <span class="settings-heading"><span class="pink">JS</span>ON<br>FOR<span class="pink">MAT</span></span>
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

        <span class="setting-1 json-gap">Font Size <span class="red">*</span></span>
        <select class="btn dropdown-font-size" id="selectjsonsize" onchange="json_font_size(0)">
            <option disabled selected value>Select Size</option>
            <option value="1">Small Size</option>
            <option value="2">Normal (Default)</option>
            <option value="3">Large</option>
            <option value="4">Extra Large</option>
            <option value="5">Maximum</option>
          </select>
        <span class="setting-1 json-gap">Json Theme <span class="red">*</span></span>
        <select class="btn dropdown-font-size" id="selectjsontheme" onchange="json_theme(0)">
            <option disabled selected value>Select Theme</option>
            <option value="1">Day (Default)</option>
            <option value="2">Night </option>
            <option value="3">Theme mix</option>
        </select>
        <span class="setting-1 json-gap">Font Family <span class="red">*</span></span>
        <select class="btn dropdown-font-size" id="selectjsonfonts" onchange="json_fonts(0)">
            <option disabled selected value>Select Fonts</option>
            <option value="1">Default Fonts</option>
            <option value="2">Font2 </option>
            <option value="3">Font3</option>
            <option value="4">Font4</option>
            <option value="5">Font5</option>
            <option value="6">Font6</option>
            <option value="7">Font7</option>
        </select>
        <span class="setting-1 json-gap">Json Sort</span>
        <select class="btn dropdown-font-size" id="tabsort" onchange="new_sorting(0);">
            <option disabled selected value>Sort JSON</option>
            <option value="1">Top Down (Default)</option>
            <option value="2">Bottom up </option>
        </select>
        <button class="btn btn-primary btn-save-settings">Copy Json Data </button>
        <button class="btn btn-success btn-enable-scrollbar" onclick="enable_scrollbar();" id="es">Enable Scrollbar </button>
        <button class="btn btn-danger btn-enable-scrollbar" onclick="disable_scrollbar();" id="ds">Disable Scrollbar </button>
    </div>


    <div class="cb"></div>
</div>


<!-- json end -->

<div id="new"></div>




</body>
</html>