<?php
ob_start();
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
    <link rel="stylesheet" href="css/lightHome.css">
    <link rel="stylesheet" href="css/guideline.css">
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
            <button class="btn btn-purple btn-add-db"  >masterPanel</button>
            <div class="more-btns">
            <a href="./" class="btn-sides"><i class="fa-solid fa-database"></i><span class="btnFont"> Databases</span></a>
                <a href="Authorities.php" class="btn-sides"><i class="fa-solid fa-user-group"></i><span class="btnFont">Authorities</span></a>
                <a href="Filteration.php" class="btn-sides"><i class="fa-solid fa-window-maximize"></i><span class="btnFont">Filteration</span></a>
                <a href="./insight.php" class="btn-sides"><i class="fas fa-chart-pie"></i><span class="btnFont">Insight</span></a>
                <a href="./settings.php" class="btn-sides"><i class="fa-solid fa-gear"></i><span class="btnFont">Settings</span></a>
                <a href="" class="btn-sides active"><i class="fa-solid fa-file-circle-exclamation"></i><span class="btnFont">Guidelines</span></a>
                <a href="./../Operations/logout.php" class="btn-sides"><i class="fa-solid fa-right-from-bracket"></i><span class="btnFont">Logout</span></a>
            </div>
        </div>
    </section>
    


    <div class="guide">
        <h2 class="insight-guide-heading">
            How to use insight feature?
        </h2>
        <p class="guide-para">
            If you want to use masterPanel's insight
            feature then you have to include our 
            <span class="filename-guide">analytics.php</span>
            file in your home page of your website.
        </p>
        <p class="guide-para">
            After including that file, Whenever a user comes to your website
            we will able to identify that wether he/she is a new user or an 
            exisiting user.
        </p>
        <p class="guide-para">
            We will only be able to track the users of pages on which you have included our 
            <span class="filename-guide"> analytics.php</span> file. So, to get the better output, 
            You need to include our file in all your pages.
        </p>
        <h2 class="insight-guide-heading need-margin-here">
            How to include our analytics.php file?
        </h2>
        <div class="algo-div-guide">
            <span class="phptag-open">&lt;?php</span>  
                <span class="inc">include <span class="inc-inc">"./masterpanel/includes/analytics.php"</span>;</span>
                <span class="cmnt-php">// Your Code Here</span>
            <span class="phptag-close">?&gt;</span>
        </div>
    </div>



<div id="new"></div>

</body>
</html>