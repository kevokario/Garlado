<div class="col-sm-12">
  
    <h3 class="text-center">
        <span class="fa fa-stack">
            <i class="fa fa-stack-1x fa-smile-o"></i>
            <i class="fa fa-stack-2x fa-square-o"></i>
        </span>  ACCOUNT VERIFICATION
    </h3>
        <hr style="margin: 5px;">
        <p class="text-justify" style="margin: 18px 0px">
            Enter the <b>CODE</b> sent to the below phone number.
        </p>
        <p id="userNumber" class="bg-danger">Garlado Online Store</p>
        <form id="verifyForm" name="verifyForm">
            <div class="form-group">
                <label>CODE</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-code"></i>
                    </span>
                    <input type="text" name="code" class="form-control" placeholder="Type Code here">
                </div>
                <span class=""></span><small></small>
            </div>
            <div class="form-group">
                <button onclick="codeVerification(this)" type="button" class="mybtn btn btn-block">
                    SUBMIT <i class="fa fa-send-o"></i>
                </button>
            </div>
            <div class="form-group">
                <p style="margin: 17px 0px">
                    Din't get the Code? Click here to get the Code
                </p>
                <button onclick="getResendCode(this)" type="button" class="mybtn1 text-uppercase btn btn-block">
                    Get Code <i class="fa fa-openid"></i>
                </button>
            </div>
        </form>
        <p style="margin: 20px 0px 10px 0px">
            Back to <a id="backtoSignupClick" onclick="loadSignUp(this)">Sign up</a> <span></span>.
        </p>
   
</div>
<style>
    #backtoSignupClick{
        cursor:pointer;
        text-decoration: none;
    }
    #userNumber{
       padding:10px;
       border-left: 9px solid #F2746B;
       color:#000D29; 
    }
</style>