

const goto_page = (page) => {
    var params = window.location.search;
    var hostname = window.location.hostname;
    var pathname = window.location.pathname;

    // FUll PAGE LINK WILL BE THIS
    var website = hostname + pathname + params;
    website = website + "&pg="+page;

    // PAGE PARAMS  WILL BE THIS
    params = params + "&pg="+page;
    
    // Check old parms
    var url = new URL(window.location.href);
    var pg = url.searchParams.get("pg");

    // alert(pg)
    if(pg == null){
        window.location.assign(params);        
    }else{
        var search_params = url.searchParams;
        search_params.set('pg', page);
        url.search = search_params.toString();
        window.location.assign(url.search);
    }
}

const pre_page = (num) => {
    num = num + 1;
    if(num == 1 || num < 0){
        return 0;
    }else{
        num = num - 1;
        goto_page(num);
    }
} 
const next_page = (num,max) => {
    num = num + 1;
    if(num == max || num > max){
        return 0;
    }else{
        num = num + 1;
        goto_page(num);
    }
} 

function enable_scrollbar(){
    // var style =  `.json-gap{margin-top:10rem;}`;
    document.getElementById("es").style.display = "none";
    document.getElementById("ds").style.display = "block";
    
    var styles = `
    .json-content::-webkit-scrollbar{
        display: block;
        width:14px;
    }
    .json-content{
        scrollbar-width: unset;
    }
`

var styleSheet = document.createElement("style")
styleSheet.setAttribute("id", "js-css");
styleSheet.innerText = styles
document.head.appendChild(styleSheet)
setCookie("scroll","1","366");
}

function disable_scrollbar(){
    document.getElementById("ds").style.display = "none";
    document.getElementById("es").style.display = "block";
    document.getElementById("js-css").remove();
    setCookie("scroll","2","-1");
}

function manageSettings(x){
    if(x == 1){
      

        
        // parms
        var url = new URL(window.location.href);
        var search_params = url.searchParams;
        search_params.set('q', '1');
        url.search = search_params.toString();
        var new_url = url.toString();
        window.location.assign(new_url);
    }
    if(x == 2){
       
        // parms
        var url = new URL(window.location.href);
        var search_params = url.searchParams;
        search_params.set('q', '2');
        url.search = search_params.toString();
        var new_url = url.toString();
        window.location.assign(new_url);

    }
    if(x == 3){
        
        // parms
        var url = new URL(window.location.href);
        var search_params = url.searchParams;
        search_params.set('q', '3');
        url.search = search_params.toString();
        var new_url = url.toString();
        window.location.assign(new_url);

    }
}

