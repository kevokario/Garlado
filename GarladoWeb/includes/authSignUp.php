<h3 class="text-center">
    <i class="fa fa-user-plus"></i>
    Sign Up
</h3>
<hr style="margin:3px 3px 19px 3px"/>
<form id="authSignUp">
    <div class="form-group ">
        <label>Email Address</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-envelope-o"></i>
            </span>
            <input type="text" name="email" onfocus="validateClientEmail(this)" onkeyup="validateClientEmail(this)" class="form-control" placeholder="Type/write your email address here"/>
        </div>
        <span class=""></span><small></small>
    </div>
    <div class="form-group ">
        <label>Phone Number</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-phone"></i>
            </span>
            <input type="text" name="phone" onfocus="validateClientPhone(this)" onkeyup="validateClientPhone(this)" class="form-control" placeholder="Type/write your phone number here"/>
        </div>
        <span class=""></span><small></small>
    </div>
    <div class="form-group ">
        <label>Set Password</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-key"></i>
            </span>
            <input type="text" name="password" onfocus="validateClientPassword(this)" onkeyup="validateClientPassword(this)" class="form-control" placeholder="Type/write your password  here"/>
        </div>
        <span class=""></span><small></small>
    </div>
    <div class="form-group" id="authSignUpFb">
    </div>
    <div class="form-group ">
        <button class="btn btn-block mybtn" type="button" onclick="clientSignUp(this)">
            Sign Up <i class="fa fa-user-plus"></i>
        </button>

    </div>
    <div class="form-group ">
        <p>
            Forgotten Password? <a style="cursor: pointer" onclick="loadPassword(this)">Get Password</a>. <span></span>
        </p>
        <p >
            Already have an account?
        </p>
        <p class="myLoader">
            Click here to <a  onclick="loadLogin(this)">Login</a>.       <span></span>  
        </p>
    </div>

</form>