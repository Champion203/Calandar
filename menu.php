<?php
session_start();
require('ConnectDatabase.php'); 
    if (isset($_SESSION['email'])){
        $username = $_SESSION['email'] ;
    }

$sql = "SELECT * FROM Admin WHERE Username = '$username' AND Class = 'SuperAdmin'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows( $stmt );

$sql = "SELECT * FROM Admin WHERE Username = '$username' AND Class = 'Admin'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count2 = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";

if ($row_count === 1){
    require ('sidebar.php');
}elseif ($row_count2 === 1){
    require ('sidebar3.php');
}else {
    require ('sidebar2.php');
}
?>