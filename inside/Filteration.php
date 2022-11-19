<?php
    ob_start();
    include "./../Operations/fetch_filter.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="./css/filteration.css">
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
            <button onclick="window.location.assign('create_filter.php')" class="btn btn-purple btn-add-db">Create a filter &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>
            <div class="more-btns">
                <a href="./" class="btn-sides"><i class="fa-solid fa-database"></i><span class="btnFont"> Databases</span></a>
                <a href="Authorities.php" class="btn-sides"><i class="fa-solid fa-user-group"></i><span class="btnFont">Authorities</span></a>
                <a href="" class="btn-sides active"><i class="fa-solid fa-window-maximize"></i><span class="btnFont">Filteration</span></a>
                <a href="./insight.php" class="btn-sides"><i class="fas fa-chart-pie"></i><span class="btnFont">Insight</span></a>
                <a href="./settings.php" class="btn-sides"><i class="fa-solid fa-gear"></i><span class="btnFont">Settings</span></a>
                <a href="./guideline.php" class="btn-sides"><i class="fa-solid fa-file-circle-exclamation"></i><span class="btnFont">Guidelines</span></a>
                <a href="./../Operations/logout.php" class="btn-sides"><i class="fa-solid fa-right-from-bracket"></i><span class="btnFont">Logout</span></a>
            </div>
        </div>
    </section>
    <h1 class="heading-type-1">
        Existing filters:
    </h1>
    <div class="ForConnectedDb">
<?php
if($filters_row>0){
 for($x=$filters_row-1;$x>=0;$x--){
    echo<<<filters
        <div class="db-card" onclick="window.location.assign('viewFilterTable.php?filter=$filterId[$x]')">
            <div class="db-icon" style="background-color:$db_bg[$x];">
                <span class="card-icon" style="color:$db_color[$x];"><i class="fa-solid fa-filter"></i></span>
            </div>
            <div class="db-content">
                <span class="db-text-up text-truncate">$filternames[$x]</span>
                <span class="db-text-down">$createrName[$x]</span>
            </div>
            <div class="cb"></div>
        </div>
filters;
}
}
?>
    </div>



    <?php
    if($filters_row == 0){
        echo<<<nofilter
        <div class="no-filter">
            <h6 class="no-filter-heading">No filter</h6>
            <button class="btn btn-purple btn-add-filter" onclick="window.location.assign('create_filter.php')"><i class="fa-solid fa-plus"></i> &nbsp; Add a filter</button>
        </div>
nofilter;
    }
    ?>

<div id="new"></div>

</body>
</html>