<?php
require_once('db/dbhelper.php');

session_start();
if(empty($_SESSION['id_user'])){
header("Location: login.php");
}


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
                    <h1>Thanh toán</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Trang chủ<span class="fa-solid fa-chevron-right"></span></a>
                        <a href="cart.php">Giỏ hàng<span class="fa-solid fa-chevron-right"></span></a>
                        <a href="checkout.php">Thanh toán </a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout_area section_gap">
        <div class="container">

            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Chi tiết thanh toán</font>
                            </font>
                        </h3>
                        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" placeholder="Tên người nhận" id="name" name="name">
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" placeholder="Số điện thoại" id="phone" name="phone">
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" placeholder="Địa chỉ" id="address" name="address">
                            </div>




                            <div class="col-md-12 form-group">

                                <textarea class="form-control" name="message" id="content" rows="1" placeholder="Ghi chú đặt hàng"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Đơn đặt hàng của bạn</font>
                                </font>
                            </h2>
                            <ul class="list">
                                <li><a href="#">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Sản phẩm</font>
                                        </font><span>
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Tổng cộng</font>
                                            </font>
                                        </span>
                                    </a></li>
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
                                <li><a href="#">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"><?=$item['title']?></font>
                                        </font><span class="middle">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">x <?=$item['num']?></font>
                                            </font>
                                        </span> <span class="last"><?=number_format($total_item, 0, '', '.')?> VND</span>
                                    </a>
                                </li>

                                <?php } ?>
                            </ul>
                            <ul class="list list_2">


                                <li><a href="#">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Tổng cộng</font>
                                        </font><span id="order_price"> <?=number_format($total, 0, '', '.')?> VND</span>
                                    </a></li>
                            </ul>


                            <a class="primary-btn" href="#" onclick="checkout()">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Mua ngay</font>
                                </font>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    function checkout() {
        var name = $('#name').val(),
            phone = $('#phone').val(),
            address = $('#address').val(),
            content = $('#content').val(),
            price = $('#order_price').html(),
            id_user = <?=$_SESSION['id_user']?>;
        if (!name || !phone || !address) {
            alert('Vui lòng nhập đầy đủ dữ liệu');
        } else {
            $.post('api.php', {
                'action': 'checkout',
                'id': id_user,
                'name': name,
                'phone': phone,
                'content': content,
                'address': address,
                'price': price,

            }, function(data) {
                alert('Mua hàng thành công');
                window.location = "index.php";

            }, )
        }
    }
    </script>

    <?php include('include/footer.php') ?>
    <?php include('include/script.php') ?>



</body>

</html>
;
