<?php
require_once('db/dbhelper.php');

session_start();
if(empty($_SESSION['id_user'])){
header("Location: login.php");
}else{
    $sql = "select * from tb_user where id=".$_SESSION['id_user'];
$user= executeSingleResult($sql);

$sql = "select * from orders where id_user =".$_SESSION['id_user'];
$orders = executeResult($sql);
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
                        <a href="user.php"><?=$user['name']?> </a>
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
                                <font style="vertical-align: inherit;">Chi tiết đơn hàng</font>
                            </font>
                        </h3>

                        <div class="cart_inner">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã đơn hàng</th>
                                            <th scope="col">Giá tiền</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Xác nhận</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($orders as $item){

                                                // $sql =  'select * from order_details where order_id ='.$item['id'];
                                                // $detail = executeResult($sql);
                                                // foreach($detail as $value )
                                             ?>

                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <?= $item['id']?>
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <h5><?=$item['price']?></h5>
                                            </td>
                                            <td>

                                                <?=$item['status']?>
                                            </td>
                                            <td>
                                                <h5>
                                                    <?php 
                                                    if($item['status'] == 'Đang giao hàng' && $item['status'] != 'Đã nhận được hàng'){
                                                            ?>
                                                    <button onclick="order4(<?=$item['id']?>)" class="genric-btn success-border">
                                                        Đã nhận được hàng
                                                    </button>

                                                    <?php    } ?>




                                                </h5>
                                            </td>
                                        </tr>

                                        <?php   }   ?>





                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;"><?=$user['name']?></font>
                                </font>
                            </h2>
                            <ul class="list">
                                <li><a href="#">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Tài khoản</font>
                                        </font><span>
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;"><?=$user['username']?></font>
                                            </font>
                                        </span>
                                    </a></li>

                            </ul>



                            <a class="primary-btn" href="#" onclick="logout()">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Đăng xuất</font>
                                </font>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    function order4(id) {
        var option = confirm('Xác nhận đã nhận được hàng ?')
        if (!option) {
            return;
        }

        $.post('api.php', {
            'action': 'order4',
            'id': id

        }, function(data) {

            location.reload();

        }, )
    }

    function logout() {
        $.post('api.php', {
            'action': 'logout'

        }, function(data) {
            alert('Đăng xuất thành công');
            window.location = "index.php";

        }, )
    }
    </script>

    <?php include('include/footer.php') ?>
    <?php include('include/script.php') ?>



</body>

</html>
;
