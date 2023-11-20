<?php
require_once('../../db/dbhelper.php');
session_start();
if (empty($_SESSION["admin_name"])) {
  header('Location: ../admin_login.php');
}

$id = $price = $price_old = $title = $thumbnail =  $content = $id_category = $mass = $status = '';
if (isset($_GET['id'])) {
  $id      = $_GET['id'];
  $sql     = 'select * from product where id = ' . $id;
  $product = executeSingleResult($sql);
  if ($product != null) {
    $title       = $product['title'];
    $price       = $product['price'];

    $thumbnail_get   = $product['avatar'];
    $id_category = $product['id_category'];
    $content     = $product['content'];
    $status      = $product['status'];
  }
}

if (!empty($_POST)) {
  if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $title = str_replace('"', '\\"', $title);
  }
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }
  if (isset($_POST['price'])) {
    $price = $_POST['price'];
    $price = str_replace('"', '\\"', $price);
  }
  if (isset($_POST['mass'])) {
    $mass = $_POST['mass'];
    $mass = str_replace('"', '\\"', $mass);
  }
  if (isset($_POST['price_old'])) {
    $price_old = $_POST['price'];
    $price_old = str_replace('"', '\\"', $price);
  }


  if (isset($_FILES['thumbnail'])) {
    $thumbnail = $_FILES['thumbnail'];


    if ($thumbnail['name'] == "") {
      $thumbnail_name = $thumbnail_get;
    } else {
    $thumbnail_name = $thumbnail['name'];
     

      move_uploaded_file($thumbnail['tmp_name'], '../../uploads/' . $thumbnail_name);
    }
  }






  if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $status = str_replace('"', '\\"', $status);
  }
  if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $content = str_replace('"', '\\"', $content);
  }
  if (isset($_POST['id_category'])) {
    $id_category = $_POST['id_category'];
  }

  if (!empty($title)) {
    $created_at  = date('Y-m-d H:s:i');
    //Luu vao database
    if ($id == '') {
      $sql = "INSERT INTO `product`( `avatar`, `title`, `price`, `id_category`, `created_at`, `status`, `content`)
			VALUES
		   
		   ('$thumbnail_name',  '$title',  '$price', '$id_category', '$created_at'  ,   '$status' ,   '$content' )";
    } else {
      $sql = 'update product set title = "' . $title . '",  avatar = "' . $thumbnail_name . '", price = "' . $price . '",  content = "' . $content . '", id_category = "' . $id_category . '", status="' . $status . '" where id = ' . $_GET['id'];
    }


    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, 'utf8');

    if (mysqli_query($conn, $sql)) {
      $last_id = mysqli_insert_id($conn);
    }
    echo '<script type="text/javascript">alert(' . $last_id . ');</script>';


    if (!empty($_POST['cate_list'])) {


      foreach ($_POST['cate_list'] as $check) {
        if(empty($_GET['id'])){

          $sq1l = "insert into size (id_pro,id_sizeName) values ('$last_id', '$check')";
        }
        else{
            $sql = "select * from size where id_sizeName = ".$check;
            $size_test = executeSingleResult($sql);
            if(empty($size_test)){
          $sq1l = "insert into size (id_pro,id_sizeName) values ('$id', '$check')";

            }
            else   $sq1l = "insert into size (id_pro,id_sizeName) values ('0', '$check')";

         
        }

        execute($sq1l);
        echo $check;
        echo '</br>';
      }
    }


    
  if (isset($_FILES['images'])) {

    $images = array_filter($_FILES['images']['name']);


    $total = count($_FILES['images']['name']);

    for( $i=0 ; $i < $total ; $i++ ) {

      $tmpFilePath = $_FILES['images']['tmp_name'][$i];


      if ($tmpFilePath != ""){
        //Setup our new file path
        $images_name = $_FILES['images']['name'][$i];

        $newFilePath = "../../uploads/" .$images_name;
    
      

        //Upload the file into the temp dir
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
    
          $sql2 = "insert into tb_images (id_pro			,image_name) values ('$last_id', '$images_name')";
          execute($sql2);
    
        }
      }
    }



}


    header('Location: index.php');
    die();
  }
}


?>
<?php

if (isset($_GET['logout_admin'])) {

  session_destroy();
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Thêm/Sửa Sản Phẩm</title>
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
                <p class="nav-link bg-danger text-white"> Admin <?= $_SESSION["admin_name"] ?></p>
                <a style="text-decoration: none;" class=" nav-link" href="index.php?adminOut=true">Đăng Xuất</a>

            </li>
        </ul>


    </div>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm/Sửa Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Tên Sản Phẩm:</label>
                        <input type="text" name="id" value="<?= $id ?>" hidden="true">
                        <input required="true" type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Chọn Danh Mục:</label>
                        <select class="form-control" name="id_category" id="id_category">
                            <option>-- Lụa chọn danh mục --</option>
                            <?php
              $sql          = 'select * from category';
              $categoryList = executeResult($sql);

              foreach ($categoryList as $item) {
                if ($item['id'] == $id_category) {
                  echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
                } else {
                  echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                }
              }
              ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Tình Trạng:</label>
                        <input style="text-transform: capitalize" class="form-control" name="status" id="status" value="<?= $status ?>"></input>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá Bán:</label>
                        <input required="true" type="number" class="form-control" id="price" name="price" value="<?= $price ?>">
                    </div>

                    <!-- <?php
          //  if (empty($_GET['id'])) {
             
             ?>
            <div class="row justify-content-center">
              <div class="col-md-12 col-lg-10 col-12">
                <label for="last-name">Size :</label>
                </br>

                <div class="row">
                  <?php
                  $sql = "select * from  sizeName";
                  $cateList = executeResult($sql);


                  $num = 0;

                  $checked = "";
                  $onclick_delete = "";
                  foreach ($cateList as $item) {
                    if(!empty($_GET['id'])){

                    
                  $sql = "select * from  size where id_pro = ".$_GET['id']."   && id_sizeName =   ".$item['id']." ";
                  $size_list = executeSingleResult($sql);
                  

                    $num++;
                    if(!empty($size_list)){
                      $checked = "checked";

                      
                      $onclick_delete   = ' deleteSize('.$item['id'].', '.$_GET['id'].')';


                    }
                    else $onclick_delete = $checked = "";
                  }

                    echo '
                                    <div class="col-lg-2 col-3">
                                    <div class="form-check form-switch">
          <input class="form-check-input" value="' . $item['id'] . '" name="cate_list[]" type="checkbox" '.$checked.'  onclick="'.$onclick_delete.'" id="flexSwitchCheckDefault' . $item['id'] . '">
          <label class="form-check-label" for="flexSwitchCheckDefault' . $item['id'] . '">' . $item['name'] . '</label>
          </div>
        </div>
                                    ';
                    if ($num == 2) {
                      echo '</br>';
                      $num = 0;
                    }
                  }
                  ?>
                </div>
              </div>
            </div>

          <?php
        //  }  
          ?> -->




                    <div class="form-group">
                        <label for="thumbnail">Ảnh bìa:</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                        <?php if (isset($_GET['id'])) {
              echo ' 
					<img src="../../uploads/' . $thumbnail_get . '" style="max-width: 200px" > 
					';
            }
            ?>
                    </div>

                    <tr>
                        <td align="right" class="ver-top"><label>Ảnh Kèm Theo:</label></td>
                        <td colspan="3">
                            <input id="album" class="form-control file" type="file" name="images[]" data-max-file-count="15" accept="image/*" multiple="multiple">
                        </td>
                    </tr>

                    <div class="form-group">
                        <label for="content">Nội Dung:</label>
                        <textarea class="form-control" rows="5" name="content" id="content"><?= $content ?></textarea>
                    </div>
                    <button class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>
    </div>












    <script type="text/javascript">
    function deleteSize(id_sizeName, id_pro) {
        var option = confirm('Bạn có chắc chắn muốn bỏ chọn size này không?')
        if (!option) {
            return;
        }

        console.log(id_sizeName, id_pro)
        //ajax - lenh post
        $.post('ajax.php', {
            'id_sizeName': id_sizeName,
            'id_pro': id_pro,
            'action': 'deleteSize'
        }, function(data) {
            location.reload()
        })
    }
    </script>











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
            <a class="text-white" href="">Coder</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script type="text/javascript">
    function updateThumbnail() {
        $('#img_thumbnail').attr('src', $('#thumbnail').val())
    }

    $(function() {
        //doi website load noi dung => xu ly phan js
        $('#content').summernote({
            height: 350
        });
    });
    </script>
</body>

</html>
