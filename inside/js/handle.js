
function on_json_load(pageNeed){
    var size = getCookie("size");
    var theme = getCookie("theme");
    var family = getCookie("font");
    var scroll = getCookie("scroll");
    setCookie("format","1","365");
    if(theme != ""){
        theme = parseInt(theme);
        json_theme(theme);
    }
    if(size != ""){
        size = parseInt(size);
        json_font_size(size);
    }
    if(family != ""){
        family = parseInt(family);
        json_fonts(family);
    }
    if(scroll != ""){
        scroll = parseInt(scroll);
        if(pageNeed == 1){
            if(scroll == 1){
                enable_scrollbar();
            }
        }
    }
    document.getElementById("doc-load").style.display = "none";
    
}
function on_table_load(){
    setCookie("format","2","365");
    document.getElementById("doc-load").style.display = "none";
}


const delete_row = (pk,pv,pt) => {
    document.getElementById("del_pk").value = pk;
    document.getElementById("del_pv").value = pv;
    document.getElementById("del_pt").value = pt;

    var code = getDeleteCode();
    document.getElementById("new").innerHTML = code;
    document.getElementById("delete-div").style.display = "block";
}

const yes_delete = (bool) => {
    if(bool == 1){
        document.getElementById("delete_form").submit();
    }else{
        document.getElementById("del_pk").value = "";
        document.getElementById("del_pv").value = "";
        document.getElementById("del_pt").value = "";
        document.getElementById("delete-div").style.display = "none";
    }
}

const edit_row = (db,tb,pk,pv) => {
    // sessionStorage.setItem("db",db);
    // sessionStorage.setItem("tb",tb);
    // sessionStorage.setItem("pk",pk);
    // sessionStorage.setItem("pv",pv);
    // window.location.assign("edit_row.php");
    document.getElementById("val_db").value = db;
    document.getElementById("val_tb").value = tb;
    document.getElementById("val_pk").value = pk;
    document.getElementById("val_pv").value = pv;
    document.getElementById("edit_form").submit();
}
const enable_editing = (edit) => {
    var loader = getLoaderCode();
    function hide_loading_with_error(){
        document.getElementById("loading").style.display = "none";
        document.getElementById("new").innerHTML  = "";
        var error_alert = getAlertCode();
        document.getElementById("new").innerHTML  = error_alert;
        document.getElementById("alert-div").style.display = "block";
    }
    
    function hide_loading_with_success(){
        document.getElementById("loading").style.display = "none";
        document.getElementById("new").innerHTML  = "";
        var editing = document.getElementsByClassName("editing");
        for(var i = 0; i < editing.length; i++){
            editing[i].style.display = "table-cell";
        }
        
    }

    if(edit==0){
        document.getElementById("new").innerHTML  = loader;
        document.getElementById("loading").style.display = "block";
        setTimeout(hide_loading_with_error,2000);
    }
    if(edit==1){
        document.getElementById("new").innerHTML  = loader;
        document.getElementById("loading").style.display = "block";
        setTimeout(hide_loading_with_success,500);
    }
}


const add_db = (server) => {
    add_database = getHTML();
    document.getElementById("new").innerHTML = add_database;
    document.getElementById("db-connect").style.display = "block";
    document.getElementById("server").value = server;
}

function go_to(max){
    var goto = prompt("Enter the data number you want to see! 1 to "+max);
    if(goto == null){return}
    goto = parseInt(goto);
    if(!Number.isInteger(goto)){
        alert("Incorrect Input!");
        return;
    }
    if(goto == 0){
        goto = 1;
    }
    if(goto < 0){
        return;
    }
    if(goto > max){
        alert("Data does not exist");
        return;
    }
    var id = "#json"+goto;
    // window.location.assign(id);
    window.location.hash = id;
}


function go_to_tab(max){
    var goto = prompt("Enter the data number you want to see! 1 to "+max);
    if(goto == null){return}
    goto = parseInt(goto);
    if(!Number.isInteger(goto)){
        alert("Incorrect Input!");
        return;
    }
    if(goto == 0){
        goto = 1;
    }
    if(goto < 0){
        return;
    }
    if(goto > max){
        alert("Data does not exist");
        return;
    }
    var id = "#tab"+goto;
    // window.location.assign(id);
    window.location.hash = id;
}

const json_font_size = (size) => {
    if(size==0){
        var selectBox = document.getElementById("selectjsonsize");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        size = parseInt(selectedValue);
        setCookie("size","0","366");
    }else{
        if(size==1){
            document.getElementById("json-all").style.fontSize = "1rem";
            setCookie("size","1","366");
        }
        if(size==2){
            document.getElementById("json-all").style.fontSize = "1.1rem";
            setCookie("size","2","366");
        }
        if(size==3){
            document.getElementById("json-all").style.fontSize = "1.25rem";
            setCookie("size","3","366");
        }
        if(size==4){
            document.getElementById("json-all").style.fontSize = "1.35rem";
            setCookie("size","4","366");
        }
        if(size==5){
            document.getElementById("json-all").style.fontSize = "1.5rem";
            setCookie("size","5","366");
        }
        return;    
    }
    if(size==1){
        document.getElementById("json-all").style.fontSize = "1rem";
        setCookie("size","1","366");
    }
    if(size==2){
        document.getElementById("json-all").style.fontSize = "1.1rem";
        setCookie("size","2","366");
    }
    if(size==3){
        document.getElementById("json-all").style.fontSize = "1.25rem";
        setCookie("size","3","366");
    }
    if(size==4){
        document.getElementById("json-all").style.fontSize = "1.35rem";
        setCookie("size","4","366");
    }
    if(size==5){
        document.getElementById("json-all").style.fontSize = "1.5rem";
        setCookie("size","5","366");
    }
}

const json_theme = (theme) => {
    if(theme==0){
        var selectBox = document.getElementById("selectjsontheme");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var theme = parseInt(selectedValue);
        setCookie("theme","0","366");    
    }else{
        if(theme == 1){
            default_theme();
            setCookie("theme","1","366"); 
        }
        if(theme == 2){
            night_theme();
            setCookie("theme","2","366"); 
        }
        if(theme == 3){
            night_two();
            setCookie("theme","3","366"); 
        }
        return true;
    }
    if(theme == 1){
        default_theme();
        setCookie("theme","1","366"); 
    }
    if(theme == 2){
        night_theme();
        setCookie("theme","2","366"); 
    }
    if(theme == 3){
        night_two();
        setCookie("theme","3","366"); 
    }
    
}
const json_fonts = (fonts) => {
    if(fonts==0){
        var selectBox = document.getElementById("selectjsonfonts");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var fonts = parseInt(selectedValue);
        setCookie("font","0","366"); 
        if(fonts == 1){
            document.getElementById("json-all").style.fontFamily = "inherit";
            setCookie("font","1","366"); 
        }
        if(fonts == 2){
            document.getElementById("json-all").style.fontFamily = "sans-serif";
            setCookie("font","2","366"); 
        }
        if(fonts == 3){
            document.getElementById("json-all").style.fontFamily = "verdana";
            setCookie("font","3","366"); 
        }
        if(fonts == 4){
            document.getElementById("json-all").style.fontFamily = "'Courier New', Courier, monospace";
            setCookie("font","4","366"); 
        }
        if(fonts == 5){
            document.getElementById("json-all").style.fontFamily = "'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif";
            setCookie("font","5","366"); 
        }
        if(fonts == 6){
            document.getElementById("json-all").style.fontFamily = "Cursive";
            setCookie("font","6","366"); 
        }
        if(fonts == 7){
            document.getElementById("json-all").style.fontFamily = "fantasy";
            setCookie("font","7","366"); 
        }
    }else{
        if(fonts == 1){
            document.getElementById("json-all").style.fontFamily = "inherit";
            setCookie("font","1","366"); 
        }
        if(fonts == 2){
            document.getElementById("json-all").style.fontFamily = "sans-serif";
            setCookie("font","2","366"); 
        }
        if(fonts == 3){
            document.getElementById("json-all").style.fontFamily = "verdana";
            setCookie("font","3","366"); 
        }
        if(fonts == 4){
            document.getElementById("json-all").style.fontFamily = "'Courier New', Courier, monospace";
            setCookie("font","4","366"); 
        }
        if(fonts == 5){
            document.getElementById("json-all").style.fontFamily = "'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif";
            setCookie("font","5","366"); 
        }
        if(fonts == 6){
            document.getElementById("json-all").style.fontFamily = "Cursive";
            setCookie("font","6","366"); 
        }
        if(fonts == 7){
            document.getElementById("json-all").style.fontFamily = "fantasy";
            setCookie("font","7","366"); 
        }
    }
}




function json_sorting(sort){
    var url_string = window.location.href;
    var url = new URL(url_string);
    var db = url.searchParams.get("db");
    var tb = url.searchParams.get("tb");
    
    var path = (window.location.origin)+(window.location.pathname);

    if(sort==0){
        var selectBox = document.getElementById("jsonsort");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var sort = parseInt(selectedValue);
        if(sort == 1){
            var target = path + "?db=" + db + "&tb=" + tb + "&sort=td";
            window.location.assign(target);
        }
        if(sort == 2){
            var target = path + "?db=" + db + "&tb=" + tb + "&sort=bu";
            window.location.assign(target);
        }
    }else{
        if(sort == 1){
            var target = path + "?db=" + db + "&tb=" + tb + "&sort=td";
            window.location.assign(target);
        }
        if(sort == 2){
            var target = path + "?db=" + db + "&tb=" + tb + "&sort=bu";
            window.location.assign(target);
        }
    }
}




function tab_sorting(sort){
    var url_string = window.location.href;
    var url = new URL(url_string);
    var db = url.searchParams.get("db");
    var tb = url.searchParams.get("tb");
    
    var path = (window.location.origin)+(window.location.pathname);

    if(sort==0){
        var selectBox = document.getElementById("tabsort");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var sort = parseInt(selectedValue);
        if(sort == 1){
            var target = path + "?db=" + db + "&tb=" + tb + "&sort=td";
            window.location.assign(target);
        }
        if(sort == 2){
            var target = path + "?db=" + db + "&tb=" + tb + "&sort=bu";
            window.location.assign(target);
        }
    }else{
        if(sort == 1){
            var target = path + "?db=" + db + "&tb=" + tb + "&sort=td";
            window.location.assign(target);
        }
        if(sort == 2){
            var target = path + "?db=" + db + "&tb=" + tb + "&sort=bu";
            window.location.assign(target);
        }
    }
}


function new_sorting(sort){
    var selectBox = document.getElementById("tabsort");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var sort = parseInt(selectedValue);


    var params = window.location.search;
    var hostname = window.location.hostname;
    var pathname = window.location.pathname;


    // Check old parms
    var url = new URL(window.location.href);
    var res = url.searchParams.get("sort");

    if(sort == 1){
        var search_params = url.searchParams;
        search_params.set('sort', "td");
        url.search = search_params.toString();
        window.location.assign(url.search);
    }
    if(sort == 2){
        var search_params = url.searchParams;
        search_params.set('sort', "bu");
        url.search = search_params.toString();
        window.location.assign(url.search);
    }


    

    
    
    
}

function night_two(){
    var myclass = document.getElementsByClassName("col-name");
    var myclass2 = document.getElementsByClassName("col-value");
    var myclass3 = document.getElementsByClassName("square-bracket");
    var colon = document.getElementsByClassName("colon");
    var comma = document.getElementsByClassName("comma");
    var curly = document.getElementsByClassName("curly");

    document.getElementById("json-head").style.backgroundColor = "#001c64";
    document.getElementById("json-screen").style.backgroundColor = "#051336";
    for (var i = 0; i < myclass.length; i++) {
        myclass[i].style.color="#9966b8";
        myclass2[i].style.color="#22aa44";
    }
    for (var i = 0; i < myclass3.length; i++) {
        myclass3[i].style.color="#f4bf75";
    }
    for (var i = 0; i < colon.length; i++) {
        colon[i].style.color="#6688cc";
    }
    for (var i = 0; i < comma.length; i++) {
        comma[i].style.color="#6688cc";
    }
    for (var i = 0; i < curly.length; i++) {
        curly[i].style.color="#ffd700";
    }    
}
function night_theme(){
    var myclass = document.getElementsByClassName("col-name");
    var myclass2 = document.getElementsByClassName("col-value");
    var myclass3 = document.getElementsByClassName("square-bracket");
    var colon = document.getElementsByClassName("colon");
    var comma = document.getElementsByClassName("comma");
    var curly = document.getElementsByClassName("curly");
    document.getElementById("json-head").style.backgroundColor = "#000000";
    document.getElementById("json-screen").style.backgroundColor = "#1e1e1e";
    for (var i = 0; i < myclass.length; i++) {
        myclass[i].style.color="#94d8fc";
        myclass2[i].style.color="#d18f74";
    }
    for (var i = 0; i < myclass3.length; i++) {
        myclass3[i].style.color="#fff";
    }
    for (var i = 0; i < colon.length; i++) {
        colon[i].style.color="#fff";
    }
    for (var i = 0; i < comma.length; i++) {
        comma[i].style.color="#fff";
    }
    for (var i = 0; i < curly.length; i++) {
        curly[i].style.color="#fff";
    }
}


function default_theme(){
    var myclass = document.getElementsByClassName("col-name");
        var myclass2 = document.getElementsByClassName("col-value");
        var myclass3 = document.getElementsByClassName("square-bracket");
        var colon = document.getElementsByClassName("colon");
        var comma = document.getElementsByClassName("comma");
        var curly = document.getElementsByClassName("curly");
        document.getElementById("json-head").style.backgroundColor = "#752bdf";
        document.getElementById("json-screen").style.backgroundColor = "#fefefe";
        for (var i = 0; i < myclass.length; i++) {
            myclass[i].style.color="#ff0000";
            myclass2[i].style.color="#0000ff";
        }
        for (var i = 0; i < myclass3.length; i++) {
            myclass3[i].style.color="green";
        }
        for (var i = 0; i < colon.length; i++) {
            colon[i].style.color="#000";
        }
        for (var i = 0; i < comma.length; i++) {
            comma[i].style.color="#000";
        }
        for (var i = 0; i < curly.length; i++) {
            curly[i].style.color="green";
        }
}


function getAlertCode(){
    let code = `
                <div class="black-bg" id="alert-div">
                    <div class="message-box"> 
                        <span class="alert-title">
                            Error
                        </span>  
                        <p class="alert-message">
                            You cannot edit this table because it doesnot have any <b>primary key </b>
                        </p> 
                        <button class="btn btn-danger btn-ok" onclick="document.getElementById('alert-div').style.display = 'none';">
                            Okay
                        </button>
                    </div>
                </div>
    `;
    return code;
}

function getDeleteCode(){
    let code = `                          
                <div class="black-bg" id="delete-div">
                <div class="message-box"> 
                    <span class="alert-title">
                        Are You Sure?
                    </span>  
                    <p class="alert-message">
                        Are you sure that you want to delete this row? This will not recover by us after deletion.
                    </p> 
                    <div class="for-dlts-btn">
                        <button class="btn btn-danger btn-delete-row" onclick="yes_delete(1);">
                            Delete it
                        </button>
                        <button class="btn btn-secondary btn-cancel" onclick="yes_delete(0);">
                            Cancel
                        </button>
                        <div class="cb"></div>
                    </div>
                </div>
                </div>
    `;
    return code;
}


function getLoaderCode() {
    let loader = `
            <div class="black-bg" id="loading">
                <div class="for-loading">
                    <div class="loading"></div>
                </div>
            </div> 
    `;
    return loader;
}

function getHTML() {
    let add_database =  `
                    <div class="black-bg" id="db-connect">
                        <div class="db-input-Div">
                            <h1 class="add-db-heading">Connect With Your Database</h1>
                            <form action="./../Operations/connect_db.php" method="POST">
                                <div class="main-input-div">
                                    <div class="left-input">
                                        <label for="server" class="form-label">Server Name</label>
                                        <input type="text" required autocomplete="off" name="server" id="server" class="collector" placeholder="Server Name">
                                        <label for="User" class="form-label">Username</label>
                                        <input type="text" required autocomplete="off" name="user" id="User" class="collector" placeholder="User Name">
                                    </div>
                                    <div class="right-input">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" autocomplete="off" name="psw" id="password" class="collector" placeholder="Password">
                                        <label for="dbname" class="form-label">Database Name</label>
                                        <input type="text" required autocomplete="off" name="dbname" id="dbname" class="collector" placeholder="Database name">
                                    </div>
                                    <div class="cb"></div>
                                </div>
                                <div class="for-btns">
                                    <button type="submit" name="connect" class="btn btn-warning btn-connect">Connect</button>
                                    <button type="button" onclick="document.getElementById('db-connect').style.display = 'none';" class="btn btn-danger btn-connect">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
`;
return add_database;
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

