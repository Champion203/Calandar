
<?php
    session_start();
    require('ConnectDatabase.php'); 
    require ('navbar.php');
	$sql = "UPDATE Reserve_Room SET 
				Status_Reserve = ? ,
                Comment = ? 
				WHERE ID_Reserve = ? ";
	$params = array($_POST["Status"], $_POST["Comment"], $_POST["ID"]);

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
                window.location.href = 'DashboardAdmin.php';
             },1500);
        </script>";
        //header("Location:dasboard.php");
	}
	sqlsrv_close($conn);
?>