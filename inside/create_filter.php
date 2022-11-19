<?php
ob_start();
    include "./../logics/if_connected_db_delete.php";
    include "./../logics/connected_db.php";
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
    <script src="./js/filter.js"></script>
    <link rel="stylesheet" href="css/lightHome.css">
    <link rel="stylesheet" href="css/create-filter.css">
    <title>HomePage - masterPanel</title>
</head>
<body onload="create_filter_load();"> 
    <header class="header">

    </header>
    <section class="side">
        <div class="forBranding">
            <span class="branding">
                <span class="setting-logo"><i class="fa-solid fa-gear"></i></span>m-<span class="P-letter">P</span>anel
            </span>
        </div>
        <div class="forButtons">
            <button class="btn btn-purple btn-add-db"  >Add Filter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>
            <div class="more-btns">
                <a href="./" class="btn-sides "><i class="fa-solid fa-database"></i><span class="btnFont"> Databases</span></a>
                <a href="" class="btn-sides"><i class="fa-solid fa-user-group"></i><span class="btnFont">Authorities</span></a>
                <a href="Filteration.php" class="btn-sides active"><i class="fa-solid fa-window-maximize"></i><span class="btnFont">Filteration</span></a>
                <a href="./insight.php" class="btn-sides"><i class="fas fa-chart-pie"></i><span class="btnFont">Insight</span></a>
                <a href="./settings.php" class="btn-sides"><i class="fa-solid fa-gear"></i><span class="btnFont">Settings</span></a>
                <a href="./guideline.php" class="btn-sides"><i class="fa-solid fa-file-circle-exclamation"></i><span class="btnFont">Guidelines</span></a>
                <a href="./../Operations/logout.php" class="btn-sides"><i class="fa-solid fa-right-from-bracket"></i><span class="btnFont">Logout</span></a>
            </div>
        </div>
    </section>
    


    <div class="main-create">
        <!-- left part start -->
        <div class="create-filter-form-left" >
            <div class="upper-filter-div">
                <h1 class="create-filter-heading">
                Create a filter 
                </h1>
                <div class="for-right-dots">
                    <span class="tab-dot tab-dot-1"></span>
                    <span class="tab-dot tab-dot-3"></span>
                    <span class="tab-dot tab-dot-2"></span>
                </div>
                <div class="cb"></div>
            </div>

            <div class="main-screen-of-filter take-filter-name" onclick="focus_input();">
                <span class="terminal-font">
                    (C) masterPanel Original, Version 1.0.0, All right reserved<br>
                    masterPanel 
                    <span class="right-arrays"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-angle-right"></i></span>
                    create  filter
                </span>
                <div class="all-inputs" id="allinput">
                    <span class="error-message-in-terminal" id="error">
                        
                    </span>
                    <span class="success-message-in-terminal" id="success">
                        
                    </span>
<!-- Start inputs of filter -->

                <div class="terinal-input-div" id="data1">
                    <span class="filter-input-heading">
                        Enter the filter name
                        <span class="right-arrays"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-angle-right"></i></span>
                    </span>
                    <form name="f1" onsubmit="return form1()">
                        <input type="text" autocomplete="off" name="filter_name" id="input" class="filter-input">
                    </form>
                    <div class="cb"></div>
                </div>
                <!-- Data 2 -->
                <div class="terinal-input-div" id="data2">
                    <span class="filter-input-heading">
                        Do you have your query? (Y / N)
                        <span class="right-arrays"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-angle-right"></i></span>
                    </span>
                    <form name="f2" onsubmit="return form2()">
                        <input type="text" autocomplete="off" name="query_y_n" id="input" class="filter-input">
                    </form>
                    <div class="cb"></div>
                </div>
                <!-- Data 3 --> 
                <div class="terinal-input-div" id="data3">
                    <span class="filter-input-heading">
                        Enter Your Query
                        <span class="right-arrays"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-angle-right"></i></span>
                    </span>
                    <div class="query_inp_div">
                        <form name="f3" onsubmit="return form3()">
                            <div class="upper-input">
                                <input type="text" name="db_user_name"  class="q_input_1" required autocomplete="off" placeholder="Database User">
                                <input type="text" name="db_psw" autocomplete="off" class="q_input_2" placeholder="User's Password">
                                <div class="cb"></div>
                            </div>
                            <textarea type="text" placeholder="Enter your query here" autocomplete="off" name="query_inp" class="filter-area"></textarea>
                            <!-- <hr class="hr-line"> -->
                            <input type="submit" value="Enter Query" class="btn btn-primary btn-query">
                        </form>
                    </div>
                    
                    <div class="cb"></div>
                </div>
                <!-- Data 4 -->
                <div class="terinal-input-div" id="data4">
                    <span class="filter-input-heading">
                        Select the database in which your table is present<br>
                        
                        <?php
                            $n = 1;
                            for($x=$loop-1;$x>=0;$x--){
                                $dbname = $db_names[$x];
                                echo<<<dbs
                                    <span class='terminal-options' onclick="select_db('$dbname',$n)">$n. $db_names[$x] </span> <br>
dbs;
                                $n++;
                            }

                        ?>
                    </span>
                    
                    <div class="cb"></div>
                </div>

                <!-- Data 5 -->
                <div class="terinal-input-div" id="data5">
                    <span class="filter-input-heading">
                        Select Your Table 
                        <span class="right-arrays"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-angle-right"></i></span>
                        <br>
                    <?php
                        $m = 1;
                        for($z=$loop-1;$z>=0;$z--){
                            echo '<div style="display:none;" id="tabs'.$m.'">';
                            $n = 1;
                            for($t=0;$t<$db_table_count[$z];$t++){   
                                $tnames = $table_names[$z][$t];
                                echo<<<tabs
                                   <span class="terminal-options" onclick="select_tb('$tnames',$m,$n)">
                                        $n. $tnames 
                                   </span><br>
tabs;
                                $n++;
                            }
                            echo '</div>';
                            $m++;
                        }
                    ?>

                    </span>
                    
                    <div class="cb"></div>
                </div>

                
                <!-- Data 6 column names -->
                <div class="terinal-input-div" id="data6">
                    <span class="filter-input-heading">
                        Select a column on which you want to apply condition
                        <span class="right-arrays"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-angle-right"></i></span>
                        <br>
                    <?php
                        $m = 1;
                        for($z=$loop-1;$z>=0;$z--){
                            $connection = new mysqli($server,$db_user[$z],$db_psw[$z],$db_names[$z]);
                            $dbname = $db_names[$z];
                            $n = 1;
                            for($t=0;$t<$db_table_count[$z];$t++){   
                                $tname = $table_names[$z][$t];
                                $sql = "SELECT * FROM $dbname.$tname";
                                $fetch_mycols = $connection -> query($sql);
                                while($mycols = $fetch_mycols -> fetch_assoc()){
                                    $cols = array_keys($mycols);
                                }
                                echo '<div style="display:none;" id="cols'.$m.$n.'">';
                                $c = 1;
                                for($p=0;$p<count($cols);$p++){
                                    echo<<<cols
                                    <span class="terminal-options" onclick="select_col('$cols[$p]')">
                                            $c. $cols[$p]
                                    </span><br>
cols;
                                    $c++;
                                }
                                echo '</div>';
                                $n++;
                            }
                            $m++;
                        }
                    ?>

                    </span>
                    
                    <div class="cb"></div>
                </div>

                <!-- Data 7 -->
                <div class="terinal-input-div" id="data7">
                    <span class="filter-input-heading">
                        Which operation you want to perform on this column<br>
                            <span class="terminal-options" onclick="select_filter_type(1)">1. Less than</span><br>
                            <span class="terminal-options" onclick="select_filter_type(2)">2. More than</span><br>
                            <span class="terminal-options" onclick="select_filter_type(3)">3. Equal to</span><br>
                            <span class="terminal-options" onclick="select_filter_type(4)">4. Less than or equal to</span><br>
                            <span class="terminal-options" onclick="select_filter_type(5)">5. More than or equal to</span><br>
                            <span class="terminal-options" onclick="select_filter_type(6)">6. String starting with</span><br>
                            <span class="terminal-options" onclick="select_filter_type(7)">7. String ending with</span><br>
                            <span class="terminal-options" onclick="select_filter_type(8)">8. String present at any position</span><br>
                    </span>
                    
                    <div class="cb"></div>
                </div>
                <!-- Data 8 -->
                <div class="terinal-input-div" id="data8">
                    <span class="filter-input-heading">
                        Enter the value
                        <span class="right-arrays"><i class="fa-solid fa-angle-right"></i><i class="fa-solid fa-angle-right"></i></span>
                    </span>
                    <form name="f4" onsubmit="return save_filter_value()">
                        <input type="text" autocomplete="off" name="filter_value" id="input" class="filter-input">
                    </form>
                    <div class="cb"></div>
                </div>

                <!-- Data 9 -->
                <div class="proceed-div" id="data9">
                    <h6 class="proceed-text">Do you want to save this filter for future...?</h6>
                    <button class="btn btn-primary btn-proceed" onclick="save_or_not(1)">Yes, Save this filter</button>
                    <h6 class="proceed-text only-once-heading">Or you want this filter only for once?</h6>
                    <button class="btn btn-danger btn-proceed" onclick="save_or_not(0)">Yes, No need to save</button>
                </div>
                <div class="proceed-div" id="data10">
                    <h6 class="proceed-text">Do you want to save this filter for future?</h6>
                    <button class="btn btn-primary btn-proceed" onclick="save_or_not_q(1)">Yes, Save this filter</button>
                    <h6 class="proceed-text only-once-heading">Or you want this filter only for once?</h6>
                    <button class="btn btn-danger btn-proceed" onclick="save_or_not_q(0)">Yes, No need to save</button>
                </div>


<!-- end filter inputs -->
                </div>
            </div>



        </div>
        <!-- left part over -->
        <div class="right-filter-info">
            <div class="content-div">
                <h3 class="content-heading ch-1">What is filter?</h3>
                <span class="content-para">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quos dignissimos, itaque sunt sit iusto nemo, veniam ipsam sapiente deleniti aliquid praesentium impedit numquam repudiandae. Dolorem saepe odio et quo! Qui?
                </span>
            </div>
            <div class="content-div content-2">
                <h3 class="content-heading ch-2">How does its work?</h3>
                <span class="content-para">
                    Adipisicing elit. Quos dignissimos, itaque sunt sit iusto nemo, veniam ipsam sapiente deleniti aliquid praesentium impedit numquam repudiandae. Dolorem saepe odio et quo! Qui? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Totam, quibusdam!
                </span>
            </div>
        </div>
        <div class="cb"></div>
    </div>





<div id="new"></div>


<form name="dynamicForm1" id="alreadyQuery" method="POST" action="./../Operations/saveUserQuery.php">
    <input type="hidden" name="filtername" id="filtername" />
    <input type="hidden" name="db_user" id="db_user_inp" />
    <input type="hidden" name="user_ps" id="user_ps_inp" />
    <input type="hidden" name="filterquery" id="filterquery" />
    <input type="hidden" name="savestatus" id="save_or_not" />
</form>
<form name="dynamicForm2" id="makeQuery" method="POST" action="./../Operations/saveOurQuery.php">
    <input type="hidden" name="filtername" id="filtername2" />
    <input type="hidden" name="filterdb" id="filterdb" />
    <input type="hidden" name="filtertb" id="filtertb" />
    <input type="hidden" name="filtercol" id="filtercol" />
    <input type="hidden" name="filtertype" id="filtertype" />
    <input type="hidden" name="filtervalue" id="filtervalue" />
    <input type="hidden" name="savestatus" id="save_or_not_2" />
</form>

</body>
</html>