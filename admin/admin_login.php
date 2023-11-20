<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Document</title>
</head>
<body  >

<div class="container   " style="margin-top: 200px; " >
<div class="row">
    

<?php
require_once("../db/config.php");
		$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die ('Lỗi kết nối'); 
		mysqli_set_charset($conn, "utf8");

		// Dùng isset để kiểm tra Form
		if(isset($_POST['login'])){
    $sql = "INSERT INTO admin_account (userName, password) VALUES ('$userName','$password')";
		
		$userName = addslashes($_POST['userName']);
		$password = addslashes($_POST['password']);
	
	
	
		$sql = "SELECT * FROM admin_account WHERE  userName ='$userName' && password ='$password' "  ;
		
		// Thực thi câu truy vấn
		$result = mysqli_query($conn, $sql);
		
		// Nếu kết quả trả về lớn hơn 1 thì nghĩa là userName hoặc email đã tồn tại trong CSDL
		if (mysqli_num_rows($result) > 0)
		{
			require_once ('../db/dbhelper.php');
		$query="SELECT id,name FROM admin_account WHERE userName ='$userName'"	;
		$product = executeSingleResult($query);



	
	session_start();
	$_SESSION["admin_name"] = $product['name'];


	
	echo '  '.$_SESSION["admin_name"].'
    <script language="javascript">alert("Đăng Nhập Thành Công !");window.location="index.php";</script>';

		// Dừng chương trình
		die ();
		}

		else {
	
		echo '<script language="javascript">alert("Sai Tài Khoản hoặc mật khẩu"); window.location="admin_login.php";</script>';
		
	
		}
		}
	
	?>


   <div class="col-md-3"></div>
<form  method="POST" class=" col-md-6  bg-dark text-white rounded   p-2" >



    <h1 class="text-center">Đăng Nhập Admin</h1>

  <div class="mb-3">
    <label  class="col-form-label">Tài Khoản:</label><br>
    <input type="text" id="user_name" name="userName" class="form-control" >
  </div>
  <div class="mb-3">
    <label  class="col-form-label">Mật Khẩu:</label><br>
    <input type="password" id="password" name="password" class="form-control">
    
  </div>


  <button type="submit" name="login" class="btn btn-primary " style="float: right;margin-right:10px ;">Đăng Nhập</button>

  


     
     

</form>
<div class="col-md-3"></div>

</div>

</div>

     


        
</body>
</html>