
//this is the sign up function

function attemptSignUp(jsonData, div) {
    $.post('Core/preloader.php',
            {
                cat: 'attemptSignUp',
                jsonData: jsonData
            },
            function (data, status) {
                var jsonData = JSON.parse(data);
                //json format email,number,password,smscode,smsstt,responseText
                if (jsonData[4] === 'sent') {
                    $(div).html('<i class="fa fa-pulse fa-refresh"></i>');
                    $.get('includes/verify.php', function (data, status) {
                        $('#userLoginFormDiv').html(data);
                        $('#userNumber').text(jsonData[1]);
                    });
                }
                if (jsonData[4] === 'unsent') {
                    $(div).html(jsonData[5]);
                }
                else{
                     $(div).html(jsonData[4]);
                }
            });
}

function codeVerificationDb(i, code) {
    $(i).removeClass('fa-send-o');
    $(i).addClass('fa-pulse fa-refresh');
    $.post('Core/preloader.php', {
        cat: 'codeVerificationDb',
        code: code
    }, function (data, status) {
        var jsonResponse = JSON.parse(data);
        $(i).removeClass('fa-pulse fa-refresh');
        $(i).addClass('fa-send-o');
        //code verification ok
        if (jsonResponse[0] === 'match') {
            document.location.href = "myOrder";
        }
        //code verification not ok
        if (jsonResponse[0] === 'mismatch') {
            test('The code provided was <b>Wrong, please try again</b>!');
        }
    });
}

function getResendCodeDb(btn, i) {
    $(i).removeClass('fa-openid');
    $(i).addClass('fa-pulse fa-refresh');
    $(btn).attr('disabled');
    $.post('Core/preloader.php', {
        cat: 'getResendCode'
    }, function (data, status) {
        $(i).removeClass('fa-pulse fa-refresh');
        $(i).addClass('fa-openid');
        $(btn).removeAttr('disabled');
        var jsonData = JSON.parse(data);
        if (jsonData[4] === 'sent') {
            test('A new Verification code has been sent to<br><b>' + jsonData[1] + '</b>. <br> Provide the code sent!');
        } else {
            test(jsonData[5]);
        }
    });
}

//client login data here
function clientLoginDb(uname, pword, i) {
    var myuname = uname.val().trim();
    var mypword = pword.val().trim();
    $(i).removeClass('fa-unlock-alt');
    $(i).addClass('fa-pulse fa-refresh');

    var jsonData = JSON.stringify([myuname, mypword]);
    $.post('Core/preloader.php', {
        cat: 'clientLogin',
        jsonData: jsonData
    }, function (data, status) {
        var jsonData = JSON.parse(data);
        if (jsonData[0] === 'empty') {
            $(i).removeClass('fa-pulse fa-refresh');
            $(i).addClass('fa-unlock-alt');
            test('Invalid <b>Username/Password</b>.Please try again.<br>If you dont have an account with us, please <b>Sign up</b> first!');
        }
        if (jsonData[0] === 'nempty') {
            document.location.href = "myOrder";
        }
    });
}
