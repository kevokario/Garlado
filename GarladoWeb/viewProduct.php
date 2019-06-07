<?php
 if(isset($_GET['t'])===FALSE){
     ?>
    <script>
    document.location.href="Home";
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
        <link href="css/vpStyle1.css" rel="stylesheet" type="text/css"/>
        <link href="css/vpStyle2.css" rel="stylesheet" type="text/css"/>
        <link href="css/vpStyle3.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="img/logo.png"/>
    </head>
    <body>
        <!--Navigation Divs-->
        <?php include './includes/navDiv.php'; ?>

        <!--Top Part : bread Crump Area-->
        <div class="container crumbDiv">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                    </ul>
                </div>
            </div>
        </div>

        <!--major div to hold the side bar and content area-->
        <div class="container-fluid dataDiv">
            <div class="row">
                <!--i am the side nav div-->
                <div class="col-sm-3 navDiv" id="navDiv">
                    <div class="directory">
                        <div class="tree">
                            <h3><small class="majorHeading"><!--Major Name--></small></h3>
                            <hr/>
                            <div class="tree-data">
                            </div>
                        </div>
                        <!--propet brand-->
                        <div class="contentMiniGroup brandYo">
                            <h3><small>Brand</small> <span class="caret pull-right"></span></h3>
                            <hr/>
                            <div class="minData">
                            </div>
                        </div>
                    </div>
                </div>
                <!--I am the content div-->
                <div class="col-sm-9 contentDiv">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="text-center majorHeading text-uppercase" style="margin-bottom : 5px; "></h3>
                        </div>
                        <div class="col-sm-12" id="searchDiv">
                            <div class="col-sm-12">
                                <hr style="margin : 1px; margin-bottom: 7px;"/>
                            </div>
                            <div class="col-sm-12" id="filterDiv">
                                <div class="col-sm-5">
                                    <form style="margin-top: 0;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="form-group form-group-sm">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                Price
                                                            </span>
                                                            <input type="number" id="priceFrom" placeholder="ksh" class="form-control"/>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group form-group-sm">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                To : 
                                                            </span>
                                                            <input id="priceTo" type="number" placeholder="ksh" class="form-control"/>
                                                            <div class="input-group-btn">
                                                                <button type="button" id="filterPrice"class="btn btn-sm">
                                                                    Go
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div> 
                                <div class="col-sm-2">
                                    <div class="form-group form-group-sm" id="sortFilter">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-filter"></i>
                                            </span>
                                            <select class="form-control">
                                                <option>Filter By</option>
                                                <option>Price ASC</option>
                                                <option>Price DESC</option>
                                                <option>Name ASC</option>
                                                <option>Name DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <ul class="pagination pagination-sm"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--I am to hold the images content-->
                    <div class="row productDiv">
                        <div class="col-sm-12">
                            <div style="min-height: 500px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p id="optionOpener">
            <i class="fa fa-list"></i>
        </p>
        <?php
        include './includes/rotMenu.php';
        include './includes/footer.php';
        include './includes/popUpMode.php';
        ?>

        <!--==================SCRIPTS=====================-->
 
        <script src="Res1/bs/js/jquery-3.3.1.js"></script>
        <script src="JS/@defaultLoaders.js" type="text/javascript"></script>
        <script src="Res1/bs/js/bootstrap.min.js"></script>
        <script src="JS/Ajax.js" type="text/javascript"></script>
        <script src="Res1/Chartjs/Chart.min.js" type="text/javascript"></script>
        <script src="Res1/bs/js/bootstrapValidator.min.js"></script>
        <script src="JS/vpScript.js" type="text/javascript"></script>
        <script src="JS/vpScript1.js" type="text/javascript"></script>
        <script>
        </script>
    </body>
</html>