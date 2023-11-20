<?php
require_once('db/dbhelper.php');

session_start();


?>



<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Karma Shop</title>
    <?php include('include/head.php') ?>
</head>

<body>
    <?php include('include/header.php') ?>


    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Giỏ hàng</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Trang chủ<span class="fa-solid fa-chevron-right"></span></a>
                        <a href="cart.php">Giỏ hàng </a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$cart = [];
if(isset($_SESSION['cart'])) {
	$cart = $_SESSION['cart'];
}

$count = 0;
$total_item = 0;
$total = 0;
foreach ($cart as $item) {
   
    $total_item = $item['num'] * $item['price']; 
    $total += $total_item; 


    ?>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="uploads/<?=$item['avatar']?>" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p><?=$item['title']?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><?=number_format($item['price'], 0, '', '.')?> VND</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input disabled type="text" name="qty" id="sst<?=$item['id']?>" maxlength="12" value="<?=$item['num']?>" title="Quantity:" class="input-text qty">
                                        <button onclick="update_cart(<?=$item['id']?>, 1)" class="increase items-count" type="button"><i class="fa-solid fa-chevron-up"></i></button>
                                        <button onclick="update_cart(<?=$item['id']?>, 0)" class="reduced items-count" type="button"><i class="fa-solid fa-chevron-down"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <h5> <?=number_format($total_item, 0, '', '.')?> VND</h5>
                                </td>
                            </tr>
                            <?php } ?>


                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <h5>Tổng đơn hàng</h5>
                                </td>
                                <td>
                                    <h5> <?=number_format($total, 0, '', '.')?> VND</h5>
                                </td>
                            </tr>

                            <script>
                            function update_cart(id, i) {


                                    if (i == 0) {
                                if ($("#sst" + id).val() > 1) {

                                        $.post('api.php', {
                                            'action': 'reduce_cart',
                                            'id': id
                                        }, function(data) {
                                            console.log('trừ 1');
                                            location.reload();
                                        }, ) };
                                    } else if (i == 1) {
                                        $.post('api.php', {
                                            'action': 'add_to_cart',
                                            'id': id,
                                            'num': 1
                                        }, function(data) {
                                            location.reload();

                                        }, )
                                    }

                               
                            }
                            </script>
                            <tr class="out_button_area">
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="index.php">Trở về </a>
                                        <a class="primary-btn" href="checkout.php">Thanh toán</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <?php include('include/footer.php') ?>
    <?php include('include/script.php') ?>



</body>

</html>
;
