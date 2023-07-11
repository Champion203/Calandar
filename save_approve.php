
<?php
    session_start();
    require('ConnectDatabase.php'); 
    require ('navbar.php');

    if(isset($_POST["ID"])){
        $Status = $_POST["Status"] ;
        $Comment = $_POST["Comment"] ;
        $ID = $_POST["ID"] ;
    }

	$sql = "UPDATE Reserve_Room SET 
				Status_Reserve = ? 
				WHERE ID_Reserve = ? ";
	$params = array($Status, $ID);

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