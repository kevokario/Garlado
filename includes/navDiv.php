<div class="container-fluid navDiv">
    <div style="width:100%; margin: 0;padding: 0">
        <img src="img/welcome.jpg" style="width:100%"/>
    </div>
    <div class="row myNavRow" data-spy="affix" data-offset-top="70" style="">
        <div class="col-sm-12">
            <ul class="myNav">
                <!--Logo and menu-->
                <li class="logo">
                    <h2> 

                        <span class="myLog">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                            <span class="glyphicon glyphicon-menu-down"></span>
                        </span>
                        <a href="Home"><img alt="logo" src="img/logo.png" class="myImg"/></a>
                    </h2>
                    <!--Add a div that appers here-->
                    <div class="myProductMenu">
                        <div class="blockDiv">
                            <h3>Shop By Category <span class="caret"></span></h3>
                            <hr/>
                            <div class="genPMenu">
                            </div>
                        </div>
                        <div class="blockDiv2" id="blockDiv2">
                            <div class="genCMenu">
                                <span id="closeMenu" style="font-size: 10px;cursor:pointer; display: none;" class="pull-right"><i class="fa fa-remove"></i></span>
                                <div class="genCdata" id="genCdata">
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!--Search bar will be here-->
                <li class="searchBar">
                    <div class="block">
                        <form>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" placeholder="Search products,brands or categories..." class="form-control search"/>
                                    <div class="input-group-btn">
                                        <button class="btn btnLarge" type="button">
                                            <span class="displayBig">Search</span>
                                            <span class="fa fa-search displaySmall"></span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <div id="searchResult" class="text-left" style="">
                            <!--<a >Loren</a><a>Am</a>-->
                        </div>
                    </div>

                </li>
                <!--extra-->
                <li class="Etc">
                    <ul class="">
                        <li class="">
                            <span class="myAcbtn">
                                <span class="fa fa-stack">
                                    <i class="fa fa-stack-1x fa-home"></i>
                                    <i class="fa fa-stack-2x fa-square-o"></i>
                                </span>
                                <br> 
                                <span class="displayBig">My Account. </span><span class="fa fa-chevron-down "></span>
                            </span>
                            <div class="myProductMenu myAccount login">
                                <h4 style="color:#000D29"><i class="fa fa-user-o"></i> Login.</h4>
                                <form class="text-left">
                                    <div class="form-group form-group-sm">
                                        <label>Email</label>
                                        <input type="text" class="form-control" placeholder="Enter email.."/>
                                        <span></span><small></small>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Enter email.."/>
                                        <span></span><small></small>
                                    </div>
                                    
                                    <div class="form-group form-group-sm">
                                        <button type="button" onclick="alert('waddup Yo!')"  class="btn btnLarge btn-sm btn-block customerLoginForm">Login</button>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <p style="padding:0">New Customer? <a>Sign Up</a></p>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li >
                            <span class="myHlp">
                                <span class="fa fa-stack " style="text-align: center">
                                    <i class="fa fa-stack-1x fa-question"></i>
                                    <i class="fa fa-stack-2x fa-square-o"></i>
                                </span>
                                <br> 
                                <span class="displayBig"> Help? </span>
                                <span class="fa fa-chevron-down "></span>
                            </span>
<!--                            
                            <div class="myProductMenu myAccount">
                                <p>Helo there?</p>
                                <p>My Account here! Wtdush!<br>
                                    i d know what
                                    <br>the f is wrion
                                    with chrome</p>
                            </div>
                            -->
                        </li>
                        <li  >
                            <span class="myCart">
                                <span class="fa fa-stack ">
                                    <i class="fa fa-stack-1x fa-shopping-cart"></i>
                                    <i class="fa fa-stack-2x fa-square-o"></i>
                                </span>

                                <br> 
                                <span class="displayBig">My Cart. </span><span class="fa fa-chevron-down "></span>
                            </span>
                            <div class="myProductMenu myAccount myShpCart">
                                <h4><i class="fa fa-cart-arrow-down"></i> My Cart.</h4>
                                <hr>
                                <div>

                                    <table class="table" style="
                                           font-size: x-small;
                                           ">
                                        <thead>
                                            <tr>
                                                <th>Item</th> <th>Qnty</th> <th>Ksh</th> <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cartData">

                                        </tbody>
                                    </table>
                                    <a href="myShoppingCart">View My Cart..</a>

                                </div>
                            </div>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--<hr/>-->
</div>