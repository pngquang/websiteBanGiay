<?php
require_once ('../../db/dbhelper.php');
require_once ('../../common/utility.php');
session_start();
if (empty($_SESSION["admin_name"])){
	header('Location: ../admin_login.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản Lý Danh Mục</title>
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
                <a class="nav-link active" href="../category/">Quản Lý Danh Mục</a>
            </li>
            <li class="nav-item col-md-2">
                <a class="nav-link " href="../product/index.php">Quản Lý Sản Phẩm</a>
            </li>
            <li class="nav-item col-md-5">
                <a class="nav-link " href="../order/admin_order.php"> Quản Lí Đơn Hàng</a>
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
                <h2 class="text-center">Quản Lý Danh Mục</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="add.php">
                            <button class="btn btn-success" style="margin-bottom: 15px;">Thêm Danh Mục</button>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <form method="get">
                            <div class="form-group" style="width: 200px; float: right;">
                                <input type="text" class="form-control" placeholder="Searching..." id="s" name="s">
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="50px">STT</th>

                            <!-- <th>Biểu Tượng</th> -->
                            <th>Tên Danh Mục</th>
                            <th width="50px"></th>
                            <th width="50px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//Lay danh sach danh muc tu database
$limit = 9;
$page  = 1;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if ($page <= 0) {
	$page = 1;
}
$firstIndex = ($page-1)*$limit;

$s = '';
if (isset($_GET['s'])) {
	$s = $_GET['s'];
}

//trang can lay san pham, so phan tu tren 1 trang: $limit
$additional = '';

if (!empty($s)) {
	$additional = ' and name like "%'.$s.'%" ';
}
$sql = 'select * from category where 1 '.$additional.' limit '.$firstIndex.', '.$limit;

$categoryList = executeResult($sql);

$sql         = 'select count(id) as total from category where 1 '.$additional;
$countResult = executeSingleResult($sql);
$number      = 0;
if ($countResult != null) {
	$count  = $countResult['total'];
	$number = ceil($count/$limit);
}

foreach ($categoryList as $item) {
	echo '<tr>
	

				<td>'.(++$firstIndex).'</td>
			
				<td>	<a style="text-decoration: none; color: black;" href="category.php?id='.$item['id'].'"> '.$item['name'].'</a></td>
				
				<td>
					<a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
				</td>
				<td>
					<button class="btn btn-danger" onclick="deleteCategory('.$item['id'].')">Xoá</button>
				</td>
			</tr>';
}
?>
                    </tbody>
                </table>
                <!-- Bai toan phan trang -->
                <?=paginarion($number, $page, '&s='.$s)?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    function deleteCategory(id) {
        var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
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
