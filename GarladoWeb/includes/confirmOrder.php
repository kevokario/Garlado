<div id="confirmOrderDiv" class="col-sm-12 confirmOrderDiv">
    <div class="row">
        <div class="col-sm-12" >
            <h2>
                Confirm My Order.
            </h2>
            <p>Please read confirm your order to ensure everything is well before you create the order.</p>
        </div>
        <div class="col-sm-12 addressDiv text-right">
            <table style="width: 100%">
                <tr>
                    <td>
                        <p>
                            <b>
                                <span></span> items, total Order Amount :
                            </b>
                        </p>
                    </td>
                    <td>
                        <p>
                            <b>
                                Ksh <span></span>
                            </b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <small>Inclusive of Tax</small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><small>Destination type <i class="fa fa-question-circle-o"></i> <span></span></small>
                            <b>Shipping Fee : </b>
                        </p>  
                    </td>
                    <td>
                        <p>
                            <b>
                                Ksh  <span></span>
                            </b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <b>
                                Payment Amount : 
                            </b>
                        </p>
                    </td>
                    <td>
                        <p class="totalAmount">
                            <b>KSH. <span></span></b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td><p>
                            <b><span> </span> : </b>
                        </p>
                    </td>
                    <td><p>
                            <b> </b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>
                        </p>
                    </td>
                </tr>
            </table>

        </div>
        <div class="text-center">
            <button class="btn mybtnAddress buttonContinue mybtnEdit"> <i class="fa fa-chevron-left"></i> Back</button>
            <button class="btn mybtnAddress buttonContinue mybtnDelete">Place Order <i class="fa fa-money"></i></button>
        </div>
    </div>
</div>

<div class="modal" role="dialog" id="modalSimulatePayment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center"> M-PESA Account <a class="btn mybtnAddress mybtnDelete pull-right" data-dismiss="modal">&times;</a></h3>
                <hr class="myHr">

                <ul class="text-justify">
                    <li>
                        Confirm your Phone Number. If ok then <b class="text-primary">'Proceed'</b> to generate payment on your 
                        phone.
                    </li>
                    <li>
                        Enter your <b>M-PESA PIN </b> on prompt-popup on your phone to generate payment. 
                    </li>
                    <li>
                        This phone number can be edited in the <span class='text-info'>'edit address'</span> section
                    </li>
                </ul>
                
                <p class='bg-danger' id="mpesa_number">
                    0704219247
                </p>
                
                <hr class="myHr">
                <div class="text-center">
                <button class="btn mybtnAddress buttonContinue mybtnDelete">
                    PROCEED <i></i>
                </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal " data-backdrop="static" role="dialog" id="ihavepaidDiv">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center">Verify Payment<a class=" pull-right btn customPaid" data-dismiss="modal">&times;</a></h3>
                <hr class="myHr">
                <p>Have you paid for your product?</p>
                <ul class="text-justify">
                    <li>
                        If yes, click the 'I have Paid' button to proceed.
                    </li>
                    <li>
                       If no, click the 'I have not Paid' button to restart the process again. 
                    </li>
                </ul>
                <button class="btn btn-block customUnpaid">
                    I have not Paid
                </button>
                <button class="btn btn-block  customPaid">
                    I have Paid <i></i>
                </button>
            </div>
        </div>
    </div>
</div>
