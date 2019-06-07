

function loginAttempt(strusername, strpassword, feedback) {
    //parameters from form
    var username = strusername;
    var password = strpassword;
    var feedback = feedback;

    //CodeCombinationUrl
    var url = "AjaxPhp/loginSrcipt.php?cat=Login&uname=" + username + "&pword=" + password;


    var ajax = getAjax();
    //  alert(ajax+"\n"+username+"\n"+password);
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            feedback.innerHTML = "";
            var response = ajax.responseText;
            if(response ==='Connect Error'){
                feedback.innerHTML='<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
            }
            if (response === 'SuccessLogin') {
                feedback.innerHTML = "Redirecting...<i class='fa fa-pulse fa-refresh'></i>";
                document.location.href = "@dashboard";
            } if (response === 'FailedLogin') {
                feedback.innerHTML = '<div class="alert alert-danger alert-dismissible">\n\
       <a class="close" data-dismiss="alert">&times;</a> <p>Invalid Username/Password. Please try again</p>  </div>';
            }


        } else if (ajax.readyState === 3) {
            feedback.innerHTML = "Connection Establisted!";

        } else if (ajax.readyState === 2) {
            feedback.innerHTML = "Connecting to server...";
        } else if (ajax.readyState === 1) {
//            feedback.innerHTML = "Created...";
            feedback.innerHTML = 'Loading...<i class="fa fa-refresh fa-spin"></i>';
        } else if (ajax.readyState === 0) {
            feedback.innerHTML = "Creating...";
        }

    };
    // alert('aax sending');
    ajax.open("GET", "AjaxPhp/loginSrcipt.php?cat=Login&uname=" + username + "&pword=" + password, true);
    ajax.send();
}


function recoverAttempt(stremail, feedback) {
    var feedback = feedback;
    var email = stremail;
    var ajax = getAjax();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
                 feedback.innerHTML="";
                 var response = ajax.responseText;
                 if(response === 'emailInvalid'){
                     feedback.innerHTML = '<div class="alert alert-danger alert-dismissible">\n\
       <a class="close" data-dismiss="alert">&times;</a> <p>Invalid Email. Please try again</p>  </div>';
                 } else {
                    //valid email 
                   alert("Comming soon");
        
                 }
               
                 
        } else if (ajax.readyState === 3) {
                 feedback.innerHTML='<p>Loading...<i class="fa fa-refresh fa-spin"></i></p>';
        } else if (ajax.readyState === 2) {
                 feedback.innerHTML="Connection Successful";
        } else if (ajax.readyState === 1) {
                feedback.innerHTML = 'Loading...<i class="fa fa-refresh fa-spin"></i>';
        } else if (ajax.readyState === 0) {
               feedback.innerHTML="Creating connection....";
        }
    };
    ajax.open("GET","AjaxPhp/loginSrcipt.php?cat=recoverPass&email="+email,true);
    ajax.send();
}

