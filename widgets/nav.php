<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>



<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="./"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-border fa-question"></i>  <span>Help</span></a>
            <a href="shopping-cart.php"><i class="fa fa-shopping-cart"></i> cart : <span class='cart'>0</span></a>
           
            <?php
             if(!isset($_SESSION['attemptSignUp'])){
                ?>
               <a href="checkout.php" class="login"><i class="fa fa-user"></i> Login</a>
                <?php
            } else {
                ?>
                <a href="#" class="loggedin">
                    <i class="fa fa-user"></i>
                    Hi 07...
                        <?php 
                            $d = json_decode($_SESSION['attemptSignUp']);
                        ?>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
     <h5>All Categories</h5>
     <ul id="categories_menu_mobile">
     <nav class="humberger__menu__nav mobile-menu">
            <li>
                <a href="#">Fresh Meat</a>
                <ul class="header__menu__dropdown">
                    <h6>Title Name</h6>
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./shop-grid.html">Shop</a></li>
            <li>
                <a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                     <h6>Title Name</h6>
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="#">Vegetables</a></li>
            <li><a href="#">Fruit & Nut Gifts</a></li>
            <li><a href="#">Fresh Berries</a></li>
            <li><a href="#">Ocean Foods</a></li>
            <li><a href="#">Butter & Eggs</a></li>
            <li><a href="#">Fastfood</a></li>
            <li><a href="#">Fresh Onion</a></li>
            <li><a href="#">Papayaya & Crisps</a></li>
            <li><a href="#">Oatmeal</a></li>
            <li><a href="#">Fresh Bananas</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> email@example.com</li>
            <li>Shipping done to all over the country!</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header mb-lg-5 mb-sm-0">

    <div class="header__top">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> email@example.com</li>
                            <li>Shipping done to all over the country!</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </div>

                        <div class="header__top__right__auth">
                            <a href="#"><i class="fa fa-phone"></i> +254 714 111 000</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="header__logo">
                    <a href="./"><img src="img/logo.png" class="img" style="height: 50px" alt=""></a>
                </div>
                <div class="hero__categories">
                    <div class="hero__categories__all" style="margin-bottom: 15px">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    <ul id="categories_menu">
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                      <li><a disabled> <i class="fa fa-spin fa-spinner"></i> Loading...</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories" style=" padding: 0;width: initial">
                               <a href="./"><img src="img/logo.png" class="img" style="height: 50px;" alt=""></a>
                            </div>
                            <input type="text" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH
                            </button>
                        </form>
                    </div>
                    <div id="searchResult" class="text-left" style="">
                        <a>Loren</a><a>Am</a>
                    </div>
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="shopping-cart.php">
                                    <i class="fa fa-shopping-cart"></i> <span class='cart'>0</span>
                                    <p>Cart</p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-question"></i>
                                    <p>Help</p>
                                </a>
                            </li>
                            <li>
                                <?php
                                    if(!isset($_SESSION['attemptSignUp'])){
                                        ?>
                                       <a href="checkout.php" class="login">
                                            <i class="fa fa-user"></i>
                                            <p>Login</p>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="#" class="loggedin">
                                            <i class="fa fa-user"></i>
                                            <p>Hi 07...
                                                <?php 
                                                    $d = json_decode($_SESSION['attemptSignUp']);
                                                ?>
                                            </p>
                                        </a>
                                        <?php
                                    }
                                ?>
                            </li>
                        </ul>
                       <!--  <div class="header__cart__price">item: <span>$150.00</span></div> -->
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg" style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.5)),
                    url('img/hero/banner.jpg');">
                    <div class="hero__text">
                        <span>New Tech</span>
                        <h2>Up to <br />40% off!</h2>
                        <p>Free Pickup and Delivery Available</p>
                        <a href="#" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Hero Section End -->

<div class="modal" id="login-modal" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <img src='./img/logo.png' class="img-thumbnail " width="70" height="70" alt="Online Duka"/>
                 <h4>My Online Duka.</h4>
            </div>
            <div class="modal-body" style="padding: 10px 25px">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>