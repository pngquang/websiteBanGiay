<?php
require_once ('../../db/dbhelper.php');
session_start();
if (empty($_SESSION["admin_name"])){
	header('Location: ../admin_login.php');
}

$id = $name ='';

if (isset($_GET['id'])) {
	$id       = $_GET['id'];
	$sql      = 'select * from category where id = '.$id;
	$category = executeSingleResult($sql);
	if ($category != null) {
		$name = $category['name'];
	}
}
if (!empty($_POST)) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$name = str_replace('"', '\\"', $name);
		echo $name;
	}
	if (!empty($name)) {
		if ($id == '') {
			$sql =  '  INSERT INTO `category`(`name`) VALUES ("'.$name.'")' ;
			echo'insert';
		} else {
			$sql = 'update category set name = "'.$name.'"  where id = '.$id;
		}

		execute($sql);

		header('Location: index.php');
		die();
	}
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Thêm/Sửa Danh Mục Sản Phẩm</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- summernote -->
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>

    <ul class="nav nav-tabs row">
        <li class="nav-item col-md-2">
            <a class="nav-link " href="../category/">Quản Lý Danh Mục</a>
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
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm/Sửa Danh Mục Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">

                        <label for="name">Tên Danh Mục:</label>
                        <input type="text" name="id" value="<?=$id?>" hidden="true">

                        <input required="true" type="text" class="form-control" id="name" name="name" value="<?=$name?>">
                    </div>
                    <button class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/anh.nguyenthao.98" role="button"><i class="fab fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

                <!-- Google -->
                <a class="btn btn-outline-light btn-floating m-1" href="nhatnguyen061003@gmail.com" role="button"><i class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

                <!-- Github -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © Code by:
            <a class="text-white" href="">Coder </a>
        </div>
        <!-- Copyright -->
    </footer>
    <script type="text/javascript">
    function updateIcon() {
        $('#img_icon').attr('src', $('#icon').val())
    }

    $(function() {
        //doi website load noi dung => xu ly phan js
        $('#img_header').summernote({
            height: 50
        });
    });
    </script>
</body>

</html>
