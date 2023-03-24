<?php
    	$serverName = "172.18.80.1";
        $userName = "sa";
        $userPassword = "P@ssw0rd";
        $dbName = "TESTDB";
    
        $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet" =>'UTF-8');
    
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
        
?>