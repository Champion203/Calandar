<?php
	session_start();
	require('ConnectDatabase.php'); 
	$stmt = "SELECT * FROM Agenda";
	$query = sqlsrv_query($conn, $stmt);

	$sql2 = "SELECT * FROM Reserve_Room WHERE Status_Reserve LIKE 'approve'";
	if (isset($_POST['Ref_Room_id'])){
	$nameroom = $_POST['Ref_Room_id'];
	$sql2 = "SELECT * FROM Reserve_Room WHERE Status_Reserve LIKE 'approve' AND Name_Room LIKE '%$nameroom%'";
	}
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_query( $conn, $sql2 , $params, $options );
	$row_count = sqlsrv_num_rows( $stmt );

	$result2 = sqlsrv_query($conn, $sql2);

	if ($row_count > 0) {
	
	$events = [];		
	$i = 1;
	while($result = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)) {
		
		$start = str_replace("T"," ",$result['Start_Reserve']);
		$end = str_replace("T"," ",$result['End_Reserve']);

		$events[] = [
		'id' => $result['ID_Reserve'],
		'title' => $result['Name_Room'],
		'start' => $start,
		'end' => $end,
				];
		$i++;
		echo $_POST['Ref_Room_id'];
	}
	}
	// $sql1 = "SELECT * FROM Reserve_Room";
	// $params = array();
	// $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	// $stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
	// $row_count = sqlsrv_num_rows( $stmt );

	// $result1 = sqlsrv_query($conn, $sql1);
	
	// $resource = [];
		
	// if ($row_count > 0) {
		
	// 	while($result = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) {
			
	// 		 $resource[] = [ 'id' => $result['ID_Reserve'] , 'title' => $result['Name_Room']];
	// 	}
	
	// }
	// $sql2 = "SELECT * FROM Reserve_Room WHERE Status_Reserve LIKE 'approve'";
	// $params = array();
	// $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	// $stmt = sqlsrv_query( $conn, $sql2 , $params, $options );
	// $row_count = sqlsrv_num_rows( $stmt );
	
	// $result2 = sqlsrv_query($conn, $sql2);

	// if ($row_count > 0) {
		
	// 	$events = [];		
	// 	$i = 1;
	// 	while($result = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)) {
			
	// 		$start = str_replace("T"," ",$result['Start_Reserve']);
    //         $end = str_replace("T"," ",$result['End_Reserve']);

	// 		$events[] = [
	// 		   'id' => $result['ID_Reserve'],
	// 		   'title' => $result['Name_Room'],
	// 		   'start' => $start,
	// 		   'end' => $end,
    //             ];
    //     $i++;
	// 	}
	// }
	// sqlsrv_close($conn);
	
	// if(isset($_GET['resource'])){
	// 	echo json_encode($resource);
	// }
	// echo json_encode($events);

	// if(isset($_GET['events'])){
	// 	echo json_encode($events);
	// }
	
?>