$(document).ready(function () {

    //load the select address page by default
    loadClientAddress();
    //get the email and number variable
    $('#addAddressForm .optionPickup').click(function () {
        optionPickupClicked();
    });
    $('#addAddressForm .optionDoorStep').click(function () {
        optionDoorStepClicked();
    });
    //get the email and number variable
    $('#editClientAddress .optionPickup').click(function () {
        optionPickupClickedEdit();
    });
    $('#editClientAddress .optionDoorStep').click(function () {
        optionDoorStepClickedEdit();
    });

    $('#saveChangesbtn').click(function () {
        saveEditAddress($(this));
    });

    var continuebtn = document.getElementById('continue');
    $(continuebtn).click(function () {
        verifyAddress();
    });

});

////////////////////////////////////////////////////
//              Loaders
////////////////////////////////////////////////////

function loadClientAddress() {
    $('#continue').attr('disabled', 'disabled');
    $.get('includes/selectAddress.php', function (data, status) {
        $('#ContainerArea').html(data);
        $('#continue').removeAttr('disabled');
        optionPickupClicked();
        loadCustomerInfo();
        loadCountries();
    });
}

function loadConfirmOrder() {
    $.get('includes/confirmOrder.php', function (data, status) {
        $('#ContainerArea').html(data);
    });
}

function loadCompleteOrder() {
    $.get('includes/completeOrder.php', function (data, status) {
        $('#ContainerArea').html(data);
    });
}


function optionPickupClicked() {
    var type = document.addAddressForm.selector;
    $(type).val('1');
    $('#addAddressForm .stationDiv').css({'display': 'block'});
    $('#addAddressForm .textAreaDiv textarea').attr({'disabled': 'true'});
    $('#addAddressForm .textAreaDiv textarea').val('');
    $('#addAddressForm .textAreaDiv textarea').parent().parent().removeClass('has-feedback has-error');
    $('#addAddressForm .textAreaDiv textarea').parent().parent().removeClass('has-feedback has-success');
    $('#addAddressForm .textAreaDiv textarea').parent().parent().children('label').removeClass('text-success');
    $('#addAddressForm .textAreaDiv textarea').parent().parent().children('label').removeClass('text-danger');
    $('#addAddressForm .textAreaDiv textarea').parent().parent().children('span').removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
    $('#addAddressForm .textAreaDiv textarea').parent().parent().children('span').removeClass('form-control-feedback glyphicon glyphicon-ok');
    $('#addAddressForm .textAreaDiv textarea').parent().parent().children('small').html('');
}

function optionDoorStepClicked() {
    var type = document.addAddressForm.selector;
    $(type).val('2');
    $('#addAddressForm .stationDiv').css({'display': 'none'});
    $('#addAddressForm .textAreaDiv textarea').removeAttr('disabled');
}

function optionPickupClickedEdit() {
    var type = document.editClientAddress.selector;
    $(type).val('1');
    $('#editClientAddress .stationDiv').css({'display': 'block'});
    $('#editClientAddress .textAreaDiv textarea').attr({'disabled': 'true'});
    $('#editClientAddress .textAreaDiv textarea').val('');
    $('#editClientAddress .textAreaDiv textarea').parent().parent().removeClass('has-feedback has-error');
    $('#editClientAddress .textAreaDiv textarea').parent().parent().removeClass('has-feedback has-success');
    $('#editClientAddress .textAreaDiv textarea').parent().parent().children('label').removeClass('text-success');
    $('#editClientAddress .textAreaDiv textarea').parent().parent().children('label').removeClass('text-danger');
    $('#editClientAddress .textAreaDiv textarea').parent().parent().children('span').removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
    $('#editClientAddress .textAreaDiv textarea').parent().parent().children('span').removeClass('form-control-feedback glyphicon glyphicon-ok');
    $('#editClientAddress .textAreaDiv textarea').parent().parent().children('small').html('');
}

function optionDoorStepClickedEdit() {
    var type = document.editClientAddress.selector;
    $(type).val('2');
    $('#editClientAddress .stationDiv').css({'display': 'none'});
    $('#editClientAddress .textAreaDiv textarea').removeAttr('disabled');
}

//this function gets the email and phone vaiable and feeds data into them

function loadCustomerInfo() {
    var email = $('#clientEmail');
    var phone = $('#clientPhone');
    $('#optionMyDetails').removeClass('unselected');
    $(email).html('<i class="fa fa-pulse fa-refresh"></i>');
    $(phone).html('<i class="fa fa-pulse fa-refresh"></i>');

    $.post('Core/preloader.php', {cat: 'loadCustomerData'}, function (data, status) {
        var jsonData = JSON.parse(data);
        if (jsonData[0] === 'nempty') {
            $(email).html(jsonData[1]);
            $(phone).html(jsonData[2]);
            loadClientAddresses(jsonData[1]);
        } else {
            loadClientAddresses(jsonData[0]);
            $(email).html(jsonData[0]);
            $(phone).html(jsonData[1]);
        }
    });
}

//get the country codes from the database and populate the countru combo
function loadCountries() {
    var country = ('#addAddressForm select:eq(0)');
    var countrySmall = $('#addAddressForm small:eq(3)');
    $(countrySmall).html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post('Core/preloader.php', {
        cat: 'loadCCountries'
    }, function (data, status) {
        $(country).html(data);
        $(countrySmall).html('');
        // $("select").niceSelect();
    });
}
//mke the method to populate the combo county based on country selected
function loadCounties(str) {
    var county = document.addAddressForm.county;
    var countySmall = $('#addAddressForm small:eq(4)');
    if (str === '---Select Country---') {
        $(county).html('<option>---Select County---</option>');
    } else {
        $(countySmall).html('<i class="fa fa-pulse fa-refresh"></i>');
        $.post('Core/preloader.php', {
            cat: 'loadCCounties',
            country: str
        }, function (data, status) {
            $(county).html(data);
            $(countySmall).html('');
        });
    }
}
//populate the constituency based on the county selected
function loadStates(str) {
    var state = document.addAddressForm.state;
    var stateSmall = $('#addAddressForm small:eq(5)');
    if (str === '---Select County---') {
        $(state).html('<option>---Select State---</option>');
    } else {
        $(stateSmall).html('<i class="fa fa-pulse fa-refresh"></i>');
        $.post('Core/preloader.php', {
            cat: 'loadSttates',
            state: str
        },
                function (data, status) {
                    $(state).html(data);
                    $(stateSmall).html('');
                }
        );
    }
}
//populate the station based on the constituency selected
function loadStations(str) {
    var station = document.addAddressForm.station;
    var stationSmall = $('#addAddressForm small:eq(6)');
    if (str === '---Select State---') {
        $(station).html('<option>---Select Station---</option>');
    } else {
        $(stationSmall).html('<i class="fa fa-pulse fa-refresh"></i>');
        $.post('Core/preloader.php', {
            cat: 'loadSttations',
            station: str
        },
                function (data, status) {
                    $(station).html(data);
                    $(stationSmall).html('');
                }
        );
    }
}

//populate address details based on the station selected
function loadStationAddress(str) {
    var description = document.addAddressForm.description;
    var descriptionSmall = $('#addAddressForm small:eq(7)');
    if (str === '---Select Station---') {
        $(description).val('');
    } else {
        $(descriptionSmall).html('<i class="fa fa-pulse fa-refresh"></i>');
        $.post('Core/preloader.php', {
            cat: 'loadStationAddress',
            station: str
        },
                function (data, status) {
                    $(description).val(data);
                    $(descriptionSmall).html('');
                }
        );
    }
}
//this function adds address
function addAddress(btn) {
    var i = $(btn).children('i');
    var form = document.addAddressForm;
    var selector = form.selector;
    var fName = form.fName;
    var lName = form.lName;
    var number = form.pNumber;
    var country = form.country;
    var county = form.county;
    var constituency = form.state;
    var station = form.station;
    var description = form.description;

    var fnst = validateClientName(fName);
    var lnst = validateClientName(lName);
    var phst = validateClientPhone(number);
    var contst = validateCountry(country);
    var counst = validateCounty(county);
    var constst = validateState(constituency);
    var myJson = new Array();
    var okstat = false;
    //json Format 
    /*
     addresstype,email,fname,lname,phone,constituency,addressdescription
     */

    //set pickup station
    if (selector.value === '1') {
        var stationst = validateStation(station);
        if (fnst === true && lnst === true && phst === true && contst === true && counst === true && constst === true && stationst === true)
        {
            myJson[0] = 'PickupStation';
            myJson[1] = $('#clientEmail').text();
            myJson[2] = fName.value.trim();
            myJson[3] = lName.value.trim();
            myJson[4] = number.value.trim();
            myJson[5] = constituency.value.trim();
            myJson[6] = description.value.trim();
            myJson[7] = 'pickup';
            okstat = true;
        }
    }
    //door step deliver
    else {
        var sdescst = validateDescription(description);
        if (fnst === true && lnst === true && phst === true && contst === true && counst === true && constst === true && sdescst === true) {
            myJson[0] = 'doorStep';
            myJson[1] = $('#clientEmail').text();
            myJson[2] = fName.value.trim();
            myJson[3] = lName.value.trim();
            myJson[4] = number.value.trim();
            myJson[5] = constituency.value.trim();
            myJson[6] = description.value.trim();
            myJson[7] = 'doorstep';
            okstat = true;
        }
    }

    //complete validation of the data types Yo!
    if (okstat === true) {
        var json = JSON.stringify(myJson);
        $(i).removeClass('fa-save');
        $(i).addClass('fa-pulse fa-refresh');
        $.post('Core/preloader.php',
                {
                    cat: 'addNewClientAddress',
                    jsonData: json
                },
                function (data, status) {
                    $(i).removeClass('fa-pulse fa-refresh');
                    $(i).addClass('fa-save');
                    var array = JSON.parse(data);
                    if (array[0] === 'Success') {
                        $('#clientAddresses').html(array[1]);
                        $('#modalAddress').modal('toggle');
                        test('You successfuly added An Address! Please Click the <b>Continue</b> button to proceed.');
                    }
                }
        );
    }
}

//populate the address data on load
function loadClientAddresses(email) {
    var div = $('#clientAddresses');
    $(div).html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post('Core/preloader.php', {
        cat: 'loadClientAddresses',
        email: email
    }, function (data, status) {
        $(div).html(data);
    }
    );
}

function editAddressData(str) {
    var form = document.editClientAddress;
    form.address.value = str;
    $('#editClientData h3 i').addClass('fa fa-pulse fa-refresh');
    $('#saveChangesbtn').attr('disabled', 'disabled');
    $.post('Core/preloader.php', {
        cat: 'editAddressData',
        id: str
    }, function (data, status) {
        $('#editClientData h3 i').removeClass('fa fa-pulse fa-refresh');
        $('#saveChangesbtn').removeAttr('disabled', 'disabled');
        var d = JSON.parse(data);
        form.fName.value = d.fname;
        form.lName.value = d.lname;
        form.pNumber.value = d.phone;
        form.country.innerHTML = '<option>' + d.country + '</option><option>---Select Country---</option>';
        form.county.innerHTML = fillDataOption(d.counties) + '<option>---Select County---</option>';
        form.state.innerHTML = fillDataOption(d.states) + '<option>---Select State---</option>';
        form.station.innerHTML = fillDataOption(d.stations) + '<option>---Select Station---</option>';
        if (d.addressType === 'doorstep') {
            $('#editClientAddress .stationDiv').css('display', 'none');
            $('#editClientAddress .textAreaDiv textarea').removeAttr('disabled', 'disabled');
            form.selector.value = 2;
        } else {
            $('#editClientAddress .stationDiv').css('display', 'block');
            $('#editClientAddress .textAreaDiv textarea').attr('disabled', 'disabled');
            form.selector.value = 1;
        }
        form.description.value = d.description;
    });
    $('#editClientData').modal('show');
}

function fillDataOption(array) {
    var fb = '';
    for (var a = 0; a < array.length; a++) {
        fb += "<option>" + array[a] + "</option>";
    }
    return fb;
}


//mke the method to populate the combo county based on country selected
function loadCountiese(str) {
    var county = document.editClientAddress.county;
    var countySmall = $('#editClientAddress small:eq(4)');
    if (str === '---Select Country---') {
        $(county).html('<option>---Select County---</option>');
    } else {
        $(countySmall).html('<i class="fa fa-pulse fa-refresh"></i>');
        $.post('Core/preloader.php', {
            cat: 'loadCCounties',
            country: str
        }, function (data, status) {
            $(county).html(data);
            $(countySmall).html('');
        });
    }
}
//populate the constituency based on the county selected
function loadStatese(str) {
    var state = document.editClientAddress.state;
    var stateSmall = $('#editClientAddress small:eq(5)');
    if (str === '---Select County---') {
        $(state).html('<option>---Select State---</option>');
    } else {
        $(stateSmall).html('<i class="fa fa-pulse fa-refresh"></i>');
        $.post('Core/preloader.php', {
            cat: 'loadSttates',
            state: str
        },
                function (data, status) {
                    $(state).html(data);
                    $(stateSmall).html('');
                }
        );
    }
}
//populate the station based on the constituency selected
function loadStationse(str) {
    var station = document.editClientAddress.station;
    var stationSmall = $('#editClientAddress small:eq(6)');
    if (str === '---Select State---') {
        $(station).html('<option>---Select Station---</option>');
    } else {
        $(stationSmall).html('<i class="fa fa-pulse fa-refresh"></i>');
        $.post('Core/preloader.php', {
            cat: 'loadSttations',
            station: str
        },
                function (data, status) {
                    $(station).html(data);
//                    test(data);
                    $(stationSmall).html('');
                }
        );
    }
}

//populate address details based on the station selected
function loadStationAddresse(str) {
    var description = document.editClientAddress.description;
    var descriptionSmall = $('#editClientAddress small:eq(7)');
    if (str === '---Select Station---') {
        $(description).val('');
    } else {
        $(descriptionSmall).html('<i class="fa fa-pulse fa-refresh"></i>');
        $.post('Core/preloader.php', {
            cat: 'loadStationAddress',
            station: str
        },
                function (data, status) {
                    $(description).val(data);
//                    test(data);
                    $(descriptionSmall).html('');
                }
        );
    }
}

//this function adds address
function saveEditAddress(btn) {
    var i = $(btn).children('i');
    var form = document.editClientAddress;
    var addressId = form.address.value;
    var selector = form.selector;
    var fName = form.fName;
    var lName = form.lName;
    var number = form.pNumber;
    var country = form.country;
    var county = form.county;
    var constituency = form.state;
    var station = form.station;
    var description = form.description;

    var fnst = validateClientName(fName);
    var lnst = validateClientName(lName);
    var phst = validateClientPhone(number);
    var contst = validateCountry(country);
    var counst = validateCounty(county);
    var constst = validateState(constituency);
    var myJson = new Array();
    var okstat = false;
    //json Format 
    /*
     addresstype,email,fname,lname,phone,constituency,addressdescription,addresstype,addressId
     */

    //set pickup station
    if (selector.value === '1') {
        var stationst = validateStation(station);
        if (fnst === true && lnst === true && phst === true && contst === true && counst === true && constst === true && stationst === true)
        {
            myJson[0] = 'PickupStation';
            myJson[1] = $('#clientEmail').text();
            myJson[2] = fName.value.trim();
            myJson[3] = lName.value.trim();
            myJson[4] = number.value.trim();
            myJson[5] = constituency.value.trim();
            myJson[6] = description.value.trim();
            myJson[7] = 'pickup';
            myJson[8] = addressId;
            okstat = true;
        }
    }
    //door step deliver
    else {
        var sdescst = validateDescription(description);
        if (fnst === true && lnst === true && phst === true && contst === true && counst === true && constst === true && sdescst === true) {
            myJson[0] = 'doorStep';
            myJson[1] = $('#clientEmail').text();
            myJson[2] = fName.value.trim();
            myJson[3] = lName.value.trim();
            myJson[4] = number.value.trim();
            myJson[5] = constituency.value.trim();
            myJson[6] = description.value.trim();
            myJson[7] = 'doorstep';
            myJson[8] = addressId;
            okstat = true;
        }
    }

    //complete validation of the data types Yo!
    if (okstat === true) {
        var json = JSON.stringify(myJson);
        $(i).removeClass('fa-save');
        $(i).addClass('fa-pulse fa-refresh');
        $.post('Core/preloader.php',
                {
                    cat: 'saveEditAddress',
                    jsonData: json
                },
                function (data, status) {
                    $(i).removeClass('fa-pulse fa-refresh');
                    $(i).addClass('fa-save');
                    var array = JSON.parse(data);
                    if (array[0] === 'Success') {
                        $('#clientAddresses').html(array[1]);
                        $('#editClientData').modal('toggle');
                        test('Changes Successfuly saved!');
                    }
                }
        );
    }
}


//====================================
// delete function
//====================================

function deleteAddressData(str) {
    var i = $(str).children('i');
    $(i).removeClass('fa-trash-o');
    $(i).addClass('fa-pulse fa-refresh');
    var email = $('#clientEmail').text();
    var address = $(str).val();
    var json = JSON.stringify([email, address]);
    $.post('Core/preloader.php', {
        cat: 'deleteAddressData',
        jsonData: json
    }, function (data, status) {
        var array = JSON.parse(data);
        if (array[0] === 'Success') {
            $('#clientAddresses').html(array[1]);
        }
    });
}
/*
 ========================================================================
 WE CONTINUE AFTER ADDRESS VERIFICATION
 ========================================================================
 */

function verifyAddress(str) {
    var email = $('#clientEmail').text();
    var i = $(str).children('i');
    $(i).removeClass('fa-chevron-right');
    $(i).addClass('fa-pulse fa-refresh');
    $.post('Core/preloader.php',
            {
                cat: 'verifyAddress',
                email: email
            },
            function (data, status) {
                $(i).removeClass('fa-pulse fa-refresh');
                $(i).addClass('fa-chevron-right');
                var json = JSON.parse(data);
                if (json[0] === 'No Address') {
                    test('<p class="text-justify">No addresses found! Please add an address first before continuing.</p>');
                }
                if (json[0] === 'Single Address') {
                    loadOrderPayment(json[1]);
                }
                if (json[0] === 'Multiple Address') {
                    $('#modalSelectAddress .addressOptions').html(json[1]);
                    $('#modalSelectAddress').modal('show');
                }
            }
    );

}

function optionSelected() {
    var form = document.selectAddress;
    var choice = form.optionaddress.value;
    if (choice.length === 0) {
        $('#modalSelectAddress').modal('toggle');
        test('<p class="text-center"> Please <b>click</b> on an address to select first befere we Continue!</p>');
    } else {
        //some function that does something when we have selected some figure!
        var btn = document.getElementById('continue');
        var i = $(btn).children('i');
        $(i).addClass('fa-chevron-right');
        $(i).removeClass('fa-pulse fa-refresh');
        loadOrderPayment(choice);
        $('#modalSelectAddress').modal('toggle');
    }
}

function loadOrderPayment(str) {
    var btn = document.getElementById('continue');
    var i = $(btn).children('i');
    $(i).addClass('fa-chevron-right');
    $(i).removeClass('fa-pulse fa-refresh');
    $('#optionMyDetails').addClass('unselected');
    $('#optionOrderPayment').removeClass('unselected');
    $.post('Core/preloader.php', {
        cat: 'loadOrderPayment',
        address: str
    }
    , function (data, status) {
        if (data === 'set') {
            $(i).removeClass('fa-chevron-right');
            $(i).addClass('fa-pulse fa-refresh');
            var clientEmail = $('#clientEmail').text();

            $.get('includes/confirmOrder.php', function (data, status) {
                $('#ContainerArea').html(data);
                var div = document.getElementById('confirmOrderDiv');
                var itemcount = $('#confirmOrderDiv table tr:eq(0) td:eq(0) p b span');
                var price = $('#confirmOrderDiv table tr:eq(0) td:eq(1) span');
                var desti = $('#confirmOrderDiv table tr:eq(2) td:eq(0) small span');
                var shipp = $('#confirmOrderDiv table tr:eq(2) td:eq(1) b span');
                var payAm = $('#confirmOrderDiv table tr:eq(3) td:eq(1) b span');
                var name = $('#confirmOrderDiv table tr:eq(4) td:eq(0) b span');
                var phone = $('#confirmOrderDiv table tr:eq(4) td:eq(1) b');
                var descr = $('#confirmOrderDiv table tr:eq(5) td p');
                //append a function to the buttons on this loaded idv
                // first we append to button back
                $('#confirmOrderDiv button:eq(0)').click(function () {
                    $(this).children('i').removeClass('fa-chevron-left').addClass('fa-pulse fa-refresh');
                    loadClientAddress();
                    $('#optionMyDetails').removeClass('unselected');
                    $('#optionOrderPayment').addClass('unselected');
                });
//                 second we append to the place order button
//                -----------------------------------------------------------------------------------------------------
//                -----------------------------------------------------------------------------------------------------
//                --------          THE BUTTON THAT IS SUPPOSED TO SIMULATE MPESA PAYMENT IS HERE               -------
//                -----------------------------------------------------------------------------------------------------
//                -----------------------------------------------------------------------------------------------------
//                
                $('#confirmOrderDiv button:eq(1)').click(function () {
//                   
                    $('#modalSimulatePayment').modal('show');

                    // here we append an onclick method to the proceed button.
                    $('#modalSimulatePayment button:eq(0)').click(function () {
                        simulatePaymentProceed($(this));
//                        alert($(this).text());
                    });
                });

                $('#ihavepaidDiv button:eq(0)').click(function () {
                    unPaidConfirmed();
                });
                $('#ihavepaidDiv button:eq(1)').click(function () {
                    paidConfirmed();
                });
                // function appending end here
                const load = '<i class="fa fa-pulse fa-refresh"></i>';
                $(itemcount).html(load);
                $(price).html(load);
                $(desti).html(load);
                $(shipp).html(load);
                $(payAm).html(load);
                $(name).html(load);
                $(phone).html(load);
                $(descr).html(load);
                $.post('Core/preloader.php',
                        {
                            cat: 'getConfirmOrderDetails',
                            address: str
                        },
                        function (data, status) {

                            var json = JSON.parse(data);
                            $(itemcount).html(json[0]);
                            $(price).html(json[1]);
                            $(desti).html(json[4]);
                            $(shipp).html(json[2]);
                            $(payAm).html(json[3]);
                            $(name).html(json[5]);
                            $(phone).html(json[6]);
                            $(descr).html(json[7]);
                        });
            });
        }
    });

}

//this function is repsonsible for tow things 
// 1 : placement of the order!
// 2 : the start simulation of the mpesa payment method
function simulatePaymentProceed(btn) {
    var i = $(btn).children('i');

    //step 1: place order
    orderPlacement(i);


}
var order_no ='';
var amt = '';

function setOrderNo(str){
    order_no = str;
}
function setAmt( str){
    amt = str;
}
function getOrderNo(){
    return order_no;
}
function getAmt(){
    return amt;
}
function orderPlacement(str) {
    var email = $('#clientEmail').text();
    var phone = $('#clientEmail').text();
    var btn = $(str).parent();
    var json = JSON.stringify([email, phone]);
    $(str).addClass('fa-pulse fa fa-refresh');
    $(btn).attr('disabled', 'disabled');
    $.post('Core/preloader.php', {
        cat: 'orderPlacement',
        json: json
    }, function (data, status) {
        //step 2: simulate payment
            var data1 = JSON.parse(data);
        if (data1[0] == 'order placed') {
            setAmt(data1[2]);
            setOrderNo(data1[1]);
            $(str).removeClass('fa-pulse fa-refresh');
            $(btn).removeAttr('disabled');
            $('#modalSimulatePayment').modal('toggle');
            $('#ihavepaidDiv').modal('show');

        } else {
            
        }
    });
}

function paidConfirmed() {
    $('#ihavepaidDiv').modal('toggle').animate({}, 1000, function () {
        $('#confirmOrderDiv button:eq(1) i').removeClass('fa-money').addClass('fa-pulse fa-refresh');
        $.get('includes/completeOrder.php', function (data, status) {
            $('#ContainerArea').html(data);
            //this function sets data to the div
            updateCompleteOrder();
            $('#optionCompleteOrder').removeClass('unselected');
            $('#optionOrderPayment').addClass('unselected');
        });
    });
}

function unPaidConfirmed() {
    $('#ihavepaidDiv').modal('toggle').animate({}, 900, function () {
        $('#modalSimulatePayment').modal('toggle');
    });
}

function updateCompleteOrder(){
    $('#completeOrderDiv table tbody tr:eq(0) td:eq(2)').text(getOrderNo());
    $('#completeOrderDiv table tbody tr:eq(1) td:eq(2)').text('ksh. '+getAmt());
    $('#completeOrderDiv table tbody tr:eq(2) button:eq(0)').click(function(){
        document.location.href="./";
    });
    $('#completeOrderDiv table tbody tr:eq(2) button:eq(1)').click(function(){
        document.location.href = "./shopping-cart.php";
    });
}