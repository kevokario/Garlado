<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include 'includes/head.php'; ?>
    <title>My Online Duka | Shoping Cart</title>
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
      .cart-title{
        /* font-size: 24px; */
        font-weight: 700;
      }
    </style>
  </head>
  <body>

    <!-- include the nav -->
    <?php include 'widgets/nav.php'; ?>

    <!-- include the shopping table -->
    <?php include 'widgets/cart/content.php' ?>

    <!-- include the footer  -->
    <?php include 'widgets/footer.php'; ?>

    <!-- include the script -->
    <?php include 'includes/scripts.php'; ?>

    <!-- include the cart scripts -->

    <script src="JS/mscScript.js"></script>
    <script src="JS/mscScript1.js"></script>
  </body>
</html>
