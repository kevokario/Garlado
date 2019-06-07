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
        <link href="css/style4.css" rel="stylesheet" type="text/css"/>
        <link href="css/style5.css" rel="stylesheet" type="text/css"/>
        <link href="css/style6.css" rel="stylesheet" type="text/css"/>
        <link href="css/style7.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="img/logo.png"/>
    </head>
    <body style="background: #fbfbfb">
        <!--Navigation Divs-->
      <?php include './includes/navDiv.php'; ?>
        <!--Carousel div-->
        <div class="container-fluid">
            <div class="row rowdiv">
                <div class="col-sm-8 col-sm-offset-2">
                    <!--                    My data will be shown here!<br/>
                                        Major Category title first</br>
                                        data next<br>
                                        I will have a z-index, below me i a carousel of advert pics
                    -->
                    <div class="carousel slide" id="carousel_adverts" data-ride="carousel">
                        <ul class="carousel-indicators">
                            <li class="active" data-target='#carousel_adverts' data-slide-to='0'></li>
                            <li data-target='#carousel_adverts' data-slide-to='1'></li>
                            <li data-target='#carousel_adverts' data-slide-to='2'></li>
                            <li data-target='#carousel_adverts' data-slide-to='3'></li>
                        </ul>
                        <div class="carousel-inner" role='listbox'>
                            <div class="item active">
                                <img src="img/1.jpg" alt="Garlado Limited..." class=""/>
                            </div>
                            <div class="item">
                                <img src="img/2.jpg" alt="Garlado Limited..." class=""/>
                            </div>
                            <div class="item">
                                <img src="img/3.jpg" alt="Garlado Limited..." class=""/>
                            </div>
                            <div class="item">
                                <img src="img/4.jpg" alt="Garlado Limited..." class=""/>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel_adverts" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel_adverts" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div style="width:100%; margin: 0;padding: 0">
            <img src="img/web-2-148.jpg" style="width:100%"/>
        </div>
        <!--Top categories Part-->
        <div class="container-fluid topCatDiv">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Our Awesome Products By Category.<span class="pull-right"><a href="?q=ProductsByCategory">See More...</span></a></h3>
                        </div>
                        <div class="panel-body"></div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width:100%; margin: 0;padding: 0">
            <img src="img/web-1-147.jpg" style="width:100%"/>
        </div>
        <!--Most bought items container-->
        <div class="container-fluid mostBoughtDiv">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Most Bought Products<span class="pull-right"><a style="font-size:12px">See More...</span></a></h3>
                        </div>
                        <div class="panel-body">

                            <!--Hold carosel and rotated title-->
                            <div class="col-sm-5 bg-danger" style="padding:0">
                                <div class="carousel slide" id="carousel_mostBought" data-ride="carousel">
                                    <ul class="carousel-indicators">
                                        <li class="active" data-target='#carousel_mostBought' data-slide-to='0'></li>
                                        <li data-target='#carousel_mostBought' data-slide-to='1'></li>
                                        <li data-target='#carousel_mostBought' data-slide-to='2'></li>
                                        <li data-target='#carousel_mostBought' data-slide-to='3'></li>
                                    </ul>
                                    <div class="carousel-inner" role='listbox'>

                                    </div>
                                    <a class="left carousel-control" href="#carousel_mostBought" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel_mostBought" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                            <!--Hold the p
                                i am carousel
ictures and names of most bought Items-->
                            <div class="col-sm-7" style="padding:0">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width:100%; margin: 0;padding: 0">
            <img src="img/fashion.png" style="width:100%; height: 50px"/>
        </div>
        <?php include './includes/rotMenu.php';?>
        <!--Our featured Brands container-->
        <div class="container-fluid featuredBrands">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Featured product Brands!</h3>
                        </div>
                        <div class="panel-body">
                            <div class="carousel slide" id="carousel_featuredBrands" data-ride="carousel">
                                <ul class="carousel-indicators">
                                    <li class="active" data-target='#carousel_featuredBrands' data-slide-to='0'></li>
                                    <li data-target='#carousel_featuredBrands' data-slide-to='1'></li>
                                    <li data-target='#carousel_featuredBrands' data-slide-to='2'></li>
                                    <li data-target='#carousel_featuredBrands' data-slide-to='3'></li>
                                </ul>
                                <div class="carousel-inner" role='listbox'>
                                    <div class="item active">
                                        <table style="width: 100%">
                                            <tr>
                                                <td class="tdTitle">
                                                    <h4>
                                                        Phones and tablets!
                                                    </h4>
                                                </td>
                                                <td class="tdImage">
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                </td>
                                            </tr>
                                        </table> 
                                    </div>
                                    <div class="item">
                                        <table style="width: 100%">
                                            <tr>
                                                <td class="tdTitle">
                                                    <h4>
                                                        Phones and tablets!
                                                    </h4>
                                                </td>
                                                <td class="tdImage">
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="item">
                                        <table style="width: 100%">
                                            <tr>
                                                <td class="tdTitle">
                                                    <h4>
                                                        Phones and tablets!
                                                    </h4>
                                                </td>
                                                <td class="tdImage">
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                    <img src="img/Qualitiy Phones as.png" alt="Garlado Limited"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                                <a class="left carousel-control" href="#carousel_featuredBrands" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel_featuredBrands" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>

            </style>
            
        </div>
        <div style="width:100%; margin: 0;padding: 0">
            <img src="img/web-1-147.jpg" style="width:100%"/>
        </div>
        <!--Major Group 1 items container-->
        <div class="container-fluid mostBoughtDiv1 color1">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel color1">
                        <div class="panel-heading color1">
                            <h3>Major Group Name<span class="pull-right"><a style="font-size:12px">See More...</span></a></h3>
                        </div>
                        <div class="panel-body">

                            <!--Hold carosel and rotated title-->
                            <div class="col-sm-5 bg-danger" style="padding:0">
                                <div class="carousel slide" id="carousel_MajorGroup" data-ride="carousel">
                                    <ul class="carousel-indicators">
                                        <li class="active" data-target='#carousel_MajorGroup' data-slide-to='0'></li>
                                        <li data-target='#carousel_MajorGroup' data-slide-to='1'></li>
                                        <li data-target='#carousel_MajorGroup' data-slide-to='2'></li>
                                        <!--                                        <li data-target='#carousel_MajorGroup' data-slide-to='3'></li>-->
                                    </ul>
                                    <div class="carousel-inner" role='listbox'>

                                    </div>
                                    <a class="left carousel-control" href="#carousel_MajorGroup" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel_MajorGroup" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                            <!--Hold the p
                                i am carousel
ictures and names of most bought Items-->
                            <div class="col-sm-7" style="padding:0">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width:100%; margin: 0;padding: 0">
            <img src="img/web-1-147.jpg" style="width:100%"/>
        </div>
        <!--Major Group 2 items container-->
        <div class="container-fluid mostBoughtDiv1 color2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel color2">
                        <div class="panel-heading color2">
                            <h3>Major Group Name2<span class="pull-right"><a style="font-size:12px">See More...</span></a></h3>
                        </div>
                        <div class="panel-body">

                            <!--Hold carosel and rotated title-->
                            <div class="col-sm-5 bg-danger" style="padding:0">
                                <div class="carousel slide" id="carousel_MajorGroup2" data-ride="carousel">
                                    <ul class="carousel-indicators">
                                        <li class="active" data-target='#carousel_MajorGroup2' data-slide-to='0'></li>
                                        <li data-target='#carousel_MajorGroup2' data-slide-to='1'></li>
                                        <li data-target='#carousel_MajorGroup2' data-slide-to='2'></li>
                                    </ul>
                                    <div class="carousel-inner" role='listbox'>

                                    </div>
                                    <a class="left carousel-control" href="#carousel_MajorGroup2" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel_MajorGroup2" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                            <div class="col-sm-7" style="padding:0">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width:100%; margin: 0;padding: 0">
            <img src="img/web-1-147.jpg" style="width:100%"/>
        </div>
        <!--Major Group 3 items container-->
        <div class="container-fluid mostBoughtDiv1 color3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel color3">
                        <div class="panel-heading color3">
                            <h3>Major Group Name3<span class="pull-right"><a style="font-size:12px">See More...</span></a></h3>
                        </div>
                        <div class="panel-body">

                            <!--Hold carosel and rotated title-->
                            <div class="col-sm-5 bg-danger" style="padding:0">
                                <div class="carousel slide" id="carousel_MajorGroup3" data-ride="carousel">
                                    <ul class="carousel-indicators">
                                        <li class="active" data-target='#carousel_MajorGroup3' data-slide-to='0'></li>
                                        <li data-target='#carousel_MajorGroup3' data-slide-to='1'></li>
                                        <li data-target='#carousel_MajorGroup3' data-slide-to='2'></li>
                                    </ul>
                                    <div class="carousel-inner" role='listbox'>

                                    </div>
                                    <a class="left carousel-control" href="#carousel_MajorGroup3" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel_MajorGroup3" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                            <!--Hold the p
                                i am carousel
ictures and names of most bought Items-->
                            <div class="col-sm-7" style="padding:0">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
         <?php include './includes/footer.php';?>
    </body>
</html>

<script src="Res1/bs/js/jquery-3.3.1.js"></script>
<script src="JS/@defaultLoaders.js" type="text/javascript"></script>
<script src="Res1/bs/js/bootstrap.min.js"></script>
<script src="JS/Ajax.js" type="text/javascript"></script>
<script src="JS/@defaultLoadersHome.js" type="text/javascript"></script>
<script src="Res1/Chartjs/Chart.min.js" type="text/javascript"></script>
<script src="Res1/bs/js/bootstrapValidator.min.js"></script>
