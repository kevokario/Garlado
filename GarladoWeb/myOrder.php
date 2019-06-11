<?php
require_once './Core/functions.php';
if (isset($_SESSION['ClientLoggedIn']) === false) {
    header('location:GarladoAuth');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Garlado Online Store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Cache-Control" content="no-store" />
        <link rel="stylesheet" href="Res1/bs/css/bootstrap.min.css"/>
        <link href="css/mOstyle1.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="Res1/bs/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="Res1/fa/css/font-awesome.min.css"/>
        <link rel="icon" href="img/logo.png"/>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 myOrderLogo">
                    <a href="Home"><img class="orderLogoImg" alt="Garlado Online Store" src="img/logo1.png"></a>
                    <h4>Garlado Online Store</h4>
                </div>
                <div class="col-sm-5 col-sm-offset-4">
                    <table class="orderLogoTable table">
                        <tr>
                            <td>
                                <div id="optionMyDetails" class="unselected">
                                    <i class="fa fa-2x fa-pencil"></i>
                                    <br>
                                    <small>My Details</small>
                                </div>
                            </td>
                            <td>
                                <div  id="optionOrderPayment" class="unselected">
                                    <i class="fa fa-2x fa-credit-card"></i>
                                    <br>
                                    <small>Order Payment</small>
                                </div>
                            </td>
                            <td>
                                <div  id="optionCompleteOrder" class="unselected">
                                    <i class="fa fa-2x fa-thumbs-o-up"></i>
                                    <br>
                                    <small>Complete Order</small>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12">
                    <hr class="myHr">
                </div>
            </div>

            <!--this is my data div yo!-->
            <div class="row myInfoDiv">
                <div class="col-sm-9">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3><i class="fa fa-user-o"></i> My Information</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        <i class="fa fa-envelope-square"></i> Email
                                    </label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static" id="clientEmail"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">
                                        <i class="fa fa-phone"></i> Phone
                                    </label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static" id="clientPhone"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="ContainerArea">
                <div class="col-sm-12 addressDivTitle">
                    <h2><i class="fa fa-address-card-o"></i> Fill in Address Details.</h2>
                    <p>Please provide defined address information for timely delivery.
                    </p>
                </div> 
                <div class="addressDiv col-sm-12">
                    <p class="addressAdd">
                        <i class="fa fa-plus"></i> 
                        <span data-toggle="modal" data-target="#modalAddress">Add Address</span>
                    </p>
                    <div class="col-sm-12" id="clientAddresses">
                    </div>
                </div>
                <div class="col-sm-4 text-center col-sm-offset-4">
                    <button onclick="verifyAddress(this)" id="continue" class="buttonContinue">Continue <i class="fa fa-chevron-right"></i></button>
                </div>
            </div>


        </div>
        <!--
                ====================================================================================================================
                    THIS CODE HERE SHOULD BE MOVED TO ANOTHER PART OF THE SCREEN. WE WILL FIGURE IT OUT. BUT NOW, IT BE HERE
                ====================================================================================================================
        -->

        <!--
                ====================================================================================================================
                ====================================================================================================================
        -->
        <div class="container-fluid paydiv">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Payment Options</h2>
                    <hr/>
                    <div class="moneyDiv">
                        M-PESA
                    </div>
                    <p>You can pay us via <strong>M-PESA</strong>. 
                        Please ensure that you provide correct address and order information and we will take care of the rest.</p>
                </div>
            </div>
        </div>
        <div class="modal" role="dialog" data-backdrop="static" id="modalAddress">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">

                            </div>
                            <div class="col-sm-12">
                                <h3 class="text-center">
                                    Add New Address
                                    <span class="btn mybtnAddress pull-right mybtnDelete" style="cursor:pointer" data-dismiss="modal" data-target="#modalAddress" class="pull-right">
                                        &times; 
                                    </span>
                                </h3>
                                <hr class="myHr"/>


                                <form id="addAddressForm" name="addAddressForm">
                                    <input type="hidden" name="selector"/>
                                    <div class="form-group">
                                        <label class="control-label">First Name : </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                            <input type="text" 
                                                   class="form-control"
                                                   name="fName"
                                                   onfocus="validateClientName(this)" onkeyup="validateClientName(this)"
                                                   placeholder="Please provide your First name"/>
                                        </div>
                                        <span class=""></span><small></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Name : </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user-o"></i>
                                            </span>
                                            <input type="text" class="form-control"
                                                   name="lName"
                                                   onfocus="validateClientName(this)" onkeyup="validateClientName(this)"
                                                   placeholder="Please provide your Last name"/>
                                        </div>
                                        <span class=""></span><small></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Phone Number : </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text" name="pNumber"
                                                   onfocus="validateClientPhone(this)" onkeyup="validateClientPhone(this)"
                                                   class="form-control" placeholder="eg. 0712345678"/>
                                        </div>
                                        <span class=""></span><small></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" class="optionPickup">Set a Pickup Station <i class="fa fa-info-circle"></i></button>
                                            <button type="button" class="optionDoorStep">Deliver to my door step <i class="fa fa-motorcycle"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Select your Country</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i>C</i>
                                                    </span>
                                                    <select name="country"
                                                            onfocus="validateCountry(this)" 
                                                            onchange="validateCountry(this), loadCounties(this.value)"
                                                            class="form-control">
                                                        <option>---Select Country---</option>
                                                    </select>
                                                </div>
                                                <span class=""></span><small></small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Select your County/Province</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i>P</i>
                                                    </span>
                                                    <select name="county"
                                                            onfocus="validateCounty(this)" onchange="validateCounty(this), loadStates(this.value)"
                                                            class="form-control">
                                                        <option>---Select County---</option>
                                                    </select>
                                                </div>
                                                <span class=""></span><small></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Select your State/Constituency</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i>S</i>
                                                    </span>
                                                    <select name="state"
                                                            onfocus="validateState(this)" 
                                                            onchange="validateState(this), loadStations(this.value)"
                                                            class="form-control">
                                                        <option>---Select State---</option>
                                                    </select>
                                                </div>
                                                <span class=""></span><small></small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 stationDiv">
                                            <div class="form-group">
                                                <label>Select a Station near you</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-fort-awesome"></i>
                                                    </span>
                                                    <select name="station"
                                                            onfocus="validateStation(this)" 
                                                            onchange="validateStation(this), loadStationAddress(this.value)"
                                                            class="form-control">
                                                        <option>---Select Station---</option>
                                                    </select>
                                                </div>
                                                <span class=""></span><small></small>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group textAreaDiv">
                                        <label>Address</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                            <textarea name="description"
                                                      onkeyup="validateDescription(this)"
                                                      onfocus="validateDescription(this)"
                                                      class="form-control" rows="4" placeholder="Provide a detailed addres here"></textarea>
                                        </div>
                                        <span class=""></span><small></small>
                                    </div>
                                    <div class="form-group text-center">
                                        <button onclick="addAddress(this)" type="button" class="btn mybtnAddress mybtnDelete">
                                            Save <i class="fa fa-save"></i>
                                        </button>
                                        <button type="reset" class="btn mybtnAddress mybtnEdit">
                                            Clear <i class="fa fa-remove"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--
        Modal delete my address
        -->
        <div data-backdrop="static" class="modal" role="dialog" id="editClientData">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 class="text-center">
                            Edit My Address <i></i>
                            <span class="btn mybtnAddress pull-right mybtnDelete" style="cursor:pointer" data-dismiss="modal" data-target="#modalAddress" class="pull-right">
                                &times; 
                            </span>
                        </h3>
                        <hr class="myHr"/>

                        <form name="editClientAddress" id="editClientAddress">
                            <input type="hidden" name="selector"/>
                            <input type="hidden" name="address"/>
                            <div class="form-group">
                                <label>First Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-o"></i>
                                    </span>
                                    <input type="text"
                                           name="fName"
                                           placeholder="Please provide your first Name"
                                           onfocus="validateClientName(this)"
                                           onkeyup="validateClientName(this)"
                                           class="form-control"/>
                                </div>
                                <small></small><span class=""></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-o"></i>
                                    </span>
                                    <input type="text"
                                           name="lName"
                                           placeholder="Please provide your last Name"
                                           onfocus="validateClientName(this)"
                                           onkeyup="validateClientName(this)"
                                           class="form-control"/>
                                </div>
                                <small></small>
                                <span class=""></span>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="text"
                                           name="pNumber"
                                           placeholder="Please provide your phone number"
                                           onfocus="validateClientPhone(this)"
                                           onkeyup="validateClientPhone(this)"
                                           class="form-control"/>
                                </div>
                                <small></small>
                                <span class=""></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="optionPickup">
                                        Set a Pickup Station <i class="fa fa-info-circle"></i>
                                    </button>
                                    <button type="button" class="optionDoorStep">
                                        Deliver to my door step 
                                        <i class="fa fa-motorcycle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select Country</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i>C</i>
                                            </span>
                                            <select name="country"
                                                    onfocus="validateCountry(this)" 
                                                    onchange="validateCountry(this), loadCountiese(this.value)"
                                                    class="form-control">
                                                <option>---Select Country---</option>
                                            </select>
                                        </div>
                                        <span class=""></span><small></small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select County/Province</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i>P</i>
                                            </span>
                                            <select name="county"
                                                    onfocus="validateCounty(this)" onchange="validateCounty(this), loadStatese(this.value)"
                                                    class="form-control">
                                                <option>---Select County---</option>
                                            </select>
                                        </div>
                                        <span class=""></span><small></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select State/Constituency</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i>S</i>
                                            </span>
                                            <select name="state"
                                                    onfocus="validateState(this)" 
                                                    onchange="validateState(this), loadStationse(this.value)"
                                                    class="form-control">
                                                <option>---Select State---</option>
                                            </select>
                                        </div>
                                        <span class=""></span><small></small>
                                    </div>
                                </div>
                                <div class="col-sm-6 stationDiv">
                                    <div class="form-group">
                                        <label>Select a Station near you</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-fort-awesome"></i>
                                            </span>
                                            <select name="station"
                                                    onfocus="validateStation(this)" 
                                                    onchange="validateStation(this), loadStationAddresse(this.value)"
                                                    class="form-control">
                                                <option>---Select Station---</option>
                                            </select>
                                        </div>
                                        <span class=""></span><small></small>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group textAreaDiv">
                                <label>Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <textarea name="description"
                                              onkeyup="validateDescription(this)"
                                              onfocus="validateDescription(this)"
                                              class="form-control" rows="4" placeholder="Provide a detailed addres here"></textarea>
                                </div>
                                <span class=""></span><small></small>
                            </div>
                            <div class="form-group text-center">
                                <button onclick="" id="saveChangesbtn"  type="button" class="btn mybtnAddress mybtnDelete">
                                    Save Changes <i class="fa fa-save"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php
        include './includes/footer.php';
        include './includes/popUpMode.php';
        ?>
        <!--this modal collects all the addresses present in question-->
        <div class="modal" role="dialog" data-backdrop="static" id="modalSelectAddress">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3 class="text-center">
                            Select an Address <i></i>
                            <span class="btn mybtnAddress pull-right mybtnDelete" style="cursor:pointer" data-dismiss="modal" data-target="#modalAddress" class="pull-right">
                                &times; 
                            </span>
                        </h3>
                        <hr class="myHr"/>

                        <form name="selectAddress">
                            <div class="addressOptions" style="height: 240px; overflow-y: auto; margin-left: auto;margin-right: auto">

                            </div>
                            <div class="form-group text-center buttonDiv">
                                <button onclick="optionSelected()" type="button" class="mybtnAddress mybtnDelete">
                                    Submit <i class="fa fa-map-marker"></i>
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

    </body>
    <script src="Res1/bs/js/jquery-3.3.1.js"></script>
    <script src="JS/Ajax.js" type="text/javascript"></script>
    <script src="Res1/bs/js/bootstrap.min.js"></script>
    <script src="Res1/bs/js/jquery.wait.js" type="text/javascript"></script>
    <script src="JS/@defaultLoaders.js" type="text/javascript"></script>
    <script src="JS/moScript.js" type="text/javascript"></script>
</html>

<!--



-->