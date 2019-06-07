function getAjax() {
    var ajax = false;
    try {
        ajax = new XMLHttpRequest();
    } catch (e) {
        try {
            ajax = new ActiveXObject("Mircosoft.XMLHTTP");
        } catch (e) {
            try {
                ajax = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                ajax = false;
            }
        }
    }
    return ajax;
}

function loadLogin() {
    var canvas = document.getElementById('canvas');
    var ajax = getAjax();

    ajax.onreadystatechange = function () {
        if (ajax.status === 200 && ajax.readyState === 4) {
            canvas.innerHTML = ajax.responseText;
        }
    };

    ajax.open("GET", "./widgets/_login.html", true);
    ajax.send();
}

function loadPassword() {
    var canvas = document.getElementById('canvas');
    var ajax = getAjax();

    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4 && ajax.status === 200) {
            canvas.innerHTML = ajax.responseText;
        }
    };
    ajax.open("GET", "widgets/_recoverPassword.html", true);
    ajax.send();
}

function firstLoad() {
    loadLogin();
}

function test(str) {
    alert(str);
}

//Add ADMIN FORM CONTENT SCRIPT
//==================================================
function addMemberFunction() {
    //variables
    var name = document.addMember.admname.value;
    var mail = document.addMember.admemail.value;
    var phone = document.addMember.admphone.value;
    var level = document.addMember.admlevel.value;
    var image = document.addMember.admphoto;
    var stat = document.addMember.status.value;


    var feedback = document.getElementById('admfeedback');

    //error divs
    var dname = document.getElementById('admname');
    var dmail = document.getElementById('admemail');
    var dphone = document.getElementById('admphone');
    var dlevel = document.getElementById('admlevel');
    var dimage = document.getElementById('admphoto');
    var dstat = document.getElementById('admstatus');

//    //validation
    var vname = nameValidate(name, dname);
    var vphone = numberValidate(phone, dphone);
    var vmail = emailValidate(mail, dmail);
    var vlevel = levelValidate(level, dlevel);
    var vimage = imageValidator(image, dimage);
    var vstat = statusValidate(stat, dstat);
//
    if (vname === false) {
        document.addMember.admname.focus();
        resetaddMember();
    } else if (vname === true && vphone === false) {
        document.addMember.vphone.focus();
        resetaddMember();
    } else if (vmail === false && vphone === true) {
        document.addMember.vmail.focus();
        resetaddMember();
    } else if (vlevel === false && vmail === true) {
        document.addMember.vlevel.focus();
        resetaddMember();
    } else if (vimage === false && vlevel === true) {
        image.focus();
        dlevel.innerHTML = '';

    } else if (vstat === false && vimage === true) {
        vstat.focus();
        dimage.innerHTML = '';

    } else {
        var st = 0;
        if (stat === 'ACTIVE') {
            st = 1;
        }
//        addMemberSave(name, mail, phone, level, image,st,feedback);
        addMemberImage(name, mail, phone, level, image.files[0], st, feedback);
    }
}



//-----------------------------------------------------
//            EDIT MEMBER DETAILS
//-----------------------------------------------------

var togglestatus = 0;
function setToggleStatus(str) {
    togglestatus = str;
}
function getToggleStatus(str) {
    return togglestatus;
}
function editMember(str) {
    fetchUserData(str);
    $('#myModalEdit').modal('toggle');
}
function fetchUserData(str) {
    var id = document.editMemberDetails.id;
    var name = document.editMemberDetails.name;
    var email = document.editMemberDetails.email;
    var phone = document.editMemberDetails.phone;
    var level = document.editMemberDetails.level;
    var status = document.editMemberDetails.status;
    var picdiv = document.getElementById('EditUserPic');
    id.value = str;
    var div = document.getElementById('editMemberFeedBack');
    var ajax = getAjax();
    var url = 'AjaxPhp/@dasboardScript.php?cat=editMember&id=' + str;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {

            var response = ajax.responseText;
            name.value = response.substring((response.indexOf('~') + 1), response.indexOf('!'));
            email.value = response.substring((response.indexOf('!') + 1), response.indexOf('+'));
            phone.value = response.substring((response.indexOf('+') + 1), response.indexOf('_'));
            var lev = response.substring((response.indexOf('_') + 1), response.indexOf('$'));
            var img = response.substring((response.indexOf('$') + 1), response.indexOf('%'));
            var stat = response.substring((response.indexOf('%') + 1));
            div.innerHTML = '';
            picdiv.innerHTML = ' <img class="userImg" src="./userpics/' + img + '" alt=""/>';
            if (lev === 'Admin') {
                level.innerHTML = '<option>Admin</option><option>Super Admin</option>';
            }
            if (lev === 'Super Admin') {
                level.innerHTML = '<option>Super Admin</option><option>Admin</option>';
            }
            if (stat === '1') {
                status.innerHTML = '<option>ACTIVE</option><option>INACTIVE</option>';
            }
            if (stat === '0') {
                status.innerHTML = '<option>INACTIVE</option><option>ACTIVE</option>';
            }
        } else {
            div.innerHTML = '<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function toggleDivImg() {
    var div = document.getElementById('toggleMemberImageDiv');
    var ts = getToggleStatus();
    if (ts === 0) {
        div.style.display = 'block';
        setToggleStatus(1);
    } else {
        div.style.display = 'none';
        setToggleStatus(0);
    }
}
function EDMSave() {
    var id = document.editMemberDetails.id.value;
    var name = document.editMemberDetails.name.value;
    var email = document.editMemberDetails.email.value;
    var phone = document.editMemberDetails.phone.value;
    var level = document.editMemberDetails.level.value;
    var status = document.editMemberDetails.status.value;
    var image = document.editMemberDetails.pic;

    var namediv = document.getElementById('EDMname');
    var emaildiv = document.getElementById('EDMemail');
    var phonediv = document.getElementById('EDMphone');

    var picdiv = document.getElementById('EDMpic');
    var pd = document.getElementById('EditUserPic');

    var toggle = getToggleStatus();
    var div = document.getElementById('editMemberFeedBack');
    //toggle status
    // 0 : no change picture
    // 1 : change picture
    //
    var nm = nameValidate(name, namediv);
    var em = emailValidate(email, emaildiv);
    var ph = numberValidate(phone, phonediv);
    var stat = 1;
    if (status === 'INACTIVE') {
        stat = 0;
    }
    //case 1
    if (toggle === 1) {
        var im = imageValidator(image, picdiv);
        if (nm === true && em === true && ph === true && im === true) {
            div.innerHTML = '';
            UpdateMemberDataA(id, name, phone, email, stat, level, image, pd, div);
        } else {
            div.innerHTML = '';
        }
    } else {
        if (nm === true && em === true && ph === true) {
            UpdateMemberDataB(id, name, phone, email, stat, level, div);
        } else {
            div.innerHTML = '';
        }
    }
}
function UpdateMemberDataB(id, name, phone, email, status, level, div) {
    var ajax = getAjax();
    var url = 'AjaxPhp/@dasboardScript.php?cat=UpdateMemberDataB&id=' + id + '&name=' + name + '&phone=' + phone + '&email=' + email + '&status=' + status + '&level=' + level;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            getDetails(id, document.getElementById('detailsarea'));
            popData();
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Updating changes...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
function UpdateMemberDataA(id, name, phone, email, status, level, image, imagediv, div) {
    var form_data1 = new FormData();
    var imagename = 'undefined';
    form_data1.append("file", image.files[0]);
    $.ajax({
        url: "uploadUserPic.php",
        method: "POST",
        data: form_data1,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            imagediv.innerHTML = "<h1 class='text-center productImg'>Uploading image...<br><i class='fa fa-pulse fa-refresh'></i></h1>";
        },
        success: function (data)
        {
            imagediv.innerHTML = '';
            imagename = data;
            functionA(id, name, phone, email, status, level, imagename, div);
        }
    });
}
function functionA(id, name, phone, email, status, level, imagename, div) {
    var picdiv = document.getElementById('EditUserPic');
    var ajax = getAjax();
    var url = 'AjaxPhp/@dasboardScript.php?cat=UpdateMemberDataA&id=' + id + '&name=' + name + '&phone=' + phone + '&email=' + email + '&status=' + status + '&level=' + level + '&image=' + imagename;
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4) {
            div.innerHTML = ajax.responseText;
            picdiv.innerHTML = ' <img class="userImg" src="./userpics/' + imagename + '" alt=""/>';
            getDetails(id, document.getElementById('detailsarea'));
            popData();
        } else {
            div.innerHTML = '<i class="fa fa-smile-o"></i> Updating changes...<i class="fa fa-spin fa-refresh"></i>';
        }
    };
    ajax.open('GET', url, true);
    ajax.send();
}
//-------------VALIDATE ADDMEMBER DATA
//-----------------------------------------------------
function levelValidate(str, ediv) {
    var level = str;
    var div = ediv;
    var result = true;
    if (level === '-------------Select Level--------------') {
        result = false;
        div.innerHTML = 'Please select a valid level'
    } else {
        div.innerHTML = '';
    }
    return result;
}

function resetaddMember() {
    document.getElementById('admfeedback').innerHTML = '';
}
//--------------GENERIC VALIDATORS
/*----------------------------------------------------*/

//---name validator
function nameValidate(str, ediv) {
    var name = str;
    var div = ediv;
    var result = true;
//   div.innerHTML
    if (name.length === 0) {
        result = false;
        div.innerHTML = 'Please provide a name';
    } else if (/[^a-z A-Z]/.test(name)) {
        result = false;
        div.innerHTML = 'Provide a valid name';
    } else if (name.length < 3) {
        result = false;
        div.innerHTML = 'name should contain atleast 3 letters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}

function nameValidate1(str, ediv) {
    var name = str;
    var div = ediv;
    var result = true;
//   div.innerHTML
    if (name.length === 0) {
        result = false;
        div.innerHTML = 'Please provide a name';
    } else if (/[^a-z A-Z&]/.test(name)) {
        result = false;
        div.innerHTML = 'Provide a valid name';
    } else if (name.length < 3) {
        result = false;
        div.innerHTML = 'name should contain atleast 3 letters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function nameValidate2(str, ediv) {
    var name = str;
    var div = ediv;
    var result = true;
//   div.innerHTML
    if (name.length === 0) {
        result = false;
        div.innerHTML = 'Please provide a name';
    } else if (/[^a-z 0-9 \- A-Z&]/.test(name)) {
        result = false;
        div.innerHTML = 'Provide a valid name';
    } else if (name.length < 3) {
        result = false;
        div.innerHTML = 'name should contain atleast 3 letters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function descriptionValidate2(str, ediv) {
    var name = str;
    var div = ediv;
    var result = true;
//   div.innerHTML
    if (name.length === 0) {
        result = false;
        div.innerHTML = 'Please provide a Description of the pickup point';
    } else if (/[^a-z 0-9 . , @ A-Z&]/.test(name)) {
        result = false;
        div.innerHTML = 'Provide a valid name';
    } else if (name.length < 9) {
        result = false;
        div.innerHTML = 'Description should contain atleast 9 letters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function countyValidate(str, ediv) {
    var name = str;
    var div = ediv;
    var result = true;
//   div.innerHTML
    if (name.length === 0) {
        result = false;
        div.innerHTML = 'Please provide a name';
    } else if (/[^a-z A-Z 0-9&]/.test(name)) {
        result = false;
        div.innerHTML = 'Provide a valid name';
    } else if (name.length < 3) {
        result = false;
        div.innerHTML = 'name should contain atleast 3 letters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function productNameValidate(str, ediv) {
    var name = str;
    var div = ediv;
    var result = true;
//   div.innerHTML
    if (name.length === 0) {
        result = false;
        div.innerHTML = 'Please provide a name';
    } else if (/[^a-z A-Z\& 0-9\-]/.test(name)) {
        result = false;
        div.innerHTML = 'Provide a valid name';
    } else if (name.length < 3) {
        result = false;
        div.innerHTML = 'name should contain atleast 3 letters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function productNameValidate1(str, ediv) {
    var name = str;
    var div = ediv;
    var result = true;
//   div.innerHTML
    if (name.length === 0) {
        result = false;
        div.innerHTML = 'Please provide a name';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}



function numberValidate(str, ediv) {
    //variables

    var number = str;
    var div = ediv;
    var result = true;
    //validation

    if (number.length === 0) {
        result = false;
        div.innerHTML = 'Please provide phone number';
    } else if (/[^0-9]/.test(number)) {
        result = false;
        div.innerHTML = 'Provide a valid number';
    } else if (number.length !== 10) {
        result = false;
        div.innerHTML = 'Phone number should only be 10 digits';
    } else {
        result = true;
        div.innerHTML = '';
    }

    return result;
}
function cCodeValidate(str, ediv) {
    //variables

    var number = str;
    var div = ediv;
    var result = true;
    //validation

    if (number.length === 0) {
        result = false;
        div.innerHTML = 'Please provide a countryCode';
    } else if (/[^0-9+]/.test(number)) {
        result = false;
        div.innerHTML = 'Provide a valid countryCode, eg <strong>+254</strong>';
    } else if (number.length < 3) {
        result = false;
        div.innerHTML = 'countryCode should contain atleast 2 characters';
    } else {
        result = true;
        div.innerHTML = '';
    }

    return result;
}

function priceValidate(str, ediv) {
    //variables

    var number = str;
    var div = ediv;
    var result = true;
    //validation

    if (number.length === 0) {
        result = false;
        div.innerHTML = 'Please provide requeired price ';
    } else if (/[^0-9]/.test(number)) {
        result = false;
        div.innerHTML = 'Provide a valid amount';
    } else {
        result = true;
        div.innerHTML = '';
    }

    return result;
}
function passwordValidate(str, ediv) {
   
    var result = true;
    var text = "";
    //provided password is empty
    if (str.length === 0) {
        ediv.innerHTML = " Please provide Password!<br/>";
        result = false;
    }

    //provided password isless than 8
    else if (str.length < 5) {
        ediv.innerHTML = " Password should have atleast 5 characters!<br/>";
        result = false;
    } else {
        ediv.innerHTML = "";
    }

    return result;
}
function passwordValidate1(str1,str, ediv,ediv1) {
   
    var result = true;
    var text = "";
    //provided password is empty
    if (str.length === 0) {
        ediv.innerHTML = " Please provide Password!<br/>";
        result = false;
    }

    //provided password isless than 8
    else if (str.length < 5) {
        ediv.innerHTML = " Password should have atleast 5 characters!<br/>";
        result = false;
    } else if(str!==str1){
        ediv.innerHTML = "Passwords do not match<br/>";
        result = false;
    } else {
        ediv.innerHTML = "";
        ediv1.innerHTML= "";
    }

    return result;
}
function quantityValidate(str, ediv) {
    //variables

    var number = str;
    var div = ediv;
    var result = true;
    //validation

    if (number.length === 0) {
        result = false;
        div.innerHTML = 'Please provide number of items';
    } else if (/[^0-9]/.test(number)) {
        result = false;
        div.innerHTML = 'Provide a valid number';
    } else {
        result = true;
        div.innerHTML = '';
    }

    return result;
}

function emailValidate(str, ediv) {
    //variables
    var email = str;
    var div = ediv;
    var result = true;

    var atpos = email.indexOf('@');
    var dotpos = email.indexOf('.');

    //validation
    if (email.length === 0) {
        result = false;
        div.innerHTML = 'Please provide email address';
    } else if (email.length < 8) {
        result = false;
        div.innerHTML = 'Email should be atleast 8 characters';
    } else if (atpos < 1 || dotpos < 1 || (dotpos - atpos) < 3 || (email.length - dotpos) < 3) {
        result = false;
        div.innerHTML = 'Provide a valid email';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function generalValidate(mygeneral, ediv) {
    var general = mygeneral;
    var div = ediv;
    var result = false;
    if (general === '------SELECT PARENT GENERAL GROUP------' || general === '---select Group---'
            || general === '------GENERAL GROUP------') {
        div.innerHTML = 'Select a valid General group';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function brandNameValidate(mygeneral, ediv) {
    var name = mygeneral;
    var div = ediv;
    var result = false;
    if (name === '------SELECT PARENT GENERAL GROUP------' || name === '---select Group---'
            || name === '------SET BRAND------') {
        div.innerHTML = 'Select a valid Brand group';
    } else if (name.length === 0) {
        result = false;
        div.innerHTML = 'Please provide Brand name';
    } else if (/[^a-z A-Z\& 0-9\-]/.test(name)) {
        result = false;
        div.innerHTML = 'Provide a valid name';
    } else if (name.length < 2) {
        result = false;
        div.innerHTML = 'Brand name should contain atleast 2 letters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function categoryValidate(mycategory, ediv) {
    var category = mycategory;
    var div = ediv;
    var result = false;
    if (category === '------SELECT CATEGORY GROUP------' || category === '---select Cat---' ||
            category === '------CATEGORY GROUP------') {
        div.innerHTML = 'Select a valid Category group';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function monthValidate(mymonth, ediv) {
    var month = mymonth;
    var div = ediv;
    var result = false;
    if ( month === '---select Month---') {
        div.innerHTML = 'Select a valid month';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function yearValidate(myyear, ediv) {
    var year = myyear;
    var div = ediv;
    var result = false;
    if ( year === '---select year---') {
        div.innerHTML = 'Select a valid year';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function specificValidate(myspecific, ediv) {
    var specific = myspecific;
    var div = ediv;
    var result = false;
    if (specific === '------SPECIFIC GROUP------' || specific === '---select group---') {
        div.innerHTML = 'Select a valid Specific Group';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function statusValidate(mystatus, ediv) {
    var status = mystatus;
    var div = ediv;
    var result = false;
    if (status === '---select status---' || status === '------SET STATUS------') {
        div.innerHTML = 'Select a valid status';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function countryValidate(mystatus, ediv) {
    var status = mystatus;
    var div = ediv;
    var result = false;
    if (status === '---select Country---') {
        div.innerHTML = 'Select a valid country';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function stateValidate(mystatus, ediv) {
    var status = mystatus;
    var div = ediv;
    var result = false;
    if (status === '---select State---') {
        div.innerHTML = 'Select a valid State/Constituency';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function countyValidate1(mystatus, ediv) {
    var status = mystatus;
    var div = ediv;
    var result = false;
    if (status === '---select County---') {
        div.innerHTML = 'Select a valid county';
    } else {
        div.innerHTML = '';
        result = true;
    }
    return result;
}
function ramValidate(myram, ediv) {
    var ram = myram;
    var div = ediv;
    var result = false;
    if (ram.length === 0) {
        result = false;
        div.innerHTML = 'Please provide Ram Size';
    } else if (/[^a-z A-Z 0-9\-]/.test(ram)) {
        result = false;
        div.innerHTML = 'Provide a valid Ram';
    } else if (ram.length < 3) {
        result = false;
        div.innerHTML = 'Ram should contain atleast 3 characters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function romValidate(myrom, ediv) {
    var ram = myrom;
    var div = ediv;
    var result = false;
    if (ram.length === 0) {
        result = false;
        div.innerHTML = 'Please provide HDD Size';
    } else if (/[^a-z A-Z 0-9\-]/.test(ram)) {
        result = false;
        div.innerHTML = 'Provide a valid HDD Size';
    } else if (ram.length < 3) {
        result = false;
        div.innerHTML = 'HDD should contain atleast 3 characters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function processorValidate(myprocessor, ediv) {
    var ram = myprocessor;
    var div = ediv;
    var result = false;
    if (ram.length === 0) {
        result = false;
        div.innerHTML = 'Please provide Processor speed';
    } else if (/[^a-z A-Z 0-9\.]/.test(ram)) {
        result = false;
        div.innerHTML = 'Provide a valid Processor speed';
    } else if (ram.length < 3) {
        result = false;
        div.innerHTML = 'Processor speed should contain atleast 3 characters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function osValidate(myos, ediv) {
    var ram = myos;
    var div = ediv;
    var result = false;
    if (ram.length === 0) {
        result = false;
        div.innerHTML = 'Please provide Os type';
    } else if (/[^a-z A-Z 0-9\-\.]/.test(ram)) {
        result = false;
        div.innerHTML = 'Provide a valid OS name';
    } else if (ram.length < 5) {
        result = false;
        div.innerHTML = 'OS name should contain atleast 5 characters<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function displayValidate(myos, ediv) {
    var ram = myos;
    var div = ediv;
    var result = false;
    if (ram.length === 0) {
        result = false;
        div.innerHTML = 'Please provide Screen size';
    } else if (/[^0-9\.]/.test(ram)) {
        result = false;
        div.innerHTML = 'Provide a valid screen Size.(Only numbers)';
    } else if (ram.length < 2) {
        result = false;
        div.innerHTML = 'Sceen size should contain atleast 2 digit<br>';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function simslotValidate(myos, ediv) {
    var ram = myos;
    var div = ediv;
    var result = false;
    if (ram.length === 0) {
        result = false;
        div.innerHTML = 'Please provide Sim Slots Available';
    } else if (/[^0-9]/.test(ram)) {
        result = false;
        div.innerHTML = 'Provide a Sim Slot number.(Only numbers)';
    } else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}
function propertyValidate(myprop, ediv) {
    var ram = myprop;
    var div = ediv;
    var result = false;
    if (ram.length === 0) {
        result = false;
        div.innerHTML = 'Please provide description for the product';
    } else if (ram.length < 4) {
        result = false;
        div.innerHTML = 'A valid description for the product should contain atleast 4 characters';
    } else if (/[^0-9 a-zA-Z\: \- \&]/.test(ram)) {
        result = false;
        div.innerHTML = 'Provide a valid description for the product\neg Color:red, 3usb ports. e.t.c';
    } /*else if (ram.indexOf(':') <0) {
     result = false;
     div.innerHTML = 'Provide the values in the pair\n Property:Value, eg Color:red';
     }*/ else {
        result = true;
        div.innerHTML = '';
    }
    return result;
}



//
// THIS FUNCTION RECORDS THE LOG OF ALL EVENTS BY A USER!
//

function log() {

}

