<?php

require('ConnectDatabase.php'); 


  if (isset($_POST['function']) && $_POST['function'] == 'Agenda') {
  	$ID = $_POST['ID'];
  	$stmt = "SELECT * FROM Building WHERE Agenda_id='$ID'";
  	$query = sqlsrv_query($conn, $stmt);
  	echo '<option value="" selected disabled>-กรุณาเลือกตึก-</option>';
  	while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
  		echo '<option value="'.$result['ID'].'">'.$result['Building'].'</option>';
  		
  	}
  }

  if (isset($_POST['function']) && $_POST['function'] == 'Building') {
  	$ID = $_POST['ID'];
  	$stmt = "SELECT * FROM Room1 WHERE Building_id='$ID'";
  	$query = sqlsrv_query($conn, $stmt);
  	echo '<option value="" selected disabled>-กรุณาเลือกห้อง-</option>';
  	while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
  		echo '<option value="'.$result['Room'].'">'.$result['Room'].'</option>';
  		
  	}
  }
?>