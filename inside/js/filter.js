
const create_filter_load = () => {
    document.getElementById("input").focus();
    document.getElementById("data9").style.display = "none";
    document.getElementById("data10").style.display = "none";
}

const focus_input = () => {
    document.getElementById("input").focus();
}


const form1 = () => {
    var error = document.getElementById("error")
    var success = document.getElementById("success")
    fname = document.forms["f1"]["filter_name"].value
    fname = fname.trim()
    var ok = 0
    if(fname == ""){
        error.innerText = "* Please enter the filter name."
        return false
    }
    if(fname.length < 4){
        error.innerText = "* Filter name must contain 4 characters. (4-30)"
        return false
    }
    if(fname.length < 4){
        error.innerText = "* Filter name can contain max 30 characters.(4-30)"
        return false
    }
    if (/^[a-zA-Z_]+$/.test(fname)) {
        if(fname[0] == "_"){
            error.innerText = "* Filter name cannot start with underscore."
            return false;
        }else{
            ok = 1
        }
    }else{
        error.innerText = "* Only alphabets and underscore are allowed here."
        return false;
    }
     

    if(ok == 1){
        document.getElementById("filtername").value = fname;
        document.getElementById("data1").remove()
        document.getElementById("data2").style.display = "block";
        success.innerText = "Filter name Save : " + fname;
        document.getElementById("input").focus();
        error.innerText = "";
        return false;

    }



    return false;
}


const form2 = () => {
    var error = document.getElementById("error")
    var success = document.getElementById("success")
    success.innerText = ""
    var resp = document.forms["f2"]["query_y_n"].value
    resp = resp.trim()
    if(resp == ""){
        error.innerText = "Please Enter input"
    }
    if(resp == "Y" || resp == "y"){
        document.getElementById("data2").remove()
        document.getElementById("data3").style.display = "block"
        document.getElementById("input").focus();
    }
    else if(resp == "N" || resp == "n"){
        document.getElementById("data2").remove()
        document.getElementById("data3").remove()
        document.getElementById("data4").style.display = "block"
    }
    else{
        error.innerText = "Please respond using Y / N"
    }
    return false
}

const form3 = () => {
    var error = document.getElementById("error")
    var success = document.getElementById("success")
    var query = document.forms["f3"]["query_inp"].value
    var db_user = document.forms["f3"]["db_user_name"].value
    var db_psw = document.forms["f3"]["db_psw"].value
    var first_word = ""
    for(var i = 0; i < 6; i++){
        first_word += query[i];
    }
    first_word = first_word.toLowerCase()
    if(first_word != "select"){
        error.innerText = "Only 'SELECT' query can be used in filter."
    }else{
        document.getElementById("filterquery").value = query;
        document.getElementById("db_user_inp").value = db_user;
        document.getElementById("user_ps_inp").value = db_psw;
        document.getElementById("data10").style.display = "block";
        document.getElementById("data3").style.display = "none";
        success.innerText = "Ok";
    }
    return false;
}


const select_db = (dbname,db_number) => {
    // var fname = document.forms["dynamicForm1"]["filtername"].value
    var tab_id = "tabs"+db_number
    var fname = document.getElementById("filtername").value
    document.getElementById("filtername2").value = fname;
    document.getElementById("filterdb").value = dbname;
    document.getElementById("data4").remove()
    document.getElementById("data5").style.display = "block";
    document.getElementById(tab_id).style.display = "block";

}
const select_tb = (tname,db_count,tb_count) => {
    var col_id = "cols"+db_count+tb_count
    document.getElementById("filtertb").value = tname;
    document.getElementById("data5").remove()
    document.getElementById("data6").style.display = "block";
    document.getElementById(col_id).style.display = "block";
}

const select_col = (colName) => {
    document.getElementById("filtercol").value = colName;
    document.getElementById("data6").remove()
    document.getElementById("data7").style.display = "block";

}
const select_filter_type = (type) => {
    document.getElementById("filtertype").value = type;
    document.getElementById("data7").remove();
    document.getElementById("data8").style.display = "block";
    document.getElementById("input").focus();
}
const save_filter_value = () => {
    var filtervalue = document.forms["f4"]["filter_value"].value
    document.getElementById("filtervalue").value = filtervalue
    document.getElementById("data8").remove();
    document.getElementById("data9").style.display = "block";
    return false
}
const save_or_not_q = (save) => {
    document.getElementById("save_or_not").value = save;
    document.getElementById("alreadyQuery").submit()
}

const save_or_not = (save) => {
    document.getElementById("save_or_not_2").value = save;
    document.getElementById("makeQuery").submit()
}

const stop_focus = () => {
    document.getElementById("filterQueryDiv").style.display = "block";
    document.getElementById("quer").style.display = "none";
}
const enable_focus = () => {
    document.getElementById("filterQueryDiv").style.display = "none";
    document.getElementById("quer").style.display = "block";
    document.getElementById('quer').focus()
}
const update_query = (q,id) => {
    var newQ = document.getElementById("quer").value;
    newQ = newQ.trim()
    if(newQ === q){
        alert("No change in query");
        return
    }
    document.getElementById("filterQueryDiv").innerText = newQ;
    document.getElementById("filterID").value = id
    document.getElementById("filterQuer").value = newQ
    document.getElementById("edit_quer_form").submit();
}