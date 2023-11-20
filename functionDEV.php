<?php
require_once ('config.php');

/**
 * Su dung cho lenh: insert/update/delete
 */
function execute($sql) {
	// Them du lieu vao database
	//B1. Mo ket noi toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn, 'utf8');

	//B2. Thuc hien truy van insert
	if(mysqli_query($conn, $sql)){
		$id_insert = mysqli_insert_id($conn);
	}

	//B3. Dong ket noi database
	mysqli_close($conn);
}
/**
 * Su dung cho lenh: select
 */
function executeResult($sql, $isSingle = false) {
	// Them du lieu vao database
	//B1. Mo ket noi toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn, 'utf8');

	//B2. Thuc hien truy van insert
	$resultset = mysqli_query($conn, $sql);
	$data      = [];


	if($isSingle) {
		$data = mysqli_fetch_array($resultset, 1);
	} else {
		while (($row = mysqli_fetch_array($resultset, 1)) != null) {
			$data[] = $row;
		}
	}

	//B3. Dong ket noi database
	mysqli_close($conn);

	return $data;
}

function executeSingleResult($sql) {
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$row    = mysqli_fetch_array($result, 1);

	//close connection
	mysqli_close($con);

	return $row;
}

