<?php
require_once ('../../db/dbhelper.php');
// session_start();
// if (empty($_SESSION["admin_name"])){
// 	header('Location: ../admin_login.php');
// }
$id = '';
if (isset($_GET['id'])) {
	$id       = $_GET['id'];
	$sql      = 'select * from category where id = '.$id;
	$category = executeSingleResult($sql);
	if ($category != null) {
		$name = $category['name'];
    $icon = $category['icon'];
	
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Category Page - <?=$name?></title>
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
	<div class="container" >
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center"><?=$name?></h2>
			</div>
			<div class="panel-body">
				<div class="row">
<?php
$sql         = 'select product.id, product.title, product.price, product.thumbnail, product.updated_at, category.name category_name from product left join category on product.id_category = category.id where category.id = '.$id;
$productList = executeResult($sql);

foreach ($productList as $item) {
	echo '<div class="col-lg-3">
				<a href="detail.php?id='.$item['id'].'"><img src="'.$item['thumbnail'].'" style="width: 100%"></a>
        
				<a style="text-decoration: none;" href="detail.php?id='.$item['id'].'">'.$item['title'].'</a>
				<p style="color: red; font-weight: bold;">'.$item['price'].'</p>
			</div>';
}
?>
				</div>
			</div>
		</div>
	</div>

	<footer class="bg-dark text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/anh.nguyenthao.98" role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="nhatnguyen061003@gmail.com" role="button"
        ><i class="fab fa-google"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-linkedin-in"></i
      ></a>

      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-github"></i
      ></a>
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

</body>
</html>