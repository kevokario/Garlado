
//////////////////////////////////////////////////////////////////////////////////////////
//                                  LOGIN AUTHORISATION                                 //
//////////////////////////////////////////////////////////////////////////////////////////

function validateLogin() {

    var username = document.login.username;
    var password = document.login.password;
    var feedback = document.getElementById('feedback');

    var usersuccess = validatorUsername();
    var passsuccess = validatorPassword();

    if (usersuccess !== true) {
        username.focus();
        feedback.innerHTML = '';
    }
    if (passsuccess !== true && usersuccess) {
        password.focus();
        feedback.innerHTML = '';
    }
    if (passsuccess && usersuccess)
    {
        feedback.innerHTML = 'Loading...<i class="fa fa-refresh fa-spin"></i>';
        loginAttempt(document.login.username.value,document.login.password.value,feedback);
    }

}



/* 
 *       THIS FUNCTION VALIDATES  USERNAME INPUT ONLY ON KEY UP! 
 */

function validatorUsername() {
    //required items
    var userfeedback = document.getElementById('userfeedback');
    var username = document.login.username.value;
    var result = true;
    var text = "";

    var atposition = username.indexOf('@');
    var dotposition = username.indexOf(".");
//    //username email is empty
    if (username.length === 0) {
        userfeedback.innerHTML = " Please provide your Email<br/>";
        result = false;
    }

//    //username email isless than 8
    else if (username.length < 8) {
        userfeedback.innerHTML = " Your Email should have atleast 8 characters<br/>";
        result = false;
    }

//    //invalid username is provided
    else if (dotposition < 1 || atposition < 1 || (dotposition - atposition) < 2 || (username.length - dotposition) < 3) {
        userfeedback.innerHTML = " Provide valid email address!<br/>";
        result = false;
    } else if (result !== false) {
        userfeedback.innerHTML = "";
    }


    return result;

}

/* 
 *       THIS FUNCTION VALIDATES  Password INPUT ONLY ON KEY UP! 
 */

function validatorPassword() {
    //required items
    var passfeedback = document.getElementById('passfeedback');
    var password = document.login.password.value;

    var result = true;
    var text = "";
    //provided password is empty
    if (password.length === 0) {
        passfeedback.innerHTML = " Please provide Password!<br/>";
        result = false;
    }

    //provided password isless than 8
    else if (password.length < 5) {
        passfeedback.innerHTML = " Password should have atleast 5 characters!<br/>";
        result = false;
    } else {
        passfeedback.innerHTML = "";
    }

    return result;

}

//////////////////////////////////////////////////////////////////////////////////////////
//                                  PASSWORD AUTHORISATION                              //
//////////////////////////////////////////////////////////////////////////////////////////

function validatorEmail() {

    var email = document.recoverPass.email.value;
    var emailfeedback = document.getElementById('emailfeedback');

    var dotpos = email.indexOf(".");
    var atpos = email.indexOf("@");
    var result = true;

    if (email.length === 0) {
        emailfeedback.innerHTML = "Please provide an email address</br>";
        result = false;
    } else if (email.length < 8) {
        emailfeedback.innerHTML = "Email address should contain atleast 8 characters";
        result = false;
    } else if(dotpos<1 || atpos< 1 || (dotpos-atpos) < 3 || (email.length-dotpos)<3 ){
         emailfeedback.innerHTML = "Provide a valid email address";
        result = false;
    }
    else{
         emailfeedback.innerHTML = "";
    }
    return result;

}

function validateForgot(){
     var email = document.recoverPass.email;
     var feedback = document.getElementById('feedback');
     
     var emailsuccess = validatorEmail();
     if(emailsuccess !== true){
         email.focus();
         feedback.innerHTML = '';
     }
     else {
        recoverAttempt(document.recoverPass.email.value,feedback);
         
     }
}



