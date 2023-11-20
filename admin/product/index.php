<?php
require_once ('../../db/dbhelper.php');
require_once ('../../common/utility.php');
session_start();
if (empty($_SESSION["admin_name"])){
	header('Location: ../admin_login.php');
	echo '  
    <script language="javascript">alert("Hello admin !");</script>';
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản Lý Sản Phẩm</title>
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
                <a class="nav-link" href="../category/">Quản Lý Danh Mục</a>
            </li>
            <li class="nav-item col-md-2">
                <a class="nav-link active" href="#">Quản Lý Sản Phẩm</a>
            </li>
            <li class="nav-item col-md-5">
                <a class="nav-link " href="../order/admin_order.php"> Quản Lí Đơn Hàng</a>
            </li>
            <li class="nav-item  col-md-3 d-flex" style="">
                <p class="nav-link bg-danger text-white"> Admin <?=$_SESSION["admin_name"] ?></p>
                <a style="text-decoration: none;" class=" nav-link" href="index.php?adminOut=true">Đăng Xuất</a>

            </li>
        </ul>


    </div>


    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Quản Lý Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <a href="add.php">
                    <button class="btn btn-success" style="margin-bottom: 15px;">Thêm Sản Phẩm</button>
                </a>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="50px">STT</th>
                            <th>Hình Ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá Bán</th>
                            <th>Danh Mục</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Cập Nhật</th>
                            <th width="50px"></th>
                            <th width="50px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//Lay danh sach danh muc tu database
$limit = 10;
$page  = 1;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if ($page <= 0) {
	$page = 1;
}
$firstIndex = ($page-1)*$limit;

$sql         = 'select * from product ';
$productList = executeResult($sql);

$sql         = 'select count(id) as total from product where 1 ';
$countResult = executeSingleResult($sql);
$number      = 0;
if ($countResult != null) {
	$count  = $countResult['total'];
	$number = ceil($count/$limit);
}

$index = 1;
foreach ($productList as $item) {
	$sql         = 'select  * from category where id = '.$item['id_category'];
	$cateList = executeSingleResult($sql);


	

?>

                        <tr>
                            <td><?=(++$firstIndex)?></td>
                            <td><img src="../../uploads/<?=$item['avatar']?>" style="max-width: 100px" /></td>
                            <td style="text-transform: capitalize;"><?=$item['title']?></td>
                            <td><?=$item['price']?></td>



                            <td><?=$cateList['name']?></td>
                            <td style="text-transform: capitalize"><?=$item['status']?></td>
                            <td><?=$item['created_at']?></td>

                            <td>
                                <a href="add.php?id=<?=$item['id']?>"><button class="btn btn-warning">Sửa</button></a>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteProduct(<?=$item['id']?>)">Xoá</button>
                            </td>
                        </tr>


                        <?php } ?>



                    </tbody>
                </table>
                <!-- Bai toan phan trang -->
                <?=paginarion($number, $page, '')?>
            </div>
        </div>
    </div>



    <script type="text/javascript">
    function deleteProduct(id) {
        var option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
        if (!option) {
            return;
        }

        console.log(id)
        //ajax - lenh post
        $.post('ajax.php', {
            'id': id,
            'action': 'delete'
        }, function(data) {
            location.reload()
        })
    }
    </script>







</body>

</html>
