<?php
$server = "172.18.80.1";
$connectionInfo = array( "Database"=>"TESTDB", "UID"=>"sa", "PWD"=>"P@ssw0rd" );
$conn = sqlsrv_connect( $server, $connectionInfo );

$sql = "SELECT * FROM Reserve_Room";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
else
   echo $row_count;
?>