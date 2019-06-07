<?php
if (isset($_GET['name']) === FALSE) {
    ?>
    <script>
        document.location.href = "Home";
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>GARLADO LTD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Cache-Control" content="no-store" />
        <link rel="stylesheet" href="Res1/bs/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="Res1/bs/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="Res1/fa/css/font-awesome.min.css"/>
        <link href="css/style1.css" rel="stylesheet" type="text/css"/>
        <link href="css/style2.css" rel="stylesheet" type="text/css"/>        
        <link href="css/style3.css" rel="stylesheet" type="text/css"/>
        <link href="css/pdStyle1.css" rel="stylesheet" type="text/css"/>
        <link href="css/pdStyle2.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="img/logo.png"/>
    </head>
    <body>
        <?php include './includes/navDiv.php'; ?>

        <!--Top Part : bread Crump Area-->
        <div class="container topPart">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">

                    </ul>
                </div>
            </div>
        </div>

        <!--Title Div-->
        <div class="container titleDiv">
            <div class="row">
                <div class="col-sm-12">
                    <h1><small> </small></h1>
                </div>
            </div>
        </div>
        <!--buy and image div-->
        <div class="container imageBuyDiv">
            <div class="row">
                <div class="col-sm-7">
                    <img src="img/logo.png" alt="logo"/>
                </div>
                <div class="col-sm-5">
                    <h2><small>More on This Product</small></h2>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Market Price</td><td> : </td><td> Ksh <span></span></td>
                            </tr>
                            <tr>
                                <td>Our Price</td><td> : </td><td> Ksh <span></span></td>
                            </tr>
                            <tr>
                                <td>Quantity</td><td>  : </td>
                                <td style="width : 70%;"> 
                                    <div class="form-group form-group-sm">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" id="" class="btn btn-sm">
                                                    -
                                                </button>
                                            </div>
                                            <input type="number" class="form-control" value="1"/>
                                            <div class="input-group-btn">
                                                <button type="button" id="" class="btn btn-sm">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Pay Amount</td><td> : </td><td> Ksh <span></span></td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="3">
                                    <button  class="btn cartbtn">
                                        Add To Cart 
                                        <i class="fa fa-cart-plus"></i>
                                    </button>
                                    <button  class="btn buybtn">
                                        Buy Now
                                        <i class="fa fa-money"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--I am description div-->
        <div class="container descriptionDiv">
            <div class="col-sm-12">
                <h2><small>Description</small></h2>
                <ul>
                    <div class="col-sm-6">
                        <li>Ram : 2gb</li>
                        <li>Rom : 250gb</li>
                        <li>Color : red</li>
                        <li>Ram : 2gb</li>
                        <li>Rom : 250gb</li>
                    </div>
                    <div class="col-sm-6">
                        <li>Color : red</li>
                        <li>Ram : 2gb</li>
                        <li>Rom : 250gb</li>
                        <li>Color : red</li>
                    </div>
                </ul>
            </div>
        </div>
        <!--More pics div-->
        <div class="container morePicDiv">
            <h2><small>More Images</small></h2>
            <div class="row">
<!--                <div class="col-sm-4"> <img src="img/2.jpg" alt=" image"/> </div>-->
            </div>
            <style>

            </style>
        </div>
        <div class="container otherProducts">
            <h2><small>Popular products</small></h2>
            <div class="row">
<!--                <a class="col-sm-3">
                    <img src="img/3.jpg" alt=" image"/>
                    <p>Some name</p>
                </a>-->

            </div>
            <style>
              
            </style>
        </div>
        <?php
        include './includes/rotMenu.php';
        include './includes/footer.php';
        include './includes/popUpMode.php';
        ?>
    </body>
    <script src="Res1/bs/js/jquery-3.3.1.js"></script>
    <script src="JS/Ajax.js" type="text/javascript"></script>
    <script src="Res1/bs/js/bootstrap.min.js"></script>
    <script src="JS/@defaultLoaders.js" type="text/javascript"></script>
    <script src="JS/pdScript.js" type="text/javascript"></script>
    <script src="JS/pdScript1.js" type="text/javascript"></script>

    <script>

    </script>
</html>