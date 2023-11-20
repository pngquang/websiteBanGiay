<?php
require_once('db/dbhelper.php');

session_start();
if (!empty($_GET['id_cate'])) {
    $sql = 'select * from category where id = ' . $_GET['id_cate'];
    $cate_list = executeSingleResult($sql);

    $sql = 'select * from product where id_category = ' . $_GET['id_cate'];
    $product_list  = executeResult($sql);
    $title = $cate_list['name'];
} else {

    $sql = 'select * from product ';
    $product_list  = executeResult($sql);
    $title = 'Sản Phẩm';
}

?>



<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title><?= $title ?></title>
    <?php include('include/head.php') ?>
</head>

<body>
    <?php include('include/header.php') ?>


    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1><?= $title ?></h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Trang chủ<span class="fa-solid fa-chevron-right"></span></a>
                        <a href="#"><?= $title ?></a>

                    </nav>
                </div>
            </div>
        </div>
    </section>
    <div class="container " style="margin-top:  50px ;margin-bottom:  50px ;">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Danh mục</div>
                    <ul class="main-categories">
                        <li class="main-nav-list ">
                            <?php
                              foreach($list_cate as $item){ ?>


                            <?php 
                                    if (!empty($_GET['id_cate'])) {
                                        if($item['id'] == $_GET['id_cate']) { ?>
                            <a href="list_product.php?id_cate=<?=$item['id']?>" class="collapsed">
                                <input class="pixel-radio" checked type="radio"> <label for="<?=$item['id']?>"><?=$item['name']?></label>
                                </span>
                            </a>
                            <?php        } else{ ?>

                            <a href="list_product.php?id_cate=<?=$item['id']?>" class="collapsed">
                                <input class="pixel-radio" type="radio"> <label for=""><?=$item['name']?></label>
                                </span>
                            </a>

                            <?php }   } else {  ?>
                            <a href="list_product.php?id_cate=<?=$item['id']?>" class="collapsed">
                                <input class="pixel-radio" type="radio"> <label for=""><?=$item['name']?></label>
                                </span>
                            </a>
                            <?php }      ?>





                            <?php    }        ?>






                        </li>

                    </ul>

                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">


                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <?php foreach($product_list as $item){ ?>
                        <div class="col-lg-4 col-md-6">

                            <div class="single-product">
                                <img class="img-fluid" style="height: 200px;" src="uploads/<?= $item['avatar']?>" alt="">
                                <div class="product-details">
                                    <h6><?= $item['title']?></h6>
                                    <div class="price">
                                        <h6><?=number_format($item['price'], 0, '', '.')?></h6>

                                    </div>
                                    <div class="prd-bottom">


                                        <a href="#addToCart1" onclick="addToCart(<?= $item['id']?>, 1)" class="social-info">
                                            <span class="fa-solid fa-cart-plus"></span>
                                            <p class="hover-text">Thêm giỏ</p>
                                        </a>
                                        <a href="product.php?id=<?=$item['id']?>" class="social-info">
                                            <span class="fa-solid fa-search"></span>
                                            <p class="hover-text">Xem</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php } ?>
                    </div>
                </section>


            </div>



        </div>
    </div>

    <?php include('include/footer.php') ?>
    <?php include('include/script.php') ?>



</body>

</html>
