<?php
session_start();
require_once('db/dbhelper.php');

if (!empty($_POST['action'])) $action = $_POST['action'];
if (!empty($_POST['num'])) $num = $_POST['num'];
if (!empty($_POST['id'])) $id = $_POST['id'];
if (!empty($_POST['name'])) $name = $_POST['name'];
if (!empty($_POST['phone'])) $phone = $_POST['phone'];
if (!empty($_POST['address'])) $address = $_POST['address'];
if (!empty($_POST['content'])) $content = $_POST['content'];
if (!empty($_POST['user_name'])) $user_name = $_POST['user_name'];
if (!empty($_POST['password'])) $password = $_POST['password'];
if (!empty($_POST['price'])) $price = $_POST['price'];


switch ($action) {
    case 'add_to_cart':
        add_to_cart($id, $num);
        break;
    case 'reduce_cart':
        reduce_cart($id);
        break;

    case 'login':
        login($user_name, $password);
        break;

    case 'register':
        register($name, $user_name, $password);
        break;


    case 'checkout':
        checkout($name, $phone, $address, $content, $id, $price);
        break;
    case 'order4':
        order4($id);
        break;
    case 'logout':
        unset($_SESSION['id_user']);
        break;
}




function add_to_cart($id, $num)
{
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    $isFind = false;
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            $cart[$i]['num'] += $num;
            $isFind = true;
            break;
        }
    }
    if (!$isFind) {
        $product = executeResult('select * from product where id = ' . $id, true);
        $product['num'] = $num;


        $cart[] = $product;
    }
    $_SESSION['cart'] = $cart;
    var_dump($_SESSION['cart']);
}
function reduce_cart($id)
{
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            $cart[$i]['num']--;
            break;
        }
    }
    $_SESSION['cart'] = $cart;
}


function login($user_name, $password)
{
    $ar = array();
    $sql = "SELECT * FROM `tb_user` WHERE `username` LIKE '$user_name' AND `password` LIKE '$password'";
    $user = executeSingleResult($sql);
    if (!$user) {
        $ar['check'] = 0;
    } else {
        $ar['check'] = 1;
        $ar['name'] = $user['name'];
        $_SESSION['id_user'] = $user['id'];
    }

    echo json_encode($ar);
}

function register($name, $user_name, $password)
{
    $ar = array();
    $sql = "SELECT * FROM `tb_user` WHERE `username` LIKE '$user_name' ";
    $user = executeSingleResult($sql);
    if (empty($user)) {
        $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }
        $sql = "insert into tb_user (name, username, password) values ('$name', '$user_name', '$password')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $last_id = mysqli_insert_id($conn);

            $ar['check'] = 1;
            $ar['id'] = $last_id;
            $_SESSION['id_user'] = $last_id;
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }

        // Ngắt kết nối
        $conn->close();
    } else {
        $ar['check'] = 0;
    }

    echo json_encode($ar);
}


function  checkout($name, $phone, $address, $content, $id, $price)
{
    $order_date = time();





    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    $sql = "insert into orders (fullname, address,  phone_number, content, order_date,id_user, price, status )
    values 
   ('$name', '$address',  '$phone', '$content', '$order_date', '$id',  '$price', 'Chờ xác nhận')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $last_id = mysqli_insert_id($conn);

        $cart = [];
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }
        for ($i = 0; $i < count($cart); $i++) {
            $id_cart = $cart[$i]['id'];
            $num_cart = $cart[$i]['num'];
            $sql = "insert into order_details (order_id, product_id,  num )
            values 
           ('$last_id', '$id_cart','$num_cart')";
            execute($sql);
        }
        unset($_SESSION['cart']);
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Ngắt kết nối
    $conn->close();
}


function order4($id)
{
    $status = 'Đã nhận được hàng';
    echo  $status;
    echo  $id;
    $sql = 'update orders set status = "' . $status . '"  where id = ' . $id;
    execute($sql);
}
