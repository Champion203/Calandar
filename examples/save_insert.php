
<?php
    session_start();
    require ('Header.html'); 
    require ('navbar.php');
    require('ConnectDatabase.php'); 
	$sql = "INSERT INTO Reserve_Room (ID_Reserve, FullName, department, organization, email, Name_Room, Start_Reserve, End_Reserve, Detail, Status_Reserve)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $Status = "wait";
    function random_strings($length_of_string) 
    { 
    $str= '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    //คำสั่งจัดเรียงลำดับตัวอักษรในข้อความแบบสุ่ม
    $str = str_shuffle($str);
    //ทำการตัด string ตามจำนวนที่ใส่เข้ามา
    $resultChar = substr($str, 0, $length_of_string); 
    return $resultChar;
    }

	$params = array(random_strings(6), $_SESSION['displayname_th'], $_SESSION['department'], $_SESSION['organization'], $_SESSION['email'], $_POST["Ref_Room_id"], $_POST["booking_start_date"], 
    $_POST["booking_end_date"], $_POST["detail"], $Status);

	$stmt = sqlsrv_query( $conn, $sql, $params);
	if( $stmt === false ) {
		 die( print_r( sqlsrv_errors(), true));
	}
	else
	{
        echo "
        <script>
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'บันทึกสำเร็จ',
            showConfirmButton: false,
            timer: 1500, });
            setTimeout(function(){
                window.location.href = 'index.php';
             },1500);
        </script>";
	}
	sqlsrv_close($conn);
?>