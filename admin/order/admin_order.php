<?php
require_once ('../../db/dbhelper.php');
require_once ('../../db/config.php');

require_once ('../../common/utility.php');
session_start();
if (empty($_SESSION["admin_name"])){
	header('Location: admin_login.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản Lý Đơn Hàng</title>
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
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Quản Lý Đơn Hàng</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">

                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>

                            <th width="130px">Mã Đơn Hàng</th>
                            <th width="200px">Khách Hàng</th>
                            <th width="200px">Ngày Đặt</th>
                            <th width="">Địa chỉ</th>
                            <th width="">Trạng thái</th>
                            <th width="200px"></th>


                            <th width=""></th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php
	
 $sql= 'SELECT * From orders  order by id DESC';
 $oder_list = executeResult($sql);
 

foreach ($oder_list as $item) { ?>
                        <tr>

                            <td><?=$item['id']?></td>
                            <td>
                                <a href="order_detail.php?id=<?=$item['id']?>">
                                    <?=$item['fullname']?> </br> ( <?=$item['phone_number']?> )
                                </a>
                            <td><?=date_time($item['order_date'])?></td>
                            <td><?=$item['address']?></td>
                            <td><?=$item['status']?></td>

                            <td>
                                <a href="order_detail.php?id=<?=$item['id']?>" class="btn btn-success " style="color: #fff;">Xem Đơn</a>
                            </td>
                        </tr>
                        <?php 
          
}
?>
                    </tbody>
                </table>






                <script type="text/javascript">
                function deleteProduct(id) {
                    var option = confirm('Bạn có chắc chắn muốn xoá đơn hàng này không?')
                    if (!option) {
                        return;
                    }

                    console.log(id)
                    //ajax - lenh post
                    $.post('order_ajax.php', {
                        'id': id,
                        'action': 'delete'
                    }, function(data) {
                        location.reload()
                    })
                }
                </script>
















</body>

</html>
