<?php
    	$serverName = "172.25.112.1"; //172.30.208.1
        $userName = "sa";
        $userPassword = "P@ssw0rd";
        $dbName = "Reserve_Room";
    
        $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet" =>'UTF-8');
    
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
?>