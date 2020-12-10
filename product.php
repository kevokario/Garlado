<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'includes/head.php'; ?>
        <title>My Online Duka | Product</title>
        <style media="screen">
            #categories_menu{
                display: none;
            }
            .hero{
                padding-bottom: 0px;
            }
            .hero__item{
                display: none;
            }
            .breadcrumb-section{
                padding: 0;
            }
            .spad{
                padding-top: 25px;
            }
            #categories_menu{
                display: none;
                position: absolute;
                background: rgb(255, 255, 255);
                z-index: 10;
            }
            .hero__categories__details{
                left: 100%;
                top: 0;
            }
            .table td{
                line-height:40px;
            }
            .descriptionDiv ul{
                list-style-type:circle;
            }
            .descriptionDiv ul li{
                margin:10px;
            }
        </style>
    </head>
    <body>
         <!-- include the nav -->
        <?php include 'widgets/nav.php'; ?>

        <!-- include the content -->
        <?php include 'widgets/product/content.php'?>

        <!-- include the footer  -->
        <?php include 'widgets/footer.php'; ?>

        <!-- include the script -->
        <?php include 'includes/scripts.php'; ?>

        <!-- include the product scripts -->
        <?php include 'includes/product/scripts.php' ?>
        
    </body>
</html>