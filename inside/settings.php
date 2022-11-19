<?php
ob_start();
    include "./../database/db.php";
    // get job
    $user = $_COOKIE["user"];
    $q = "SELECT job_post FROM authorities WHERE unique_id = '$user'";
    $getData = $con->query($q);
    while($r = mysqli_fetch_assoc($getData)){
        $MyPost = $r["job_post"];
        break;
    }



    $q = "SELECT * FROM dbs WHERE active = 1";
    $getOutput = $con->query($q);
    $noData = 0;
    $ii=0;
    if($getOutput->num_rows == 0){
        $noData = 1;
    }else{
        while($r = mysqli_fetch_assoc($getOutput)){
            $dbName[$ii] = $r["db"];
            $dbUser[$ii] = $r["db_user"];
            $ConnectedBy[$ii] = $r["connect_by"];
            $id[$ii] = $r["id"];
            $ii++;
        }
    }



    // get filters
    $q = "SELECT * FROM filterx";
    $getOutput = $con->query($q);
    $noFilterData = 0;
    $iii=0;
    if($getOutput->num_rows == 0){
        $noFilterData = 1;
    }else{
        while($r = mysqli_fetch_assoc($getOutput)){
            $filterName[$iii] = $r["filtername"];
            $filterCreator[$iii] = $r["filterCreater"];
            $filterQuery[$iii] = $r["filterQuery"];
            $filterid[$iii] = $r["id"];
            $iii++;
        }
    }



        // get authorities/admin
        $q = "SELECT * FROM authorities WHERE job_post != 1";
        $getOutput = $con->query($q);
        $noAdminData = 0;
        $iiii=0;
        if($getOutput->num_rows == 0){
            $noAdminData = 1;
        }else{
            while($r = mysqli_fetch_assoc($getOutput)){
                $AdminName[$iiii] = $r["fullname"];
                $AdminEmail[$iiii] = $r["email_id"];
                $AdminPhone[$iiii] = $r["phone_number"];
                $AdminRegisterBy[$iiii] = $r["parent"];
                $Adminid[$iiii] = $r["id"];
                $aid = $Adminid[$iiii];
                $AdminBlock = $r["block_status"];
                if($MyPost == '1'){
                    if($AdminBlock == '1'){
                        $AdminBtn[$iiii] = '<a href="./middleware/unblockAdmin.php?admin='.$aid.'"><button class="btn btn-success">Unblock</button></a>';
                    }if($AdminBlock == '0'){
                        $AdminBtn[$iiii] = '<a href="./middleware/blockAdmin.php?admin='.$aid.'"><button class="btn btn-danger">Block</button></a>';
                    }
                }
                else{
                    if($AdminBlock == '1'){
                        $AdminBtn[$iiii] = '<button class="btn btn-success disabled">Unblock</button>';
                    }if($AdminBlock == '0'){
                        $AdminBtn[$iiii] = '<button class="btn btn-danger disabled">Block</button>';
                    }
                }
                if($r["job_post"]=='2'){
                    $AdminPost[$iiii] = "Sub-Admin";
                }
                $iiii++;
            }
        }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./media/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="./js/handle.js"></script>
    <script src="./js/handle_two.js"></script>
    <link rel="stylesheet" href="css/lightHome.css">
    <link rel="stylesheet" href="css/setting.css">
    <title>Settings - masterPanel</title>
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
            <button class="btn btn-purple btn-add-db">Add Database &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>
            <div class="more-btns">
                <a href="./" class="btn-sides"><i class="fa-solid fa-database"></i><span class="btnFont"> Databases</span></a>
                <a href="Authorities.php" class="btn-sides"><i class="fa-solid fa-user-group"></i><span class="btnFont">Authorities</span></a>
                <a href="Filteration.php" class="btn-sides"><i class="fa-solid fa-window-maximize"></i><span class="btnFont">Filteration</span></a>
                <a href="./insight.php" class="btn-sides"><i class="fas fa-chart-pie"></i><span class="btnFont">Insight</span></a>
                <a href="./settings.php" class="btn-sides active"><i class="fa-solid fa-gear"></i><span class="btnFont">Settings</span></a>
                <a href="./guideline.php" class="btn-sides"><i class="fa-solid fa-file-circle-exclamation"></i><span class="btnFont">Guidelines</span></a>
                <a href="./../Operations/logout.php" class="btn-sides"><i class="fa-solid fa-right-from-bracket"></i><span class="btnFont">Logout</span></a>
            </div>
        </div>
    </section>

    <div class="main-setting">
        <div class="upper-in-settings">
            <button class="btn btn-for-settings active-setting" id="dbbtn" onclick="manageSettings(1)">Databases</button>
            <button class="btn btn-for-settings" id="filterbtn" onclick="manageSettings(2)">Filters</button>
            <button class="btn btn-for-settings" id="adminbtn" onclick="manageSettings(3)">Authorities</button>
            <div class="cb"></div>
        </div>
        <div class="down-in-settings">
            
        <!-- For Database Settings -->
            <div class="db-stngs" id="dbstng">
<?php

if($noData == 0){
echo<<<tabs0
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No.</th>
                <th scope="col">DataBase Name</th>
                <th scope="col">DB user</th>
                <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
tabs0;
$num = 1;
for($z=$ii-1;$z>=0;$z--){
echo<<<tabs

    <tr>
      <th scope="row">$num</th>
      <td>$dbName[$z]</td>
      <td>$dbUser[$z]</td>
      <td><a href="middleware/disconnectDb.php?db=$id[$z]"><button class="btn btn-danger">Disconnect</button></a></td>
    </tr>

tabs;
$num++;
}
echo '</tbody></table>';
}else{
    echo "<span class='no_data'>no database Connected</span>";
}
?>
            </div>
    <!-- FOR filter settings -->
            <div class="db-stngs" id="filterstng">
<?php

if($noFilterData == 0){
echo<<<tabs0
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Filter Name</th>
                <th scope="col">Filter Query</th>
                <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
tabs0;
$num = 1;
for($z=$iii-1;$z>=0;$z--){
echo<<<tabs

    <tr>
      <th scope="row">$num</th>
      <td>$filterName[$z]</td>
      <td>$filterQuery[$z]</td>
      <td><a href="middleware/disconnectFilter.php?id=$filterid[$z]"><button class="btn btn-danger">Remove</button></a></td>
    </tr>

tabs;
$num++;
}
echo '</tbody></table>';
}else{
    echo "<span class='no_data'>no filter exist</span>";
}
?>
            </div>


            <!-- Over -->

    <!-- FOR Admin settings -->
<div class="db-stngs" id="adminstng">
<?php

if($noAdminData == 0){
echo<<<tabs0
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Authority Name</th>
                <th scope="col">Authority Email</th>
                <th scope="col">Authority Mobile</th>
                <th scope="col">Post</th>
                <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
tabs0;
$num = 1;
for($z=$iiii-1;$z>=0;$z--){
echo<<<tabs

    <tr>
      <th scope="row">$num</th>
      <td>$AdminName[$z]</td>
      <td>$AdminEmail[$z]</td>
      <td>$AdminPhone[$z]</td>
      <td>$AdminPost[$z]</td> 
      <td>$AdminBtn[$z]</td>
    </tr>

tabs;
$num++;
}
echo '</tbody></table>';
}else{
    echo "<span class='no_data'>No Authorities</span>";
}
?>
            </div>


            <!-- Over -->


        </div>
    </div>


<div id="new"></div>

</body>
</html>

































<?php
    if(isset($_GET["q"])){
        $myQ = $_GET["q"];
        if($myQ == '1'){
echo<<<script1
            <script>
                document.getElementById("dbstng").style.display = "block";
                document.getElementById("filterstng").style.display = "none";
                document.getElementById("adminstng").style.display = "none";
        
                // change active btn
                document.getElementById("dbbtn").classList.add("active-setting");
                document.getElementById("filterbtn").classList.remove("active-setting");
                document.getElementById("adminbtn").classList.remove("active-setting");
            </script>
script1;
        }
        if($myQ == '2'){
echo<<<script2
            <script>
                document.getElementById("filterstng").style.display = "block";
                document.getElementById("dbstng").style.display = "none";
                document.getElementById("adminstng").style.display = "none";
                
                // change active btn
                document.getElementById("filterbtn").classList.add("active-setting");
                document.getElementById("dbbtn").classList.remove("active-setting");
                document.getElementById("adminbtn").classList.remove("active-setting");
            </script>
script2;
        }
        if($myQ == '3'){
echo<<<script3
            <script>
                document.getElementById("adminstng").style.display = "block";
                document.getElementById("filterstng").style.display = "none";
                document.getElementById("dbstng").style.display = "none";
                
                // change active btn
                document.getElementById("adminbtn").classList.add("active-setting");
                document.getElementById("filterbtn").classList.remove("active-setting");
                document.getElementById("dbbtn").classList.remove("active-setting");
            </script>
script3;
        }
    }
?>