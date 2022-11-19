<?php
ob_start();
    include "./../Operations/getAuthorities.php";
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
    <script src="./js/auth.js"></script>
    <link rel="stylesheet" href="css/lightHome.css">
    <link rel="stylesheet" href="css/viewTableLight.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Authorities - masterPanel</title>

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
            <?php echo $add_btn; ?>
            <div class="more-btns">
                <a href="./" class="btn-sides"><i class="fa-solid fa-database"></i><span class="btnFont"> Databases</span></a>
                <a href="Authorities.php" class="btn-sides active"><i class="fa-solid fa-user-group"></i><span class="btnFont">Authorities</span></a>
                <a href="Filteration.php" class="btn-sides"><i class="fa-solid fa-window-maximize"></i><span class="btnFont">Filteration</span></a>
                <a href="./insight.php" class="btn-sides"><i class="fas fa-chart-pie"></i><span class="btnFont">Insight</span></a>
                <a href="./settings.php" class="btn-sides"><i class="fa-solid fa-gear"></i><span class="btnFont">Settings</span></a>
                <a href="./guideline.php" class="btn-sides"><i class="fa-solid fa-file-circle-exclamation"></i><span class="btnFont">Guidelines</span></a>
                <a href="./../Operations/logout.php" class="btn-sides"><i class="fa-solid fa-right-from-bracket"></i><span class="btnFont">Logout</span></a>
            </div>
        </div>
    </section>
    
<?php
echo<<<x
    <h1 class="heading-type-1">
        Administrator :
    </h1>
    <div class="main-for-admin">
x;
if($Admin_exist == 1){
    for($i=$z-1;$i>=0;$i--){
        if($jobPost[$i] == '1'){
echo<<<admin
        <div class="admin-card">
            <div class="admin-img">
                <span class="user-icon"><i class="fa-solid fa-user-large"></i></span>
            </div>
            <div class="content-inCard">
                <div class="line text-truncate">
                    <span class="admin-content-text ques-text auth-post">Administrator</span>
                </div>
                <div class="line text-truncate">
                    <span class="admin-content-text ques-text">Name :</span>
                    <span class="admin-content-text answ-text">$auth_name[$i]</span>
                </div>
                <div class="line text-truncate">
                    <span class="admin-content-text ques-text">Email :</span>
                    <span class="admin-content-text answ-text">$authEmail[$i]</span>
                </div>
                <div class="line text-truncate">
                    <span class="admin-content-text ques-text">Mobile :</span>
                    <span class="admin-content-text answ-text"> $phNumber[$i]</span>
                </div>
                <div class="line">
                    <div class="for-card-btns">
                        <a href="mailto:$authEmail[$i]"><button class="btn btn-primary"><i class="fa-solid fa-envelope"></i></button></a>
                        <a href="tel:$phNumber[$i]"><button class="btn btn-success"><i class="fa-solid fa-phone"></i></button></a>
                    </div>
                    <div class="cb"></div>
                </div>
            </div>
        </div>
        
admin;
    }
}
}else{
    echo '<h6 class="no-data-heading no-sub-admin">No admin exist</h6>';

}
        echo '<div class="cb"></div>';
    echo '</div>';
echo<<<x
    <h1 class="heading-type-1 heading-margin">
        Sub-Administrators :
    </h1>
    <div class="main-for-admin">
x;
if($subAdmin_exist == 1){
    for($i=$z-1;$i>=0;$i--){
        if($jobPost[$i] == '2'){
echo<<<subAdmin
        <div class="admin-card">
            <div class="admin-img">
                <span class="user-icon"><i class="fa-solid fa-user-large"></i></span>
            </div>
            <div class="content-inCard">
                <div class="line text-truncate">
                    <span class="admin-content-text ques-text auth-post">Sub-Administrator</span>
                </div>
                <div class="line text-truncate">
                    <span class="admin-content-text ques-text">Name :</span>
                    <span class="admin-content-text answ-text"> $auth_name[$i]</span>
                </div>
                <div class="line text-truncate">
                    <span class="admin-content-text ques-text">Email :</span>
                    <span class="admin-content-text answ-text"> $authEmail[$i]</span>
                </div>
                <div class="line text-truncate">
                    <span class="admin-content-text ques-text">Mobile :</span>
                    <span class="admin-content-text answ-text">$phNumber[$i]</span>
                </div>
                <div class="line">
                    <div class="for-card-btns">
                        $block_button[$i]
                        <a href="mailto:$authEmail[$i]"><button class="btn btn-primary"><i class="fa-solid fa-envelope"></i></button></a>
                        <a href="tel:$phNumber[$i]"><button class="btn btn-success"><i class="fa-solid fa-phone"></i></button></a>
                    </div>
                    <div class="cb"></div>
                </div>
            </div>
        </div>
        
subAdmin;
    }
}
}else{
    echo '<h6 class="no-data-heading no-sub-admin">No Sub-admin exist</h6>';

}

        echo '<div class="cb"></div>';
    echo '</div>';

echo<<<managers
    <!-- Managers -->

    <h1 class="heading-type-1 heading-margin">
        Managers :
    </h1>
    <h6 class="no-data-heading">Manager's feature will available in next update (masterPanel 2.O)</h6>
managers;

?>
<div id="new"></div>

</body>
</html>