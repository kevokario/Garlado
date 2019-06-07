<!DOCTYPE html>
<html>
    <head>
        <title>GARLADO LTD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Cache-Control" content="no-store" />
        <link rel="stylesheet" href="Res1/bs/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="Res1/bs/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="Res1/fa/css/font-awesome.min.css"/>
        <link href="css/mscStyle1.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="img/logo.png"/>
    </head>
    <body>
        <!--Jumbotron header-->
        <div style="width:100%; margin: 0;padding: 0">
            <a href="Home"><img src="img/welcome.jpg" style="width:100%"/></a>
        </div>
        <div class="jumbotron myJumboron" data-spy="affix" data-offset="70">
            <h2>My Shopping Cart  <i class="fa fa-cart-plus"></i> </h2>
        </div>
        <!--Container div-->
        <div class="container myShoppingCartContainer">
            <div class="row">
                <div class="col-sm-12 text-center shoppingCartNav">
                    <i class="pull-left fa fa-chevron-left"></i> 
                    <i class="fa fa-pulse center fa-refresh"></i>
                    <i class="pull-right fa fa-chevron-right"></i>
                </div>
                <div class="col-sm-10 col-sm-offset-1" id="contentDivMyCart">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Product   
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Amount per item.
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="myShoppingListItems">

                        </tbody>
                    </table>

                    <div class="col-sm-12 totalPriceDiv">
                        <p>Total Amount : <span id="myShoppingListPrice">KSH 0</span></p>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button class="buyMyItems">
                            Buy My Items 
                            <i class="fa fa-money"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <style>

        </style>
        <?php
        include './includes/footer.php';
        include './includes/popUpMode.php';
        ?>
    </body>
    <script src="Res1/bs/js/jquery-3.3.1.js"></script>
    <script src="JS/Ajax.js" type="text/javascript"></script>
    <script src="Res1/bs/js/bootstrap.min.js"></script>
    <script src="JS/@defaultLoaders.js" type="text/javascript"></script>
    <script src="JS/mscScript.js" type="text/javascript"></script>
    <script src="JS/mscScript1.js" type="text/javascript"></script>
</html>
