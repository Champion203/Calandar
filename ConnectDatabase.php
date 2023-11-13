<?php
// $serverName = "10.20.64.151"; //172.30.208.1
// $userName = "sa";
// $userPassword = "P@ssw0rd";
// $dbName = "Reverse_Room";

$serverName = "10.13.112.246"; //10.12.233.3
$userName = "champ894";
$userPassword = "P@ssw0rd1";
$dbName = "ReserveRoom";

$connectionInfo = array("Database" => $dbName, "UID" => $userName, "PWD" => $userPassword, "MultipleActiveResultSets" => true, "CharacterSet" => 'UTF-8');

$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>