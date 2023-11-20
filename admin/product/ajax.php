<?php
require_once ('../../db/dbhelper.php');
session_start();


if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['id'])) {
					$id = $_POST['id'];

					$sql = 'delete from product where product.id = '.$id;
					execute($sql);
				}
				break;
				case 'deleteSize':
					if (isset($_POST['id_sizeName'])) {
						$id_sizeName = $_POST['id_sizeName'];
					}
					if (isset($_POST['id_pro'])) {
						$id_pro = $_POST['id_pro'];
					}
					
						$sql = 'delete from size where id_pro = '.$id_pro.' && id_sizeName = '.$id_sizeName.' ';
						execute($sql);
					break;
	
	



		}
	}
}