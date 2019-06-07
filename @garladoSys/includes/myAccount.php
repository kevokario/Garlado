<style>
    .userImg{
        height: 200px;
        border: 1px solid #999;
        border-radius: 5px;
        padding: 4px;
        transition: 1s;
        width:100%;
    }
    @media(max-width:768px){
        .userImg{
            height: 230px;
            border: 1px solid #999;
            border-radius: 5px;
            padding: 4px;
            width:60%;
            margin-right: 20%;
            margin-left: 20%;
        }
    } 
</style>
<div class="modal fade" data-backdrop="static" role="dialog" id="modalMyAccount">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header text-center">
                <a class="close btn btn-info" data-dismiss="modal">&times;</a>
                <h3>
                    <span class="fa fa-stack">
                        <i class="fa fa-stack-1x fa-user-secret"></i>
                        <i class="fa fa-stack-2x fa-square-o"></i>
                    </span>
                    My Account.
                </h3>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="text-center col-sm-12" style="text-decoration: underline">My Profile</h4>
                            <div id="myPic"></div>
                        </div>
                        <div class="col-sm-8">
                            <h4 class="" style="text-decoration: underline">My Details.</h4>
                            <form style="margin-top: 5px">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label> Name </label>
                                            <p class="form-control-static" id="myName">Name</p>
                                        </div>
                                        <div class="form-group">
                                            <label> Email </label>
                                            <p class="form-control-static" id="myEmail">mail</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label> Phone </label>
                                            <p class="form-control-static" id="myPhone">phone </p>
                                        </div>
                                        <div class="form-group">
                                            <label> Level </label>
                                            <p class="form-control-static" id="myLevel">level</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button  value="<?php echo $_SESSION['marvel'] ?>" onclick="modifyMyAccount(this.value)" class="btn btn-success btn-sm" type="button">
                                            change my password
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p class="mydef">Riotech Developers</p>
            </div>
        </div>
    </div>
</div>
<!--======================================================================================================================-->
<div class="modal" id="modifyMyAccount" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center" style="">
                <a class="btn btn-info close" data-dismiss="modal">&times;</a>
                <h4 style="color:#fff;text-decoration: none;">
                    <span class="fa fa-stack fa-lg">
                        <i class="fa fa-key fa-stack-1x"></i>
                        <i class="fa fa-stack-2x fa-square-o"></i>
                    </span> 
                    Change Password
                </h4>
            </div>
            <div class="modal-body">
                <form name="changePassword">
                    <input type="hidden" name="id">
                    <div class="form-group form-group-sm">
                        <label>
                            Enter new Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </span>
                            <input type="password"
                                   onfocus="passwordValidate1(document.changePassword.pass2.value,this.value,document.getElementById('cp1'),document.getElementById('cp2'))"
                                   onkeyup="passwordValidate1(document.changePassword.pass2.value,this.value,document.getElementById('cp1'),document.getElementById('cp2'))"
                                   class="form-control" name="pass1" placeholder="Enter your new password"/>
                        </div>
                        <p class="text-danger" id="cp1"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label>
                            Confirm new Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </span>
                            <input type="password"
                                   onfocus="passwordValidate1(document.changePassword.pass1.value,this.value,document.getElementById('cp2'),document.getElementById('cp1'))"
                                   onkeyup="passwordValidate1(document.changePassword.pass1.value,this.value,document.getElementById('cp2'),document.getElementById('cp1'))"
                                   class="form-control" name="pass2" placeholder="Re-Enter your new password"/>
                        </div>
                        <p class="text-danger" id="cp2"></p>
                    </div>
                    <div id="cpfeedback" class="form-group form-group-sm mydef text-center text-success">
                     
                    </div>
                    <div class="form-group form-group-sm">
                        <button class="btn btn-primary btn-sm" onclick="resetPassword()" type="button">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mydef">
                    Riotech Developers
                </p>
            </div>
        </div>
    </div>
</div>
