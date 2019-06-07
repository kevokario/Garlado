<h3 class="text-center">
    <i class="fa fa-user-o"></i>
    Login
</h3>
<hr style="margin:3px 3px 19px 3px"/>
<form id="authLogin">
    <div class="form-group ">
        <label>Provide Email</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-envelope-o"></i>
            </span>
            <input type="text" onfocus="validateClientEmail(this)" onkeyup="validateClientEmail(this)" class="form-control" placeholder="Your email,your username!"/>
        </div>
        <span></span><small></small>
    </div>
    <div class="form-group ">
        <label>Provide Password</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-key"></i>
            </span>
            <input type="password" onfocus="validateClientPassword(this)" onkeyup="validateClientPassword(this)" class="form-control" placeholder="Type your password here"/>
        </div>
        <span></span><small></small>
    </div>
    <div class="form-group ">
        <button class="btn btn-block mybtn" type="button" onclick="clientLogin(this)">
            Login <i class="fa fa-unlock-alt"></i>
        </button>

    </div>
    <div class="form-group ">
        <p>
            Forgotten Password? <a style="cursor: pointer" onclick="loadPassword(this)">Get Password</a>. <span></span>
        </p>
        <p >
            Don't have an account?
        </p>
        <p class="myLoader" >
            <a onclick="loadSignUp(this)">Sign Up here</a>.       <span></span>  
        </p>
    </div>

</form>