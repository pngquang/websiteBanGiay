<?php
require_once ('../../db/dbhelper.php');
session_start();
// if (empty($_SESSION["admin_name"])){
// 	header('Location: ../admin_login.php');
// }

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];
		if (isset($_POST['status']))	$status = $_POST['status'];
		if (isset($_POST['id']))	$id = $_POST['id'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['id'])) {
					$id = $_POST['id'];
                    $sql = 'delete from orders where id = '.$id;
					execute($sql);
					$sql2 = 'delete from order_details where order_id = '.$id;
					execute($sql2);
					
				}
				break;

				case 'trade_order_status':
					$sql = 'update orders set status = "'.$status.'"  where id = '.$id;
						execute($sql);
					break;
		}
	}
}
