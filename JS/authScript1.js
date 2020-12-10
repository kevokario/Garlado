function loadLogin(str) {
    var div = $('#userLoginFormDiv');
    $(str).parent().children('span').html('<i class="fa fa-pulse fa-refresh"></i>');
    $.get('includes/authLogin.php', function (data, status) {
        div.html(data);
    });
}
function loadSignUp(str) {
    var div = $('#userLoginFormDiv');
    $(str).parent().children('span').html('<i class="fa fa-pulse fa-refresh"></i>');
    $.get('includes/authSignUp.php', function (data, status) {
        div.html(data);
    });
}
function loadPassword(str) {
    var div = $('#userLoginFormDiv');
    $(str).parent().children('span').html('<i class="fa fa-pulse fa-refresh"></i>');
    $.get('includes/password.php', function (data, status) {
        div.html(data);
    });
}
function accountVerify(str) {
    var div = $('#userLoginFormDiv');
    $(str).parent().children('span').html('<i class="fa fa-pulse fa-refresh"></i>');
    $.get('includes/verify.php', function (data, status) {
        div.html(data);
    });
}
function clientSignUp(btn) {
    var form = document.getElementById('authSignUp');
    var div = document.getElementById('authSignUpFb');
    var email = form.email;
    var phone = form.phone;
    var passw = form.password;
    var btni = $(form).children('button i');
    btni.removeClass('fa-user-plus');
    btni.addClass('fa-pulse fa-refresh');
    var eml = validateClientEmail(email);
    var phn = validateClientPhone(phone);
    var pas = validateClientPassword(passw);


    if (eml === true && phn === true && pas === true) {
        var array = [email.value, phone.value, passw.value];
        var jsonData = JSON.stringify(array);
        $(div).html('<i class="fa fa-pulse fa-refresh"></i>');
        attemptSignUp(jsonData, div);
    }
}
function clientPassword() {
    test('Forgot Password Clicked!');
}

function clientLogin(btn) {
    var uname = $('#authLogin input:eq(0)');
    var pword = $('#authLogin input:eq(1)');
    var i = $(btn).children('i');
    //  test(uname+'<br>'+pword);
    var unameStat = validateClientEmail(uname);
    var pnameStat = validateClientPassword(pword);
    //validation first

    if (unameStat === true && pnameStat === true) {
        clientLoginDb(uname,pword,i);
    }
}

function codeVerification(btn) {
    var code = document.verifyForm.code;
    var i = $(btn).children('i');
    var codestat = validateVerificationCode(code);
    if(codestat===true){
        codeVerificationDb(i,code.value.trim());
    }
}

function getResendCode(btn) {
    var i = $(btn).children('i');
    getResendCodeDb(btn,i);
}

