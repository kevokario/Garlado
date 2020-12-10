<h3 class="text-center">
    <i class="fa fa-key"></i>
    Get Password
</h3>
<hr style="margin:3px 3px 19px 3px"/>
<form id="authPassword">
    <div class="form-group ">
        <label>Provide Email</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-envelope-o"></i>
            </span>
            <input type="text" class="form-control" placeholder="Your email,your username!"/>
        </div>
        <span></span><small class='text-danger'></small>
    </div>
    
    <div class="form-group ">
        <button class="btn btn-block mybtn" type="button" onclick="clientPassword()">
            Recover
        </button>

    </div>
    <div class="form-group ">
        
        <p class="myLoader">
            <a  onclick="loadLogin(this)">Login</a>.       <span></span>  
        </p>
    </div>

</form>