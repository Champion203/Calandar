<?php
	require ('ConnectDatabase.php');
	$sql1 = "SELECT * FROM Reserve_Room";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_query( $conn, $sql1 , $params, $options );
	$row_count = sqlsrv_num_rows( $stmt );

	$result1 = sqlsrv_query($conn, $sql1);
	
	$resource = [];
		
	if ($row_count > 0) {
		
		while($result = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) {
			
			 $resource[] = [ 'id' => $result['ID_Reserve'] , 'title' => $result['Name_Room']];
		}
	
	}
	$sql2 = "SELECT * FROM Reserve_Room WHERE Status_Reserve LIKE '%approve%'";
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_query( $conn, $sql2 , $params, $options );
	$row_count = sqlsrv_num_rows( $stmt );
	
	$result2 = sqlsrv_query($conn, $sql2);

	if ($row_count > 0) {
		
		$events = [];
		
		$i = 1;

		while($result = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)) {
			
			$start = str_replace(" ","T",$result['Time_Reserve']);
            $end = str_replace(" ","T",$result['Time_End']);

			$events[] = [
			   'id' => $result['ID_Reserve'],
			   'resourceId' => $result['ID_Reserve'],
			   'start' => $start,
			   'end' => $end,
			   'end' => $end,
			   'title' => $result['Name_Room'],
                        ];
        $i++;
		}
	}
	
	sqlsrv_close($conn);
	
	if(isset($_GET['resource'])){
		echo json_encode($resource);
	}
	
	if(isset($_GET['events'])){
		echo json_encode($events);
	}
	
?>