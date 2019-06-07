<?php
require_once './Core/functions.php';
include './includes/header.php';
if (isset($_SESSION['marvel']) === false) {
    ?>
    <script>document.location.href = 'index';</script>
    <?php
}
?>
<link href="css/style2.css" rel="stylesheet" type="text/css"/>
<link href="css/style3.css" rel="stylesheet" type="text/css"/>
<script src="Ajax/@dashboardloader.js" type="text/javascript"></script>
<script src="Ajax/@dashboardPhp.js" type="text/javascript"></script>
<style>
    
</style>
</head>
<?php
 // change onload to menuClicked('defaultPage') after deployment
?>
<body onload="menuClicked('defaultPage')">
    <div class="container-fluid jumbotron">
        <div class="row">
            <div class="col-sm-3 text-center">
                <a href="@dashboard"><img src="img/logo.png" alt="Garlando Limited"/></a>
            </div>
            <div class="col-sm-7">
                <h1>
                    Garlado Limited
                </h1>
                <h3>
                    <span class="fa-stack ">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-user-secret fa-stack-1x"></i>
                    </span> 
                    Admin DashBoard.

                </h3>
            </div>
        </div>
    </div>
    <hr style=" margin: 1px;"/>
    <!--
    ============================================================================================
                                    MY NAVIGATION BAR
    ============================================================================================
   -->

    <nav class="nav navbar-default">
<div class="container-fluid bg1">
    <div class="nav navbar-header">
        <button type="button" data-toggle="collapse" class="navbar-toggle" data-target="#mynav">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">
            <span class="fa fa-stack" style="color:#fff">
                <i class="fa fa-square-o fa-stack-2x"></i>
                <i class="fa fa-home fa-stack-1x"></i>
            </span>
        </a>
    </div>
<div class="collapse navbar-collapse" id="mynav">
    <ul class="nav navbar-nav">
      <!-- //////////////////////////////////////Menu 1 start//////////////////////////////////////////////////<-->
        <li class="dropdown">
            <a data-toggle="dropdown">
                <span class="fa fa-user-secret"></span>
                <sup><span class="fa fa-briefcase"></span></sup>
                Manage Users <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a onclick="menuClicked('Manage Staff')"><span class="fa fa-stack">
                            <i class="fa fa-stack-1x fa-user-secret"></i>
                            <i class="fa fa-stack-2x fa-square-o"></i>
                        </span>
                        Manage Staff
                    </a>
                </li>
                <li>
                    <a>
                        <span class="fa fa-stack">
                            <i class="fa fa-stack-1x fa-user-o"></i>
                            <i class="fa fa-stack-2x fa-square-o"></i>
                        </span>
                        Manage Clients
                    </a>
                </li>
            </ul>
        </li>
         <li class="dropdown">
            <a data-toggle="dropdown">
                <span class="fa fa-user-secret"></span>
                <sup><span class="fa fa-briefcase"></span></sup>
                Products Manager <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a onclick="menuClicked('goodsManager')"><span class="fa fa-stack">
                            <i class="fa fa-stack-1x fa-briefcase"></i>
                            <i class="fa fa-stack-2x fa-square-o"></i>
                        </span>
                       Manage my Products
                    </a>
                </li>
                <li>
                    <a onclick="menuClicked('my Store')">
                        <span class="fa fa-stack">
                            <i class="fa fa-stack-1x fa-book"></i>
                            <i class="fa fa-stack-2x fa-square-o"></i>
                        </span>
                        My Store
                    </a>
                </li>
                <li>
                    <a onclick="menuClicked('pickup manager')">
                        <span class="fa fa-stack">
                            <i class="fa fa-stack-1x fa-fort-awesome"></i>
                            <i class="fa fa-stack-2x fa-square-o"></i>
                        </span>
                        Pick-up Points
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">

                <i class="fa fa-user-secret"></i>

                User : <strong><?php echo $_SESSION['marvel']; ?></strong>
                <span class="glyphicon glyphicon-chevron-down"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a onclick="myAccount('<?php echo $_SESSION['marvel']?>')">
                        <i class="fa fa-user-o"></i>
                         My Account
                    </a>
                </li>
                <li>
                    <a href="@logout">
                        <span class="glyphicon glyphicon-log-out"></span> 
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
        </div>
    </nav>

  
    <div class="container-fluid mydiv" id="mainDivDboard">
        
    </div>
    <?php require './includes/myAccount.php';?>
</body>
</html>
