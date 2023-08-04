<?php
session_start();
require('ConnectDatabase.php'); 
    if (isset($_SESSION['email'])){
        $username = $_SESSION['email'] ;
    }

$sql = "SELECT * FROM Admin WHERE Username = '$username'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
if ($row_count === 1)
    require ('sidebar.php');
elseif ($row_count === 0)
    require ('sidebar2.php');
?>