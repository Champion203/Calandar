<?php
    session_start();
    require('ConnectDatabase.php'); 
    require ('navbar.php');
    $sql = "DELETE FROM Reserve_Room
				WHERE ID_Reserve = ? ";
	$params = array($_GET['del']);

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
            title: 'ลบเรียบร้อย',
            showConfirmButton: false,
            timer: 1500, });
            setTimeout(function(){
                window.location.href = 'dasboard_user.php';
             },1500);
        </script>";
	}

	sqlsrv_close($conn);
?>