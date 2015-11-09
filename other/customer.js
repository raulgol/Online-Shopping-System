// this is the .js file for the whole website

// load the home page of the site
function startPage() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/startpage',// 
        //data:,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //alert(txt);
            $("#save_nav_bar").html(txt); 
            //document.getElementById('save_nav_bar').innerHTML = txt;
            dispLoginNavBar();
            //
        },
        error:function(){
            alert('Error');
        }
    })
    
}

// display the navigation bar. If the user has logged in, his/her name will be displayed
function dispLoginNavBar() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/displayNavBar',// 
        //data:'case='+case,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#login_nav").html(txt); 
            //document.getElementById('login_nav').innerHTML = txt;
            //alert('dis login bar');
           navBarCartNumber();
        },
        error:function(){
            alert('Error');
        }
    })
}

// display special deals products 
function special(cid) {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/display_special',// 
        data:'cid='+cid,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#product_info").html(txt); 
            dispLoginNavBar();
            //document.getElementById('product_info').innerHTML = txt;
        },
        error:function(){
            alert('Error');
        }
    })
}

// display all the products
function regular_page(category_id) {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/regularPage',// 
        data:'cid='+category_id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //alert(txt);
            $("#product_info").html(txt); 
            dispLoginNavBar();
            //document.getElementById('product_info').innerHTML = txt;
        },
        error:function(){
            alert('Error');
        }
    })
}

// display the login page
function dispLoginPage() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/disp_login_page',// 
       // data:'cid='+category_id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#save_nav_bar").html(txt);
            //document.getElementById('save_nav_bar').innerHTML = txt;
            //dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    })
}

// pass the login information to server and check correctness
function login_confirm() {

    var un = $('#id_txt_0_un').val();//document.getElementById('').value;
    var pw = $('#id_txt_1_pw').val();//document.getElementById('id_txt_1_pw').value;

    if((un == null || un == '') && (pw == null || pw == '')) {
        $("#id_div_login_err").html(''); 
        //document.getElementById('').innerHTML = ;
        return;
    }
    if((un == null || un == '') || (pw == null || pw == '')) {
        $("#id_div_login_err").html('Invalid Login'); 
        //document.getElementById('').innerHTML = '';
        return;
    }

    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/login_confirm',// 
        data:'username='+un+'&'+'password='+pw,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //alert(txt);//
            if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                return;
            }
            if(txt=='0' || txt==0) {

                startPage();
                //dispLoginNavBar();
            }
            if(txt=='1' || txt==1) {
                $("#id_div_login_err").html('');
                //document.getElementById('id_div_login_err').innerHTML = '';
            }
            if (txt=='2' || txt==2) {
                $("#id_div_login_err").html('Invalid Login');
                //document.getElementById('id_div_login_err').innerHTML = 'Invalid Login';
            }
            if (txt=='3' || txt==3) {
                cart();
                dispLoginNavBar();
            } 
        },
        error:function(){
            alert('Error');
        }
    })
}

// create account
function createAccount() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/display_create_acc',// 
       // data:'cid='+category_id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#save_nav_bar").html(txt);
            //document.getElementById('save_nav_bar').innerHTML = txt;
            dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    })
}

// log out
function cusLogOut() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/cus_log_out',// 
       // data:'cid='+category_id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //document.getElementById('id_div_1_table').innerHTML = txt;
            startPage();
            //dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    })
}

// modify password
function editProfilePassword() {//view_edit_profile_password.php
   // document.getElementById('save_nav_bar').innerHTML =  '<div id="product_content" style="height:440px"><div id="product_head">Account Management</div><div style="margin-left:auto;margin-right:auto;width:550px;position:relative;top:30%;"><div style="float:left"><input type="button" value="Edit Your Profile" onclick="editProfileDisp()" style="width:200px;height:60px;font-size:15pt"></div><div style="float:left;width:150px;height:60px"></div><div style="float:left"><input type="button" onclick="changePasswordDisp()" value="Change Password" style="width:200px;height:60px;font-size:15pt"></div><div style="clear:both"></div></div></div>'; 
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/view_edit_profile_password',// 
        
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
             $("#save_nav_bar").html(txt); 
            //document.getElementById('').innerHTML = ;
            dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    })
}

// modify user's profile
function editProfileDisp() {
        $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/edit_profile_display',// 
 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#save_nav_bar").html(txt);
            dispLoginNavBar();
            //document.getElementById('save_nav_bar').innerHTML = txt;

        },
        error:function(){
            alert('Error');
        }
    })
}

// display the page of modifying password
function changePasswordDisp() {
     $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/change_password_disp',// 
 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#save_nav_bar").html(txt);
            dispLoginNavBar();
            //document.getElementById('save_nav_bar').innerHTML = txt;

        },
        error:function(){
            alert('Error');
        }
    })
    //document.getElementById('save_nav_bar').innerHTML = '';
}

// the submit button of changing password
function changePasswordConfirm() {
    var pw0 = $('#id_change_pw_0').val();//document.getElementById('id_change_pw_0').value;
    var pw1 = $('#id_change_pw_1').val();//document.getElementById('id_change_pw_1').value;

    if((pw0==null || pw0=='')&&(pw1==null||pw1=='')) {
        $("#id_change_pe_err_msg").html('Password must be at least 6 characters long.');
        //document.getElementById('id_change_pe_err_msg').innerHTML = 'Password must be at least 6 characters long.';
        return;
    }
    if((pw0==null || pw0=='')||(pw1==null||pw1=='')) {
        $("#id_change_pe_err_msg").html('Please enter a password and confirm it.');
        //document.getElementById('id_change_pe_err_msg').innerHTML = 'Please enter a password and confirm it.';
        return;
    }
    if(pw0!=pw1) {
        $("#id_change_pe_err_msg").html('Please check that your passwords match and try again.');
        //document.getElementById('id_change_pe_err_msg').innerHTML = 'Please check that your passwords match and try again.';
        return;
    }
    if(pw0.length <6) {
        $("#id_change_pe_err_msg").html('Password must be at least 6 characters long.');
        //document.getElementById('id_change_pe_err_msg').innerHTML = 'Password must be at least 6 characters long.';
        return;
    }
    //alert("changepassword");

    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/change_password',// 
        data:'pw0='+pw0+'&'+'pw1='+pw1,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                return;
            }
            //alert(txt);
            // 0:Password must be at least 6 characters long. 1:Please enter a password and confirm it. 2:Please check that your passwords match and try again. 3:Password has been changed! 4:Error: password has not been changed.
             
            if(txt=='0' || txt==0) {
                $("#id_change_pe_err_msg").html('Password must be at least 6 characters long.');
                //document.getElementById('id_change_pe_err_msg').innerHTML = 'Password must be at least 6 characters long.';
            }
            if(txt=='1' || txt==1) {
                $("#id_change_pe_err_msg").html('Please enter a password and confirm it.');
                //document.getElementById('id_change_pe_err_msg').innerHTML = 'Please enter a password and confirm it.';
            }
            if(txt=='2' || txt==2) {
                $("#id_change_pe_err_msg").html('Please check that your passwords match and try again.');
                //document.getElementById('id_change_pe_err_msg').innerHTML = 'Please check that your passwords match and try again.';
            }
            if(txt=='3' || txt==3) {
                change_pw_succeed();     
            }
            if(txt=='4' || txt==4) {
                $("#id_change_pe_err_msg").html('Error: password has not been changed.');
                //document.getElementById('id_change_pe_err_msg').innerHTML = 'Error: password has not been changed.';
            }
             
        },
        error:function(){
            alert('Error');
        }
    })

   
}

// if change the password successfully
function change_pw_succeed() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/change_pw_succeed',// 
        //data:'pw0='+pw0+'&'+'pw1='+pw1,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            // 0:Password must be at least 6 characters long. 1:Please enter a password and confirm it. 2:Please check that your passwords match and try again. 3:Password has been changed! 4:Error: password has not been changed.
            // document.getElementById('').innerHTML = ;
             $("#save_nav_bar").html(txt);
        },
        error:function(){
            alert('Error');
        }
    })                
}

// submit button to create a new account
function createAccountConfirm() {
    var un = $('#create_acc_un').val();//document.getElementById('create_acc_un').value;
    var pw0 = $('#create_acc_pw0').val();//document.getElementById('create_acc_pw0').value;
    var pw1 = $('#create_acc_pw1').val();//document.getElementById('create_acc_pw1').value;
    var fn = $('#create_acc_f_name').val();//document.getElementById('create_acc_f_name').value;
    var ln = $('#create_acc_l_name').val();//document.getElementById('create_acc_l_name').value;
    var em = $('#create_acc_email').val();//document.getElementById('create_acc_email').value;
 
    if(un==null || un=='') {
        $("#id_error_create_acc_0").html('Please enter your username.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Please enter your username.';
        return;
    }
    var pattern = new RegExp("^[a-zA-Z0-9_]{3,30}$");
    if(!pattern.test(un)) {
        $("#id_error_create_acc_0").html('Username can only contains letters, digits and underscores. And it should be 3 to 30 characters long.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Username can only contains letters, digits and underscores. And it should be 3 to 30 characters long.';
        return;
    }

    if((pw0==null || pw0=='')&&(pw1==null||pw1=='')) {
        $("#id_error_create_acc_0").html('Password must be at least 6 characters long.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Password must be at least 6 characters long.';
        return;
    }
    if((pw0==null || pw0=='')||(pw1==null||pw1=='')) {
        $("#id_error_create_acc_0").html('Please enter the password twice to confirm it.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Please enter the password twice to confirm it.';
        return;
    }
    if(pw0!=pw1) {
        $("#id_error_create_acc_0").html('Please check that your passwords match and try again.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Please check that your passwords match and try again.';
        return;
    }
    if(pw0.length<6) {
        $("#id_error_create_acc_0").html('Password must be at least 6 characters long.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Password must be at least 6 characters long.';
        return;
    }

    if(fn==null || fn=='') {
        $("#id_error_create_acc_0").html('Please enter your first name.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Please enter your first name.';
        return;
    }
    var pattern = new RegExp("^[a-zA-Z]{1,30}$");
    if(!pattern.test(fn)) {
        $("#id_error_create_acc_0").html('Only letters are allowed in first name and last name.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Only letters are allowed in first name and last name.';//single quotes 
        return;
    }
    if(ln==null || ln=='') {
        $("#id_error_create_acc_0").html('Please enter your last name.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Please enter your last name.';
        return;
    }
    var pattern = new RegExp("^[a-zA-Z]{1,30}$");
    if(!pattern.test(ln)) {
        $("#id_error_create_acc_0").html('Only letters are allowed in first name and last name.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Only letters are allowed in first name and last name.';//single quotes 
        return;
    }
    if(em==null || em=='') {
        $("#id_error_create_acc_0").html('Please enter your email address.');
        //document.getElementById('id_error_create_acc_0').innerHTML = 'Please enter your email address.';
        return;
    } 
    
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/create_acc_confirm',// 
        data:'pw0='+pw0+'&'+'pw1='+pw1+'&'+'un='+un+'&'+'fn='+fn+'&'+'ln='+ln+'&'+'em='+em,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            // 0:Password must be at least 6 characters long. 1:Please enter a password and confirm it. 2:Please check that your passwords match and try again. 3:Password has been changed! 4:Error: password has not been changed.
            //alert(txt);
            if(txt=='0' || txt==0) {
                $("#id_error_create_acc_0").html('Password must be at least 6 characters long.');
                //document.getElementById('id_error_create_acc_0').innerHTML = 'Password must be at least 6 characters long.';
            }
            if(txt=='1' || txt==1) {
                $("#id_error_create_acc_0").html('Please enter the password twice to confirm it.');
                //document.getElementById('id_error_create_acc_0').innerHTML = 'Please enter the password twice to confirm it.';
            }
            if(txt=='2' || txt==2) {
                 $("#id_error_create_acc_0").html('Please check that your passwords match and try again.');
                //document.getElementById('').innerHTML = ;
            }
            if(txt=='3' || txt==3) {
                 $("#id_error_create_acc_0").html('Please enter your username.');
               // document.getElementById('id_error_create_acc_0').innerHTML = ;
            }
            if(txt=='4' || txt==4) {
                $("#id_error_create_acc_0").html('Username can only contains letters, digits and underscores. And it should be 3 to 30 characters long.');
                //document.getElementById('id_error_create_acc_0').innerHTML = ;
            }
            if(txt=='5' || txt==5) {
                $("#id_error_create_acc_0").html('The username already exists.');
                //document.getElementById('id_error_create_acc_0').innerHTML = ;
            }
            if(txt=='6' || txt==6) {
                 $("#id_error_create_acc_0").html('Please enter your first name.');
                //document.getElementById('id_error_create_acc_0').innerHTML = ;
            }
            if(txt=='7' || txt==7) {
                $("#id_error_create_acc_0").html('Only letters are allowed in first name and last name.');
                //document.getElementById('id_error_create_acc_0').innerHTML = ;//single quotes 
            }
            if(txt=='8' || txt==8) {
                $("#id_error_create_acc_0").html('Please enter your last name.');
               // document.getElementById('id_error_create_acc_0').innerHTML = ;
            }
            if(txt=='9' || txt==9) {
                $("#id_error_create_acc_0").html('Please enter your email address.');
                //document.getElementById('id_error_create_acc_0').innerHTML = ;
            }
            if(txt=='10' || txt==10) {
                 $("#id_error_create_acc_0").html('Invalid email address.');
                //document.getElementById('id_error_create_acc_0').innerHTML = ;
            }
            if(txt=='12' || txt==12) {
                $("#id_error_create_acc_0").html('Error: account can not be created.');
                //document.getElementById('id_error_create_acc_0').innerHTML = ;
            }
            if(txt=='11' || txt==11) {
                create_acc_succeed();
            }
            if(txt=='13' || txt==13) {//cart
                cart();
                dispLoginNavBar();
            }  
            if(txt=='14' || txt==14) {//home
                startPage();
            }
        },
        error:function(){
            alert('Error');
        }
    })
}

// create a new account successfully
function create_acc_succeed() {
$.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/create_acc_succeed',// 
       // data:'cid='+category_id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#id_div0").html(txt);
            //document.getElementById('').innerHTML = ;
            //dispLoginNavBar(); 
        },
        error:function(){
            alert('Error');
        }
    })
                //
}

// submit button to edit the profile
function editProfileConfirm() {
    var un = $('#create_acc_un').val();//document.getElementById('create_acc_un').value;
    var fn = $('#create_acc_f_name').val();//document.getElementById('create_acc_f_name').value;
    var ln = $('#create_acc_l_name').val();//document.getElementById('create_acc_l_name').value;
    var em = $('#create_acc_email').val();//document.getElementById('create_acc_email').value;
    // fields validation
    if(un==null || un=='') {
        $("#id_error_create_acc_0").html('Please enter your username.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z0-9_]{3,30}$");
    if(!pattern.test(un)) {
         $("#id_error_create_acc_0").html('Username can only contains letters, digits and underscores. And it should be 3 to 30 characters long.');
        return;
    }
    if(fn==null || fn=='') {
         $("#id_error_create_acc_0").html('Please enter your first name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z]{1,30}$");
    if(!pattern.test(fn)) {
        $("#id_error_create_acc_0").html('Only letters are allowed in first name and last name.');
        return;
    }
    if(ln==null || ln=='') {
        $("#id_error_create_acc_0").html('Please enter your last name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z]{1,30}$");
    if(!pattern.test(ln)) {
        $("#id_error_create_acc_0").html('Only letters are allowed in first name and last name.');
        return;
    }
    if(em==null || em=='') {
        $("#id_error_create_acc_0").html('Please enter your email address.');
        return;
    }
        $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/edit_profile_confirm',// 
        data:'un='+un+'&'+'fn='+fn+'&'+'ln='+ln+'&'+'em='+em,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                return;
            }
            //alert(txt);
            if(txt=='3' || txt==3) {
                $("#id_error_create_acc_0").html('Please enter your username.');
            }
            if(txt=='4' || txt==4) {
                $("#id_error_create_acc_0").html('Username can only contains letters, digits and underscores. And it should be 3 to 30 characters long.');
            }
            if(txt=='5' || txt==5) {
                $("#id_error_create_acc_0").html('The username already exists.');
            }
            if(txt=='6' || txt==6) {
                $("#id_error_create_acc_0").html('Please enter your first name.');
            }
            if(txt=='7' || txt==7) {
                 $("#id_error_create_acc_0").html('Only letters are allowed in first name and last name.');
            }
            if(txt=='8' || txt==8) {
                $("#id_error_create_acc_0").html('Please enter your last name.');
            }
            if(txt=='9' || txt==9) {
                $("#id_error_create_acc_0").html('Please enter your email address.');
            }
            if(txt=='10' || txt==10) {
                 $("#id_error_create_acc_0").html('Invalid email address.');
            }
            if(txt=='12' || txt==12) {
                $("#id_error_create_acc_0").html('Error: failed to modify your profile.');
            }
            if(txt=='100' || txt==100) { 
                edit_prof_succeed();
                dispLoginNavBar();      
            }
        },
        error:function(){
            alert('Error');
        }
    })
}

// successfully modified the profile
function edit_prof_succeed() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/edit_prof_succeed',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //document.getElementById('').innerHTML = ;
             $("#id_div0").html(txt);
            //dispLoginNavBar(); 
        },
        error:function(){
            alert('Error');
        }
    })
}

// display the page of address and payment information
function addr_payment_display() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/addr_payment_display',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
             $("#save_nav_bar").html(txt);
            dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    })
}

// display the page of adding/updating shipping address
function addUpdateShippingAddr() {
    sa_fn = $('#id_sa_fn').val();//document.getElementById('id_sa_fn').value;
    sa_addr = $('#id_sa_addr').val();//document.getElementById('id_sa_addr').value;
    sa_city = $('#id_sa_city').val();//document.getElementById('id_sa_city').value;
    sa_state = $('#id_sa_state').val();//document.getElementById('id_sa_state').value;
    sa_zip = $('#id_sa_zip').val();//document.getElementById('id_sa_zip').value;
    sa_pn = $('#id_sa_phone_number').val();//document.getElementById('id_sa_phone_number').value;

   if(sa_fn==null || sa_fn=='') {
        $("#id_error_shipping_addr").html('Please enter your name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,50}$");
    if(!pattern.test(sa_fn)) {
        $("#id_error_shipping_addr").html('Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.');
        return;
    }
    if(sa_addr==null || sa_addr=='') {
         $("#id_error_shipping_addr").html('Please enter your address.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z0-9 ]{1,100}$");
    if(!pattern.test(sa_addr)) {
        $("#id_error_shipping_addr").html('Invalid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.');
        return;
    }
    if(sa_city==null || sa_city=='') {
        $("#id_error_shipping_addr").html('Please enter the city name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,30}$");
    if(!pattern.test(sa_city)) {
        $("#id_error_shipping_addr").html('Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.');
        return;
    }
    if(sa_state==null || sa_state=='') {
        $("#id_error_shipping_addr").html('Please enter the state name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,20}$");
    if(!pattern.test(sa_state)) {
        $("#id_error_shipping_addr").html('Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.');
        return;
    }
    if(sa_zip==null || sa_zip=='') {
        $("#id_error_shipping_addr").html('Please enter the zip code.');
        return;
    }
    if(sa_pn==null || sa_pn=='') {
         $("#id_error_shipping_addr").html('Please enter the phone number.');
        return;
    }
    var pattern = new RegExp("^(?:\([2-9][0-9]{2}\)\ ?|[2-9][0-9]{2}(?:\-?|\ ?))[2-9][0-9]{2}[- ]?[0-9]{4}$");
    if(!pattern.test(sa_pn)) {
        $("#id_error_shipping_addr").html('Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.');
        return;
    }
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/add_update_shipping_addr',// 'mode='+mode+'&'+
        data:'sa_fn='+sa_fn +'&'+'sa_addr='+sa_addr+'&'+'sa_city='+sa_city+'&'+'sa_state='+sa_state+'&'+'sa_zip='+sa_zip+'&'+'sa_pn='+sa_pn,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                return;
            }
            // 4. Please enter your name. 5. Only letters, commas, periods, hyphens and spaces are allowed in name field. And the length should be 1 to 50 characters.
            // 6. Please enter your address. 7. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.
            // 8. Please enter the city name. 9. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.
            // 10. Please enter the state name. 11. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.
            // 12. Please enter the zip code. 13. Invalid zip code. Correct format: 12345 | 12345-6789 | 12345 1234.
            // 14. Please enter the phone number. 15. Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.
            if(txt=='0' || txt==0) {
                $("#id_error_shipping_addr").html('An shipping address has been successfully added.');
                butt_change_0();
            } 
            if(txt=='1' || txt==1) {
                $("#id_error_shipping_addr").html('The shipping address has been successfully updated.');
            }
            if(txt=='2' || txt==2) {
                $("#id_error_shipping_addr").html('Error: the shipping address can not be added.');
            }
            if(txt=='3' || txt==3) {
                $("#id_error_shipping_addr").html('Error: the shipping address can not be updated.');
            }
            if(txt=='4' || txt==4) {
                $("#id_error_shipping_addr").html('Please enter your name.');
            }
            if(txt=='5' || txt==5) {
                 $("#id_error_shipping_addr").html('Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.');
            }
            if(txt=='6' || txt==6) {
                $("#id_error_shipping_addr").html('Please enter your address.');
            }
            if(txt=='7' || txt==7) {
                 $("#id_error_shipping_addr").html('Invalid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.');
            }
            if(txt=='8' || txt==8) {
                $("#id_error_shipping_addr").html('Please enter the city name.');
            }
            if(txt=='9' || txt==9) {
                $("#id_error_shipping_addr").html('Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.');
            }
            if(txt=='10' || txt==10) {
                $("#id_error_shipping_addr").html('Please enter the state name.');
            }
            if(txt=='11' || txt==11) {
                $("#id_error_shipping_addr").html('Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.');
            }
            if(txt=='12' || txt==12) {
                $("#id_error_shipping_addr").html('Please enter the zip code.'); 
            }
            if(txt=='13' || txt==13) {
                $("#id_error_shipping_addr").html('Invalid zip code. Correct format: 12345 | 12345-6789 | 12345 1234.'); 
            }
            if(txt=='14' || txt==14) {
                $("#id_error_shipping_addr").html('Please enter the phone number.'); 
            }
            if(txt=='15' || txt==15) {
                $("#id_error_shipping_addr").html('Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.'); 
            }
        },
        error:function(){
            alert('Error');
        }
    })
}

function butt_change_0() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/butt_change_0',// 
         
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#addr_pament_display_button_0").html(txt);             
        },
        error:function(){
            alert('Error');
        }
    })
}

// display the page of adding/updating credit card information
function addUpdateCreditCard() {
    ba_nm = $('#id_ba_name').val();//document.getElementById('id_ba_name').value;
    ba_cn = $('#id_ba_card_number').val();//document.getElementById('id_ba_card_number').value;
    ba_month = $('#id_ba_expire_mon').val();//document.getElementById('id_ba_expire_mon').value;
    ba_year = $('#id_ba_expire_year').val();//document.getElementById('id_ba_expire_year').value;
    ba_cvv = $('#id_ba_cvv').val();//document.getElementById('id_ba_cvv').value;
    ba_addr = $('#id_ba_addr').val();//document.getElementById('id_ba_addr').value;
    ba_ct = $('#id_ba_city').val();//document.getElementById('id_ba_city').value;
    ba_st = $('#id_ba_state').val();//document.getElementById('id_ba_state').value;
    ba_zip = $('#id_ba_zip').val();//document.getElementById('id_ba_zip').value;
    ba_pn = $('#id_ba_phone_number').val();//document.getElementById('id_ba_phone_number').value;

    if(ba_nm==null || ba_nm=='') {
        $("#id_error_billing_addr_payment_method").html('Please enter your name.');   
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,50}$");
    if(!pattern.test(ba_nm)) {
        $("#id_error_billing_addr_payment_method").html('Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.');   
        return;
    }
    if(ba_cn==null || ba_cn=='') {
        $("#id_error_billing_addr_payment_method").html('Please enter your credit card number.');   
        return;
    }
    var pattern = new RegExp("^[0-9]{16}$");
    if(!pattern.test(ba_cn)) {
        $("#id_error_billing_addr_payment_method").html('Invalid credit card number. Credit card number should contain 16 digits.');   
        return;
    }
    if(ba_month==null || ba_month=='' || ba_year==null || ba_year=='') {
        $("#id_error_billing_addr_payment_method").html('Please provide the expiration date of your credit card.');   
        return;
    }
    if(ba_cvv==null || ba_cvv=='') {
        $("#id_error_billing_addr_payment_method").html('Please enter the CVV number.');   
        return;
    }
    var pattern = new RegExp("^[0-9]{3}$");
    if(!pattern.test(ba_cvv)) {
        $("#id_error_billing_addr_payment_method").html('Invalid CVV number. The CVV number should contain 3 digits.');   
        return;
    }
    if(ba_addr==null || ba_addr=='') {
        $("#id_error_billing_addr_payment_method").html('Please enter your billing address.');   
        return;
    }
    var pattern = new RegExp("^[a-zA-Z0-9 ]{1,100}$");
    if(!pattern.test(ba_addr)) {
        $("#id_error_billing_addr_payment_method").html('In valid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.');   
        return;
    }
    if(ba_ct==null || ba_ct=='') {
        $("#id_error_billing_addr_payment_method").html('Please enter the city name.');   
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,30}$");
    if(!pattern.test(ba_ct)) {
        $("#id_error_billing_addr_payment_method").html('Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.');   
        return;
    }
    if(ba_st==null || ba_st=='') {
        $("#id_error_billing_addr_payment_method").html('Please enter the state name.');   
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,20}$");
    if(!pattern.test(ba_st)) {
        $("#id_error_billing_addr_payment_method").html('Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.');   
        return;
    }
    if(ba_zip==null || ba_zip=='') {
        $("#id_error_billing_addr_payment_method").html('Please enter the zip code.');   
        return;
    }
    
    if(ba_pn==null || ba_pn=='') {
        $("#id_error_billing_addr_payment_method").html('Please enter the phone number.');   
        return;
    }
    var pattern = new RegExp("^(?:\([2-9][0-9]{2}\)\ ?|[2-9][0-9]{2}(?:\-?|\ ?))[2-9][0-9]{2}[- ]?[0-9]{4}$");
    if(!pattern.test(ba_pn)) {
        $("#id_error_billing_addr_payment_method").html('Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.');   
        return;
    }
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/add_update_card_billing_addr',// 'mode='+mode+'&'+
        data:'ba_nm='+ba_nm +'&'+'ba_cn='+ba_cn+'&'+'ba_month='+ba_month+'&'+'ba_year='+ba_year+'&'+'ba_cvv='+ba_cvv+'&'+'ba_addr='+ba_addr + 
        '&' + 'ba_ct='+ba_ct+'&'+'ba_st='+ba_st+'&'+'ba_zip='+ba_zip+'&'+'ba_pn='+ba_pn,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                return;
            }
            // 4. Please enter your name. 5. Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.
            // 6. Please enter your credit card number. 7. Invalid credit card number. Credit card number should contain 16 digits.
            // 8. Please provide the expiration date of your credit card.
            // 9. Please enter the CVV number. 10. Invalid CVV number. The CVV number should contain 3 digits. 
            // 11. Please enter your billing address. 12. In valid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.
            // 13. Please enter the city name. 14. Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.
            // 15. Please enter the state name. 16. Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.
            // 17. Please enter the zip code. 18. Invalid zip code. Correct format: 12345 | 12345-6789 | 12345 1234.
            // 19. Please enter the phone number. 20. Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.
            if(txt=='0' || txt==0) {
                $("#id_error_billing_addr_payment_method").html('The credit card and billing address has been successfully added.');   
                butt_change_1();
            } 
            if(txt=='1' || txt==1) {
                $("#id_error_billing_addr_payment_method").html('The credit card and billing address have been successfully updated.');   
            }
            if(txt=='2' || txt==2) {
                 $("#id_error_billing_addr_payment_method").html('Error: the credit card and billing address can not be added.');   
            }
            if(txt=='3' || txt==3) {
                 $("#id_error_billing_addr_payment_method").html('Error: the credit card and billing address can not be updated.');   
            }
            if(txt=='4' || txt==4) {
                 $("#id_error_billing_addr_payment_method").html('Please enter your name.');   
            }
            if(txt=='5' || txt==5) {
                 $("#id_error_billing_addr_payment_method").html('Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.');   
            }
            if(txt=='6' || txt==6) {
                 $("#id_error_billing_addr_payment_method").html('Please enter your credit card number.');   
            }
            if(txt=='7' || txt==7) {
                 $("#id_error_billing_addr_payment_method").html('Invalid credit card number. Credit card number should contain 16 digits.');   
            }
            if(txt=='8' || txt==8) {
                 $("#id_error_billing_addr_payment_method").html('Please provide the expiration date of your credit card.');   
            }
            if(txt=='9' || txt==9) {
                 $("#id_error_billing_addr_payment_method").html('Please enter the CVV number.');   
            }
            if(txt=='10' || txt==10) {
                 $("#id_error_billing_addr_payment_method").html('Invalid CVV number. The CVV number should contain 3 digits.');   
            }
            if(txt=='11' || txt==11) {
                 $("#id_error_billing_addr_payment_method").html('Please enter your billing address.');   
            }
            if(txt=='12' || txt==12) {
                 $("#id_error_billing_addr_payment_method").html('In valid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.');   
            }
            if(txt=='13' || txt==13) {
                 $("#id_error_billing_addr_payment_method").html('Please enter the city name.');   
            }
            if(txt=='14' || txt==14) {
                 $("#id_error_billing_addr_payment_method").html('Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.');   
            }
            if(txt=='15' || txt==15) {
                 $("#id_error_billing_addr_payment_method").html('Please enter the state name.');   
            }
            if(txt=='16' || txt==16) {
                 $("#id_error_billing_addr_payment_method").html('Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.');   
            }
            if(txt=='17' || txt==17) {
                 $("#id_error_billing_addr_payment_method").html('Please enter the zip code.');   
            }
            if(txt=='18' || txt==18) {
                 $("#id_error_billing_addr_payment_method").html('Invalid zip code. Correct format: 12345 | 12345-6789 | 12345 1234.');   
            }
            if(txt=='19' || txt==19) {
                 $("#id_error_billing_addr_payment_method").html('Please enter the phone number.');   
            }
            if(txt=='20' || txt==20) {
                 $("#id_error_billing_addr_payment_method").html('Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.');   
            }
        },
        error:function(){
            alert('Error');
        }
    })
}
 
function butt_change_1() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/butt_change_1',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#addr_pament_display_button_1").html(txt); 
        },
        error:function(){
            alert('Error');
        }
    })
}     

// add product to cart
function addToCart(pro_id) {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/add_to_cart',// 
        data:'pro_id='+pro_id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            if( (txt!=null) && (txt != '') && (txt.length > 10)  ) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                flac_recommand_cart = false;
                return;
            }
            navBarCartNumber();
            if(flac_recommand_cart) {
                cart();
                flac_recommand_cart = false;
            }
            
        },
        error:function(){
            alert('Error');
        }
    })
}

var flac_recommand_cart = false;
function addToCart_recommand(id) {
    flac_recommand_cart = true;
    addToCart(id);
}

// display the cart page
function cart() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/cart_display',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
           $("#save_nav_bar").html(txt); 
            dispLoginNavBar();
            reccomand();  
        },
        error:function(){
            alert('Error');
        }
    })
}

// recommand relative products according to user's cart
function reccomand() {
        $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/recommand',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#reccomend").html(txt);
        },
        error:function(){
            alert('Error');
        }
    })
}

// function of 'minus' button in cart page
function cartQtyMinus(id) {//0
    qty=$('#cartqtyinput_'+id).val();//document.getElementById('cartqtyinput_'+id).value;
    qty--;
    $('#cartqtyinput_'+id).val(qty);
    cartQtyInput(qty, id);
}

// function of 'plus' button in cart page
function cartQtyPlus(id) {//1
    qty=$('#cartqtyinput_'+id).val();//document.getElementById('cartqtyinput_'+id).value;
    qty++;
    $('#cartqtyinput_'+id).val(qty);
    cartQtyInput(qty, id);
}

// function of text field of quantity of products
function cartQtyInput(qty, id) {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/cart_qty_input',// 
        data:'id='+id+'&'+'qty='+qty+ '&'+ 'mode='+'1',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
             if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                return;
            }
           if(txt=='-1'|| txt==-1  ) {
                $("#cart_err_msg_"+id).html('Invalid Number!');
                $('#cartqtyinput_'+id).val(1);
            }
            if(txt=='1'|| txt==1  ) {
                 $("#cart_err_msg_"+id).html('');
            }
            if(txt=='2'|| txt==2  ) {
                $("#cart_err_msg_"+id).html("Can't change qty.");
            }
            cartTotPrice(id);
        },
        error:function(){
            alert('Error');
        }
    })
}

// delete an item in the cart
function cartItermDelete(id) {//2
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/cart_qty_input',// 
        data:'id='+id+'&'+'mode='+'-1' +'&'+ 'qty='+'0',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
             if( (txt!=null) && (txt != '') && (txt.length > 10)  ) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();  
                return;
            }
            cart();
            navBarCartNumber();
        },
        error:function(){
            alert('Error');
        }
    })
}

// calculate the total price of the cart
function cartTotPrice(id) {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/cart_total_price',// 
        data:'id='+id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#cart_total_price_"+id).html(txt);
        },
        error:function(){
            alert('Error');
        }
    })
}

// redirect to the check out page
function proceedToCO() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/proceed_to_co',// 
        //data:'id='+id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                return;
            }
            if(txt==0) { // go to login page
                dispLoginPage();
            }
            else {
                // go to address and payment info page
                checkOutShippingAddr();
            }            
        },
        error:function(){
            alert('Error');
        }
    })
}

function checkOutShippingAddr() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/check_out_shipping_addr',// 
        //data:'id='+id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#save_nav_bar").html(txt);
            dispLoginNavBar();

        },
        error:function(){
            alert('Error');
        }
    })

}
function checkOutShippingAddrConfirm() {
    sa_fn = $('#id_sa_fn_co').val();//document.getElementById('id_sa_fn_co').value;
    sa_addr = $('#id_sa_addr_co').val();//document.getElementById('id_sa_addr_co').value;
    sa_city = $('#id_sa_city_co').val();//document.getElementById('id_sa_city_co').value;
    sa_state = $('#id_sa_state_co').val();//document.getElementById('id_sa_state_co').value;
    sa_zip = $('#id_sa_zip_co').val();//document.getElementById('id_sa_zip_co').value;
    sa_pn = $('#id_sa_phone_number_co').val();//document.getElementById('id_sa_phone_number_co').value;
    if(sa_fn==null || sa_fn=='') {
        $("#id_error_shipping_addr_co").html('Please enter your name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,50}$");
    if(!pattern.test(sa_fn)) {
        $("#id_error_shipping_addr_co").html('Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.');
        return;
    }
    if(sa_addr==null || sa_addr=='') {
        $("#id_error_shipping_addr_co").html('Please enter your address.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z0-9 ]{1,100}$");
    if(!pattern.test(sa_addr)) {
        $("#id_error_shipping_addr_co").html('Invalid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.');
        return;
    }
    if(sa_city==null || sa_city=='') {
        $("#id_error_shipping_addr_co").html('Please enter the city name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,30}$");
    if(!pattern.test(sa_city)) {
        $("#id_error_shipping_addr_co").html('Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.');
        return;
    }
    if(sa_state==null || sa_state=='') {
        $("#id_error_shipping_addr_co").html('Please enter the state name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,20}$");
    if(!pattern.test(sa_state)) {
        $("#id_error_shipping_addr_co").html('Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.');
        return;
    }
    if(sa_zip==null || sa_zip=='') {
        $("#id_error_shipping_addr_co").html('Please enter the zip code.');
        return;
    }
    if(sa_pn==null || sa_pn=='') {
        $("#id_error_shipping_addr_co").html('Please enter the phone number.');
        return;
    }
    var pattern = new RegExp("^(?:\([2-9][0-9]{2}\)\ ?|[2-9][0-9]{2}(?:\-?|\ ?))[2-9][0-9]{2}[- ]?[0-9]{4}$");
    if(!pattern.test(sa_pn)) {
        $("#id_error_shipping_addr_co").html('Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.');
        return;
    }
 
        $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/add_update_shipping_addr',// 
        data:'sa_fn='+sa_fn +'&'+'sa_addr='+sa_addr+'&'+'sa_city='+sa_city+'&'+'sa_state='+sa_state+'&'+'sa_zip='+sa_zip+'&'+'sa_pn='+sa_pn,
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
             if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                return;
            }
            //alert(txt);
            if(txt=='0' || txt==0 || txt=='1' || txt==1) {
                checkOutCreditCard();
            } 
            if(txt=='2' || txt==2) {
                $("#id_error_shipping_addr_co").html('Error: the shipping address can not be added.');
            }
            if(txt=='3' || txt==3) {
                $("#id_error_shipping_addr_co").html('Error: the shipping address can not be updated.');
            }
            if(txt=='4' || txt==4) {
                $("#id_error_shipping_addr_co").html('Please enter your name.');
            }
            if(txt=='5' || txt==5) {
                $("#id_error_shipping_addr_co").html('Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.');
            }
            if(txt=='6' || txt==6) {
                $("#id_error_shipping_addr_co").html('Please enter your address.');
            }
            if(txt=='7' || txt==7) {
                $("#id_error_shipping_addr_co").html('Invalid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.');
            }
            if(txt=='8' || txt==8) {
                $("#id_error_shipping_addr_co").html('Please enter the city name.');
            }
            if(txt=='9' || txt==9) {
                $("#id_error_shipping_addr_co").html('Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.');
            }
            if(txt=='10' || txt==10) {
                $("#id_error_shipping_addr_co").html('Please enter the state name.');
            }
            if(txt=='11' || txt==11) {
                $("#id_error_shipping_addr_co").html('Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.');
            }
            if(txt=='12' || txt==12) {
                $("#id_error_shipping_addr_co").html('Please enter the zip code.');
            }
            if(txt=='13' || txt==13) {
                $("#id_error_shipping_addr_co").html('Invalid zip code. Correct format: 12345 | 12345-6789 | 12345 1234.');
            }
            if(txt=='14' || txt==14) {
                $("#id_error_shipping_addr_co").html('Please enter the phone number.');
            }
            if(txt=='15' || txt==15) {
                $("#id_error_shipping_addr_co").html('Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.');
            }
        },
        error:function(){
            alert('Error');
        }
    })
}

function checkOutCreditCard() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/check_out_credit_card',// 
        //data:'id='+id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            $("#save_nav_bar").html(txt);
            dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    })
}

function checkOutCreditCardConfirm() {
    ba_nm = $('#id_ba_name_co').val();//document.getElementById('id_ba_name_co').value;
    ba_cn = $('#id_ba_card_number_co').val();//document.getElementById('id_ba_card_number_co').value;
    ba_month = $('#id_ba_expire_mon_co').val();//document.getElementById('id_ba_expire_mon_co').value;
    ba_year = $('#id_ba_expire_year_co').val();//document.getElementById('id_ba_expire_year_co').value;
    ba_cvv = $('#id_ba_cvv_co').val();//document.getElementById('id_ba_cvv_co').value;
    ba_addr = $('#id_ba_addr_co').val();//document.getElementById('id_ba_addr_co').value;
    ba_ct = $('#id_ba_city_co').val();//document.getElementById('id_ba_city_co').value;
    ba_st = $('#id_ba_state_co').val();//document.getElementById('id_ba_state_co').value;
    ba_zip = $('#id_ba_zip_co').val();//document.getElementById('id_ba_zip_co').value;
    ba_pn = $('#id_ba_phone_number_co').val();//document.getElementById('id_ba_phone_number_co').value;
 
    if(ba_nm==null || ba_nm=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please enter your name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,50}$");
    if(!pattern.test(ba_nm)) {
        $("#id_error_billing_addr_payment_method_co").html('Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.');
        return;
    }
    if(ba_cn==null || ba_cn=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please enter your credit card number.');
        return;
    }
    var pattern = new RegExp("^[0-9]{16}$");
    if(!pattern.test(ba_cn)) {
        $("#id_error_billing_addr_payment_method_co").html('Invalid credit card number. Credit card number should contain 16 digits.');
        return;
    }
    if(ba_month==null || ba_month=='' || ba_year==null || ba_year=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please provide the expiration date of your credit card.');
        return;
    }
    if(ba_cvv==null || ba_cvv=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please enter the CVV number.');
        return;
    }
    var pattern = new RegExp("^[0-9]{3}$");
    if(!pattern.test(ba_cvv)) {
        $("#id_error_billing_addr_payment_method_co").html('Invalid CVV number. The CVV number should contain 3 digits.');
        return;
    }
    if(ba_addr==null || ba_addr=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please enter your billing address.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z0-9 ]{1,100}$");
    if(!pattern.test(ba_addr)) {
        $("#id_error_billing_addr_payment_method_co").html('In valid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.');
        return;
    }
    if(ba_ct==null || ba_ct=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please enter the city name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,30}$");
    if(!pattern.test(ba_ct)) {
        $("#id_error_billing_addr_payment_method_co").html('Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.');
        return;
    }
    if(ba_st==null || ba_st=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please enter the state name.');
        return;
    }
    var pattern = new RegExp("^[a-zA-Z ]{1,20}$");
    if(!pattern.test(ba_st)) {
        $("#id_error_billing_addr_payment_method_co").html('Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.');
        return;
    }
    if(ba_zip==null || ba_zip=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please enter the zip code.');
        return;
    }
    
    if(ba_pn==null || ba_pn=='') {
        $("#id_error_billing_addr_payment_method_co").html('Please enter the phone number.');
        return;
    }
    var pattern = new RegExp("^(?:\([2-9][0-9]{2}\)\ ?|[2-9][0-9]{2}(?:\-?|\ ?))[2-9][0-9]{2}[- ]?[0-9]{4}$");
    if(!pattern.test(ba_pn)) {
        $("#id_error_billing_addr_payment_method_co").html('Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.');
        return;
    }
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/add_update_card_billing_addr',// 'mode='+mode+'&'+
        data:'ba_nm='+ba_nm +'&'+'ba_cn='+ba_cn+'&'+'ba_month='+ba_month+'&'+'ba_year='+ba_year+'&'+'ba_cvv='+ba_cvv+'&'+'ba_addr='+ba_addr + 
        '&' + 'ba_ct='+ba_ct+'&'+'ba_st='+ba_st+'&'+'ba_zip='+ba_zip+'&'+'ba_pn='+ba_pn,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            if(txt.length > 10) {
                $("#save_nav_bar").html(txt);
                dispLoginNavBar();
                return;
            }
            // 4. Please enter your name. 5. Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.
            // 6. Please enter your credit card number. 7. Invalid credit card number. Credit card number should contain 16 digits.
            // 8. Please provide the expiration date of your credit card.
            // 9. Please enter the CVV number. 10. Invalid CVV number. The CVV number should contain 3 digits. 
            // 11. Please enter your billing address. 12. In valid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.
            // 13. Please enter the city name. 14. Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.
            // 15. Please enter the state name. 16. Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.
            // 17. Please enter the zip code. 18. Invalid zip code. Correct format: 12345 | 12345-6789 | 12345 1234.
            // 19. Please enter the phone number. 20. Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.
            if(txt=='0' || txt==0 || txt=='1' || txt==1) {
                placeOrder();
            } 
            if(txt=='2' || txt==2) {
                $("#id_error_billing_addr_payment_method_co").html('Error: the credit card and billing address can not be added.');
            }
            if(txt=='3' || txt==3) {
                $("#id_error_billing_addr_payment_method_co").html('Error: the credit card and billing address can not be updated.');
            }
            if(txt=='4' || txt==4) {
                $("#id_error_billing_addr_payment_method_co").html('Please enter your name.');
            }
            if(txt=='5' || txt==5) {
                $("#id_error_billing_addr_payment_method_co").html('Invalid name. Only letters and spaces are allowed in name field. And the length should be 1 to 50 characters.');
            }
            if(txt=='6' || txt==6) {
                $("#id_error_billing_addr_payment_method_co").html('Please enter your credit card number.');
            }
            if(txt=='7' || txt==7) {
                $("#id_error_billing_addr_payment_method_co").html('Invalid credit card number. Credit card number should contain 16 digits.');
            }
            if(txt=='8' || txt==8) {
                $("#id_error_billing_addr_payment_method_co").html('Please provide the expiration date of your credit card.');
            }
            if(txt=='9' || txt==9) {
                $("#id_error_billing_addr_payment_method_co").html('Please enter the CVV number.');
            }
            if(txt=='10' || txt==10) {
                $("#id_error_billing_addr_payment_method_co").html('Invalid CVV number. The CVV number should contain 3 digits.');
            }
            if(txt=='11' || txt==11) {
                $("#id_error_billing_addr_payment_method_co").html('Please enter your billing address.');
            }
            if(txt=='12' || txt==12) {
                $("#id_error_billing_addr_payment_method_co").html('In valid address. Only letters, digits and spaces are allowed in address field. And the length should be 1 to 100 characters.');
            }
            if(txt=='13' || txt==13) {
                $("#id_error_billing_addr_payment_method_co").html('Please enter the city name.');
            }
            if(txt=='14' || txt==14) {
                $("#id_error_billing_addr_payment_method_co").html('Invalid city name. Only letters and spaces are allowed in city field. And the length should be 1 to 30 characters.');
            }
            if(txt=='15' || txt==15) {
                $("#id_error_billing_addr_payment_method_co").html('Please enter the state name.');
            }
            if(txt=='16' || txt==16) {
                $("#id_error_billing_addr_payment_method_co").html('Invalid state name. Only letters and spaces are allowed in state field. And the length should be 1 to 20 characters.');
            }
            if(txt=='17' || txt==17) {
                $("#id_error_billing_addr_payment_method_co").html('Please enter the zip code.');
            }
            if(txt=='18' || txt==18) {
                $("#id_error_billing_addr_payment_method_co").html('Invalid zip code. Correct format: 12345 | 12345-6789 | 12345 1234.');
            }
            if(txt=='19' || txt==19) {
                $("#id_error_billing_addr_payment_method_co").html('Please enter the phone number.');
            }
            if(txt=='20' || txt==20) {
                $("#id_error_billing_addr_payment_method_co").html('Invalid phone number. Correct format: 9496983107 | 949-698-3107 | 949 698 3107.');
            }
            
        },
        error:function(){
            alert('Error');
        }
    })
}

// place order. Save the order information to database
function placeOrder() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/place_order',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //0. Please login first.  1. Failed to place order. The cart is empty. Please add products to cart first.
            //2. Error: failed to place order.  3. Error: the order has been placed but some (or all) products are absent in this order.
            //4. Error: the order has been successfully placed but the cart can not be cleared.  5. ok
            //<div id="login_nav"></div>
             $("#save_nav_bar").html(txt);
             dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    }) 
}
 
// order history
function ordersPlaced() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/orders_placed_display',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //alert(txt);
            $("#save_nav_bar").html(txt);
            dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    })
}

// previous order details
function orderDetails(id) {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/details_of_orders_display',// 
        data:'id='+id,// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //alert(txt);
            $("#save_nav_bar").html(txt);
            dispLoginNavBar();
        },
        error:function(){
            alert('Error');
        }
    })
}

// display the item number in the navigation bar dynamicly 
function navBarCartNumber() {
    $.ajax({
        type:'post',// 
        url:'http://cs-server.usc.edu:6452/x7/index.php/customer/nav_bar_cart_num',// 
        dataType:'text',// XML ,Json jsonp script html text 
        success:function(txt){
            //alert(txt);
            $("#nav_bar_cart_number").html(txt);
        },
        error:function(){
            alert('Error');
        }
    })
}

