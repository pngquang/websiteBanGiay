<?php
require_once('db/dbhelper.php');
?>



<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Karma Shop</title>
    <?php include('include/head.php') ?>
</head>

<body>
    <?php include('include/header.php') ?>




    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12">
                    <div class="active-banner-slider owl-carousel">

                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>Nike New <br>Collection!</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="https://preview.colorlib.com/theme/karma/img/banner/banner-img.png" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="row single-slide">
                            <div class="col-lg-5">
                                <div class="banner-content">
                                    <h1>Nike New <br>Collection!</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="https://preview.colorlib.com/theme/karma/img/banner/banner-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="features-area section_gap">
        <div class="container">
            <div class="row features-inner">

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/f-icon1.png.webp" alt="">
                        </div>
                        <h6>Free Delivery</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/f-icon2.png.webp" alt="">
                        </div>
                        <h6>Return Policy</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/f-icon3.png.webp" alt="">
                        </div>
                        <h6>24/7 Support</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="omg/f-icon4.png.webp" alt="">
                        </div>
                        <h6>Secure Payment</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="category-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="img/c1.jpg.webp" alt="">
                                <a href="#c1.jpg.webp" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="img/c2.jpg.webp" alt="">
                                <a href="#c2.jpg.webp" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="img/c3.jpg.webp" alt="">
                                <a href="#c3.jpg.webp" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Product for Couple</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="img/c4.jpg.webp" alt="">
                                <a href="#c4.jpg.webp" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-deal">
                        <div class="overlay"></div>
                        <img class="img-fluid w-100" src="img/c5.jpg.webp" alt="">
                        <a href="#c5.jpg.webp" class="img-pop-up" target="_blank">
                            <div class="deal-details">
                                <h6 class="deal-title">Sneaker for Sports</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="owl-carousel active-product-area section_gap">
        <?php

$sql  = 'select * from category';
$categoryList = executeResult($sql);
foreach($categoryList as $item){ ?>


        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1><?=$item['name']?></h1>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php

$sql  = 'select * from product where id_category =  '.$item['id'].' ORDER BY `product`.`id` DESC';
$proList = executeResult($sql);
foreach($proList as $value){ ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="uploads/<?= $value['avatar']?>" alt="">
                            <div class="product-details">
                                <h6><?= $value['title']?></h6>
                                <div class="price">
                                    <h6><?=number_format($value['price'], 0, '', '.')?></h6>

                                </div>
                                <div class="prd-bottom">


                                    <a href="#addToCart1" onclick="addToCart(<?= $value['id']?>, 1)" class="social-info">
                                        <span class="fa-solid fa-cart-plus"></span>
                                        <p class="hover-text">Thêm giỏ</p>
                                    </a>
                                    <a href="product.php?id=<?=$value['id']?>" class="social-info">
                                        <span class="fa-solid fa-search"></span>
                                        <p class="hover-text">Xem</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php      }   ?>



                </div>
            </div>
        </div>

        <?php      }   ?>

    </section>

    <!-- 
    <section class="exclusive-deal-area">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 no-padding exclusive-left">
                    <div class="row clock_sec clockdiv" id="clockdiv">
                        <div class="col-lg-12">
                            <h1>Exclusive Hot Deal Ends Soon!</h1>
                            <p>Who are in extremely love with eco friendly system.</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="row clock-wrap">
                                <div class="col clockinner1 clockinner">
                                    <h1 class="days">150</h1>
                                    <span class="smalltext">Days</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="hours">23</h1>
                                    <span class="smalltext">Hours</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="minutes">47</h1>
                                    <span class="smalltext">Mins</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="seconds">59</h1>
                                    <span class="smalltext">Secs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Shop Now</a>
                </div>
                <div class="col-lg-6 no-padding exclusive-right">
                    <div class="active-exclusive-product-slider">

                        <div class="single-exclusive-slider">
                            <img class="img-fluid" src="https://preview.colorlib.com/theme/karma/img/product/e-p1.png" alt="">
                            <div class="product-details">
                                <div class="price">
                                    <h6>$150.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                                <h4>addidas New Hammer sole
                                    for Sports person</h4>
                                <div class="add-bag d-flex align-items-center justify-content-center">
                                    <a class="add-btn" href="#"><span class="ti-bag"></span></a>
                                    <span class="add-text text-uppercase">Add to Bag</span>
                                </div>
                            </div>
                        </div>

                        <div class="single-exclusive-slider">
                            <img class="img-fluid" src="https://preview.colorlib.com/theme/karma/img/product/e-p1.png" alt="">
                            <div class="product-details">
                                <div class="price">
                                    <h6>$150.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                                <h4>addidas New Hammer sole
                                    for Sports person</h4>
                                <div class="add-bag d-flex align-items-center justify-content-center">
                                    <a class="add-btn" href="#"><span class="ti-bag"></span></a>
                                    <span class="add-text text-uppercase">Add to Bag</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <section style="background-color: #e7dede;padding: 50px 0; margin: 20px 0" class="brand-area section_gap">
        <div class="container">
            <div class="row">
                <a class="col single-img" href="https://preview.colorlib.com/theme/karma/#">
                    <img class="img-fluid d-block mx-auto" src="https://preview.colorlib.com/theme/karma/img/brand/1.png" alt="">
                </a>
                <a class="col single-img" href="https://preview.colorlib.com/theme/karma/#">
                    <img class="img-fluid d-block mx-auto" src="https://preview.colorlib.com/theme/karma/img/brand/2.png" alt="">
                </a>
                <a class="col single-img" href="https://preview.colorlib.com/theme/karma/#">
                    <img class="img-fluid d-block mx-auto" src="https://preview.colorlib.com/theme/karma/img/brand/3.png" alt="">
                </a>
                <a class="col single-img" href="https://preview.colorlib.com/theme/karma/#">
                    <img class="img-fluid d-block mx-auto" src="https://preview.colorlib.com/theme/karma/img/brand/4.png" alt="">
                </a>
                <a class="col single-img" href="https://preview.colorlib.com/theme/karma/#">
                    <img class="img-fluid d-block mx-auto" src="https://preview.colorlib.com/theme/karma/img/brand/5.png" alt="">
                </a>
            </div>
        </div>
    </section>


    <?php include('include/footer.php') ?>
    <?php include('include/script.php') ?>



</body>

</html>
