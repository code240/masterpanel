<?php
ob_start();
    error_reporting(0);
    include "./../database/db.php";
    include "./../logics/if_connected_db_delete.php";
    include "./../logics/connected_db.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="./js/handle.js"></script>
    <link rel="stylesheet" href="css/lightHome.css">
    <title>HomePage - masterPanel</title>
</head>
<body> 
    <header class="header">

    </header>
    <section class="side">
        <div class="forBranding">
            <span class="branding">
                <span class="setting-logo"><i class="fa-solid fa-gear"></i></span>m-<span class="P-letter">P</span>anel
            </span>
        </div>
        <div class="forButtons">
            <button class="btn btn-purple btn-add-db"  onclick="add_db('<?php echo $server; ?>');">Add Database &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>
            <div class="more-btns">
                <a href="" class="btn-sides active"><i class="fa-solid fa-database"></i><span class="btnFont"> Databases</span></a>
                <a href="Authorities.php" class="btn-sides"><i class="fa-solid fa-user-group"></i><span class="btnFont">Authorities</span></a>
                <a href="Filteration.php" class="btn-sides"><i class="fa-solid fa-window-maximize"></i><span class="btnFont">Filteration</span></a>
                <a href="./insight.php" class="btn-sides"><i class="fas fa-chart-pie"></i><span class="btnFont">Insight</span></a>
                <a href="./settings.php" class="btn-sides"><i class="fa-solid fa-gear"></i><span class="btnFont">Settings</span></a>
                <a href="./guideline.php" class="btn-sides"><i class="fa-solid fa-file-circle-exclamation"></i><span class="btnFont">Guidelines</span></a>
                <a href="./../Operations/logout.php" class="btn-sides"><i class="fa-solid fa-right-from-bracket"></i><span class="btnFont">Logout</span></a>
            </div>
        </div>
    </section>
    <h1 class="heading-type-1">
        Connected Databases :
    </h1>
    <div class="ForConnectedDb">

    <?php
    for($x=$loop-1;$x>=0;$x--){
        echo<<<dbs
            <div class="db-card" onclick="show_tables('$db_names[$x]')">
                <div class="db-icon" style="background-color:$db_bg[$x];">
                    <span class="card-icon" style="color:$db_color[$x];"><i class="fa-solid fa-database"></i></span>
                </div>
                <div class="db-content">
                    <span class="db-text-up text-truncate">$db_names[$x]</span>
                    <span class="db-text-down">$db_table_count[$x] Tables</span>
                </div>
                <div class="cb"></div>
            </div>
dbs;
    }

    ?>
        


       
    <div class="cb"></div>
</div>


<?php


for($z=$loop-1;$z>=0;$z--){
    $dname = $db_names[$z];
echo<<<tablesDisplay
<div class="forTables" id="$db_names[$z]">
    <h1 class="heading-type-2">
        $db_names[$z]<b style="color: red;"> / </b>Tables  :
    </h1>
    <div class="forTableCards">
tablesDisplay;    

$tcount = $db_table_count[$z];
if($tcount==0){
    echo "<span class='notice-no-table'>No Tables in this database</span>";
}else{
    for($t=0;$t<$db_table_count[$z];$t++){   
        $tnames = $table_names[$z][$t];
        $trows = $table_rows[$z][$t];
        $tcolor = $t_color[$z][$t];
        $tbg = $t_bgcolor[$z][$t];
    echo<<<tables_card
            <div class="table-card" onclick="view_table('$dname','$tnames')">
                <div class="table-icon" style="background-color:$tbg;">
                    <span class="card-icon" style="color:$tcolor;"><i class="fa-solid fa-table-cells"></i></span>
                </div>
                <div class="table-content">
                    <span class="table-text-up text-truncate">$tnames</span>
                    <span class="table-text-down">$trows Rows</span>
                </div>
                <div class="cb"></div>
            </div>
    tables_card;
    }
}

echo<<<tablesDisplay2

        <div class="cb"></div>
    </div>
    </div>

tablesDisplay2;

}

?>




<!-- Hide all tables div -->

<script>

<?php
echo "function hide_tables(){";
for($x=$loop-1;$x>=0;$x--){
    echo<<<Script
        document.getElementById("$db_names[$x]").style.display = 'none';
Script;
}

echo "}";
echo "hide_tables();";
?>

</script>

<script>
    const show_tables = (id) => {
        hide_tables();
        document.getElementById(id).style.display = 'block';
    }
    const view_table = (db,tb) => {
        var format = getCookie("format");
        if(format != ""){
            var page = "json_view.php";
        }else{
            format = parseInt(format);
        }
        if(format == 1){
            var page = "json_view.php";
        }else if(format == 2){
            var page = "table_view.php";
        }else{
            var page = "json_view.php";
        }
        window.location.assign(`${page}?db=${db}&tb=${tb}`);
    }
</script>

<div id="new"></div>

</body>
</html>