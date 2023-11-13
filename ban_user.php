<?php
session_start();
require('Header.html');
require('navbar.php');
require('ConnectDatabase.php');
$sql = "INSERT INTO Ban_User (Email, Baned)
            VALUES (?, ?)";

if (isset($_POST["Email"]) and ($_POST["Baned"])) {
    $Email = $_POST["Email"];
    $Baned = $_POST["Baned"];
}
$params = array($Email, $Baned);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "
    <script>
    Swal.fire({
    position: 'top-center',
    icon: 'success',
    title: 'บันทึกสำเร็จ',
    showConfirmButton: false,
    timer: 1500, });
    setTimeout(function(){
        window.location.href = 'baned.php';
        },1500);
    </script>";
}
sqlsrv_close($conn);
?>