<?php
require_once ('../../db/dbhelper.php');
session_start();
// if (empty($_SESSION["admin_name"])){
// 	header('Location: ../../admin_login.php');
// }
$id = '';

if (isset($_GET['id'])) {
	$id       = $_GET['id'];
	$sql      = 'select * from order_details where order_id = '.$id;
	$order_details = executeResult($sql);

	
	$sql1      = 'select * from orders where id ='.$id;
	$order = executeSingleResult($sql1);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Khách Hàng <?= $order['fullname'] ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php

function admin_out() {
  session_destroy();
  header('Location: index.php');
}

if (isset($_GET['adminOut'])) {
	admin_out();
  
}
?>
    <div>

        <ul class="nav nav-tabs row">
            <li class="nav-item col-md-2">
                <a class="nav-link " href="../category/">Quản Lý Danh Mục</a>
            </li>
            <li class="nav-item col-md-2">
                <a class="nav-link " href="../product/index.php">Quản Lý Sản Phẩm</a>
            </li>
            <li class="nav-item col-md-5">
                <a class="nav-link active" href="#"> Quản Lí Đơn Hàng</a>
            </li>
            <li class="nav-item  col-md-3 d-flex" style="">
                <p class="nav-link bg-danger text-white"> Admin <?=$_SESSION["admin_name"] ?></p>
                <a class="nav-link" href="../product/index.php?adminOut=true">Đăng Xuất</a>

            </li>
        </ul>


    </div>

    <div class="container my-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Đơn Hàng Của : <?= $order['fullname'] ?> </h2>
            </div>
            <div class="row my-3 border p-3 ">
                <div class="col-6"> Trạng thái đơn hàng :</div>
                <div class="col-3"><select class="form-control" name="" id="status">
                        <option value="<?= $order['status'] ?>"> <?php
                       
                        
                        ?>Hiện chọn <?= $order['status'] ?></option>
                        <option value="Đang chuẩn bị">Đang chuẩn bị</option>
                        <option value="Đang giao hàng">Đang giao hàng</option>
                    </select>
                </div>
                <div class="col-3">
                    <button class="btn btn-success" onclick="trade_order_status(<?=$_GET['id']?>)">Thay Đổi Trạng thái Đơn Hàng</button>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php
// $sql         = 'select order_details.num , order_details.num, product.id, product.title, product.price, product.thumbnail, product.updated_at from product left join order_details on product.id = order_details.product_id where order_details.order_id = '.$id;
// $productList = executeResult($sql);
$total = 0;
foreach ($order_details as $item) {

	$sql = "select * from product where id= ".$item['product_id'];
$productList = executeSingleResult($sql);

$sql = "select * from order_details where id= ".$item['id'];
$order_details1 = executeSingleResult($sql);




    $total += $item['num'] * $productList['price'];
	echo '<div class="col-lg-3 p-2 bg-dark mt-1" >
    <div class=" " style="border: solid 2px black;">
    
				<img src="../../uploads/'.$productList['avatar'].'" width="100%" height="250px">
				<div class="text-center text-white p-2">
  <h5  style="height: 25px; overflow: hidden; text-transform: capitalize;display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; ">'.$productList['title'].'</h5>
	  
</div>
				<p class="text-center" style="color: white; font-weight: bold;">Giá '.number_format($productList['price'], 0, '', '.').' VND</p>
				<p class="text-center" style="color: white; font-weight: bold;">Số lượng '.$item['num'].'</p>
		
				<p class="text-center" style="color: white; font-weight: bold;">Tổng tiền sản phẩm '.number_format($item['num'] * $productList['price'], 0, '', '.').' VND</p>
                
                </div></div>';
}
?>
                </div>
            </div>


        </div>
        <div class="text-center mt-5">
            <h1>Tổng Tiền Đơn Hàng : <?=number_format($total, 0, '', '.')?> VND</h1>
        </div>

    </div>


    <script>
    function trade_order_status(id) {
        var status = $('#status').val();
        $.post('order_ajax.php', {
            'action': 'trade_order_status',
            'id': id,
            'status': status
        }, function(data) {
            alert('Thay đổi trạng thái đơn hàng thành công');
            window.location = "admin_order.php";

        }, )
    }
    </script>
</body>

</html>
