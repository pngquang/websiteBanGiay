<?php
require_once ('config.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * Su dung cho lenh: insert/update/delete
 */
function execute($sql) {
	// Them du lieu vao database
	//B1. Mo ket noi toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn, 'utf8');

	//B2. Thuc hien truy van insert
	mysqli_query($conn, $sql);

	//B3. Dong ket noi database
	mysqli_close($conn);
}
/**
 * Su dung cho lenh: select
 */
function executeResult($sql, $isSingle = false) {
	// Them du lieu vao database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn, 'utf8');

	
	$resultset = mysqli_query($conn, $sql);
	$data      = [];


	if($isSingle) {
		$data = mysqli_fetch_array($resultset, 1);
	} else {
		while (($row = mysqli_fetch_array($resultset, 1)) != null) {
			$data[] = $row;
		}
	}

	mysqli_close($conn);

	return $data;
}

function executeSingleResult($sql) {
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	
	mysqli_set_charset($con, 'utf8');

	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$row    = mysqli_fetch_array($result, 1);

	//close connection
	mysqli_close($con);

	return $row;
}

function date_time($value)
{
    $fcDate = date("m/d/Y", time());
    $vlDate = date("m/d/Y", $value);

    $fcTime_g = date("G", time());
    $fcTime_i = date("i", time());
    $fcTime_s = date("s", time());

    $vlTime_g = date("G", $value);
    $vlTime_i = date("i", $value);
    $vlTime_s = date("s", $value);
    $echo = "";
    $time = 0;

    if ($vlDate == $fcDate) {

        
        if ($fcTime_g == $vlTime_g) {
     
            if ($fcTime_i == $vlTime_i) {
                if ($fcTime_s == $vlTime_s) {
                    $echo =  "$time giây trước";

                } else {
                    $time =   $fcTime_s - $vlTime_s ; 
                     $echo =   " $time giây trước";
                }
            } else   {
                $time = $fcTime_i - $vlTime_i ; 
                $echo=  "$time phút trước";
            }
        } else {
            $time = $fcTime_g - $vlTime_g ; $echo =   " $time giờ trước";
        }


    } else $echo = $vlDate;

   
    return $echo;
}
