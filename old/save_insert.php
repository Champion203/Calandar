
<?php
    session_start();
    require ('Header.html'); 
    require ('navbar.php');
    require('ConnectDatabase.php'); 
	$sql = "INSERT INTO Reserve_Room (Name_Room, Time_Reserve, Time_End, Status_Reserve) VALUES (?, ?, ?, ?)";

	$params = array($_POST["sel1"], $_POST["booking_start_date"], $_POST["booking_end_date"], $_POST["detail"]);

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