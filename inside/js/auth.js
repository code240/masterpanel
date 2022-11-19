const add_auth = (uid) => {
    var auth_code = getHTML_Auth()
    // console.log(auth_code);
    document.getElementById("new").innerHTML = auth_code;
    document.getElementById("add-auth").style.display = "block";
}



const block_auth = (authId) => {
    var block_code = authBlockCode(authId)
    document.getElementById("new").innerHTML = block_code;
    document.getElementById("delete-div").style.display = "block";
}

const yes_block = (x,z) => {
    if(x == 1){
        window.location.assign("./../Operations/blockAuth.php?auth="+z);
    }
    else{
        document.getElementById("new").innerHTML = "";
    }
}











































function getHTML_Auth() {
    let add_auth =  `
                    <div class="black-bg" id="add-auth">
                        <div class="db-input-Div">
                            <h1 class="add-db-heading">Add a Sub-Administrator</h1>
                            <form action="./../Operations/add_auth.php" method="POST">
                                <div class="main-input-div">
                                    <div class="left-input">
                                        <label for="sa_name" class="form-label">Full Name</label>
                                        <input type="text" required autocomplete="off"  name="sa_name" id="sa_name" class="collector" placeholder="Sub-Admin Name">
                                        <label for="sa_email" class="form-label">Sub-admin's email</label>
                                        <input type="email" required autocomplete="off" name="sa_email" id="sa_email" class="collector" placeholder="Email Address">
                                    </div>
                                    <div class="right-input">
                                        <label for="sa_phone" class="form-label">Phone Number</label>
                                        <input type="text" required autocomplete="off" name="sa_phone" id="sa_phone" class="collector" placeholder="Mobile Number">
                                        <label for="Password" class="form-label">Password</label>
                                        <input type="Password" required autocomplete="off" name="sa_psw" id="Password" class="collector" placeholder="Enter password">
                                        <input type="hidden" value="2" name="job_post">
                                    </div>
                                    <div class="cb"></div>
                                </div>
                                <div class="for-btns">
                                    <button type="submit" name="connect" class="btn btn-warning btn-connect"><i class="fa-solid fa-plus"></i> &nbsp; Add</button>
                                    <button type="button" onclick="document.getElementById('add-auth').style.display = 'none';" class="btn btn-danger btn-connect">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
`;
return add_auth;
}


function authBlockCode(xyz){
    let code = `                          
                <div class="black-bg" id="delete-div">
                <div class="message-box"> 
                    <span class="alert-title">
                        Are You Sure?
                    </span>  
                    <p class="alert-message">
                        Are you sure that you want to block the Sub-Admin?
                    </p> 
                    <div class="for-dlts-btn">
                        <button class="btn btn-danger btn-delete-row" onclick="yes_block(1,'${xyz}');">
                            Block it
                        </button>
                        <button class="btn btn-secondary btn-cancel" onclick="yes_block(0,'${xyz}');">
                            Cancel
                        </button>
                        <div class="cb"></div>
                    </div>
                </div>
                </div>
    `;
    return code;
}

